import time
import paho.mqtt.client as mqtt
import json
import subprocess
import mysql.connector
import argparse
import requests

# Pakai database local
DB_HOST = "localhost"  # Ganti dengan IP atau hostname MariaDB jika perlu
DB_PORT = "3306"  # Ganti dengan PORT MariaDB jika perlu
DB_USER = "root"  # Nama user yang sudah dibuat
DB_PASSWORD = ""  # Password yang digunakan saat membuat user
DB_NAME = "qos"  # Nama database yang telah dibuat

# MQTT Configuration
def get_mqtt_config(use_server=False):
    if use_server:
        # Pakai server prof
        return {
            "broker": "140.130.19.38",
            "port": 1883,
            "username": "std2024",
            "password": "Emna2024",
            "topic": "terima/qos/pi1"  # Ganti topic menjadi "terima/qos/pi2" di raspi kedua
        }
    else:
        # Pakai mosquitto
        return {
            "broker": "test.mosquitto.org",
            "port": 1883,
            "username": "",
            "password": "",
            "topic": "terima/qos/pi1"  # Ganti topic menjadi "terima/qos/pi2" di raspi kedua
        }

# Fungsi untuk menjalankan iPerf3 dan mengambil hasilnya
def run_iperf3():
    # Angka 2 menunjukkan detik pemrosessan pembacaan iperf3
    command = ["iperf3", "-c", "127.0.0.1", "-u", "-t", "2", "-J"]  # -u untuk UDP, -J untuk JSON output   
    try:
        result = subprocess.run(command, capture_output=True, text=True, check=True)
        return json.loads(result.stdout)
    except subprocess.CalledProcessError as e:
        print(f"Error menjalankan iPerf3: {e}")
        print(f"stderr: {e.stderr}")
        return None

# Fungsi untuk mengambil data QoS dari hasil iPerf3
def generate_qos_data():
    iperf_data = run_iperf3()
    if iperf_data and "error" not in iperf_data:
        try:
            bandwidth = iperf_data["end"]["sum_received"].get("bits_per_second", 0) / 1e6  # Convert to Mbps
            jitter = iperf_data["end"]["sum_received"].get("jitter_ms", 0)
            packet_loss = iperf_data["end"]["sum_received"].get("lost_packets", 0)
            latency = iperf_data["end"]["sum_received"].get("end", 0) * 1000

            return {
                "latency": round(latency, 18),
                "jitter": round(jitter, 18),
                "packet_loss": round(packet_loss, 18),
                "bandwidth": round(bandwidth, 18),
            }
        except KeyError as e:
            print(f"Error mengakses data iPerf3: {e}")
            return None
    else:
        print("Error dalam hasil iPerf3:", iperf_data.get("error", "Unknown error"))
        return None

# Fungsi untuk menyimpan data ke database
def save_to_database(data, raspi_id):
    try:
        connection = mysql.connector.connect(
            host=DB_HOST,
            user=DB_USER,
            port=DB_PORT,
            password=DB_PASSWORD,
            database=DB_NAME,
        )
        cursor = connection.cursor()
        
        # Format query sesuai dengan contoh
        query = f"""
            INSERT INTO data_raspi (raspi_id, bandwidth, latency, jitter, packet_loss)
            VALUES ({raspi_id}, {data['bandwidth']}, {data['latency']}, {data['jitter']}, {data['packet_loss']});
        """
        cursor.execute(query)
        connection.commit()
        print(f"Data berhasil disimpan ke database: {data}")
    except mysql.connector.Error as err:
        print(f"Error menyimpan data ke database: {err}")
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()

# Fungsi untuk menyimpan data ke API
def save_to_api(data, raspi_id):
    try:
        # Ganti URL sesuai dengan endpoint API yang digunakan
        api_url = "http://140.130.19.38:58130/api/api.php"
        payload = {
            "raspi_id": raspi_id,
            "bandwidth": data['bandwidth'],
            "latency": data['latency'],
            "jitter": data['jitter'],
            "packet_loss": data['packet_loss']
        }
        response = requests.post(api_url, json=payload)
        if response.status_code == 200:
            print(f"Data berhasil dikirim ke API: {data}")
        else:
            print(f"Error mengirim data ke API. Status code: {response.status_code}")
    except Exception as e:
        print(f"Error mengirim data ke API: {e}")

# Fungsi untuk mengirim data ke MQTT dan database/API
def send_qos_data(use_local_db=False, use_api=False, use_server=False, client_id=""):
    # Get MQTT configuration
    mqtt_config = get_mqtt_config(use_server)
    
    client = mqtt.Client(client_id=client_id)
    if mqtt_config["username"]:  # Only set credentials if username exists
        client.username_pw_set(mqtt_config["username"], mqtt_config["password"])
    client.connect(mqtt_config["broker"], mqtt_config["port"], 60)
    client.loop_start()

    print(f"Connected to MQTT broker {mqtt_config['broker']} with client ID: {client_id}")

    while True:
        data = generate_qos_data()
        if data:
            # Kirim data ke MQTT broker
            client.publish(mqtt_config["topic"], json.dumps(data))
            print(f"Data dikirim ke MQTT: {data}")

            # Simpan data ke database lokal atau API berdasarkan parameter
            if use_api:
                save_to_api(data, 1)  # Ganti raspi_id menjadi 2 di raspi kedua
            elif use_local_db:
                save_to_database(data, 1)  # Ganti raspi_id menjadi 2 di raspi kedua
            else:
                print("No storage method specified. Use --local for database or --api for API")
        else:
            print("Error dalam mengambil data QoS.")
        # Angka 2 menyesuaikan dari pembacaan iperf3
        time.sleep(2)

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description='QoS Data Collection Script')
    parser.add_argument('--local', action='store_true', help='Use local database instead of API')
    parser.add_argument('--api', action='store_true', help='Use API endpoint for data storage')
    parser.add_argument('--client', type=str, default="", help='MQTT client ID (e.g., --client="mq1")')
    
    # MQTT broker selection group
    mqtt_group = parser.add_mutually_exclusive_group(required=True)
    mqtt_group.add_argument('--server', action='store_true', help='Use professor server (140.130.19.38)')
    mqtt_group.add_argument('--mosquitto', action='store_true', help='Use Mosquitto test server (test.mosquitto.org)')
    
    args = parser.parse_args()
    
    send_qos_data(use_local_db=args.local, use_api=args.api, use_server=args.server, client_id=args.client)

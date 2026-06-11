<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

?>

<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>

  <!-- Grafik di dalam kolom Raspberry Pi 1 -->
  <div class="row">
    <!-- Kolom Raspberry Pi 1 -->
    <div class="col-12">
      <div class="card h-100">
        <div class="card-header">
          <h5 class="text-dark">Raspberry Pi 1</h5>
        </div>
        <div class="card-body p-0">
          <div class="row">
            <!-- Grafik Bandwidth -->
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card h-100">
                <div class="card-header pb-0">
                  <h6 class="text-dark">Bandwidth</h6>
                </div>
                <div class="card-body pt-0">
                  <canvas id="bandwidthChart" style="height:500px !important;"></canvas>
                </div>
              </div>
            </div>
            
            <!-- Grafik Latency -->
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card h-100">
                <div class="card-header pb-0">
                  <h6 class="text-dark">Latency</h6>
                </div>
                <div class="card-body pt-0">
                  <canvas id="latencyChart" style="height:500px !important;"></canvas>
                </div>
              </div>
            </div>
            
            <!-- Grafik Jitter -->
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card h-100">
                <div class="card-header pb-0">
                  <h6 class="text-dark">Jitter</h6>
                </div>
                <div class="card-body pt-0">
                  <canvas id="jitterChart" style="height:500px !important;"></canvas>
                </div>
              </div>
            </div>

            <!-- Grafik Packet Loss -->
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card h-100">
                <div class="card-header pb-0">
                  <h6 class="text-dark">Packet Loss</h6>
                </div>
                <div class="card-body pt-0">
                  <canvas id="packetLossChart" style="height:500px !important;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik di dalam kolom Raspberry Pi 2 -->
  <div class="row">
    <!-- Kolom Raspberry Pi 2 -->
    <div class="col-12">
      <div class="card h-100">
        <div class="card-header">
          <h5 class="text-dark">Raspberry Pi 2</h5>
        </div>
        <div class="card-body p-0">
          <div class="row">
            <!-- Grafik Bandwidth -->
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card h-100">
                <div class="card-header pb-0">
                  <h6 class="text-dark">Bandwidth</h6>
                </div>
                <div class="card-body pt-0">
                  <canvas id="bandwidthChart2" style="height:500px !important;"></canvas>
                </div>
              </div>
            </div>
            
            <!-- Grafik Latency -->
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card h-100">
                <div class="card-header pb-0">
                  <h6 class="text-dark">Latency</h6>
                </div>
                <div class="card-body pt-0">
                  <canvas id="latencyChart2" style="height:500px !important;"></canvas>
                </div>
              </div>
            </div>
            
            <!-- Grafik Jitter -->
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card h-100">
                <div class="card-header pb-0">
                  <h6 class="text-dark">Jitter</h6>
                </div>
                <div class="card-body pt-0">
                  <canvas id="jitterChart2" style="height:500px !important;"></canvas>
                </div>
              </div>
            </div>

            <!-- Grafik Packet Loss -->
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card h-100">
                <div class="card-header pb-0">
                  <h6 class="text-dark">Packet Loss</h6>
                </div>
                <div class="card-body pt-0">
                  <canvas id="packetLossChart2" style="height:500px !important;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik untuk Bandwidth Raspberry Pi 1
    const bandwidthCtx = document.getElementById('bandwidthChart').getContext('2d');
    const bandwidthChart = new Chart(bandwidthCtx, {
        type: 'line',
        data: {
            labels: [], // Label per 10 data
            datasets: [{
                label: 'Bandwidth (Raspberry Pi 1)',
                data: [], // Data kosong pada awalnya
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' Mbps';
                        }
                    }
                }
            }
        }
    });

    // Grafik untuk Latency Raspberry Pi 1
    const latencyCtx = document.getElementById('latencyChart').getContext('2d');
    const latencyChart = new Chart(latencyCtx, {
        type: 'line',
        data: {
            labels: [], // Label per 10 data
            datasets: [{
                label: 'Latency (Raspberry Pi 1)',
                data: [], // Data kosong pada awalnya
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' ms';
                        }
                    }
                }
            }
        }
    });

    // Grafik untuk Jitter Raspberry Pi 1
    const jitterCtx = document.getElementById('jitterChart').getContext('2d');
    const jitterChart = new Chart(jitterCtx, {
        type: 'line',
        data: {
            labels: [], // Label per 10 data
            datasets: [{
                label: 'Jitter (Raspberry Pi 1)',
                data: [], // Data kosong pada awalnya
                backgroundColor: 'rgba(255, 206, 86, 0.6)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' ms';
                        }
                    }
                }
            }
        }
    });

    // Grafik untuk Packet Loss Raspberry Pi 1
    const packetLossCtx = document.getElementById('packetLossChart').getContext('2d');
    const packetLossChart = new Chart(packetLossCtx, {
        type: 'line',
        data: {
            labels: [], // Label per 10 data
            datasets: [{
                label: 'Packet Loss (Raspberry Pi 1)',
                data: [], // Data kosong pada awalnya
                backgroundColor: 'rgba(153, 102, 255, 0.6)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' %';
                        }
                    }
                }
            }
        }
    });

    // Grafik untuk Bandwidth Raspberry Pi 2
    const bandwidthCtx2 = document.getElementById('bandwidthChart2').getContext('2d');
    const bandwidthChart2 = new Chart(bandwidthCtx2, {
        type: 'line',
        data: {
            labels: [], // Label per 10 data
            datasets: [{
                label: 'Bandwidth (Raspberry Pi 2)',
                data: [], // Data kosong pada awalnya
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' Mbps';
                        }
                    }
                }
            }
        }
    });

    // Grafik untuk Latency Raspberry Pi 2
    const latencyCtx2 = document.getElementById('latencyChart2').getContext('2d');
    const latencyChart2 = new Chart(latencyCtx2, {
        type: 'line',
        data: {
            labels: [], // Label per 10 data
            datasets: [{
                label: 'Latency (Raspberry Pi 2)',
                data: [], // Data kosong pada awalnya
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' ms';
                        }
                    }
                }
            }
        }
    });

    // Grafik untuk Jitter Raspberry Pi 2
    const jitterCtx2 = document.getElementById('jitterChart2').getContext('2d');
    const jitterChart2 = new Chart(jitterCtx2, {
        type: 'line',
        data: {
            labels: [], // Label per 10 data
            datasets: [{
                label: 'Jitter (Raspberry Pi 2)',
                data: [], // Data kosong pada awalnya
                backgroundColor: 'rgba(255, 206, 86, 0.6)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' ms';
                        }
                    }
                }
            }
        }
    });

    // Grafik untuk Packet Loss Raspberry Pi 2
    const packetLossCtx2 = document.getElementById('packetLossChart2').getContext('2d');
    const packetLossChart2 = new Chart(packetLossCtx2, {
        type: 'line',
        data: {
            labels: [], // Label per 10 data
            datasets: [{
                label: 'Packet Loss (Raspberry Pi 2)',
                data: [], // Data kosong pada awalnya
                backgroundColor: 'rgba(153, 102, 255, 0.6)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' %';
                        }
                    }
                }
            }
        }
    });

    // Fungsi untuk memperbarui grafik dengan data terbaru
    function updateCharts() {
        fetch('data.php')
            .then(response => response.json())
            .then(data => {
                // Ambil data untuk Raspberry Pi 1
                const raspi1_bandwidth = [];
                const raspi1_latency = [];
                const raspi1_jitter = [];
                const raspi1_packetloss = [];
                const raspi1_timestamps = [];

                // Ambil data untuk Raspberry Pi 2
                const raspi2_bandwidth = [];
                const raspi2_latency = [];
                const raspi2_jitter = [];
                const raspi2_packetloss = [];
                const raspi2_timestamps = [];

                // Memproses data Raspberry Pi 1
                data.raspi_1.reverse().forEach(item => {
                    raspi1_bandwidth.push(parseFloat(item.bandwidth));
                    raspi1_latency.push(parseFloat(item.latency));
                    raspi1_jitter.push(parseFloat(item.jitter));
                    raspi1_packetloss.push(parseFloat(item.packet_loss));
                    raspi1_timestamps.push(item.timestamp);
                });

                // Memproses data Raspberry Pi 2
                data.raspi_2.reverse().forEach(item => {
                    raspi2_bandwidth.push(parseFloat(item.bandwidth));
                    raspi2_latency.push(parseFloat(item.latency));
                    raspi2_jitter.push(parseFloat(item.jitter));
                    raspi2_packetloss.push(parseFloat(item.packet_loss));
                    raspi2_timestamps.push(item.timestamp);
                });

                // Update grafik Bandwidth Raspberry Pi 1
                bandwidthChart.data.labels = raspi1_timestamps;
                bandwidthChart.data.datasets[0].data = raspi1_bandwidth;
                bandwidthChart.update();

                // Update grafik Latency Raspberry Pi 1
                latencyChart.data.labels = raspi1_timestamps;
                latencyChart.data.datasets[0].data = raspi1_latency;
                latencyChart.update();

                // Update grafik Jitter Raspberry Pi 1
                jitterChart.data.labels = raspi1_timestamps;
                jitterChart.data.datasets[0].data = raspi1_jitter;
                jitterChart.update();

                // Update grafik Packet Loss Raspberry Pi 1
                packetLossChart.data.labels = raspi1_timestamps;
                packetLossChart.data.datasets[0].data = raspi1_packetloss;
                packetLossChart.update();

                // Update grafik Bandwidth Raspberry Pi 2
                bandwidthChart2.data.labels = raspi2_timestamps;
                bandwidthChart2.data.datasets[0].data = raspi2_bandwidth;
                bandwidthChart2.update();

                // Update grafik Latency Raspberry Pi 2
                latencyChart2.data.labels = raspi2_timestamps;
                latencyChart2.data.datasets[0].data = raspi2_latency;
                latencyChart2.update();

                // Update grafik Jitter Raspberry Pi 2
                jitterChart2.data.labels = raspi2_timestamps;
                jitterChart2.data.datasets[0].data = raspi2_jitter;
                jitterChart2.update();

                // Update grafik Packet Loss Raspberry Pi 2
                packetLossChart2.data.labels = raspi2_timestamps;
                packetLossChart2.data.datasets[0].data = raspi2_packetloss;
                packetLossChart2.update();
            })
            .catch(error => console.error('Error:', error));
    }

    // Update grafik setiap 2 detik
    setInterval(updateCharts, 2000);
</script>


<?php require_once '../layout/_bottom.php'; ?>
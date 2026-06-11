<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

// Query untuk mengambil data raspberry_pi, bandwidth, latency, jitter, dan packet_loss
$result = mysqli_query($connection, "
SELECT 
    d.data_raspi_id,
    r.raspi_id AS raspi_id,
    r.raspi_name AS raspi_name,
    d.bandwidth AS download_speed, 
    d.bandwidth AS upload_speed, 
    d.latency AS latency, 
    d.jitter AS jitter, 
    d.packet_loss AS packet_loss,
    d.created_at AS data_created_at, 
    d.updated_at AS data_updated_at  
FROM 
    raspi r
LEFT JOIN 
    data_raspi d ON r.raspi_id = d.raspi_id
WHERE 
    r.raspi_id = 2
ORDER BY 
    d.created_at DESC;  -- Urutkan berdasarkan kolom updated_at, dari yang terbaru

");

if (!$result) {
    die('Query Failed: ' . mysqli_error($connection));
}
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Raspberry Pi 2</h1>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-striped w-100" id="table-1">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Bandwidth</th>
                  <th>Latency</th>
                  <th>Jitter</th>
                  <th>Packet Loss</th>
                  <th>Data Created At</th>
                  <th style="width: 150">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($result)) :
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= round($data['download_speed'], 3) ?> Mbps</td>
                    <td><?= round($data['latency'], 3) ?> ms</td>
                    <td><?= round($data['jitter'], 3) ?> ms</td>
                    <td><?= round($data['packet_loss'], 3) ?> %</td>
                    <td><?= $data['data_created_at'] ?></td>
                    <td>
                      <a class="btn btn-sm btn-danger mb-md-0 mb-1" 
                         href="delete.php?raspi_id=<?= $data['raspi_id'] ?>&data_raspi_id=<?= $data['data_raspi_id'] ?>">
                         <i class="fas fa-trash fa-fw"></i>
                      </a>
                    </td>
                  </tr>
                <?php
                endwhile;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>

<!-- Page Specific JS File -->
<?php
if (isset($_SESSION['info'])) :
  if ($_SESSION['info']['status'] == 'success') {
?>
    <script>
      iziToast.success({
        title: 'Sukses',
        message: `<?= $_SESSION['info']['message'] ?>`,
        position: 'topCenter',
        timeout: 5000
      });
    </script>
  <?php
  } else {
  ?>
    <script>
      iziToast.error({
        title: 'Gagal',
        message: `<?= $_SESSION['info']['message'] ?>`,
        timeout: 5000,
        position: 'topCenter'
      });
    </script>
<?php
  }

  unset($_SESSION['info']);
  $_SESSION['info'] = null;
endif;
?>
<script src="../assets/js/page/modules-datatables.js"></script>

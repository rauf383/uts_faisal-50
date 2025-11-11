<?php
include_once("config.php");

$id = $_GET['id'];
$result = mysqli_query($mysqli, "SELECT * FROM alat WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if(isset($_POST['update'])) {
    $nama_alat = $_POST['nama_alat'];
    $serial_number = $_POST['serial_number']; // ✅ Tambahan kolom SN
    $tahun = $_POST['tahun'];
    $merek = $_POST['merek'];
    $lokasi = $_POST['lokasi'];
    $tanggal_kalibrasi = $_POST['tanggal_kalibrasi'];
    $status = $_POST['status'];

    // ✅ Update dengan serial_number
    $update = mysqli_query($mysqli, "UPDATE alat SET 
        nama_alat='$nama_alat',
        serial_number='$serial_number',
        tahun='$tahun',
        merek='$merek',
        lokasi='$lokasi',
        tanggal_kalibrasi='$tanggal_kalibrasi',
        status='$status' 
        WHERE id=$id");

    echo "<script>
      alert('✅ Data alat berhasil diperbarui!');
      window.location.href='index.php';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Alat</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
  <style>
    body { 
      background: #f8f9fa; 
      position: relative;
      min-height: 100vh;
      padding-bottom: 60px; /* ruang untuk footer */
      font-family: 'Segoe UI', sans-serif;
    }
    .container { 
      max-width: 600px; 
      margin-top: 40px; 
    }
    .card { 
      border-radius: 12px; 
      box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
    }
    h4 { 
      color: #0d6efd; 
    }
    /* ✅ Footer */
    .footer {
      position: absolute;
      bottom: 10px;
      width: 100%;
      text-align: center;
      color: #6c757d;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card p-4">
      <h4 class="mb-3 text-center">✏️ Edit Data Alat</h4>
      <form method="post">
        <div class="mb-3">
          <label>Nama Alat</label>
          <input type="text" name="nama_alat" class="form-control" value="<?= $data['nama_alat'] ?>" required>
        </div>

        <!-- ✅ Tambahan kolom Serial Number -->
        <div class="mb-3">
          <label>Serial Number (SN)</label>
          <input type="text" name="serial_number" class="form-control" value="<?= $data['serial_number'] ?>" required>
        </div>

        <div class="mb-3">
          <label>Tahun</label>
          <input type="number" name="tahun" class="form-control" value="<?= $data['tahun'] ?>" required>
        </div>
        <div class="mb-3">
          <label>Merek</label>
          <input type="text" name="merek" class="form-control" value="<?= $data['merek'] ?>" required>
        </div>
        <div class="mb-3">
          <label>Lokasi</label>
          <input type="text" name="lokasi" class="form-control" value="<?= $data['lokasi'] ?>" required>
        </div>
        <div class="mb-3">
          <label>Tanggal Kalibrasi</label>
          <input type="date" name="tanggal_kalibrasi" class="form-control" value="<?= $data['tanggal_kalibrasi'] ?>" required>
        </div>
        <div class="mb-3">
          <label>Status</label>
          <select name="status" class="form-select" required>
            <option value="Layak" <?= $data['status']=='Layak'?'selected':'' ?>>Layak</option>
            <option value="Tidak Layak" <?= $data['status']=='Tidak Layak'?'selected':'' ?>>Tidak Layak</option>
            <option value="Perlu Kalibrasi" <?= $data['status']=='Perlu Kalibrasi'?'selected':'' ?>>Perlu Kalibrasi</option>
          </select>
        </div>
        <button name="update" class="btn btn-success w-100">💾 Simpan Perubahan</button>
      </form>
      <a href="index.php" class="btn btn-link mt-3">← Kembali</a>
    </div>
  </div>
  
</body>
</html>
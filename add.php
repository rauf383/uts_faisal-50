<?php 
include_once("config.php");

if(isset($_POST['Submit'])) {
    $nama_alat = $_POST['nama_alat'];
    $serial_number = $_POST['serial_number']; // Tambahan SN
    $tahun = $_POST['tahun'];
    $merek = $_POST['merek'];
    $lokasi = $_POST['lokasi'];
    $tanggal_kalibrasi = $_POST['tanggal_kalibrasi'];
    $status = $_POST['status'];

    // Query dengan kolom serial_number
    $result = mysqli_query($mysqli, "INSERT INTO alat(nama_alat,serial_number,tahun,merek,lokasi,tanggal_kalibrasi,status)
        VALUES('$nama_alat','$serial_number','$tahun','$merek','$lokasi','$tanggal_kalibrasi','$status')");

    echo "<script>
      alert('✅ Data alat berhasil ditambahkan!');
      window.location.href='index.php';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Alat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    /* ✅ Tambahan footer */
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
      <h4 class="mb-3 text-center">🩺 Tambah Alat Baru</h4>
      <form action="add.php" method="post">
        <div class="mb-3">
          <label>Nama Alat</label>
          <input type="text" name="nama_alat" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Serial Number (SN)</label>
          <input type="text" name="serial_number" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Tahun</label>
          <input type="number" name="tahun" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Merek</label>
          <input type="text" name="merek" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Lokasi</label>
          <input type="text" name="lokasi" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Tanggal Kalibrasi</label>
          <input type="date" name="tanggal_kalibrasi" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Status</label>
          <select name="status" class="form-select" required>
            <option value="Layak">Layak</option>
            <option value="Tidak Layak">Tidak Layak</option>
            <option value="Perlu Kalibrasi">Perlu Kalibrasi</option>
          </select>
        </div>
        <button type="submit" name="Submit" class="btn btn-primary w-100">Tambah Alat</button>
      </form>
      <a href="index.php" class="btn btn-link mt-3">← Kembali</a>
    </div>
  </div>

</body>
</html>
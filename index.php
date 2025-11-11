<?php 
include_once("config.php");

// Pencarian
$search = "";
if(isset($_GET['search'])) {
  $search = $_GET['search'];
  $result = mysqli_query($mysqli, "SELECT * FROM alat WHERE nama_alat LIKE '%$search%' OR serial_number LIKE '%$search%' ORDER BY id DESC");
} else {
  $result = mysqli_query($mysqli, "SELECT * FROM alat ORDER BY id DESC");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Alat Kesehatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f5f8fa;
      font-family: 'Segoe UI', sans-serif;
      position: relative;
      min-height: 100vh;
      padding-bottom: 60px; /* beri ruang untuk footer */
    }
    .navbar {
      background: #007bff;
    }
    .navbar-brand {
      color: white;
      font-weight: bold;
    }
    .card {
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    th {
      background-color: #007bff;
      color: white;
    }
    /* ✅ Tambahan untuk copyright */
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
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">Selamat Datang Di Sistem Monitoring Alat</a>
      <div class="ms-auto">
        <a href="add.php" class="btn btn-light btn-sm">+ Tambah Alat</a>
        <!-- ✅ Tambahkan konfirmasi logout -->
        <a href="logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="card p-4">
      <h4 class="mb-3">📋 Daftar Alat Kesehatan</h4>

      <!-- Form Pencarian -->
      <form method="GET" class="mb-3">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Cari alat berdasarkan nama atau SN..." value="<?= htmlspecialchars($search) ?>">
          <button class="btn btn-primary">Cari</button>
        </div>
      </form>

      <table class="table table-bordered table-hover align-middle">
        <tr class="text-center">
          <th>No</th>
          <th>Nama Alat</th>
          <th>Serial Number</th>
          <th>Tahun</th>
          <th>Merek</th>
          <th>Lokasi</th>
          <th>Tgl Kalibrasi</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while($user_data = mysqli_fetch_array($result)) {
          $status_color = ($user_data['status'] == 'Layak') ? 'success' : (($user_data['status'] == 'Perlu Kalibrasi') ? 'warning' : 'danger');
          echo "<tr>";
          echo "<td>".$no++."</td>";
          echo "<td>".$user_data['nama_alat']."</td>";
          echo "<td>".$user_data['serial_number']."</td>";
          echo "<td>".$user_data['tahun']."</td>";
          echo "<td>".$user_data['merek']."</td>";
          echo "<td>".$user_data['lokasi']."</td>";
          echo "<td>".$user_data['tanggal_kalibrasi']."</td>";
          echo "<td class='text-center'><span class='badge bg-$status_color'>".$user_data['status']."</span></td>";
          echo "<td class='text-center'>
                <a href='edit.php?id=$user_data[id]' class='btn btn-warning btn-sm'>Edit</a> 
                <a href='delete.php?id=$user_data[id]' class='btn btn-danger btn-sm' onclick='return confirm(\"Hapus data alat ini?\")'>Hapus</a>
                </td>";
          echo "</tr>";
        }
        ?>
      </table>
    </div>
  </div>

</body>
</html>
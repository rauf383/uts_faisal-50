
<?php
include_once("config.php");

$id = $_GET['id'];

if(isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    mysqli_query($mysqli, "DELETE FROM alat WHERE id=$id");
    echo "<script>
      alert('Data alat berhasil dihapus!');
      window.location.href='index.php';
    </script>";
} else {
    echo "<script>
      if(confirm('Apakah kamu yakin ingin menghapus data ini?')) {
        window.location.href='delete.php?id=$id&confirm=yes';
      } else {
        window.location.href='index.php';
      }
    </script>";
}
?>
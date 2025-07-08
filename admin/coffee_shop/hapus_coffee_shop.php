<html>
    <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>
<?php
session_start();
include "../../config/koneksi.php";
if (isset($_GET['id_coffee'])) {
    $id = $_GET['id_coffee'];

    // Hindari SQL Injection (walaupun tidak pakai stmt, minimal sanitasi ID)
    $id = intval($id); // Ubah ke integer

    // Query DELETE langsung
    $query = "DELETE FROM coffee_shops WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Berhasil Menghapus Data',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../index.php';
                }
            });
            </script>
            ";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>

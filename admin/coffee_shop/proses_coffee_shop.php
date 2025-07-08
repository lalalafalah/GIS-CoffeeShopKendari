<html>
    <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>
<?php
session_start();
include "../../config/koneksi.php";
if (isset($_POST['btnProses'])) {
    $nama_coffee_shop = $_POST["nama_coffee_shop"];
    $link_share_loc = $_POST["link_share_loc"];
    $lat = $_POST["lat"];
    $lng = $_POST["lng"];
    $alamat = $_POST["alamat"];

    if ($_POST['btnProses'] == 'tambah') {
        $query = "INSERT INTO `coffee_shops` (`id`, `lat`, `link_share_loc`, `name`, `lng`, `alamat`) VALUES 
                                      (NULL, '$lat', '$link_share_loc', '$nama_coffee_shop', '$lng', '$alamat')";
        $sql = mysqli_query($conn, $query);
        if ($sql) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Menambahkan Coffee Shop',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../index.php';
                }
            });
            </script>
            ";
        }
    } else {
        $id_coffee_shop = $_POST['id_coffee'];
        $query = "SELECT * FROM coffee_shops WHERE `id` = '$id_coffee_shop'";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($result);
        $query = "UPDATE `coffee_shops` SET `lat` = '$lat', `name` = '$nama_coffee_shop', `lng` = '$lng', `alamat` = '$alamat' , `link_share_loc` = '$link_share_loc' WHERE `coffee_shops`.`id` = $id_coffee_shop";

        $sql = mysqli_query($conn, $query);

        if ($sql) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Informasi Diperbarui',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../index.php';
                }
            });
            </script>
            ";
        }
    }
}

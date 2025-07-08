<html>
    <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>
<?php
include("../config/koneksi.php");


if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mendapatkan data pengguna
    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();

        // Verifikasi password secara langsung (TIDAK AMAN jika password tidak dienkripsi)
        if ($password == $userData["password"]) {
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["id"] = $userData['id_admin'];
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Berhasil Login',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php';
                }
            });
            </script>
            ";        } else {
            header("Location: login.php?pesan=password salah");
        }
    } else {
        header("Location: login.php?pesan=username salah");
    }

    $con->close(); // Perbaikan: sebelumnya tertulis $conn, harusnya $con
}
?>

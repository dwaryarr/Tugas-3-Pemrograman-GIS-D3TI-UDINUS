<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,600,700,700i&display=swap" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/fontawesome-all.css" rel="stylesheet">
    <link href="../css/swiper.css" rel="stylesheet">
    <link href="../css/magnific-popup.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <style>
        body {
            background-color: #fbf9f5;
        }
    </style>
</head>

<body>
    <center><a class="btn-solid-reg" href="tambah.php"> &#10133; Tambah Data</a></center><br>
    <?php
    include "koneksipgsql.php";
    $sql = "select * from hotel";
    $hasil = pg_query($conn, $sql);
    $no = 1;

    echo "<table class='table table-active'>
            <tr><th>No</th><th>Nama Hotel</th><th>Jenis</th><th>Alamat</th><th>Edit</th><th>Delete</th></tr>";
    while ($row = pg_fetch_array($hasil)) {
        echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>" . $row['namahotel'] . "</td>
					<td>" . $row['jenis'] . "</td>
					<td>" . $row['alamat'] . "</td>
        <td><a class='btn-solid-reg' href='edit.php?id=" . $row["id"] . "'>&#9998; Edit</a></td>
        <td><a class='btn-solid-reg' href='delete.php?id=" . $row["id"] . "' onclick='deleteData();'>&#128465; Delete</a></td>
        </tr>";
    }
    echo "</table>";
    pg_close($conn);
    ?>
    <script>
        function deleteData() {
            if (alert("Data Terhapus!")) {

            }
        }
    </script>

    <!-- Scripts -->
    <script src="../js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="../js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="../js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="../js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="../js/jquery.countdown.min.js"></script> <!-- The Final Countdown plugin for jQuery -->
    <script src="../js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="../js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="../js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="../js/scripts.js"></script> <!-- Custom scripts -->
</body>

</html>
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

        .form1 {
            width: 500pt;
            padding: 8px 10px;
            margin-top: 5px;
        }

        select {
            width: 100%;
            padding: 8px 10px;
            border: none;
            border-radius: 4px;
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <table>
        <form method='post'>
            <tr>
                <td><b>Nama Hotel</b>&emsp;</td>
                <td><input type='text' class="form1" name='namahotel' required></td>
            </tr>
            <tr>
                <td><b>Jenis</b>&emsp;</td>
                <td><select name='jenis' id='jenis' required>
                        <option value=''>Pilih..</option>
                        <option value='Berbintang'>Berbintang</option>
                        <option value='Non-Bintang'>Non-Bintang</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><b>Alamat</b>&emsp;</td>
                <td><input type='text' class="form1" name='alamat' required></td>
            </tr>
            <tr>
                <td><b>Latitude</b>&emsp;</td>
                <td><input type='text' class="form1" name='lat' required></td>
            </tr>
            <tr>
                <td><b>Longitude</b>&emsp;</td>
                <td><input type='text' class="form1" name='lng' required></td>
            </tr>
            <tr>
                <td></td>
                <td><br>
                    <div class='d-grid gap-2 d-md-block'>
                        <input type='submit' class="btn-solid-reg" value='Simpan' name='simpan' onclick='alert(" Simpan data berhasil..!")'>
                        <input type='reset' class="btn-solid-reg" value='Reset' name='reset'>
                </td>
            </tr>
        </form>
    </table>
    <br>
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a class="btn-solid-reg" href="tabledata.php">Kembali</a>

    <?php
    include "koneksipgsql.php";
    if (isset($_POST['simpan'])) {
        $namahotel  = $_POST['namahotel'];
        $jenis    = $_POST['jenis'];
        $alamat = $_POST['alamat'];
        $lat      = $_POST['lat'];
        $lng      = $_POST['lng'];

        $sql = "SELECT max(gid) as gid,max(id) as id from hotel";
        $hasil = pg_query($conn, $sql);
        $data = pg_fetch_array($hasil);
        $gid = $data['gid'] + 1;
        $id = $data['id'] + 1;

        $sql = "INSERT INTO hotel (gid,id,namahotel,alamat,jenis,geom) values ('$gid','$id','$namahotel','$alamat','$jenis',
                ST_SetSRID(ST_MakePoint($lng,$lat), 4326))";
        pg_query($conn, $sql);
        header("location:tabledata.php");
    }
    ?>


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
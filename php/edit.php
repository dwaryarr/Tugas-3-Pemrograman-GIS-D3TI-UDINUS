<html>

<head>
    <style>
        body {
            background-color: #fbf9f5;
        }

        input[type=text],
        select {
            width: 50%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 50%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 10px;
        }

        .btn-solid-reg {
            display: inline-block;
            padding: 1.1875rem 2.125rem 1.1875rem 2.125rem;
            border: 0.125rem solid #ffbd50;
            border-radius: 2rem;
            background-color: #ffbd50;
            color: #333;
            font: 600 0.875rem/0 "Montserrat", sans-serif;
            text-decoration: none;
            transition: all 0.2s;
        }
    </style>
</head>

<body>
    <?php
    include "koneksipgsql.php";
    $id = $_GET["id"];
    /* CONVERT GEOM TO LAT+LNG : ST_X(geom) AS lng,ST_Y(geom) AS lat*/
    $ambildata = pg_query($conn, "SELECT namahotel,jenis,alamat,ST_X(geom) AS lng,
    ST_Y(geom) AS lat FROM hotel WHERE id='$id'");
    $data = pg_fetch_array($ambildata);
    ?>
    <center>
        <font face="verdana">
            <form class="form1" method="POST" action="">
                <div>Nama Hotel</div>
                <div><input class="search" type='text' name='namahotel' value='<?php echo $data['namahotel'] ?>'></div>
                <div>Jenis</div>
                <div><select name='jenis' id='jenis' required>
                        <option value='<?php echo $data['jenis'] ?>'><?php echo $data['jenis'] ?></option>
                        <option value='Berbintang'>Berbintang</option>
                        <option value='Non-Bintang'>Non-Bintang</option>
                    </select>
                </div>
                <div>Alamat</div>
                <div><input class="search" type='text' name='alamat' value='<?php echo $data['alamat'] ?>'></div>
                <div>Latitude</div>
                <div><input class="search" type='text' name='lat' value='<?php echo $data['lat'] ?>'></div>
                <div>Longitude</div>
                <div><input class="search" type='text' name='lng' value='<?php echo $data['lng'] ?>'></div>
                <div><input type='submit' name="simpan" value='Simpan' onclick="alert('Data Tersimpan')"></div>
                <div><a class="btn-solid-reg" href="tabledata.php">Kembali</a></div>
    </center>


    <?php
    if (isset($_POST['simpan'])) {
        $namahotel  = $_POST['namahotel'];
        $jenis     = $_POST['jenis'];
        $alamat       = $_POST['alamat'];
        $lat   = $_POST['lat'];
        $lng        = $_POST['lng'];

        pg_query($conn, "UPDATE hotel SET namahotel='$namahotel',
        /*CONVERT LAT+LNG TO GEOM : geom=ST_SetSRID(ST_MakePoint($lng,$lat), 4326) */
     jenis='$jenis', alamat='$alamat', geom=ST_SetSRID(ST_MakePoint($lng,$lat), 4326) WHERE id='$id'")
            or die(pg_close($conn));
        header("location:tabledata.php");
    }

    ?>
</body>

</html>
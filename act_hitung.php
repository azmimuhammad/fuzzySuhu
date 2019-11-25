<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Fuzzy</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3 margin-top"></div>
            <div class="col-md-6 content margin-top">
                <h1 class="judul"><span class="glyphicon glyphicon-tree-conifer"></span> Green House Cabai</h1><hr>
                <?php
                    include "Fuzzy.php";

                    $nilai_suhu = $_POST['suhu'];
                    $nilai_intCahaya = $_POST['intCahaya'];
                    $sampel = $_POST['centroid'];

                    $fuzzyObj = new Fuzzy;
                    $fuzzyObj->Suhu($nilai_suhu);
                    $fuzzyObj->intCahaya($nilai_intCahaya);
                    $fuzzyObj->Fuzzifikasi();
                    echo "<hr>" . "Rules yang dipakai : " . "<br>";
                    $fuzzyObj->inferensi();
                    echo "<br>";
                    $fuzzyObj->def_Cen($sampel);
                ?>
                
                <a href="index.php" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-home"></span> Go Home</a>
                <br>
            </div>
            <div class="col-md-3 margin-top"></div>
        </div>
    </div>
    
  <script type="text/javascript" src="public/assets/js/jquery.js"></script>
  <script type="text/javascript" src="public/assets/js/bootstrap.min.js"></script>
</body>
</html>
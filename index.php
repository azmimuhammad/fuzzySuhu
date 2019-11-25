<html lang="en">
<head>
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
                <form action="act_hitung.php" method="post">
                    <div class="form-group">
                        <label for="inputSuhu">Masukan Nilai Suhu (<sup>o</sup>C)</label>
                        <input type="text" id="inputSuhu" class="form-control" placeholder="Ex : 20" name="suhu" >
                    </div>
                    <div class="form-group">
                        <label for="inputintCahaya">Masukan Nilai Intensitas Cahaya (fc)</label>
                        <input type="text" id="inputintCahaya" class="form-control" placeholder="Ex : 2000" name="intCahaya" >
                    </div>
                    <div class="form-group">
                        <label for="inputCentroid">Masukan Jumlah Sampel pada Cetroid</label>
                        <input type="text" id="inputCentroid" class="form-control" placeholder="Ex : 10" name="centroid" >
                    </div>
                    <button type="submit" class="btn btn-large btn-block btn-success">Submit</button>
                </form>
            </div>
            <div class="col-md-3 margin-top"></div>
        </div>
    </div>
    
  <script type="text/javascript" src="public/assets/js/jquery.js"></script>
  <script type="text/javascript" src="public/assets/js/bootstrap.min.js"></script>
</body>
</html>
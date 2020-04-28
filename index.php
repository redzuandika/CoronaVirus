<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Pemantauan Virus Corona (COVID-19)</title>
</head>

<body>
    <div class="jumbotron jumbotron-fluid bg-primary text-white">
        <div class="container text-center">
            <h1 class="display-4">Pemantauan Kasus COVID-19 Di Dunia</h1>
            <p class="lead">Pemantauan Data Kasus Covid-19 Secara Real Time</p><br>
            <h5>Dibuat Oleh : Redzuan Dika</h5>

        </div>
    </div>
    <style type="text/css">
        .kotak {
            padding: 30px 40px;
            border-radius: 5px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="bg-info kotak text-white">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Positif</h5>
                            <h2 id="positif"> 12345</h2>
                            <h5>Orang</h5>
                        </div>
                        <div class="col-md-4">
                            <img src="assets/positif.png" style="width: 120px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-success kotak text-white">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Sembuh</h5>
                            <h2 id="kasus-sembuh"> 12345</h2>
                            <h5>Orang</h5>
                        </div>
                        <div class="col-md-4">
                            <img src="assets/sembuh.png" style="width: 120px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-danger kotak text-white">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Meninggal</h5>
                            <h2 id="kasus-mati"> 12345</h2>
                            <h5>Orang</h5>
                        </div>
                        <div class="col-md-4">
                            <img src="assets/dad.png" style="width: 120px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="bg-primary kotak text-white">
                    <div class="row">
                        <div class="col-md-3">
                            <h5>Kasus Indonesia</h5>
                            <h5 id="kasus-id">Positif : 10 Orang <br> Sembuh : 10 Orang <br>Meninggal : 10 Orang</h5>
                        </div>
                        <div class="col-md-4">
                            <img src="assets/ind.png" style="width: 120px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header bg-warning text-white">
            <b>
                DATA KASUS COVID 19 INDONESIA
            </b>
        </div>
        <table class="table table-bordered mt-3">
            <thead>
                <th>No</th>
                <th>Nama Provinsi</th>
                <th>Positif</th>
                <th>meninggal</th>
                <th>Sembuh</th>
            </thead>
            <tbody id="table-data">

            </tbody>

        </table>
    </div>
    </div>
    <footer class="bg-info text-white text-center">
        <p>Copyright &copy Redzuan Dika </p>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
<script>
    $(document).ready(function() {
        //panggil
        semuadata();
        negaradata();
        dataprov();
        //refresh
        setInterval(function() {
            semuadata();
            negaradata();
            dataprov();
        }, 5000);

        function semuadata() {
            $.ajax({
                url: 'https://coronavirus-19-api.herokuapp.com/all/',
                success: function(data) {
                    try {
                        var json = data;
                        var kasus = data.cases;
                        var meninggal = data.deaths;
                        var sembuh = data.recovered;

                        $('#positif').html(kasus);
                        $('#kasus-mati').html(meninggal);
                        $('#kasus-sembuh').html(sembuh);

                    } catch {
                        alert('Eror 404');
                    }
                }
            });
        }

        function negaradata() {
            $.ajax({
                url: 'https://coronavirus-19-api.herokuapp.com/countries/',
                success: function(data) {
                    try {
                        var json = data;
                        var html = [];
                        if (json.length > 0) {
                            var i;
                            for (i = 0; i < json.length; i++) {
                                var negaradata = json[i];
                                var namanegara = negaradata.country;

                                if (namanegara === 'Indonesia') {
                                    var kasus = negaradata.cases;
                                    var meninggal = negaradata.deaths;
                                    var sembuh = negaradata.recovered;
                                    $('#kasus-id').html(
                                        'Positif : ' + kasus + ' orang <br> Meninggal : ' + meninggal + ' orang <br> Sembuh: ' + sembuh + ' orang')
                                }
                            }
                        }


                    } catch {
                        alert('Eror 404');
                    }
                }
            });
        }

        function dataprov() {
            $.ajax({
                url: 'curl.php',
                type: 'GET',
                success: function(data) {
                    try {

                        $('#table-data').html(data);


                    } catch {
                        alert('Eror 404');
                    }
                }
            });
        }

    });
</script>
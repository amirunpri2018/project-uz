<?php

session_start();

?>

<!doctype html>
<html lang="pl">
<head>
    <title>Shoply | Panel Klienta</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700|Titillium+Web&amp;subset=latin-ext"
          rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../produkty/css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand social" href="#">

        <i class="fab fa-facebook-f"></i>
        <i class="fab fa-instagram"></i>
        <i class="fab fa-twitter"></i>
        <i class="fab fa-google-plus-g"></i>
        <i class="fab fa-pinterest-p"></i>

    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php
                    if (isset($_SESSION['zalogowany'])){
                        echo "<span class=\"nav-link\">
                                <a href='../panelklienta/account.php'>
                                    Cześć <b>".$_SESSION['z_imie']."</b>!
                                </a>
                              </span>
                             ";
                    } else {
                        echo "<a class=\"nav-link\" href=\"account.php\">Rejestracja</a>";
                    }
                ?>

            </li>

            <li class="nav-item">
                <a class="nav-link" style="color:  rgba(182, 182, 182, 0.49);" href="#">|
                </a>
            </li>

            <li class="nav-item dropdown">
                <?php
                    if (isset($_SESSION['zalogowany'])) {
                        echo "<a class=\"nav-link\" href='../logout.php'\">Wyloguj</a>";
                    } else {
                        echo "<a class=\"nav-link dropdown-toggle\" href='#'\">Pomoc</a>";
                    }
                ?>
            </li>
        </ul>
    </div>
</nav>

<header class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"
       style="letter-spacing: 1.5px; margin-top: -10px; font-family: 'Raleway', sans-serif; font-size: 60px;">
        <span style="color: #ca7b11; font-weight: bold">Shop</span>ly <span style="font-size: 34px;"></span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 menuroll" style="font-size: 25px;padding-bottom: 10px;"
        ">
        <li class="nav-item">
            <a class="nav-link" href="../">Start</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:  rgba(226,226,226,0.49);" href="#">|
            </a></li>
        <li class="nav-item">
            <a class="nav-link" href="../produkty">Produkty</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:  rgba(226,226,226,0.49);" href="#">|
            </a></li>
        <li class="nav-item">
            <a class="nav-link" style="" href="#">Zamówienie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:  rgba(226,226,226,0.49);" href="#">|
            </a></li>
        <li class="nav-item" style="margin-top: -5px;">
            <a class="nav-link openbasketmenu" style="font-size: 30px;" href="#"><i
                        class="fas fa-shopping-cart"></i></a>
        </li>
        </ul>
    </div>
</header>

<main id="main_start" style="background-color: white;">
    <div class="img">
        <div class="tekst">Panel Klienta</div>
    </div>

    <div class="container order_container">


        <div class="row">
            <div class="col-md-3">
                <?php
                    require_once '../inc/CustomerPanelContent/customerPanelLeftBar.php';
                ?>
            </div>

            <div class="col-md-9">
                <div class="list-group list-group-flush">
                    <p class="list-group-item list-group-item-action active">Zmiana podstawowych danych konta</p>
                </div>

                <br>

                <?php
                    require_once '../inc/Database/Connect.php';
                    require_once '../inc/Database/CustomerPanel.php';

                    $getOrders = new CustomerPanel();
                    $getOrders->getCustomerData();
                ?>

            </div>

<script>
    $(document).ready(function () {
        $("#kwota2").val(localStorage.getItem('sumalist'));
        $("#zamowienie2").val(localStorage.getItem('item_id'));

        var pp = $("#nr_zamowienia").html(Math.floor((Math.random() * 10000) + 1));

        document.getElementById("nr_zamowienia2").value = pp.html();
        localStorage.setItem('order_id', document.getElementById("nr_zamowienia2").value);
    });

</script>

                </div>
            </div>
        </div>
        <div class="alert alert-dark alert-dismissible fade show notification2"
             style="margin-top: 50px; opacity: 0.8;" role="alert">
            <strong>Powiadomienie <i class="far fa-bell"></i></strong> Czas realizacji zamówienia wynosi 1-2 dni
            robocze.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</main>

<footer>
    <div id="footer" style="position:absolute; bottom: 0px; z-index: -5;">
        <a class="navbar-brand social"
           style="color: white; font-size: 24px; padding-left: 70px; padding-top: 30px; padding-right: 70px;"
           href="#">

            <i style="margin: 8px; opacity: 0.6;" class="fab fa-facebook-f"></i>
            <i style="margin: 8px; opacity: 0.6;" class="fab fa-instagram"></i>
            <i style="margin: 8px; opacity: 0.6;" class="fab fa-twitter"></i>
            <i style="margin: 8px; opacity: 0.6;" class="fab fa-google-plus-g"></i>
            <i style="margin: 8px; opacity: 0.6;" class="fab fa-pinterest-p"></i>
        </a>

        <span class="footerbottom"
              style="float: right; margin-top: 40px; margin-right: 70px; opacity: 0.6; font-family: Raleway;">Regulamin <span
                    style="margin-left: 10px; margin-right: 10px;">|</span> Polityka prywatności</span>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="../produkty/js/jquery.ndd.js"></script>
<script src="../produkty/js/modernizr.js"></script>
<script src="../produkty/js/script.js"></script>

</body>
</html>
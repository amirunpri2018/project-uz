<?php

session_start();

?>

<!doctype html>
<html lang="pl">
<head>
    <title>Shoply | Produkty</title>
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<style>
    * {
        user-drag: none;
        user-select: none;
        -moz-user-select: none;
        -webkit-user-drag: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>

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

                if (isset($_SESSION['zalogowany']))
                {
                    echo "<span class=\"nav-link\">Cześć <b>".$_SESSION['z_imie']."</b>!</span>";
                }

                else
                {
                    echo "<a class=\"nav-link\" href=\"../\">Rejestracja</a>";
                }
                ?>

            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:  rgba(182, 182, 182, 0.49);" href="#">|
                </a>
            </li>
            <li class="nav-item dropdown">
                <?php

                if (isset($_SESSION['zalogowany']))
                {
                    echo "<a class=\"nav-link\" href='../logout.php'\">Wyloguj</a>";
                }


                else
                {
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
            <a class="nav-link" style="color: #e28000; opacity: 1;" href="#">Produkty</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:  rgba(226,226,226,0.49);" href="#">|
            </a></li>
        <li class="nav-item">
            <a class="nav-link" href="../zamowienie">Zamówienie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:  rgba(226,226,226,0.49);" href="#">|
            </a></li>
        <li class="nav-item" style="margin-top: -5px;">
            <a class="nav-link openbasketmenu" style="font-size: 30px;" href="#"><i class="fas fa-shopping-cart"></i></a>
        </li>
        </ul>
    </div>
</header>
<main id="main">
    <div class="img">
        <div class="tekst">Produkty</div>
    </div>

    <div id="box1">

        <div class="alert alert-warning" style="color: black" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">Powiadomienie <i class="far fa-bell"></i></h4>
            <p>Drogi kliencie! Pobierz aplikacje i odbierz <b>30 PLN</b> na pierwsze zakupy!</p>
            <p class="mb-0" style="text-align: center;">
                <button type="button" class="btn btn-outline-dark btn-lg"
                        style="margin-right: 3px; margin-top: 10px; margin-bottom: 15px; background-color: white"><i
                            class="fab fa-google-play"></i> Google Play
                </button>
                <button type="button" class="btn btn-outline-dark btn-lg"
                        style="background-color: white; margin-bottom: 15px; margin-top: 10px;"><i
                            style="font-size: 24px; margin-right: 3px;" class="fab fa-apple"></i> App Store
                </button>
                <br><span>Pobierając naszą aplikację na telefon, zyskujesz szybszą wysyłkę oraz bon rabatowy na pierwsze zakupy.</span>
            </p>
        </div>
    </div>

    <div id="sklep">

        <div id="kategoria">
            <ul class="list-group">
                <li class="list-group-item active"><i class="fas fa-align-justify"></i><a href="#" style="text-decoration: none; color: white">Wszystkie produkty</a></li>
                <li class="list-group-item"><a href="elektronika" style="color: black; text-decoration: none"><i class="fas fa-tv"></i> Elektronika</a></li>
                <li class="list-group-item"><a href="ubrania" style="color: black; text-decoration: none"><i class="fas fa-tshirt"></i> Ubrania</li>
                <li class="list-group-item"><a href="mieszkanie" style="color: black; text-decoration: none"><i class="fas fa-home"></i> Mieszkanie</li>
                <li class="list-group-item"><a href="szkola" style="color: black; text-decoration: none"><i class="fas fa-table"></i> Szkoła</li>
                <li class="list-group-item"><a href="motoryzacja" style="color: black; text-decoration: none"><i class="fas fa-car"></i> Motoryzacja</li>
                <li class="list-group-item"><a href="sport" style="color: black; text-decoration: none"><i class="fas fa-bicycle"></i> Sport</li>
            </ul>
        </div>

        <div id="produkty">
            <ul class="nav nav-tabs">
                <div class="pos-f-t">
                    <div class="collapse" id="navbarToggleExternalContent">
                        <div class="bg-light p-4">
                                                        <span class="text-muted">
                                        <ul class="nav justify-content-center">
<li class="list-group-item">
    <a href="#" style="text-decoration: none; color: orange;">
    <i class="fas fa-align-justify"></i> Wszystkie produkty</a></li>
                <li class="list-group-item"><a style="text-decoration: none; color: orange;" href="elektronika"><i class="fas fa-tv"></i> Elektronika</a></li>
                <li class="list-group-item"><a style="text-decoration: none; color: orange;" href="ubrania"><i class="fas fa-tshirt"></i> Ubrania</a></li>
                <li class="list-group-item"><a style="text-decoration: none; color: orange;" href="mieszkanie"><i class="fas fa-home"></i> Mieszkanie</a></li>
                <li class="list-group-item"><a style="text-decoration: none; color: orange;" href="szkola"><i class="fas fa-table"></i> Szkoła</a></li>
                <li class="list-group-item"><a style="text-decoration: none; color: orange;" href="motoryzacja"><i class="fas fa-car"></i> Motoryzacja</a></li>
                <li class="list-group-item"><a style="text-decoration: none; color: orange;" href="sport"><i class="fas fa-bicycle"></i> Sport</a></li>
</ul>
                            </span>
                        </div>
                    </div>
                    <nav class="navbar navbar-light bg-light menu">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </nav>
                </div>
                <li class="nav-item padding show2">
                    <a class="nav-link padding" href="#"><i class="fas fa-exchange-alt"></i></a>
                </li>
                <li class="nav-item hidden">
                    <a class="nav-link" href="index.php">Cena: rosnąco</i></a>
                </li>
                <li class="nav-item hidden">
                    <a class="nav-link" href="index2.php">Cena: malejąco</a>
                </li>
                <li class="nav-item hidden active">
                    <a class="nav-link active" href="#">Alfabetycznie <i class="fas fa-caret-right"></i></i></a>
                </li>
                <li class="nav-item hidden" style="margin-top: 9px; margin-left: 8px; opacity: 1;">
                    Ilość produktów: <b><?php

                    require_once "php/connect.php";
                    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

                    if ($result = $polaczenie->query("SELECT * FROM produkty ORDER BY nazwa")) {

                        $row_cnt = $result->num_rows;

                        echo $row_cnt;

                        /* close result set */
                        $result->close();
                    }
                    ?></b>

                </li>
                <li class="nav-item" style="position:absolute; right: 100px;">
                    <form  class="form-inline my-2 my-lg-0 searchSql">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="color: orange;"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" id="input" class="form-control" placeholder="Znajdź przedmiot" aria-label="Znajdź przedmiot" aria-describedby="basic-addon1">
                        </div>
                    </form>
                </li>
            </ul>
        </div>

        <div id="lista_produktow">

            <?php

            $sql = "SELECT * FROM produkty ORDER BY nazwa";
            $result = $polaczenie->query($sql);
            $i = 1;

            $ilosc_produktow = $result->num_rows;

            if ($result->num_rows > 0) {
                // output data of each row

                echo "<div class='row'>";

                while ($row = $result->fetch_assoc()) {
                    $i++;
                    echo "<div class=\"col-md-3\">

                    <section class='produkt' id='$i' draggable='true'>";

                    if ($row["id"] == 1) {
                        echo "<img src='img/1.jpg' style='width: 100%;'>";
                    } else if ($row["id"] == 2) {
                        echo "<img src='img/2.jpg' style='width: 100%;'>";
                    } else if ($row["id"] == 3) {
                        echo "<img src='img/3.jpg' style='width: 100%;'>";
                    } else if ($row["id"] == 4) {
                        echo "<img src='img/4.jpg' style='width: 100%;'>";
                    } else if ($row["id"] == 5) {
                        echo "<img src='img/5.jpg' style='width: 100%;'>";
                    } else if ($row["id"] == 6) {
                        echo "<img src='img/6.jpg' style='width: 100%;'>";
                    } else if ($row["id"] == 7) {
                        echo "<img src='img/7.jpg' style='width: 100%;'>";
                    } else if ($row["id"] == 8) {
                        echo "<img src='img/8.jpg' style='width: 100%;'>";
                    } else if ($row["id"] == 8) {
                        echo "<img src='img/9.jpg' style='width: 100%;'>";
                    } else if ($row["id"] == 9) {
                        echo "<img src='img/9.jpg' style='width: 100%;'>";
                    } else if ($row["id"] == 10) {
                        echo "<img src='img/10.jpg' style='width: 100%;'>";
                    } else if ($row["id"] == 11) {
                        echo "<img src='img/11.jpg' style='width: 100%;'>";
                    } else if ($row["id"] == 12) {
                        echo "<img src='img/12.jpg' style='width: 100%;'>";
                    }

                    echo "<div class=\"opis\">
                        <div class=\"nazwa\" style='margin-top:6px;'>".$row['nazwa']."</div>
                        <div><b>Cena:</b> <span class=\"cenaprzedmiotu\">".$row['cena']."</span> PLN</div>
                        <div class='kategoriaproduktu' style='display: none;'>".$row['kategoria']."</div>
                        <div class='movetobasket'><i class=\"fas fa-arrows-alt\"></i>
                    </div><div class='addtobasket'><i class=\"fas fa-cart-plus\"></i></div>";

                    echo "</section></div>";
                }
            }

            echo "</div>";

            $polaczenie->close();
            ?>

        </div>
    </div>
</main>

<footer>
    <div id="footer">
        <a class="navbar-brand social" style="color: white; font-size: 24px; padding-left: 70px; padding-top: 30px; padding-right: 70px;"
           href="#">

            <i style="margin: 8px; opacity: 0.6;" class="fab fa-facebook-f"></i>
            <i style="margin: 8px; opacity: 0.6;" class="fab fa-instagram"></i>
            <i style="margin: 8px; opacity: 0.6;" class="fab fa-twitter"></i>
            <i style="margin: 8px; opacity: 0.6;" class="fab fa-google-plus-g"></i>
            <i style="margin: 8px; opacity: 0.6;" class="fab fa-pinterest-p"></i>

        </a>
    </div>
</footer>

<aside id="itembasket">
    <i class="fas fa-shopping-basket"></i>
</aside>

<div id="kontener_koszyka" style="display: none;">
    <div id="info_przeniesienie" style="display: none;">Przenieś przedmiot tutaj</div>

    <ul id="koszyk">

    </ul>

    <div id="cena"><b>Razem: </b><span>0.00</span> zł    <a href="../zamowienie"><button type="button" style="float: right; margin-right: 70px; margin-top: -6px;" class="btn btn-dark">Zamawiam</button></a></div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="js/jquery.ndd.js"></script>
<script src="js/modernizr.js"></script>
<script src="js/script.js"></script>
</body>
</html>
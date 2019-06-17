<?php

session_start();

if (!isset($_SESSION['zalogowany']))
{
    header('Location: login.php');
    exit();
}

require_once "produkty/php/connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if (isset($_POST['p_nr']) && !empty($_POST['p_nr'])) {

    $p_nr = $_POST['p_nr'];

    if ($polaczenie->connect_errno != 0) {
        echo "Error: " . $polaczenie->connect_errno;
    } else {

        $p_nr = htmlentities($p_nr, ENT_QUOTES, "UTF-8");

        if ($rezultat = @$polaczenie->query(
            sprintf("SELECT status FROM zamowienia WHERE id = '%s'",
                mysqli_real_escape_string($polaczenie, $p_nr)))) {
            $ilu_userow = $rezultat->num_rows;

            if ($ilu_userow > 0) {

                $wiersz = $rezultat->fetch_assoc();
                $_SESSION['status'] = $wiersz['status'];
                $rezultat->free_result();
            } else {
                echo "<style>

input[type='text'], input[type='password']  {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.09)!important;
}
</style>";
                $_SESSION['blad2'] = '<div style="color: red; text-align: center; font-size: 14px; font-weight: bold; margin: 10px;">Nie znaleziono takiego zamówienia.</div>';
            }}
    }
}

$polaczenie->close();

?>

<!doctype html>
<html lang="pl">
<head>
    <title>Shoply</title>
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
    <link rel="stylesheet" href="produkty/css/style.css">
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
                    echo "<a class=\"nav-link\" href='logout.php'\">Wyloguj</a>";
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
       style="letter-spacing: 1.5px; margin-top: -5px; font-family: 'Raleway', sans-serif; font-size: 60px;">
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
            <a class="nav-link" style="color: #e28000; opacity: 1;" href="#">Start</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:  rgba(226,226,226,0.49);" href="#">|
            </a></li>
        <li class="nav-item">
            <a class="nav-link" href="produkty">Produkty</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:  rgba(226,226,226,0.49);" href="#">|
            </a></li>
        <li class="nav-item">
            <a class="nav-link" href="zamowienie">Zamówienie</a>
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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="register">
                    <div style="text-align: center; font-size: 22px; margin-bottom: 10px;">Status zamówienia</div>
                    <form method="post">
                        <div style="text-align: center;"><input type="text" placeholder="Podaj nr. zamówienia" name="p_nr"></div>


                        <div style="text-align: center;"><input type="submit" value="Sprawdź"></div>
                    </form>

                    <?php

                        if (isset($_SESSION['status']))
                        {
                            echo "<div style='text-align: center; margin-top: 10px;'>Status zamowienia nr: <b>".$_POST['p_nr']."</b>: ".$_SESSION['status']."</div>";
                            unset ($_SESSION['status']);
                        }

                        if (isset($_SESSION['blad2']))
                        {
                            echo $_SESSION['blad2'];
                            unset ($_SESSION['blad2']);
                        }

                        ?></div>

                </div>
            </div>

        <div class="alert alert-warning alert-dismissible fade show notification"
             style="margin-top: 30px; opacity: 0.8; width: 100%!important;" role="alert">
            <strong>Powiadomienie <i class="far fa-bell"></i></strong> Nasz sklep pracuje od poniedziałku do piątku w
            godzinach 8-16!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</main>

<footer>
    <div id="footer" style="position:fixed; bottom: 0px; z-index: -5;">
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
<script src="produkty/js/jquery.ndd.js"></script>
<script src="produkty/js/modernizr.js"></script>
<script src="produkty/js/script.js"></script>
</body>
</html>
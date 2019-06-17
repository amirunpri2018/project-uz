<?php

session_start();

if (isset($_SESSION['zalogowany'])) {
    header('Location: panel.php');
    exit();
}

if (isset($_POST['imie'])) {
    $wszystko_ok = true;

// imie
    $imie = $_POST['imie'];


    if (strlen($imie) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Pole imię jest wymagane!";


        echo "<style>

input[name='imie'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";

    }

    if (strlen($imie) > 16) {
        $wszystko_ok = false;
        $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 15 liter!";

        echo "<style>

input[name='imie'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";

    }

    if (ctype_alnum($imie) == false) {
        $wszystko_ok = false;
        $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Pole imię jest wymagane!";

        echo "<style>

input[name='imie'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";

    }

    if (preg_match("/[^A-z_-]/", $imie) == 1) {
        $wszystko_ok = false;
        $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Wprowadź tylko litery!";

        echo "<style>

input[name='imie'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";

    }

//koniec imienia

//nazwisko
    $nazwisko = $_POST['nazwisko'];

    if (strlen($nazwisko) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Pole nazwisko jest wymagane!";

        echo "<style>

input[name='nazwisko'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (strlen($nazwisko) > 16) {
        $wszystko_ok = false;
        $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 15 liter!";

        echo "<style>

input[name='nazwisko'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (ctype_alnum($nazwisko) == false) {
        $wszystko_ok = false;
        $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Pole nazwisko jest wymagane!";

        echo "<style>

input[name='nazwisko'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (preg_match("/[^A-z_-]/", $nazwisko) == 1) {
        $wszystko_ok = false;
        $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Wprowadź tylko litery!";

        echo "<style>

input[name='nazwisko'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

//koniec nazwisko

//poczatek haslo

    $haslo = $_POST['haslo'];

    if (strlen($haslo) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Pole hasło jest wymagane!";

        echo "<style>

input[name='haslo'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (strlen($haslo) > 11) {
        $wszystko_ok = false;
        $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 10 znaków!";

        echo "<style>

input[name='haslo'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }


//koniec haslo

//poczatek adres

    $adres = $_POST['adres'];

    if (strlen($adres) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_adres'] = "<i class=\"fas fa-user-times\"></i> Pole adres dostawy jest wymagane!";

        echo "<style>

input[name='adres'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (strlen($adres) > 40) {
        $wszystko_ok = false;
        $_SESSION['e_adres'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 40 znaków!";

        echo "<style>

input[name='adres'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    $miejscowosc = $_POST['miejscowosc'];

    if (strlen($miejscowosc) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_miejscowosc'] = "<i class=\"fas fa-user-times\"></i> Pole miejscowość jest wymagane!";

        echo "<style>

input[name='miejscowosc'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (strlen($miejscowosc) > 40) {
        $wszystko_ok = false;
        $_SESSION['e_miejscowosc'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 40 znaków!";

        echo "<style>

input[name='miejscowosc'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    //poczatek login

    $login = $_POST['login'];

    require_once "produkty/php/connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            // czy numer dostępu istnieje?
            $rezultat = $polaczenie->query("SELECT login FROM klienci WHERE login='$login'");
            if (!$rezultat)
                throw new Exception($polaczenie->error);
            $ile_takich_loginow = $rezultat->num_rows;
            if ($ile_takich_loginow > 0) {
                $wszystko_ok = false;
                $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Istnieje już taki login!";
                echo "<style>
            input[name='login'] {
            border: 1px solid red!important;
            background-color: rgba(255,0,0,0.10)!important;
            }
            </style>";
            }
        }
        $polaczenie->close();

    } catch (Exception $e) {
        echo "<span style='color: red;'>Błąd serwera! Prosimy o rejestrację w innym terminie! :)</span>";
        echo $e;
    };

    if (strlen($login) < 1) {
        $wszystko_ok = false;
        $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Pole login jest wymagane!";

        echo "<style>

input[name='login'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

    if (strlen($login) > 11) {
        $wszystko_ok = false;
        $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 10 znaków!";

        echo "<style>

input[name='login'] {
border: 1px solid red!important;
background-color: rgba(255,0,0,0.10)!important;
}

</style>";
    }

//koniec login

    if ($wszystko_ok == true) {

        require_once "produkty/php/connect.php";

        try {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if ($polaczenie->connect_errno != 0) {
                throw new Exception(mysqli_connect_errno());
            } else {

                $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

                $imie = htmlentities($imie, ENT_QUOTES, "UTF-8");
                $nazwisko = htmlentities($nazwisko, ENT_QUOTES, "UTF-8");
                $adres = htmlentities($adres, ENT_QUOTES, "UTF-8");
                $login = htmlentities($login, ENT_QUOTES, "UTF-8");
                $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
                $miejscowosc = htmlentities($miejscowosc, ENT_QUOTES, "UTF-8");

                if ($polaczenie->query(sprintf("INSERT INTO klienci VALUES (NULL, '%s', '%s', '%s', '%s', '%s', '%s')",

                    mysqli_real_escape_string($polaczenie, $login),
                    mysqli_real_escape_string($polaczenie, $haslo),
                    mysqli_real_escape_string($polaczenie, $imie),
                    mysqli_real_escape_string($polaczenie, $nazwisko),
                    mysqli_real_escape_string($polaczenie, $adres),
                    mysqli_real_escape_string($polaczenie, $miejscowosc)))) {

                    $_SESSION['udanarejestracja'] = "Rejestracja zakończona pomyślnie!";
                    header('location: login.php');
                }
            }
            $polaczenie->close();
        } catch (Exception $e) {
            echo "<span style='color: red;'>Błąd serwera! Prosimy o rejestrację w innym terminie! :)</span>";
            echo $e;
        }
    }
}

//koniec adres
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

                if (isset($_SESSION['zalogowany'])) {
                    echo "<span class=\"nav-link\">Cześć <b>" . $_SESSION['z_imie'] . "</b>!</span>";
                } else {
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

                if (isset($_SESSION['zalogowany'])) {
                    echo "<a class=\"nav-link\" href='logout.php'\">Wyloguj</a>";
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
            <div class="col-md-6">
                <div id="register">
                    <div style="text-align: center; font-size: 22px; margin-bottom: 10px;">Rejestracja</div>
                    <form method="post">
                        <div><input type="text" placeholder="Podaj imię" name="imie" value="<?php

                            if (isset($_POST['imie'])) {

                                if (strlen($imie) < 1) {
                                    echo "";
                                }

                                if (strlen($imie) > 16) {
                                    echo "";
                                }

                                if (ctype_alnum($imie) == false) {
                                    echo "";
                                }

                                if (preg_match("/[^A-z_-]/", $imie) == 1) {
                                    echo "";
                                } else {
                                    echo $imie;
                                }
                            }


                            ?>"></div>

                        <?php

                        if (isset($_SESSION['e_imie'])) {
                            echo '<div class="f_error" style>' . $_SESSION['e_imie'] . '</div>';
                            unset($_SESSION['e_imie']);
                        }

                        ?>

                        <div><input type="text" placeholder="Podaj nazwisko" name="nazwisko" value="<?php

                            if (isset($_POST['nazwisko'])) {

                                if (strlen($nazwisko) < 1) {
                                    echo "";
                                }

                                if (strlen($nazwisko) > 16) {
                                    echo "";
                                }

                                if (ctype_alnum($nazwisko) == false) {
                                    echo "";
                                }

                                if (preg_match("/[^A-z_-]/", $nazwisko) == 1) {
                                    echo "";
                                } else {
                                    echo "$nazwisko";
                                }

                            }

                            ?>"></div>

                        <?php

                        if (isset($_SESSION['e_nazwisko'])) {
                            echo '<div class="f_error" style>' . $_SESSION['e_nazwisko'] . '</div>';
                            unset($_SESSION['e_nazwisko']);
                        }

                        ?>
                        <div><input type="text" placeholder="Podaj adres zamieszkania" name="adres" value="<?php

                            if (isset($_POST['adres'])) {

                                if (strlen($adres) < 1) {
                                    echo "";
                                }

                                if (strlen($adres) > 40) {
                                    echo "";
                                } else {
                                    echo $adres;
                                }
                            }


                            ?>"></div>

                        <?php

                        if (isset($_SESSION['e_adres'])) {
                            echo '<div class="f_error" style>' . $_SESSION['e_adres'] . '</div>';
                            unset($_SESSION['e_adres']);
                        }

                        ?>

                        <div><input type="text" placeholder="Podaj miejscowość" name="miejscowosc" value="<?php

                            if (isset($_POST['miejscowosc'])) {

                                if (strlen($miejscowosc) < 1) {
                                    echo "";
                                }

                                if (strlen($miejscowosc) > 40) {
                                    echo "";
                                } else {
                                    echo $miejscowosc;
                                }
                            }

                            ?>"></div>

                        <?php

                        if (isset($_SESSION['e_miejscowosc'])) {
                            echo '<div class="f_error" style>' . $_SESSION['e_miejscowosc'] . '</div>';
                            unset($_SESSION['e_miejscowosc']);
                        }

                        ?>

                        <div><input type="text" placeholder="Wprowadź login" name="login" value="<?php

                            if (isset($_POST['login'])) {

                                if (strlen($login) < 1) {
                                    echo "";
                                }

                                if (strlen($login) > 11) {
                                    echo "";
                                } else {
                                    echo "$login";
                                }
                            }

                            ?>"></div>

                        <?php

                        if (isset($_SESSION['e_login'])) {
                            echo '<div class="f_error" style>' . $_SESSION['e_login'] . '</div>';
                            unset($_SESSION['e_login']);
                        }

                        ?>
                        <div><input type="password" placeholder="Wprowadź hasło" name="haslo" value="<?php

                            if (isset($_POST['haslo'])) {

                                if (strlen($haslo) < 1) {
                                    echo "";
                                }

                                if (strlen($haslo) > 11) {
                                    echo "";
                                } else {
                                    echo "$haslo";
                                }
                            }

                            ?>"></div>

                        <?php

                        if (isset($_SESSION['e_haslo'])) {
                            echo '<div class="f_error" style>' . $_SESSION['e_haslo'] . '</div>';
                            unset($_SESSION['e_haslo']);
                        }

                        ?>

                        <div><input type="submit" value="Załóż konto"></div>
                        <div style="text-align: center; font-size: 14px; color: grey;">Masz już konto? <a
                                    href="login.php" style="font-weight: bold; text-decoration: none; color: grey;">Zaloguj
                                się</a></div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div id="continue">
                    <a href="produkty">
                        <button type="button" class="btn btn-warning" style="width: 70%; font-size: 19px;">Kontynuuj <i
                                    class="fas fa-angle-right"></i></button>
                    </a><br>
                    <div style="opacity: 0.5; font-size: 15px; text-align: center; margin-top: 7px; padding-bottom: 30px;">
                        bez zakładania
                        nowego konta
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-warning alert-dismissible fade show notification"
             style="margin-top: 30px; opacity: 0.8;" role="alert">
            <strong>Powiadomienie <i class="far fa-bell"></i></strong> Rejestrując swoje konto, zwiększasz szybkość
            realizacji zamówienia.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</main>

<footer>
    <div id="footer" style="position:absolute; bottom: 0px; z-index: -5; ">
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
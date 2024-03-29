<?php

session_start();
ob_start();

if (isset($_POST['kwota2'])) {
    $_SESSION['kwota2'] = $_POST['kwota2'];
    $_SESSION['taskOption'] = $_POST['taskOption'];
    $orderProductsIDs = $_POST['zamowienie2'];

    require_once '../inc/Database/Connect.php';
    require_once '../inc/Database/CreateOrder.php';

    $newOrder = new CreateOrder($_SESSION['z_id'], $_SESSION['kwota2'], $_SESSION['taskOption'], $orderProductsIDs);

    /*if ($wszystko_ok2 == true) {

        require_once "../produkty/php/connect.php";

        try {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if ($polaczenie->connect_errno != 0) {
                throw new Exception(mysqli_connect_errno());
            } else {
                $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

                $zamowienie2 = $_POST['zamowienie2'];
                $imie2 = $_SESSION['imie2'];
                $nazwisko2 = $_SESSION['nazwisko2'];
                $adres2 = $_SESSION['adres2'];
                $var = $_SESSION['taskOption'];
                $nr_zamowienia2 = $_SESSION['nr_zamowienia2'];
                $kwota2 = $_SESSION['kwota2'];
                $miejscowosc2 = $_SESSION['miejscowosc2'];
                $z_id = $_SESSION['z_id'];

                $sql = "SELECT `id` FROM `order` ORDER BY id DESC LIMIT 1";
                $lastOrderNumber = $polaczenie->query($sql);
                $row = $lastOrderNumber->fetch_assoc();


                $imie2 = htmlentities($_SESSION['imie2'], ENT_QUOTES, "UTF-8");
                $nazwisko2 = htmlentities($_SESSION['nazwisko2'], ENT_QUOTES, "UTF-8");
                $adres2 = htmlentities($_SESSION['adres2'], ENT_QUOTES, "UTF-8");
                $miejscowosc2 =htmlentities($_SESSION['miejscowosc2'], ENT_QUOTES, "UTF-8");

                $articlesid = explode(',', $zamowienie2);


                if ($polaczenie->query(sprintf("INSERT INTO `order` (`id`, `customer_id`, `status_id`, `date`, `price`, `shipping_method`) VALUES (null, '%d', '%d', '%s', '%f', '%s')",

                    mysqli_real_escape_string($polaczenie, $z_id),
                    mysqli_real_escape_string($polaczenie, 3),
                    mysqli_real_escape_string($polaczenie, date("Y-m-d H:i:s")),
                    mysqli_real_escape_string($polaczenie, $kwota2),
                    mysqli_real_escape_string($polaczenie, $var)

                    ))) {

                    foreach($articlesid as $articleId) {

                        $polaczenie->query(sprintf("INSERT INTO `order_detail` (`id`, `order_number_id`, `article_id`, `price`, `quantity`) VALUES (null, '%d', '%d', '%f', '%d')",

                            mysqli_real_escape_string($polaczenie, $row['id']+1),
                            mysqli_real_escape_string($polaczenie, (int)$articleId),
                            mysqli_real_escape_string($polaczenie, 1),
                            mysqli_real_escape_string($polaczenie, 1)

                        ));
                    }


                    $_SESSION['udanezamowienie'] = true;
                    header('Location: zamowienie.php');
                }
            }

            $polaczenie->close();

        } catch (Exception $e) {


            echo "<span style='color: red;'>Błąd serwera! Prosimy o zakupy w innym terminie! :)</span>";
            echo $e;
        }
    }*/
}

?>

<!doctype html>
<html lang="pl">
<head>
    <title>Shoply | Zamówienie</title>
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

                if (isset($_SESSION['zalogowany'])) {
                    echo "<span class=\"nav-link\">
                                <a href='../panelklienta'>
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
                    echo "<a class=\"nav-link\" href='logout.php'\">Wyloguj</a>";
                } else
                {
                    echo "<a class=\"nav-link\" href=\"login.php\">Logowanie</a>";
                }
                ?>
            </li>
        </ul>
    </div>
</nav>
<header class="navbar navbar-expand-lg navbar-light bg-light" >
    <a class="navbar-brand" href="/index.php"
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
            <a class="nav-link" style="color: #e28000; opacity: 1;" href="/index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:  rgba(226,226,226,0.49);" href="#">|
            </a></li>
        <li class="nav-item">
            <a class="nav-link" href="produkty">Kategorie</a>
              <ul>
               <li><a href="/produkty/motoryzacja">Motoryzacja</a></li>
               <li><a href="/produkty/elektronika">Elektronika</a></li>
               <li><a href="/produkty/mieszkanie">Mieszkanie</a></li>
               <li><a href="/produkty/ubrania">Ubrania</a></li>
               <li><a href="/produkty/szkola">Szkoła</a></li>
               <li><a href="/produkty/sport">Sport</a></li>
          </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link" style="color:  rgba(226,226,226,0.49);" href="#">|

            </a></li>

        <li class="nav-item">
            <a class="nav-link" href="/zamowienie">Zamówienie</a>
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

    <div class="container order_container">
        <div class="row">
            <div class="col-md-6">
                <div id="order">
                    <ul id="koszyk">

                    </ul>
                    <div id="cena"><b>Razem: </b>

                        <span>0.00</span>

                        zł
                    </div>

                </div>

                <?php

                if (isset($_SESSION['zalogowany']))
                {
                    echo "<div style='text-align: center; margin-top: 20px;'><a href='../panel.php' style='font-weight: bold; color: #da8e00; text-decoration: none;'>Sprawdź</a> status zamówienia.</div>";
                }

                else {
                    echo "<div style=\"text-align: center; margin-top: 20px;\"><a href=\"../login.php\"
                                                                      style=\"font-weight: bold; color: #da8e00; text-decoration: none\">Zaloguj
                        się</a>, aby sprawdzić status zamówienia.
                </div>";
                }

                ?>


            </div>
            <div class="col-md-6 contact-col">
                <div id="order">
                    <div style="text-align: center; font-size: 22px; margin-bottom: 10px;">Wybierz metode wysylki</div>
                    <form method="post" id="order_form">



                        <select name="taskOption" form="order_form">
                            <option value="Przelew tradycyjny">Przelew tradycyjny</option>
                            <option value="Płatność przy odbiorze">Płatność przy odbiorze</option>
                        </select>

                        <input style="display: none;" id="kwota2" type="text" name="kwota2" readonly>
                        <input style="display: none;" id="zamowienie2" type="text" name="zamowienie2" readonly>



                        <script>
    $(document).ready(function () {
        $("#kwota2").val(localStorage.getItem('sumalist'));
        $("#zamowienie2").val(localStorage.getItem('item_id'));



        if ($("#zamowienie2").val().slice(-2) == ', ') {
            $("#zamowienie2").val($("#zamowienie2").val().slice(0, -2));
        } else {
            $("#zamowienie2").val($("#zamowienie2").val().slice(0, -1));
        }


        document.getElementById("nr_zamowienia2").value = pp.html();
        localStorage.setItem('order_id', document.getElementById("nr_zamowienia2").value);
    });

</script>

                        <input id="submitbutton" type="submit" value="Zamawiam">
                    </form>
                    <?php

                    if (isset($_SESSION['e_kwota2'])) {
                        echo $_SESSION['e_kwota2'];
                        unset($_SESSION['e_kwota2']);
                    }
                    ?>
                    <a href="../produkty"><input type="button" value="Powrót do sklepu"></a>
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
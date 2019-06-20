<?php

session_start();


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
    <style type="text/css">




        ul {
     list-style: none;
     float: left;
}
 
ul > li {
     margin: 0;
     padding: 0;
     float: left; 
     position: relative;
     height: 30px;
}
 
ul > li > a {
     padding: 10px; 
     color: #444;
     text-decoration: none; 
}
 
ul > li > a:hover, 
ul > li:hover > a {
     color: rgba(226,226,226,0.49);
     text-decoration: underline;
    
}
 
ul > li ul {
     padding: 0;
     position: absolute; 
     display: none; 
     left: 0px; 
     top: 30px; 
     width: 200px; 
     text-align: left;
     background-color: #fcfcfc;
     border: 1px solid #ccc;
}
 
ul li:hover > ul {
     display: block;
     margin-top: 11px;
}
 
ul > li ul ul {
     left: 200px; 
     top: -1px;
}
 
ul > li ul li {
     margin: 0; 
     padding: 0;
     position: relative; 
     float: none; 
     height: auto;
}
 
ul > li ul li a {
     padding: 10px 20px; 
     color: #505050; 
     text-decoration: none;
     display: block;
}
 
ul > li ul li a:hover,
ul > li ul li:hover > a {
     text-decoration: none;
     color: #fff;
     background-color: #f26c4f;
}
    html,
    body,
    ,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px) {

      html,
      body,
      ,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      ,
      .carousel {
        height: 100vh;
      }
    }

    .view,body,html{height:100%}

    .carousel{height:50%}

    .carousel .carousel-inner,.carousel .carousel-inner .active,.carousel .carousel-inner .carousel-item{
      height:100%
      }
      @media (max-width:776px)
      {
        .carousel{
          height:100%}}.page-footer{background-color:#929FBA}

  </style>
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
    <a class="navbar-brand" href="homepage.html"
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
            <a class="nav-link" style="color: #e28000; opacity: 1;" href="#">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color:  rgba(226,226,226,0.49);" href="#">|
            </a></li>
        <li class="nav-item">
            <a class="nav-link" href="produkty">Kategorie</a>
              <ul>
               <li><a href="/project-uz/produkty/motoryzacja">Motoryzacja</a></li>
               <li><a href="/project-uz/produkty/elektornika">Elektornia</a></li>
               <li><a href="/project-uz/produkty/mieszkanie">Mieszkanie</a></li>
               <li><a href="/project-uz/produkty/ubrania">ubrania</a></li>
               <li><a href="/project-uz/produkty/szkola">szkoła</a></li>
               <li><a href="/project-uz/produkty/sport">Sport</a></li>
          </ul>
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

   <!--Carousel Wrapper-->
  <div id="carousel-example-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel" >

    <!--Indicators-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-1z" data-slide-to="1"></li>
      <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

      <!--First slide-->
      <div class="carousel-item active">
        <div class="view" style="background-image: url('zdjecia/baner_sport.jpg'); background-repeat: no-repeat; background-size: cover; ">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4"  >
                <strong>Odżywki białkowe</strong>
              </h1>

              <p>
                <strong>Znajdź swój ulubiony smak</strong>
              </p>

              <p class="mb-4 d-none d-md-block">
                <strong>Największy wybór</strong>
              </p>

              <a target="_blank" href="/project-uz/produkty/sport" class="btn btn-outline-white btn-lg">Zobacz
               
              </a>
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/First slide-->

      <!--Second slide-->
      <div class="carousel-item">
        <div class="view" style="background-image: url('zdjecia/baner_ubrania.jpg'); background-repeat: no-repeat; background-size: cover;color: white;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Ubrania sportowe</strong>
              </h1>

              <p>
                <strong>W poszukiwaniu nowej pasji</strong>
              </p>

            

              <a target="_blank" href="/project-uz/produkty/ubrania" class="btn btn-outline-white btn-lg">Sprawdź więcej
        
              </a>
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/Second slide-->

      <!--Third slide-->
      <div class="carousel-item">
        <div class="view" style="background-image: url('zdjecia/baner_szkola.jpg'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Buty sportowe</strong>
              </h1>

              <p>
                <strong>Rozmiary od 36 do 48</strong>
              </p>

            

              <a target="_blank" href="/project-uz/produkty/szkola" class="btn btn-outline-white btn-lg">Zobacz
            
              </a>
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/Third slide-->

    </div>
    <!--/.Slides-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->

  </div>
  <!--/.Carousel Wrapper-->

<!-- Section: Products v.4 -->

<hr>
<!-- Section: Products v.1 -->
<section class="text-center my-5">

  <!-- Section heading -->
  <h2 class="h1-responsive font-weight-bold text-center my-5">Kategorie produktów</h2>
  <!-- Section description -->
  <p class="grey-text text-center w-responsive mx-auto mb-5"></p>

  <!-- Grid row -->
  <div class="row">

    <!-- Grid column -->
    <div class="col-lg-3 col-md-6 mb-lg-0 mb-4">
      <!-- Card -->
      <div class="card card-cascade narrower card-ecommerce">
        <!-- Card image -->
        <div class="view view-cascade overlay">
          <img src="zdjecia/ubrania.jpg" class="card-img-top"
            alt="sample photo">
          <a>
            <div class="mask rgba-white-slight"></div>
          </a>
        </div>
        <!-- Card image -->
        <!-- Card content -->
        <div class="card-body card-body-cascade text-center">
          <!-- Category & Title -->
          <a class="grey-text">
            <h5>Ubrania</h5>
          </a>
         
          <p class="card-text"></p>
          <!-- Card footer -->
          <div class="card-footer px-1">
            <span class="float-left font-weight-bold">
              <strong>Ceny od 120zł</strong>
            </span>
            <span class="float-right font-weight-bold" >
              <strong ><a href="/project-uz/produkty/ubrania">Zobacz</a></strong>
            </span>
            
             
            
          </div>
        </div>
        <!-- Card content -->
      </div>
      <!-- Card -->
    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-lg-3 col-md-6 mb-lg-0 mb-4">
      <!-- Card -->
      <div class="card card-cascade narrower card-ecommerce">
        <!-- Card image -->
        <div class="view view-cascade overlay">
          <img src="zdjecia/sport.jpg" class="card-img-top"
            alt="sample photo">
          <a>
            <div class="mask rgba-white-slight"></div>
          </a>
        </div>
        <!-- Card image -->
      <!-- Card content -->
        <div class="card-body card-body-cascade text-center">
          <!-- Category & Title -->
          <a  class="grey-text">
            <h5>sport</h5>
          </a>
         
          <p class="card-text"></p>
          <!-- Card footer -->
          <div class="card-footer px-1">
            <span class="float-left font-weight-bold">
              <strong>Ceny od 120zł</strong>
            </span>
            <span class="float-right font-weight-bold" >
              <strong ><a href="/project-uz/produkty/sport">Zobacz</a></strong>
            </span>
           
           
          </div>
        </div>
        <!-- Card content -->
      </div>
      <!-- Card -->
    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-lg-3 col-md-6 mb-md-0 mb-3">
      <!-- Card -->
      <div class="card card-cascade narrower card-ecommerce">
        <!-- Card image -->
        <div class="view view-cascade overlay">
          <img src="zdjecia/mieszkanie.jpg" class="card-img-top"
            alt="sample photo">
          <a>
            <div class="mask rgba-white-slight"></div>
          </a>
        </div>
        <!-- Card image -->
  <!-- Card content -->
        <div class="card-body card-body-cascade text-center">
          <!-- Category & Title -->
          <a  class="grey-text">
            <h5>Mieszkanie</h5>
          </a>
         
          <p class="card-text"></p>
          <!-- Card footer -->
          <div class="card-footer px-1">
            <span class="float-left font-weight-bold">
              <strong>Ceny od 120zł</strong>
            </span>
            <span class="float-right font-weight-bold" >
              <strong ><a href="/project-uz/produkty/sport">Zobacz</a></strong>
            </span>
          </div>
        </div>
        <!-- Card content -->
      </div>
      <!-- Card -->
    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-lg-3 col-md-6">
      <!-- Card -->
      <div class="card card-cascade narrower card-ecommer ce">
        <!-- Card image -->
        <div class="view view-cascade overlay">
          <img src="zdjecia/elektornika.jpg" class="card-img-top"
            alt="sample photo">
          <a>
            <div class="mask rgba-white-slight"></div>
          </a>
        </div>
        <!-- Card image -->
    <!-- Card content -->
        <div class="card-body card-body-cascade text-center">
          <!-- Category & Title -->
          <a  class="grey-text">
            <h5>Elektronika</h5>
          </a>
         
          <p class="card-text"></p>
          <!-- Card footer -->
          <div class="card-footer px-1">
            <span class="float-left font-weight-bold">
              <strong>Ceny od 120zł</strong>
            </span>
            <span class="float-right font-weight-bold" >
              <strong ><a href="/project-uz/produkty/elektornika">Zobacz</a></strong>
            </span>
          </div>
        </div>
        <!-- Card content -->
      </div>
      <!-- Card -->
    </div>
    <!-- Grid column -->

  </div>
  <!-- Grid row -->

</section>
<!-- Section: Products v.1 -->
</main>
   <footer >
    <div id="footer" style="position: relative; bottom: 0px; z-index: -5;">
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
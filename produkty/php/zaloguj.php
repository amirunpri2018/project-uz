<?php
session_start();
if ((!isset($_POST['login'])) || (!isset($_POST['password']))) {
    header('location: ../index.php');
    exit();
}
require_once "connect.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$login = $_POST['login'];
$haslo = $_POST['password'];
if ($polaczenie->connect_errno != 0) {
    echo "Error: " . $polaczenie->connect_errno;
} else {
    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
    if ($rezultat = @$polaczenie->query(
        sprintf("SELECT * FROM customer WHERE login = '%s' AND password = '%s'",
            mysqli_real_escape_string($polaczenie, $login),
            mysqli_real_escape_string($polaczenie, $haslo)))) {
        $ilu_userow = $rezultat->num_rows;
        if ($ilu_userow > 0) {
            $_SESSION['zalogowany'] = true;
            $wiersz = $rezultat->fetch_assoc();
            $_SESSION['z_id'] = $wiersz['z_id'];
            $_SESSION['name'] = $wiersz['name'];
            $_SESSION['surname'] = $wiersz['surname'];
            $_SESSION['login'] = $wiersz['login'];
            $_SESSION['password'] = $wiersz['password'];
            $_SESSION['address'] = $wiersz['address'];

            unset($_SESSION['blad']);
            $rezultat->free_result();
            header('Location: ../index.php');
        } else {
            $_SESSION['blad'] = '<div style="color: red; text-align: center; font-size: 13px;">Nieprawidłowy numer lub kod dostępu!</div>';
            header('location: ../index.php');
        }
    }
    $polaczenie->close();
}
?>

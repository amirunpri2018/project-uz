<?php


class CustomerRegister {
    public function registerCustomer($imie, $nazwisko, $login, $haslo, $adres, $zip, $miejscowosc, $phone){
        $wszystko_ok = true;
        $phone = str_replace(' ', '', $phone);

        echo '
            <style>
                input[name=\'imie\'] {
                    border: 1px solid red!important;
                    background-color: rgba(255,0,0,0.10)!important;
                }
                
                input[name=\'nazwisko\'] {
                    border: 1px solid red!important;
                    background-color: rgba(255,0,0,0.10)!important;
                }
                
                input[name=\'login\'] {
                    border: 1px solid red!important;
                    background-color: rgba(255,0,0,0.10)!important;
                }
                
                input[name=\'haslo\'] {
                    border: 1px solid red!important;
                    background-color: rgba(255,0,0,0.10)!important;
                }
                
                input[name=\'adres\'] {
                    border: 1px solid red!important;
                    background-color: rgba(255,0,0,0.10)!important;
                }
                
                input[name=\'phone\'] {
                    border: 1px solid red!important;
                    background-color: rgba(255,0,0,0.10)!important;
                }
                
                input[name=\'zip\'] {
                    border: 1px solid red!important;
                    background-color: rgba(255,0,0,0.10)!important;
                }
                
                input[name=\'miejscowosc\'] {
                    border: 1px solid red!important;
                    background-color: rgba(255,0,0,0.10)!important;
                }
                
                .inputDBException {
                    color: red;
                }
            </style>
        ';
        // === IMIĘ ===

        if (strlen($imie) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Pole imię jest wymagane!";
        }

        if (strlen($imie) > 16) {
            $wszystko_ok = false;
            $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 15 liter!";
        }

        if (ctype_alnum($imie) == false) {
            $wszystko_ok = false;
            $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Pole imię jest wymagane!";
        }

        if (preg_match("/[^A-z_-]/", $imie) == 1) {
            $wszystko_ok = false;
            $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Wprowadź tylko litery!";
        }

        // === NAZWISKO ===

        if (strlen($nazwisko) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Pole nazwisko jest wymagane!";
        }

        if (strlen($nazwisko) > 16) {
            $wszystko_ok = false;
            $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 15 liter!";
        }

        if (ctype_alnum($nazwisko) == false) {
            $wszystko_ok = false;
            $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Pole nazwisko jest wymagane!";
        }

        if (preg_match("/[^A-z_-]/", $nazwisko) == 1) {
            $wszystko_ok = false;
            $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Wprowadź tylko litery!";
        }

        // === LOGIN ===

        if (strlen($login) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Pole login jest wymagane!";
        }

        if (strlen($login) > 11) {
            $wszystko_ok = false;
            $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 10 znaków!";
        }

        // === HASŁO ===

        if (strlen($haslo) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Pole hasło jest wymagane!";
        }

        if (strlen($haslo) > 11) {
            $wszystko_ok = false;
            $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 10 znaków!";
        }

        // === ULICA ===

        if (strlen($adres) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_adres'] = "<i class=\"fas fa-user-times\"></i> Pole adres dostawy jest wymagane!";
        }

        if (strlen($adres) > 40) {
            $wszystko_ok = false;
            $_SESSION['e_adres'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 40 znaków!";
        }

        // === KOD POCZTOWY ===

        if (strlen($zip) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_zip'] = "<i class=\"fas fa-user-times\"></i> Pole kod pocztowy jest wymagane!";
        }

        if (strlen($zip) > 6) {
            $wszystko_ok = false;
            $_SESSION['e_zip'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 6 znaków!";
        }

        // === MIEJSCOWOSC ===

        if (strlen($miejscowosc) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_miejscowosc'] = "<i class=\"fas fa-user-times\"></i> Pole miejscowość jest wymagane!";
        }

        if (strlen($miejscowosc) > 40) {
            $wszystko_ok = false;
            $_SESSION['e_miejscowosc'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 40 znaków!";
        }

        // === NUMER TELEFONU ===

        if (strlen($phone) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_phone'] = "<i class=\"fas fa-user-times\"></i> Pole telefon jest wymagane!";
        }

        if (strlen($phone) > 11) {
            $wszystko_ok = false;
            $_SESSION['e_phone'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 9 znaków!";
        }

        // === ZAPRZESTAN WYKONYWANIE ===

        if($wszystko_ok == false){
            return 1;
        }

        $databaseConnection = new Connect();

        try {
            $checkIfLoginExist = $databaseConnection->query(
                "SELECT login 
                        FROM customer 
                        WHERE login='$login'")->numRows();

            if($checkIfLoginExist > 0){
                $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Istnieje już taki login!";
                return 1;
            }
        } finally {
            $databaseConnection->close();
        }

        $databaseConnection = new Connect();

        try {
             $registerUser = $databaseConnection->query(
                "INSERT INTO customer 
                            VALUES (NULL, '$imie', '$nazwisko', '$adres', '$miejscowosc', '$zip', '$phone', '$login', '$haslo')");
        } catch (Exception $e) {
            echo "
                <span class='inputDBException'>
                    Błąd serwera! Prosimy o rejestrację w innym terminie! :)
                </span>";

            echo $e;
        } finally {
            $databaseConnection->close();
            $_SESSION['udanarejestracja'] = "Rejestracja zakończona pomyślnie!";
            header('location: /login.php');
            exit();
        }
    }
}
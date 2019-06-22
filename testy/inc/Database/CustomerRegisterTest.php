<?php


class CustomerRegisterTest extends PHPUnit_Framework_TestCase {
    public function testRegisterCustomer(){
        $wszystko_ok = true;

        $imie = 'Andrzej';
        $nazwisko = 'Newton';
        $adres = 'Podgórna 16';
        $miejscowosc = 'Wolsztyn';
        $zip = '64-200';
        $phone = '600700800';
        $login = 'andrew123';
        $haslo = 'lol1234';

        /*echo '
            <!--<style>
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
            </style>-->
        ';*/
        // === IMIĘ ===

        if (strlen($imie) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Pole imię jest wymagane!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_imie']);
        }

        if (strlen($imie) > 16) {
            $wszystko_ok = false;
            $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 15 liter!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_imie']);
        }

        if (ctype_alnum($imie) == false) {
            $wszystko_ok = false;
            $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Pole imię jest wymagane!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_imie']);
        }

        if (preg_match("/[^A-z_-]/", $imie) == 1) {
            $wszystko_ok = false;
            $_SESSION['e_imie'] = "<i class=\"fas fa-user-times\"></i> Wprowadź tylko litery!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_imie']);
        }

        // === NAZWISKO ===

        if (strlen($nazwisko) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Pole nazwisko jest wymagane!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_nazwisko']);
        }

        if (strlen($nazwisko) > 16) {
            $wszystko_ok = false;
            $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 15 liter!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_nazwisko']);
        }

        if (ctype_alnum($nazwisko) == false) {
            $wszystko_ok = false;
            $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Pole nazwisko jest wymagane!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_nazwisko']);
        }

        if (preg_match("/[^A-z_-]/", $nazwisko) == 1) {
            $wszystko_ok = false;
            $_SESSION['e_nazwisko'] = "<i class=\"fas fa-user-times\"></i> Wprowadź tylko litery!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_nazwisko']);
        }

        // === LOGIN ===

        if (strlen($login) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Pole login jest wymagane!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_login']);
        }

        if (strlen($login) > 11) {
            $wszystko_ok = false;
            $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 10 znaków!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_login']);
        }

        // === HASŁO ===

        if (strlen($haslo) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Pole hasło jest wymagane!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_haslo']);
        }

        if (strlen($haslo) > 11) {
            $wszystko_ok = false;
            $_SESSION['e_haslo'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 10 znaków!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_haslo']);
        }

        // === ULICA ===

        if (strlen($adres) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_adres'] = "<i class=\"fas fa-user-times\"></i> Pole adres dostawy jest wymagane!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_adres']);
        }

        if (strlen($adres) > 40) {
            $wszystko_ok = false;
            $_SESSION['e_adres'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 40 znaków!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_adres']);
        }

        // === KOD POCZTOWY ===

        if (strlen($zip) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_zip'] = "<i class=\"fas fa-user-times\"></i> Pole kod pocztowy jest wymagane!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_zip']);
        }

        if (strlen($zip) > 6) {
            $wszystko_ok = false;
            $_SESSION['e_zip'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 6 znaków!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_zip']);
        }

        // === MIEJSCOWOSC ===

        if (strlen($miejscowosc) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_miejscowosc'] = "<i class=\"fas fa-user-times\"></i> Pole miejscowość jest wymagane!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_miejscowosc']);
        }

        if (strlen($miejscowosc) > 40) {
            $wszystko_ok = false;
            $_SESSION['e_miejscowosc'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 40 znaków!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_miejscowosc']);
        }

        // === NUMER TELEFONU ===

        if (strlen($phone) < 1) {
            $wszystko_ok = false;
            $_SESSION['e_phone'] = "<i class=\"fas fa-user-times\"></i> Pole telefon jest wymagane!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_phone']);
        }

        if (strlen($phone) > 11) {
            $wszystko_ok = false;
            $_SESSION['e_phone'] = "<i class=\"fas fa-user-times\"></i> Wprowadź maksymalnie 9 znaków!";

            $this->assertInternalType('boolean', $wszystko_ok);
            $this->assertInternalType('string', $_SESSION['e_phone']);
        }

        // === ZAPRZESTAN WYKONYWANIE ===

        if($wszystko_ok == false){
            $this->assertEquals($wszystko_ok, false);
            return 1;
        }

        $mockedDbConnection = \Mockery::mock('\Doctrine\DBAL\Connection');
        $mockedStatement = \Mockery::mock('\Doctrine\DBAL\Driver\Statement');
        //$databaseConnection = new Connect();

        try {
            $mockedDbConnection
                ->shouldReceive('executeQuery')
                ->with("
                        SELECT login 
                        FROM customer 
                        WHERE login='$login'")
                ->andReturn($mockedStatement);

            $mockedRows = array(
            );

            $mockedStatement
                ->shouldReceive('num_rows')
                ->andReturns(count($mockedRows));

            $this->assertEquals(count($mockedRows), 0);

            if(count($mockedRows) > 0){

            }

            /*$checkIfLoginExist = $databaseConnection->query(
                "SELECT login 
                        FROM customer 
                        WHERE login='$login'")->numRows();

            if($checkIfLoginExist > 0){
                $_SESSION['e_login'] = "<i class=\"fas fa-user-times\"></i> Istnieje już taki login!";
                return 1;
            }*/
        } finally {
            Mockery::close();
            //$databaseConnection->close();
        }

        $mockedDbConnection = \Mockery::mock('\Doctrine\DBAL\Connection');
        $mockedStatement = \Mockery::mock('\Doctrine\DBAL\Driver\Statement');
        //$databaseConnection = new Connect();

        try {
            $mockedDbConnection
                ->shouldReceive('executeQuery')
                ->with("
                        INSERT INTO customer 
                            VALUES (NULL, '$imie', '$nazwisko', '$adres', '$miejscowosc', '$zip', '$phone', '$login', '$haslo')")
                ->andReturn($mockedStatement);

            /*$registerUser = $databaseConnection->query(
                "INSERT INTO customer
                            VALUES (NULL, '$imie', '$nazwisko', '$adres', '$miejscowosc', '$zip', '$phone', '$login', '$haslo')");*/
        } catch (Exception $e) {
            echo "
                <span class='inputDBException'>
                    Błąd serwera! Prosimy o rejestrację w innym terminie! :)
                </span>";

            echo $e;
        } finally {
            Mockery::close();
            //$databaseConnection->close();
            $_SESSION['udanarejestracja'] = "Rejestracja zakończona pomyślnie!";
            $this->assertInternalType('string', $_SESSION['udanarejestracja']);
            //header('location: login.php');
        }
    }
}
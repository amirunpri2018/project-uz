<?php


class CustomerLoginTest extends PHPUnit_Framework_TestCase {
    public function testLoginCustomer(){
        $mockedDbConnection = \Mockery::mock('\Doctrine\DBAL\Connection');
        $mockedStatement = \Mockery::mock('\Doctrine\DBAL\Driver\Statement');
        //$databaseConnection = new Connect();

        $login = 'andrew123';
        $password = 'lol1234';

        try {
            $mockedDbConnection
                ->shouldReceive('executeQuery')
                ->with("
                        SELECT * 
                        FROM customer 
                        WHERE login = '$login' 
                            AND password = '$password';")
                ->andReturn($mockedStatement);

            $mockedRows = array(
                array('id' => 1,
                    'name' => 'Andrzej',
                    'surname' => 'Newton',
                    'address' => 'Podgórna 16',
                    'city' => 'Wolsztyn',
                    'zip_code' => '64-200',
                    'phone_number' => '600700800',
                    'login' => 'andrew123',
                    'password' => 'lol1234')
            );

            $mockedStatement
                ->shouldReceive('num_rows')
                ->andReturns(count($mockedRows));

            $this->assertEquals(count($mockedRows), 1);

            if(count($mockedRows) != 1){

            } else {
                $zalogowany = true;
                $this->assertEquals($zalogowany, true);

                $expectedResult = $mockedRows;

                foreach($expectedResult as $row){
                    $this->assertInternalType('int', $row['id']);
                    $this->assertInternalType('string', $row['name']);
                    $this->assertInternalType('string', $row['surname']);
                    $this->assertInternalType('string', $row['address']);
                    $this->assertInternalType('string', $row['city']);
                    $this->assertInternalType('string', $row['zip_code']);
                    $this->assertInternalType('string', $row['phone_number']);
                    $this->assertInternalType('string', $row['login']);
                    $this->assertInternalType('string', $row['password']);
                }
            }

            /*
            $loginCustomer = $databaseConnection->query(
                "SELECT * 
                        FROM customer 
                        WHERE login = '$login' 
                            AND password = '$password'");

            $howManyUsers = $loginCustomer->numRows();

            if($howManyUsers != 1){
                echo "<style>
                        input[type='text'], input[type='password']  {
                            border: 1px solid red!important;
                            background-color: rgba(255,0,0,0.09)!important;
                        }
                        .sessionError {
                            color: red; 
                            text-align: center; 
                            font-size: 14px; 
                            font-weight: bold; 
                            margin: 10px;
                        }
                    </style>";

                $_SESSION['blad1'] = '<div class="sessionError">Nieprawidłowy login lub hasło!</div>';
            } else {
                $_SESSION['zalogowany'] = true;

                $result = $loginCustomer->fetchAll();

                foreach($result as $row){
                    $_SESSION['z_id'] = $row['id'];
                    $_SESSION['z_imie'] = $row['name'];
                    $_SESSION['z_nazwisko'] = $row['surname'];
                    $_SESSION['z_adres'] = $row['address'];
                    $_SESSION['z_miejscowosc'] = $row['city'];
                }

                header('Location: panel.php');
            }*/
        } finally {
            Mockery::close();
            //$databaseConnection->close();
        }
    }
}
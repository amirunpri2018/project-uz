<?php


class CustomerLogin {
    public function loginCustomer($login, $password){
        $databaseConnection = new Connect();

        try {
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
            }
        } finally {
            $databaseConnection->close();
        }
    }
}
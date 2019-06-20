<?php


class CustomerPanelTest extends PHPUnit_Framework_TestCase {
    public function testGetCustomerData() {
        $mockedDbConnection = \Mockery::mock('\Doctrine\DBAL\Connection');
        $mockedStatement = \Mockery::mock('\Doctrine\DBAL\Driver\Statement');
        //$getCustomerData = new Connect();

        $CustomerID = 1;

        try {
            $mockedDbConnection
                ->shouldReceive('executeQuery')
                ->with("SELECT 
                            Name AS Imie,
                            Surname AS Nazwisko,
                            Address AS Ulica,
                            Zip_Code AS Kod_Pocztowy,
                            City AS Miejscowosc,
                            Phone_Number AS Nr_Telefonu,
                            '' AS Email
                        FROM customer
                        WHERE id = '$CustomerID';")
                ->andReturn($mockedStatement);
            /*$getInfo = $getCustomerData->query(
                        "SELECT
                            Imie,
                            Nazwisko,
                            Adres AS Ulica,
                            '' as Kod_Pocztowy,
                            Miejscowosc,
                            '' AS Nr_Telefonu,
                            '' AS Email
                        FROM klienci
                        WHERE id = 4;"
            )->fetchAll();*/

            $mockedRows = array(
                array('Imie' => 'Andzej',
                    'Nazwisko' => 'Newton',
                    'Adres' => 'Podgórna 16',
                    'Kod_Pocztowy' => '64-200',
                    'Miejscowosc' => 'Wolsztyn',
                    'Nr_Telefonu' => '600 700 900',
                    'Email'=> 'andrzej@newton.com')
            );

            $mockedStatement
                ->shouldReceive('fetch')
                ->andReturnUsing(function () use (&$mockedRows) {
                    $row = current($mockedRows);
                    next($mockedRows);
                    return $row;
                });

            $expectedResult = $mockedRows;

            foreach($expectedResult as $row){
                $this->assertInternalType('string', $row['Imie']);
                $this->assertInternalType('string', $row['Nazwisko']);
                $this->assertInternalType('string', $row['Adres']);
                $this->assertInternalType('string', $row['Kod_Pocztowy']);
                $this->assertInternalType('string', $row['Miejscowosc']);
                $this->assertInternalType('string', $row['Nr_Telefonu']);
                $this->assertInternalType('string', $row['Email']);
            }

            //foreach($getInfo as $result){
                /*echo '<form>';
                echo '    <div class="form-row">';
                echo '        <div class="form-group col-md-6">';
                echo '            <label for="inputImie">Imię: </label>';
                echo '            <input type="text" class="form-control" id="inputImie" 
                                    placeholder="Podaj imię: " value="' . $this->assertInternalType('string', $imie) . '">';
                echo '        </div>';
                echo '        <div class="form-group col-md-6">';
                echo '            <label for="inputImie">Nazwisko: </label>';
                echo '            <input type="text" class="form-control" id="inputImie" 
                                    placeholder="Podaj nazwisko: " value="' . $this->assertInternalType('string', $nazwisko) . '">';
                echo '        </div>';
                echo '    </div>';
                echo '';
                echo '    <div class="form-group">';
                echo '        <label for="inputUlica">Ulica: </label>';
                echo '        <input type="text" class="form-control" id="inputUlica" 
                                    placeholder="Podaj ulicę: " value="' . $this->assertInternalType('string', $ulica) . '">';
                echo '    </div>';
                echo '';
                echo '    <div class="form-row">';
                echo '        <div class="form-group col-md-6">';
                echo '            <label for="inputKodPocztowy">Kod pocztowy: </label>';
                echo '            <input type="text" class="form-control" id="inputKodPocztowy" 
                                    placeholder="Podaj kod pocztowy: " value="' . $this->assertInternalType('string', $kod_pocztowy) . '">';
                echo '        </div>';
                echo '        <div class="form-group col-md-6">';
                echo '            <label for="inputMiejscowosc">Miejscowość: </label>';
                echo '            <input type="text" class="form-control" id="inputMiejscowosc" 
                                    placeholder="Podaj miejscowość: " value="' . $this->assertInternalType('string', $miejscowosc) . '">';
                echo '        </div>';
                echo '    </div>';
                echo '';
                echo '    <div class="form-group">';
                echo '        <label for="inputNrTelefonu">Numer telefonu: </label>';
                echo '        <input type="text" class="form-control" id="inputNrTelefonu" 
                                    placeholder="Podaj numer telefonu: " value="' . $this->assertInternalType('string', $nr_telefonu) . '">';
                echo '    </div>';
                echo '';
                echo '    <div class="form-group">';
                echo '        <label for="inputEmail">Adres e-mail: </label>';
                echo '        <input type="email" class="form-control" id="inputEmail" 
                                    placeholder="Podaj adres e-mail: " value="' . $this->assertInternalType('string', $email) . '">';
                echo '    </div>';
                echo '';
                echo '    <button type="submit" class="btn btn-primary">Zapisz</button>';
                echo '</form>';*/
            //}

        } finally {
            Mockery::close();
            //$getCustomerData->close();
        }
    }

    public function testGetCustomerOrders() {
        $mockedDbConnection = \Mockery::mock('\Doctrine\DBAL\Connection');
        $mockedStatement = \Mockery::mock('\Doctrine\DBAL\Driver\Statement');
        //$getOrders = new Connect();

        $CustomerID = 1;

        try {
            $mockedDbConnection
                ->shouldReceive('executeQuery')
                ->with("SELECT 
                    o.ID as ID, 
                    o.Date as Data_Zlozenia,
                    s.Name as Nazwa_Statusu,
                    o.Price as Kwota
                FROM `order` AS o
                    INNER JOIN status AS s ON s.ID = o.`status_id`
                WHERE o.customer_id = '$CustomerID'")
                ->andReturn($mockedStatement);

            /*$getOrdersList = $getOrders->query(
                "SELECT 
                    o.ID as ID, 
                    o.Data_Zlozenia as Data_Zlozenia,
                    s.Nazwa as Nazwa_Statusu,
                    o.Kwota as Kwota
                FROM zamowienia AS o
                    INNER JOIN status AS s ON s.ID = o.`Status`"
            )->fetchAll();*/

            $mockedRows = array(
                array('ID' => 1,
                    'Data_Zlozenia' => '2019-06-15 20:10:20',
                    'Nazwa' => 'Zamkniety (wysłano)',
                    'Kwota' => 360.00),
                array('ID' => 2,
                    'Data_Zlozenia' => '2019-06-18 14:35:57',
                    'Nazwa' => 'Nowe',
                    'Kwota' => 240.97),
            );

            /*echo '<table class="table table-hover">';
            echo '    <thead class="thead-dark">';
            echo '        <tr>';
            echo '            <th scope="col">Nr zamówienia</th>';
            echo '            <th scope="col">Data złożenia</th>';
            echo '            <th scope="col">Status zamówienia</th>';
            echo '            <th scope="col">Wartość</th>';
            echo '        </tr>';
            echo '    </thead>';
            echo '    <tbody>';*/

            $mockedStatement
                ->shouldReceive('fetch')
                ->andReturnUsing(function () use (&$mockedRows) {
                    $row = current($mockedRows);
                    next($mockedRows);
                    return $row;
                });

            $expectedResult = $mockedRows;

            foreach($expectedResult as $row){
                $this->assertInternalType('int', $row['ID']);
                $this->assertInternalType('string', $row['Data_Zlozenia']);
                $this->assertInternalType('string', $row['Nazwa']);
                $this->assertInternalType('float', $row['Kwota']);
            }

            /*foreach($getOrdersList as $result){
                echo '        <tr>';
                echo '            <th scope="row">#' .  sprintf('%08d', $result['ID']) . '</th>';
                echo '            <td>' . $result['Data_Zlozenia'] . '</td>';
                echo '            <td>' . $result['Nazwa_Statusu'] . '</td>';
                echo '            <td>' . number_format($result['Kwota'], 2,',', ' ') . ' zł' . '</td>';
                echo '        </tr>';
            }*/

            //echo '    </tbody>';
            //echo '</table>';

        } finally {
            Mockery::close();
            //$getOrders->close();
        }
    }

    public function testGetCustomerQuestions(){
        $mockedDbConnection = \Mockery::mock('\Doctrine\DBAL\Connection');
        $mockedStatement = \Mockery::mock('\Doctrine\DBAL\Driver\Statement');
        //$getQuestions = new Connect();

        $CustomerID = 1;

        try {
            $mockedDbConnection
                ->shouldReceive('executeQuery')
                ->with("SELECT
                            q.ID AS ID,
                            q.Topic AS Temat,
                            q.Date AS Utworzono,
                            MAX(qc.Date) AS Ostatnia_odp,
                            zs.Name AS Status
                        FROM ask_question AS q
                            INNER JOIN ask_conversation AS qc ON q.ID = qc.question_id
                            INNER JOIN ask_status AS zs ON q.status_id = zs.ID
                        WHERE q.customer_id = '$CustomerID'
                        GROUP BY q.ID;")
                ->andReturn($mockedStatement);

            /*$getQuestionsList = $getQuestions->query(
                "SELECT
                            q.ID AS ID,
                            q.Topic AS Temat,
                            q.Date AS Utworzono,
                            MAX(qc.Date) AS Ostatnia_odp,
                            zs.Name AS Status
                        FROM ask_question AS q
                            INNER JOIN ask_conversation AS qc ON q.ID = qc.question_id
                            INNER JOIN ask_status AS zs ON q.status_id = zs.ID
                        WHERE q.customer_id = '$CustomerID'
                        GROUP BY q.ID;"
            )->fetchAll();*/

            $mockedStatement
                ->shouldReceive('fetch')
                ->andReturnUsing(function () use (&$mockedRows) {
                    $row = current($mockedRows);
                    next($mockedRows);
                    return $row;
                });

            $mockedRows = array(
                array('ID' => 1,
                    'Temat' => 'Rabat',
                    'Utworzono' => '2019-06-20 18:13:17',
                    'Ostatnia_odp' => '2019-06-21 09:03:45',
                    'Status' => 'Zamknięte'),
                array('ID' => 2,
                    'Temat' => 'Status zamówienia',
                    'Utworzono' => '2019-07-01 15:19:22',
                    'Ostatnia_odp' => '2019-07-01 16:33:48',
                    'Status' => 'Odpowiedź sklepu'),
            );

            $mockedStatement
                ->shouldReceive('fetch')
                ->andReturnUsing(function () use (&$mockedRows) {
                    $row = current($mockedRows);
                    next($mockedRows);
                    return $row;
                });

            $expectedResult = $mockedRows;

            foreach($expectedResult as $row){
                $this->assertInternalType('int', $row['ID']);
                $this->assertInternalType('string', $row['Temat']);
                $this->assertInternalType('string', $row['Utworzono']);
                $this->assertInternalType('string', $row['Ostatnia_odp']);
                $this->assertInternalType('string', $row['Status']);
            }

            /*echo '<table class="table table-hover">';
            echo '    <thead class="thead-dark">';
            echo '        <tr>';
            echo '            <th scope="col">Temat</th>';
            echo '            <th scope="col">Utworzono</th>';
            echo '            <th scope="col">Ostatnia odpowiedź</th>';
            echo '            <th scope="col">Status</th>';
            echo '        </tr>';
            echo '    </thead>';
            echo '    <tbody>';

            foreach($getQuestionsList as $result){
                echo '        <tr class="clickable-row" data-href="../panelklienta/zapytania.php?id=' . $result['ID'] . '">';
                echo '            <th scope="row">' . $result['Temat'] . '</th>';
                echo '            <td>' . $result['Utworzono'] . '</td>';
                echo '            <td>' . $result['Ostatnia_odp'] . '</td>';
                echo '            <td>' . $result['Status'] . '</td>';
                echo '        </tr>';

                $questionsIDs[] = $result['ID'];
            }

            echo '    </tbody>';
            echo '</table>';

            echo '<script>
                jQuery(document).ready(function($) {
                    $(".clickable-row").click(function() {
                        window.location = $(this).data("href");
                    });
                });
                </script>';
         */
        } finally {
            Mockery::close();
            //$getQuestions->close();
        }
    }

    public function testGetQuestionDetails(){
        $mockedDbConnection = \Mockery::mock('\Doctrine\DBAL\Connection');
        $mockedStatement = \Mockery::mock('\Doctrine\DBAL\Driver\Statement');
        //$getQuestion = new Connect();
        $statusID = -1;

        $CustomerID = 1;
        $QuestionID = 1;

        try {
            $mockedDbConnection
                ->shouldReceive('executeQuery')
                ->with("SELECT
                            qc.question_id AS ID_Zapytania,
                            q.topic AS Temat,
                            (SELECT 
                                CONCAT(name, ' ', surname) 
                            FROM customer
                            WHERE customer.id = qc.customer_id) AS Uzytkownik,
                            qc.date AS Data,
                            qc.contents AS Tresc,
                            zs.Name AS Status
                        FROM ask_conversation AS qc
                            INNER JOIN ask_question AS q ON q.customer_id = qc.customer_id
                            INNER JOIN ask_status AS zs ON q.status_id = zs.ID
                        WHERE q.customer_id = '$CustomerID'
                            AND qc.question_id = '$QuestionID'
                        GROUP BY qc.ID")
                ->andReturn($mockedStatement);

            $mockedStatement
                ->shouldReceive('fetch')
                ->andReturnUsing(function () use (&$mockedRows) {
                    $row = current($mockedRows);
                    next($mockedRows);
                    return $row;
                });

            $mockedRows = array(
                array('ID' => 1,
                    'Temat' => 'Rabat',
                    'Uzytkownik' => 'Andzej Newton',
                    'Data' => '2019-06-20 19:17:33',
                    'Tresc' => 'Dzień dobry<br><br>Co się dzieje z moim zamówieniem? Od 3 dni nie zmienił się status!<br>',
                    'Status' => 'Nowe')
            );

            $mockedStatement
                ->shouldReceive('fetch')
                ->andReturnUsing(function () use (&$mockedRows) {
                    $row = current($mockedRows);
                    next($mockedRows);
                    return $row;
                });

            $expectedResult = $mockedRows;

            foreach($expectedResult as $row){
                $this->assertInternalType('int', $row['ID']);
                $this->assertInternalType('string', $row['Temat']);
                $this->assertInternalType('string', $row['Uzytkownik']);
                $this->assertInternalType('string', $row['Data']);
                $this->assertInternalType('string', $row['Tresc']);
                $this->assertInternalType('string', $row['Status']);
            }

            /*$getDetails = $getQuestion->query(
                "SELECT
                            qc.ID_Zapytania AS ID_Zapytania,
                            q.Temat AS Temat,
                            (SELECT 
                                CONCAT(imie, ' ', nazwisko) 
                            FROM klienci 
                            WHERE klienci.id = qc.ID_Uzytkownika) AS Uzytkownik,
                            qc.Data_Wyslania AS Data,
                            qc.Tresc AS Tresc,
                            q.Status AS Status
                        FROM zap_konwersacja AS qc
                            INNER JOIN zap_zapytania AS q ON q.ID = qc.ID_Zapytania
                            INNER JOIN zap_status AS zs ON q.`Status` = zs.ID
                        WHERE q.ID_Klienta = 4 
                            AND qc.ID_Zapytania = '$ID_Zapytania'
                        GROUP BY qc.ID"
            )->fetchAll();

            foreach($getDetails as $result){
                echo '<table class="table table-hover">';
                echo '    <thead class="thead-dark">';
                echo '        <tr>';
                echo '            <th style="width: 33.33%;" scope="col">Temat: ' . $result['Temat'] . '</th>';
                echo '            <th style="width: 33.33%;" scope="col">Od: ' . $result['Uzytkownik'] . '</th>';
                echo '            <th style="width: 33.33%;" scope="col">Data: ' . $result['Data'] . '</th>';
                echo '        </tr>';
                echo '    </thead>';
                echo '    <tbody>';
                echo '        <tr>';
                echo '            <td colspan="3">' . $result['Tresc'] . '</td>';
                echo '        </tr>';
                echo '    </tbody>';
                echo '</table>';

                $statusID = $result['Status'];
            }

            if($statusID < 4){
                echo '<div class="form-group">';
                    echo '<table class="table table-hover">';
                    echo '    <thead class="thead-dark">';
                    echo '        <tr>';
                    echo '            <th scope="col">Twoja odpowiedź: </th>';
                    echo '        </tr>';
                    echo '    </thead>';
                    echo '</table>';

                    echo '<textarea class="form-control" id="textAreaTrescWiadomosci" rows="3"></textarea>';
                    echo '<button type="submit" class="btn btn-primary">Wyślij wiadomość</button>';
                echo '</div>';
            }*/
        } finally {
            Mockery::close();
            //$getQuestion->close();
        }
    }

    public function changeCustomerData() {

    }

    public function changeCustomerOrders(){

    }
}
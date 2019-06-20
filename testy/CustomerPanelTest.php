<?php

//require_once '../inc/Database/Connect.php';

class CustomerPanelTest extends PHPUnit_Framework_TestCase {
    public function testGetCustomerData() {
        //$getCustomerData = new Connect();

        try {
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

            $imie = 'Andrzej';
            $nazwisko = 'Newton';
            $ulica = 'Podgórna 16';
            $kod_pocztowy = '64-200';
            $miejscowosc = 'Wolsztyn';
            $nr_telefonu = '600 700 900';
            $email = 'andrzej@newton.com';

            //foreach($getInfo as $result){
                echo '<form>';
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
                echo '</form>';
            //}

        } finally {
            //$getCustomerData->close();
        }
    }

    public function getCustomerOrders() {
        $getOrders = new Connect();

        try {
            $getOrdersList = $getOrders->query(
                "SELECT 
                    o.ID as ID, 
                    o.Data_Zlozenia as Data_Zlozenia,
                    s.Nazwa as Nazwa_Statusu,
                    o.Kwota as Kwota
                FROM zamowienia AS o
                    INNER JOIN status AS s ON s.ID = o.`Status`"
            )->fetchAll();

            echo '<table class="table table-hover">';
            echo '    <thead class="thead-dark">';
            echo '        <tr>';
            echo '            <th scope="col">Nr zamówienia</th>';
            echo '            <th scope="col">Data złożenia</th>';
            echo '            <th scope="col">Status zamówienia</th>';
            echo '            <th scope="col">Wartość</th>';
            echo '        </tr>';
            echo '    </thead>';
            echo '    <tbody>';

            foreach($getOrdersList as $result){
                echo '        <tr>';
                echo '            <th scope="row">#' .  sprintf('%08d', $result['ID']) . '</th>';
                echo '            <td>' . $result['Data_Zlozenia'] . '</td>';
                echo '            <td>' . $result['Nazwa_Statusu'] . '</td>';
                echo '            <td>' . number_format($result['Kwota'], 2,',', ' ') . ' zł' . '</td>';
                echo '        </tr>';
            }

            echo '    </tbody>';
            echo '</table>';

        } finally {
            $getOrders->close();
        }
    }

    public function getCustomerQuestions(){
        $getQuestions = new Connect();

        try {
            $getQuestionsList = $getQuestions->query(
                "SELECT
                            q.ID AS ID,
                            q.Temat AS Temat,
                            q.Data_Utworzenia AS Utworzono,
                            MAX(qc.Data_Wyslania) AS Ostatnia_odp,
                            zs.Nazwa AS Status
                        FROM zap_zapytania AS q
                            INNER JOIN zap_konwersacja AS qc ON q.ID = qc.ID_Zapytania
                            INNER JOIN zap_status AS zs ON q.`Status` = zs.ID
                        WHERE q.ID_Klienta = 4
                        GROUP BY q.ID;"
            )->fetchAll();

            echo '<table class="table table-hover">';
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
        } finally {
            $getQuestions->close();
        }
    }

    public function getQuestionDetails($ID_Zapytania){
        $getQuestion = new Connect();
        $statusID = -1;

        try {
            $getDetails = $getQuestion->query(
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
            }
        } finally {
            $getQuestion->close();
        }
    }

    public function changeCustomerData() {

    }

    public function changeCustomerOrders(){

    }
}
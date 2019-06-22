<?php


class CustomerPanel {
    public function getCustomerData($CustomerID) {
        $getCustomerData = new Connect();

        try {
            $getInfo = $getCustomerData->query(
                "SELECT 
                            Name AS Imie,
                            Surname AS Nazwisko,
                            Address AS Ulica,
                            Zip_Code AS Kod_Pocztowy,
                            City AS Miejscowosc,
                            Phone_Number AS Nr_Telefonu,
                            '' AS Email
                        FROM customer
                        WHERE id = '$CustomerID';"
            )->fetchAll();

            foreach($getInfo as $result){
                echo '<form>';
                echo '    <div class="form-row">';
                echo '        <div class="form-group col-md-6">';
                echo '            <label for="inputImie">Imię: </label>';
                echo '            <input type="text" class="form-control" id="inputImie" 
                                    placeholder="Podaj imię: " value="' . $result['Imie'] . '">';
                echo '        </div>';
                echo '        <div class="form-group col-md-6">';
                echo '            <label for="inputImie">Nazwisko: </label>';
                echo '            <input type="text" class="form-control" id="inputImie" 
                                    placeholder="Podaj nazwisko: " value="' . $result['Nazwisko'] . '">';
                echo '        </div>';
                echo '    </div>';
                echo '';
                echo '    <div class="form-group">';
                echo '        <label for="inputUlica">Ulica: </label>';
                echo '        <input type="text" class="form-control" id="inputUlica" 
                                    placeholder="Podaj ulicę: " value="' . $result['Ulica'] . '">';
                echo '    </div>';
                echo '';
                echo '    <div class="form-row">';
                echo '        <div class="form-group col-md-6">';
                echo '            <label for="inputKodPocztowy">Kod pocztowy: </label>';
                echo '            <input type="text" class="form-control" id="inputKodPocztowy" 
                                    placeholder="Podaj kod pocztowy: " value="' . $result['Kod_Pocztowy'] . '">';
                echo '        </div>';
                echo '        <div class="form-group col-md-6">';
                echo '            <label for="inputMiejscowosc">Miejscowość: </label>';
                echo '            <input type="text" class="form-control" id="inputMiejscowosc" 
                                    placeholder="Podaj miejscowość: " value="' . $result['Miejscowosc'] . '">';
                echo '        </div>';
                echo '    </div>';
                echo '';
                echo '    <div class="form-group">';
                echo '        <label for="inputNrTelefonu">Numer telefonu: </label>';
                echo '        <input type="text" class="form-control" id="inputNrTelefonu" 
                                    placeholder="Podaj numer telefonu: " value="' . $result['Nr_Telefonu'] . '">';
                echo '    </div>';
                echo '';
                echo '    <div class="form-group">';
                echo '        <label for="inputEmail">Adres e-mail: </label>';
                echo '        <input type="email" class="form-control" id="inputEmail" 
                                    placeholder="Podaj adres e-mail: " value="' . $result['Email'] . '">';
                echo '    </div>';
                echo '';
                echo '    <button type="submit" class="btn btn-primary">Zapisz</button>';
                echo '</form>';
            }

        } finally {
            $getCustomerData->close();
        }
    }

    public function getCustomerOrders($CustomerID) {
        $getOrders = new Connect();

        try {
            $getOrdersList = $getOrders->query(
                "SELECT 
                    o.ID as ID, 
                    o.Date as Data_Zlozenia,
                    s.Name as Nazwa_Statusu,
                    o.Price as Kwota
                FROM `order` AS o
                    INNER JOIN status AS s ON s.ID = o.`status_id`
                WHERE o.customer_id = '$CustomerID';"
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

    public function getOrderDetails($CustomerID, $QuestionID){
        $getOrders = new Connect();

        try {
            $getOrderDetails = $getOrders->query("
            ");
        } finally {
            $getOrders->close();
        }
    }

    public function getCustomerQuestions($CustomerID){
        $getQuestions = new Connect();

        try {
            $getQuestionsList = $getQuestions->query(
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

    public function getQuestionDetails($CustomerID, $QuestionID){
        $getQuestion = new Connect();
        $statusID = -1;

        try {
            $getDetails = $getQuestion->query(
                "SELECT
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
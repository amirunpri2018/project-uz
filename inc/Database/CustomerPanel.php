<?php


class CustomerPanel {
    public function getCustomerData() {
        $getCustomerData = new Connect();

        try {
            $getInfo = $getCustomerData->query(
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

    public function changeCustomerData() {

    }

    public function changeCustomerOrders(){

    }
}
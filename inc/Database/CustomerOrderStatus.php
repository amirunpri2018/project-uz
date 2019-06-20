<?php


class CustomerOrderStatus {
    public function getOrderStatus($CustomerID, $OrderID){
        $databaseConnection = new Connect();

        try {
            $getStatus = $databaseConnection->query(
                "SELECT s.name AS Status 
                        FROM `order` AS o 
                            INNER JOIN `status` as s
                                ON o.status_id = s.id
                        WHERE o.id = '$OrderID'
                            AND o.customer_id = '$CustomerID';");

            $numRows = $getStatus->numRows();

            if($numRows < 1){
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

                $_SESSION['blad2'] = '<div class="sessionError">Nie znaleziono takiego zamówienia!</div>';
            } else {
                $result = $getStatus->fetchAll();

                foreach($result as $row){
                    $_SESSION['status'] = $row['Status'];
                }
            }
        } finally {
            $databaseConnection->close();
        }
    }
}
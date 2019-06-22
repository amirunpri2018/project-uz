<?php


class CustomerOrderStatusTest extends PHPUnit_Framework_TestCase {
    public function testGetOrderStatus(){
        $mockedDbConnection = \Mockery::mock('\Doctrine\DBAL\Connection');
        $mockedStatement = \Mockery::mock('\Doctrine\DBAL\Driver\Statement');
        //$databaseConnection = new Connect();

        $OrderID = '1';
        $CustomerID = '1';

        try {
            $mockedDbConnection
                ->shouldReceive('executeQuery')
                ->with("
                        SELECT s.name AS Status 
                        FROM `order` AS o 
                            INNER JOIN `status` as s
                                ON o.status_id = s.id
                        WHERE o.id = '$OrderID'
                            AND o.customer_id = '$CustomerID'")
                ->andReturn($mockedStatement);

            $mockedRows = array(
                array('Status' => 'Zakończone (wysłane)')
            );

            $mockedStatement
                ->shouldReceive('num_rows')
                ->andReturns(count($mockedRows));

            $this->assertEquals(count($mockedRows), 1);

            if(count($mockedRows) < 1){

            } else {
                $mockedStatement
                    ->shouldReceive('fetch')
                    ->andReturnUsing(function () use (&$mockedRows) {
                        $row = current($mockedRows);
                        next($mockedRows);
                        return $row;
                    });

                $expectedResult = $mockedRows;

                foreach($expectedResult as $row){
                    $this->assertInternalType('string', $row['Status']);
                }
            }

            /*
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
            }*/
        } finally {
            Mockery::close();
            //$databaseConnection->close();
        }
    }
}
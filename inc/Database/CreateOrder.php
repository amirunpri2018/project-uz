<?php

class CreateOrder {
    public function __construct($customerID, $orderValue, $paymentMethod, $orderProducts){
        $databaseConnection = new Connect();
        $orderDate = date("Y-m-d H:i:s");

        try {
            $createOrder = $databaseConnection->query("
                INSERT INTO `order` VALUES (NULL, '$customerID', '3', '$orderDate', '$orderValue', '$paymentMethod');");

            $getOrderID = $databaseConnection->query("
                SELECT o.id AS OrderID
                FROM `order` AS o
                WHERE o.customer_id = '$customerID'
                    AND o.date = '$orderDate'")->fetchArray();

            $getOrderID = $getOrderID['OrderID'];
            $orderProductIDs = explode(',', $orderProducts);

            foreach($orderProductIDs as $productID) {
                $databaseConnection->query("
                    INSERT INTO `order_detail` (`id`, `order_number_id`, `article_id`, `price`, `quantity`) 
                    VALUES (NULL, '$getOrderID', '$productID', '1', '1')");
            }
        } catch (Exception $e) {
            echo "<span style='color: red;'>
                    Błąd serwera! Prosimy o zakupy w innym terminie! :)</span>";
            echo $e;
        } finally {
            $databaseConnection->close();
            $_SESSION['udanezamowienie'] = true;
            header('Location: /zamowienie/zamowienie.php');
        }
    }
}
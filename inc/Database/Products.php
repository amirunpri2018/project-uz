<?php


class Products {
    public function getProductsNumber(){
        $databaseConnection = new Connect();

        try {
            $getProducts = $databaseConnection->query(
                "SELECT * 
                        FROM article 
                        ORDER BY price DESC");

            $howManyRows = $getProducts->numRows();

            return $howManyRows;
        } finally {
            $databaseConnection->close();
        }
    }

    public function getProductList(){
        $databaseConnection = new Connect();

        try {
            $getProducts = $databaseConnection->query(
                "SELECT * 
                        FROM article 
                        ORDER BY price DESC");

            $howManyRows = $getProducts->numRows();

            if($howManyRows > 0){
                return $getProducts->fetchAll();
            }
        } finally {
            $databaseConnection->close();
        }
    }
}
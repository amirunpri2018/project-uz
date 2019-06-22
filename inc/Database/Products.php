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

    public function getProductListOrderByPriceASC(){
        $databaseConnection = new Connect();

        try {
            $getProducts = $databaseConnection->query(
                "SELECT * 
                        FROM article 
                        ORDER BY price ASC");

            $howManyRows = $getProducts->numRows();

            if($howManyRows > 0){
                return $getProducts->fetchAll();
            }
        } finally {
            $databaseConnection->close();
        }
    }

    public function getProductListOrderByPriceDESC(){
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

    public function getProductListOrderByNameASC(){
        $databaseConnection = new Connect();

        try {
            $getProducts = $databaseConnection->query(
                "SELECT * 
                        FROM article 
                        ORDER BY `name` ASC");

            $howManyRows = $getProducts->numRows();

            if($howManyRows > 0){
                return $getProducts->fetchAll();
            }
        } finally {
            $databaseConnection->close();
        }
    }
}
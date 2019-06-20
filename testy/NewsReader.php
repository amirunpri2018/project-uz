<?php


class NewsReader
{
    public function getAllHeadlinesUppercase(\Doctrine\DBAL\Connection $dbConnection)
    {
        $headlines = array();

        $statement = $dbConnection->executeQuery('SELECT headline FROM news ORDER BY id DESC');

        while ($row = $statement->fetch()) {
            $headlines[] = strtoupper($row['headline']);
        }

        return $headlines;
    }
}
<?php

require_once 'NewsReader.php';

class ExampleTest extends PHPUnit_Framework_TestCase {
 
    public function testGreetings(){
        $greetings = 'Hello World';
        $this->assertEquals('Hello World', $greetings);
    }

    public function GetAllHeadlinesUppercase(){
/*        $mockedDbConnection = \Mockery::mock('\Doctrine\DBAL\Connection');

        $mockedStatement = \Mockery::mock('\Doctrine\DBAL\Driver\Statement');

        $mockedDbConnection
            ->shouldReceive('executeQuery')
            ->with('SELECT headline FROM news ORDER BY id DESC')
            ->andReturn($mockedStatement);

        $mockedRows = array(
            array('headline' => 'First headline'),
            array('headline' => 'Second headline')
        );

        $mockedStatement
            ->shouldReceive('fetch')
            ->andReturnUsing(function () use (&$mockedRows) {
                $row = current($mockedRows);
                next($mockedRows);
                return $row;
            });

        $newsReader = new NewsReader();

        $expectedHeadlines = array('FIRST HEADLINE', 'SECOND HEADLINE');
        $actualHeadlines = $newsReader->getAllHeadlinesUppercase($mockedDbConnection);

        $this->assertEquals($expectedHeadlines, $actualHeadlines);*/
    }
}

?>
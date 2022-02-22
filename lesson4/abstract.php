<?php


/**
 * Интерфейс Абстрактной фабрики объявляет создающие методы для каждого
 * определённого типа продукта.
 */
abstract class DbFactory
{
    public function createDbConnection() : DbConnection;

    public function createDbRecrord() : DbRecrord;

    public function createDbQueryBuiler() : DbQueryBuiler;

    public function combineConnectionRecrordQueryBuiler()
    {
        $connection = $this->createDbConnection();
        $recrord = $this->createDbRecrord();
        $queryBuiler = $this->createDbQueryBuiler();
    }
}

/**
 * Каждая Конкретная Фабрика соответствует определённому варианту (или
 * семейству) продуктов.
 *
 */
class MySQLConnection implements DbFactory
{
    public function createDbConnection() : DbConnection
    {
        return new MySQLDbConnection();
    }

    public function createDbRecrord() : DbRecrord
    {
        return new MySQLDbRecrord();
    }

    public function createDbQueryBuiler() : DbQueryBuiler
    {
        return new MySQLDbQueryBuiler();
    }
}


class PostgreConnection implements DbFactory
{
    public function createDbConnection() : DbConnection
    {
        return new PostgreDbConnection();
    }

    public function createDbRecrord() : DbRecrord
    {
        return new PostgreDbRecrord();
    }

    public function createDbQueryBuiler() : DbQueryBuiler
    {
        return new PostgreDbQueryBuiler();
    }
}

class OracleConnection implements DbFactory
{
    public function createDbConnection() : DbConnection
    {
        return new OracleDbConnection();
    }

    public function createDbRecrord() : DbRecrord
    {
        return new OracleDbRecrord();
    }

    public function createDbQueryBuiler() : DbQueryBuiler
    {
        return new OracleDbQueryBuiler();
    }
}

interface DbConnection
{
    public function getDbConnection(): string;
}

/**
 * Этот Конкретный Продукт предоставляет подключение к базе данных.
 */
class MySQLDbConnection implements DbConnection
{
    public function getDbConnection(): string
    {
        return 
        $hostname="your_hostname";
        $username="your_dbusername";
        $password="your_dbpassword";
        mysqli_connect($hostname,$username, $password) or die ("html>script language='JavaScript'>alert('Не удается подключиться к базе данных. Повторите попытку позже.'),history.go(-1)/script>/html>");
    }
}

class PostgreDbConnection implements DbConnection
{
    public function getDbConnection(): string
    {
        return 
        $hostname="your_hostname";
        $username="your_dbusername";
        $password="your_dbpassword";
        pg_connect($hostname,$username, $password) or die ("html>script language='JavaScript'>alert('Не удается подключиться к базе данных. Повторите попытку позже.'),history.go(-1)/script>/html>");
    }
}

class OracleDbConnection implements DbConnection
{
    public function getDbConnection(): string
    {
        return 
        $hostname="your_hostname";
        $username="your_dbusername";
        $password="your_dbpassword";
        OCILogon($hostname,$username, $password) or die ("html>script language='JavaScript'>alert('Не удается подключиться к базе данных. Повторите попытку позже.'),history.go(-1)/script>/html>");
    }
}


/**
 * Запись таблицы базы данных.
 */
interface DbRecrord
{
    public function getDbRecrord(): string;
}


class MySQLDbRecrord implements DbRecrord
{
    public function getDbRecrord(): string
    {
        return "CREATE TABLE tbl_name (id INTEGER AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), age INTEGER)";
    }
}

class PostgreDbRecrord implements DbRecrord
{
    public function getDbRecrord(): string
    {
        return "CREATE TABLE tbl_name (id INTEGER AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), age INTEGER)";
    }
}

class OracleDbRecrord implements DbRecrord
{
    public function getDbRecrord(): string
    {
        return "CREATE TABLE tbl_name (id INTEGER AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), age INTEGER)";
    }
}


/**
 * Конструктор запросов к базе данных
 */
interface DbQueryBuiler
{
    public function getDbQueryBuiler(): string;
}


class MySQLDbQueryBuiler implements DbQueryBuiler
{
    public function getDbQueryBuiler(): string
    {
        return  "SELECT * FROM tbl_name";
    }
}

class PostgreDbQueryBuiler implements DbQueryBuiler
{
    public function getDbQueryBuiler(): string
    {
        return  "SELECT * FROM tbl_name";
    }
}

class OracleDbQueryBuiler implements DbQueryBuiler
{
    public function getDbQueryBuiler(): string
    {
        return "SELECT * FROM tbl_name";
    }
}

function clientCode(DbFactory $factory)
{
    $dataDbConnection = $factory->createDbConnection();
    $dataDbRecrord = $factory->createDbRecrord();
    $dataDbQueryBuiler = $factory->createDbQueryBuiler();

    echo $dataDbConnection->getDbConnection() . "\n";
    echo $dataDbRecrord->getDbRecrord() . "\n";
    echo $dataDbQueryBuiler->getDbQueryBuiler() . "\n";
}
echo "Client: Testing client code with the first factory type:\n";
clientCode(new MySQLConnection());

echo "\n";

echo "Client: Testing the same client code with the second factory type:\n";
clientCode(new PostgreConnection());

echo "\n";

echo "Client: Testing the same client code with the second factory type:\n";
clientCode(new OracleConnection());





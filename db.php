<?php

class DB
{
    private $connection;
    private $fetchMode;

    public function __construct($fetchMode)
    {
        $this->fetchMode = $fetchMode;
        $this->connection = new PDO('mysql:host=localhost;dbname=gb', 'root', '');
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function fetch($query, $params = [])
    {
        $this->execute($query, $params, $stm);
        return $stm->fetch($this->fetchMode);
    }

    public function fetchAll($query, $params = [])
    {
        $this->execute($query, $params, $stm);
        return $stm->fetchAll($this->fetchMode);
    }

    public function execute($query, $params = [], &$stm)
    {
        $stm = $this->connection->prepare($query);
        return $stm->execute($params);
    }

    public function rowCount($query)
    {
        $this->execute($query, $stm);
        return $stm->rowCount();
    }
}

?>

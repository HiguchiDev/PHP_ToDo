<?php

abstract class DBAccessor{

    protected $dbh;
    protected $dbName;
    protected $tableName;
    protected $user;
    protected $password;

    function __construct()	{
        $dsn = 'mysql:dbname=' . $this->dbName . ';host=localhost;charset=utf8';

        $this->dbh = new PDO($dsn, $this->user, $this->password);
        $this->dbh->query('SET NAMES utf8');
        $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function fetchAll(){
        $sql = 'SELECT * FROM ' . $this->tableName . ' ORDER BY id DESC';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    abstract public function insert($param);

    abstract public function delete($entity);
}
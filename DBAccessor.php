<?php
    class DBAccessor{

        private $dbh;

        function __construct($dsn, $user, $password)	{
            $this->dbh = new PDO($dsn, $user, $password);
            $this->dbh->query('SET NAMES utf8');
            $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        function fetchAll(){
            $sql = 'SELECT * FROM tasks ORDER BY id DESC';
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        }
    }
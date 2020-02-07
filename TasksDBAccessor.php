<?php

require_once 'TasksTableEntity.php';
require_once 'DBAccessor.php';

class TasksDBAccessor extends DBAccessor{

    function __construct()	{
        $this->dbName = 'todolist';
        $this->tableName = 'tasks';
        $this->user = 'root';
        $this->password = '';

        parent::__construct();
    }

    function insert($entity){
        $sql = 'INSERT INTO ' . $this->tableName . ' (name, memo, done) VALUES (?, ?, 0)';
        $stmt = $this->dbh->prepare($sql);

        $stmt->bindValue(1, $entity->name, PDO::PARAM_STR);
        $stmt->bindValue(2, $entity->memo, PDO::PARAM_STR);

        $stmt->execute();

        unset($entity->name, $entity->memo);
    }

    public function delete($ids){


        $deleteId = '(';

        if(is_array($ids)){
            for($i = 0; $i < count($ids); $i++){
                if($i === count($ids) - 1){
                    $deleteId .= '?)';
                }
                else{
                    $deleteId .= '?, ';
                }
                
            }
        }

        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE id in ' . $deleteId;
        $stmt = $this->dbh->prepare($sql);


        //var_dump($sql);

        for($i = 0; $i < count($ids); $i++){
            //var_dump($ids[$i]);
            $stmt->bindValue($i + 1, $ids[$i], PDO::PARAM_INT);
            
        }
        


        $stmt->execute();

    }

}
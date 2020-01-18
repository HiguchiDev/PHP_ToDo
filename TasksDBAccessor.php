<?php

require 'TasksTableEntity.php';
require './DBAccessor.php';

class TasksDBAccessor extends DBAccessor{

    function insert($entity){
        $sql = 'INSERT INTO ' . $this->tableName . ' (name, memo, done) VALUES (?, ?, 0)';
        $stmt = $this->dbh->prepare($sql);

        $stmt->bindValue(1, $entity->name, PDO::PARAM_STR);
        $stmt->bindValue(2, $entity->memo, PDO::PARAM_STR);

        $stmt->execute();

        unset($entity->name, $entity->memo);
    }

}
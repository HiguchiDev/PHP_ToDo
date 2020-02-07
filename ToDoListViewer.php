<?php
    require_once 'EnumInputType.php';

class ToDoListViewer{

    private function taskView($task){
?>
        <dt>
            <label><input type="checkbox" name=<?=EnumInputType::DELETE_TASK()->valueOf() . '[]'?> value=<?=$task["id"] ?>><?=$task["name"] ?></label><br>
        </dt>
        <dd>
            <?=$task["memo"] ?>
        </dd>
<?php
    }
    public function view($contents){
?>
        <form action='index.php' method='post'>
        <ul>
            <li><span>タスク名　:　</span><input type='text' name=<?=EnumFormName::NAME()->valueOf() ?> value=<?php if(isset($name)){print($name);} ?>></li>
            <li><span>メモ　　　:　</span><textarea name=<?=EnumFormName::MEMO()->valueOf() ?>><?php if(isset($memo)){print($memo);} ?></textarea></li>
            <li><input type='submit' name=<?=EnumInputType::SUBMIT()->valueOf() ?>></li>
        </ul>
        </form>

        <form action="index.php" method="post"><br>
<?php
        if(is_array($contents)){
            foreach ($contents as $task) {
                $this->taskView($task);
            }
        }
?>
        <input type='submit' value="完了済タスク削除"> 
        </form>
<?php
    }
}
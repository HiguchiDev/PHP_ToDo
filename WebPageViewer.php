<?php
    require_once 'EnumInputType.php';

class WebPageViewer{

    public function defaultView(){
        ?>
            <form action='index.php' method='post'>
            <ul>
                <li><span>タスク名　:　</span><input type='text' name=<?=EnumFormName::NAME()->valueOf() ?> value=<?php if(isset($name)){print($name);} ?>></li>
                <li><span>メモ　　　:　</span><textarea name=<?=EnumFormName::MEMO()->valueOf() ?>><?php if(isset($memo)){print($memo);} ?></textarea></li>
                <li><input type='submit' name=<?=EnumInputType::SUBMIT()->valueOf() ?>></li>
            </ul>
            </form>
<?php
    }
    
    public function taskView($contants){
?>
            <form method="post" action="index.php"><br>
<?php            
            if(is_array($contants)){
            foreach ($contants as $value) {
?>
                <dt>
                    <label><input type="checkbox" name=<?=EnumInputType::DELETE_TASK()->valueOf() . '[]'?> value=<?=$value["id"] ?>><?=$value["name"] ?></label><br>
                </dt>
                <dd>
                    <?=$value["memo"] ?>
                </dd>

<?php
            }
?>

            <input type='submit' value="完了済タスク削除"> 
            </form>
            <?php
        }
    }
}
?>
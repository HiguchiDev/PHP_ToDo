<?php
class WebPageViewer{

    public function defaultView(){
        ?>
            <form action='index.php' method='post'>
            <ul>
                <li><span>タスク名</span><input type='text' name=<?=EnumFormName::NAME()->valueOf() ?> value=<?php if(isset($name)){print($name);} ?>></li>
                <li><span>メモ</span><textarea name=<?=EnumFormName::MEMO()->valueOf() ?>><?php if(isset($memo)){print($memo);} ?></textarea></li>
                <li><input type='submit' name=<?=EnumInputType::SUBMIT()->valueOf() ?>></li>
            </ul>
            </form>
        <?php
    }
    
    public function taskView($contants){
        if(is_array($contants)){
            foreach ($contants as $value) {    
                print '<dt>';
                print $value["name"];
                print '</dt>';

                print '<dd>';
                print $value["memo"];
                print '</dd>';
            }
        }
    }
}
?>
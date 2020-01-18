<?php
    require 'EnumFormName.php';
    require 'TaskViewer.php';
    require 'FormChecker.php';
    require 'TasksDBAccessor.php';
?>

<form action="index.php" method="post">
<ul>
    <li><span>タスク名</span><input type="text" name=<?php echo EnumFormName::NAME()->valueOf() ?> value="<?php if(isset($name)){print($name);} ?>"></li>
    <li><span>メモ</span><textarea name=<?php echo EnumFormName::MEMO()->valueOf() ?>><?php if(isset($memo)){print($memo);} ?></textarea></li>
    <li><input type="submit" name="submit"></li>
</ul>
</form>
<?php
    //phpinfo();
    $dbName = 'todolist';
    $tablename = 'tasks';
    $user = "root";
    $password = "";

    $dbAccessor = new TasksDBAccessor($dbName, $tablename, $user, $password); 

    print('</dl>');

    if(isset($_POST['submit'])){
        $formChecker = new FormChecker();
        $errors = $formChecker->doCheck($_POST['submit']);

        if(!empty($errors)){
            echo '入力されていない項目があります';
        }

        $name = '';
        $memo = '';

        if (!empty($_POST[EnumFormName::NAME()->valueOf()])) {
            $name = $_POST[EnumFormName::NAME()->valueOf()];
        }

        if (!empty($_POST[EnumFormName::MEMO()->valueOf()])) {
            $memo = $_POST[EnumFormName::MEMO()->valueOf()];
        }

        $name = htmlspecialchars($name, ENT_QUOTES);
        $memo = htmlspecialchars($memo, ENT_QUOTES);
        
        if(count($errors) === 0){
            $entity = new TasksTableEntity();
            $entity->name = $name;
            $entity->memo = $memo;

            $dbAccessor->insert($entity);
        }
    }


    $resultList = $dbAccessor->fetchAll();

    $taskViewer = new TaskViewer();
    $taskViewer->view($resultList);

    ?>
</body>
</html>
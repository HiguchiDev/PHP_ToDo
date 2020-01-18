<?php
    require 'EnumFormName.php';
    require 'DBAccessor.php';
    require 'TaskViewer.php';
    require 'FormChecker.php';
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
    $dsn = 'mysql:dbname=todolist;host=localhost;charset=utf8';
    $user = "root";
    $password = "";

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

        $errors = array();
        $name = htmlspecialchars($name, ENT_QUOTES);
        $memo = htmlspecialchars($memo, ENT_QUOTES);
        
        if(count($errors) === 0){
            
            $dsn = 'mysql:dbname=todolist;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';

            $dbh = new PDO($dsn, $user, $password);
            $dbh->query('SET NAMES utf8');
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $sql = 'INSERT INTO tasks (name, memo, done) VALUES (?, ?, 0)';
            $stmt = $dbh->prepare($sql);

            
            $stmt->bindValue(1, $name, PDO::PARAM_STR);
            $stmt->bindValue(2, $memo, PDO::PARAM_STR);

            $stmt->execute();

            $dbh = null;

            unset($name, $memo);
        }
    }

    $dbAccessor = new DBAccessor($dsn, $user, $password); 
    $resultList = $dbAccessor->fetchAll();

    $taskViewer = new TaskViewer();
    $taskViewer->view($resultList);

    ?>
</body>
</html>
<form action="index.php" method="post">
<ul>
    <li><span>タスク名</span><input type="text" name="name" value="<?php if(isset($name)){print($name);} ?>"></li>
    <li><span>メモ</span><textarea name="memo"><?php if(isset($memo)){print($memo);} ?></textarea></li>
    <li><input type="submit" name="submit"></li>
</ul>
</form>
<?php
$dsn = 'mysql:dbname=todolist;host=localhost;charset=utf8';
$user = "root";
$password = "";

$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$sql = 'SELECT id, name, memo, done FROM tasks ORDER BY id DESC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$dbh = null;

print('<dl>');

while($task = $stmt->fetch(PDO::FETCH_ASSOC)){
    

    print '<dt>';
    print $task["name"];
    print '</dt>';

    print '<dd>';
    print $task["memo"];
    print '</dd>';

}

print('</dl>');

if(isset($_POST['submit'])){
$name = $_POST['name'];
    $memo = $_POST['memo'];
	$errors = array();
    $name = htmlspecialchars($name, ENT_QUOTES);
    $memo = htmlspecialchars($memo, ENT_QUOTES);

    if($name === ''){
        $errors['name'] = 'お名前が入力されていません。';
    }

    if($memo === ''){
        $errors['memo'] = 'メモが入力されていません。';
    }
    
    
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

?>
</body>
</html>
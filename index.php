<?php
    require 'EnumFormName.php';
    require 'FormChecker.php';
    require 'TasksDBAccessor.php';
    require 'EnumInputType.php';
    require 'WebPageViewer.php';
?>

<?php

    $webPageViewer = new WebPageViewer();

    $webPageViewer->defaultView();

    $dbName = 'todolist';
    $tablename = 'tasks';
    $user = 'root';
    $password = '';

    $dbAccessor = new TasksDBAccessor($dbName, $tablename, $user, $password); 

    print('</dl>');

    if(isset($_POST[EnumInputType::SUBMIT()->valueOf()])){
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
        
        $formChecker = new FormChecker();
        if(empty($formChecker->doCheck($_POST[EnumInputType::SUBMIT()->valueOf()]))){
            $entity = new TasksTableEntity();
            $entity->name = $name;
            $entity->memo = $memo;

            $dbAccessor->insert($entity);

            header('Location: ./');
            exit;
        }
        else{
            echo '入力されていない項目があります';
        }
    }

    $resultList = $dbAccessor->fetchAll();
    $webPageViewer->taskView($resultList);

?>
</body>
</html>
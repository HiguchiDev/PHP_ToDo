<?php
    require_once 'EnumFormName.php';
    require_once 'FormChecker.php';
    require_once 'TasksDBAccessor.php';
    require_once 'EnumInputType.php';
    require_once 'ToDoListViewer.php';

    $dbAccessor = new TasksDBAccessor();
    $errorMessage = null;

    if (isset($_POST[EnumInputType::DELETE_TASK()->valueOf()]) && is_array($_POST[EnumInputType::DELETE_TASK()->valueOf()])) {
        $ids = $_POST[EnumInputType::DELETE_TASK()->valueOf()];
        $dbAccessor->delete($ids);

    } else if (isset($_POST[EnumInputType::SUBMIT()->valueOf()])) {
        $formChecker = new FormChecker();
        if (!$formChecker->isFormEmpty($_POST[EnumInputType::SUBMIT()->valueOf()])) {
            $entity = new TasksTableEntity();
            $entity->name = $_POST[EnumFormName::NAME()->valueOf()];
            $entity->memo = $_POST[EnumFormName::MEMO()->valueOf()];

            htmlspecialchars($entity->name, ENT_QUOTES);
            htmlspecialchars($entity->memo, ENT_QUOTES);

            $dbAccessor->insert($entity);

            header('Location: ./');
            exit;
        } else {
            $errorMessage = '入力されていない項目があります';
        }
    }

    $taskList = $dbAccessor->fetchAll();
    
    $ToDoListViewer = new ToDoListViewer();
    $ToDoListViewer->view($taskList, $errorMessage);

?>
</body>
</html>
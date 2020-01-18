<?php
class FormChecker{

    function doCheck($contents) {
        $errors = array();

        if(isset($contents)){
            if (empty($_POST[EnumFormName::NAME()->valueOf()])) {
                $errors[EnumFormName::NAME()->valueOf()] = 'お名前が入力されていません。';
            }
    
            if (empty($_POST[EnumFormName::MEMO()->valueOf()])) {
                $errors[EnumFormName::MEMO()->valueOf()] = 'メモが入力されていません。';
            }
            
        }
        
        return $errors;
    }
}
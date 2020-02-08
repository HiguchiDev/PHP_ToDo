<?php
class FormChecker{

    function isFormEmpty($contents) {
        if(isset($contents)){
            if (empty($_POST[EnumFormName::NAME()->valueOf()]) || empty($_POST[EnumFormName::MEMO()->valueOf()])) {
                return true;
            }
        }
        
        return false;
    }
}
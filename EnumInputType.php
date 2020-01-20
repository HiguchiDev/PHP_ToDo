<?php
    require_once 'Enum.php';
// トランプのスート型を定義する。4種類しか値を取らない。
// Enumをextendして、定数をセット
final class EnumInputType extends Enum
{
    const SUBMIT = 'submit';    
}
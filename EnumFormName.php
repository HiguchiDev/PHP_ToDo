<?php
    require_once 'Enum.php';
// トランプのスート型を定義する。4種類しか値を取らない。
// Enumをextendして、定数をセット
final class EnumFormName extends Enum
{
    const NAME = 'name';    
    const MEMO = 'memo';
}

//使い方メモ
/*
//インスタンス化
$suit = new Suit(Suit::SPADE);
echo $suit; //toString実装済みなので文字列キャスト可能

echo $suit->valueOf(); //生の値を取り出す。intやfloat等の場合に。

// 適当な値を突っ込もうとすると、InvalidArgumentExceptionが発生して停止
//$suit = new Suit('uso800');



//__callStaticを定義してあるのでnewを使わずこんな感じでも書ける(PHP5.3以降)
$suit = Suit::SPADE();
*/
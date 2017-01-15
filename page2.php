<?php
/*

Написать класс для работы с валютой на основе публичного API: http://api.fixer.io/latest. 
Нужна конвертация валюты относительно базовой, получение валюты по названию, 
каждый запрос к API Fixer должен быть записан в лог-файл.

Обязательна документация на все методы класса (PHPDoc).

*/
ini_set('display_errors', 'On');
include("ModelLatest.php");

$latest = new ModelLatest();
$converted = $latest->convertByBaseСurrency("BRL", 3);
$currencyAmount = $latest->getByСurrencyName("BRL");
echo "converted =".$converted." currencyAmount=".$currencyAmount;
?>
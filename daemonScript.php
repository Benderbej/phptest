<?php
//is that linux pseudo-daemon
//http://mithrandir.ru/professional/php/php-daemons.html
//php -f /path/to/my/daemonScript.php

include("ModelLatest.php");

while(1) {//endless
    writeIntoFile();
    sleep(86400); 
}

    function writeIntoFile(){
        $latest = new ModelLatest();
        $currencyUSD = $latest->getByСurrencyName("USD");
        $currencyEUR = $latest->getByСurrencyName("EUR");
        $currencyRUB = $latest->getByСurrencyName("RUB");
        $file = fopen("currencies.txt","a");
        $date = date('m/d/Y h:i:s a', time())."   USD=".$currencyUSD." EUR=".$currencyEUR." RUB".$currencyRUB."/n";
        fwrite($file, $date."\n");
        fclose($file);
    }
	//не совсем понял что имеется ввиду под оберткой для консоли
?>
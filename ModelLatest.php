<?php
class ModelLatest {
   private $incomingJsonString;
   private $ratesJson;
   private $rates;
   private $ratesArr;
   private $currentCurrencyName;
    
	/**
     * @author Benderbej
     * @copyright 2017 BenderbejProductions
     * @return Constructor
     */
   function ModelLatest() {
        $this->incomingJsonString = file_get_contents("http://api.fixer.io/latest");
        $this->ratesJson=json_decode($this->incomingJsonString);
        $this->rates = $this->ratesJson->rates;
        $this->ratesArr = (array) $this->rates;
        $this->currentCurrencyName = $this->ratesJson->base;
        $this->logIntoFile();
   }
   
    //Нужна конвертация валюты относительно базовой ?? базовая одна - насколько я понимаю, евро, и валюты, как понимаю, относительно нее
    /**
     * @param string $currency int $amount
     * @author Benderbej
     * @copyright 2017 BenderbejProductions
     * @return int summ
     */
    public function convertByBaseСurrency($currency, $amount) {
        return $this->ratesArr[$currency]*$amount;
    }
    
    //получение валюты по названию
     /**
     * @param string $currency
     * @author Benderbej
     * @copyright 2017 BenderbejProductions
     * @return int currency
     */
    public function getByСurrencyName($currency) {
        return $this->ratesArr[$currency];
    }
    
    //каждый запрос к API Fixer должен быть записан в лог-файл.
    /**
     * @author Benderbej
     * @copyright 2017 BenderbejProductions
     * @return int writes log with date and current currencies into the log file
     */
    private function logIntoFile(){
        $file = fopen("logs.txt","a");
        $date = date('m/d/Y h:i:s a', time())."   ".$this->incomingJsonString."/n";
        fwrite($file, $date."\n");
        fclose($file);
    }
}
?>
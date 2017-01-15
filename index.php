<?php
//here you can check
//http://odeghda.ru/
//http://odeghda.ru/page2.php
echo "parsing!";
$incomingJsonString = file_get_contents("http://api.fixer.io/latest");
echo "<hr />parsing string: ".$incomingJsonString."<hr />";

$obj=json_decode($incomingJsonString);
$base = $obj->base;
$date = $obj->date;
$rates = $obj->rates;
$baseDateRatesString = "BASE=".$base." DATE=".$date."<hr />";
echo $baseDateRatesString;

$ksort=null; $vsort=null;

if ($_SERVER['REQUEST_METHOD']=='GET')
{
  if (!empty($_GET['keysort'])){
      $ksorting=$_GET['keysort'];
      if($ksorting ==1){$ksort=1;} else {$ksort=2;}
  }
  if (!empty($_GET['valsort'])){
      $vsorting=$_GET['valsort'];
      if($vsorting == 1){$vsort=1;} else {$vsort=2;}
  }  
}

print formView()."<br />".tableView($rates, $ksort, $vsort);

function formView(){
$formView =
"<form action=\"\" method=\"get\">
 <p>Сортировка по названию валюты: <input class=\"checkboxbutton\" type=\"radio\" name=\"keysort\" value=\"1\" /><input class=\"checkboxbutton\" type=\"radio\" name=\"keysort\" value=\"2\" /></p>
 <p>Сортировка по значению: <input class=\"checkboxbutton\" type=\"radio\" name=\"valsort\" value=\"1\" /><input class=\"checkboxbutton\" type=\"radio\" name=\"valsort\" value=\"2\" /></p>
 <p><input type=\"submit\" value=\"обновить\" /></p>
</form>";
return $formView;
}

function tableView($rates, $ksort=1, $vsort=2){
    
    $ratesarr =  (array) $rates;
    
    if($ksort==2){krsort($ratesarr);} else {ksort($ratesarr);}
    if(isset($vsort)){
        if($vsort==2){arsort($ratesarr);} else if ($vsort==1) {asort($ratesarr);}
        
    }

    reset($ratesarr);
    $tableContent = "";
    $styleString = " class=\"grey\" ";
    $i=0;
    foreach ($ratesarr as $key => $value){
        if ($i%2==1){$tableContent = $tableContent."<tr ".$styleString."><td>".$key."</td><td>".$value."</td></tr>";} else {
            $tableContent = $tableContent."<tr><td>".$key."</td><td>".$value."</td></tr>";
        }
        $i++;
    }
    
    $result = "
        <table>".
            $tableContent.
        "</table>";
    return  $result;
}


?>
<style type="text/css">.grey {color:#fff; background-color:#ccc;}</style>


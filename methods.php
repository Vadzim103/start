<?php
abstract class Calc {
    protected $dbc;
    public function getMonthPay(){
    }
    public function getPercent(){ 
    }
    public function databaseUpdate(){ 
    }
}
 class CreditCalc extends Calc{
     
      protected $dbc;
      
      //Метод расчета итоговой суммы выплат
      public function getMonthPay($i,$n,$s){
      $a = (($i*pow((1+$i),$n))/(pow((1+$i),$n)-1))*$n*$s;
      return number_format($a,2);
      }
      
      //Метод для получения сумм месячных оплат, сумм процентов, сумм погашения основного долга, сумм остатков основного долга
      public function getPercent($i,$n,$s){    
      $a = ($i*pow((1+$i),$n))/(pow((1+$i),$n)-1)*$s;
      //Сумма месячной оплаты
      echo '<td>'.number_format($a,2).'</td>';
      static $ost = 0;
      $proc = ($ost+$s)*$i;
      //Сумма процентов
      echo '<td>'.number_format($proc,2).'</td>';
      $osn_dolg = $a-$proc;
      //Сумма погашения основного долга
      echo '<td>'.number_format($osn_dolg,2).'</td>';
      $ostatok = $ost-$osn_dolg;
      $ostat = $ostatok + $s;
      if($ostat < 0){
      echo '<td>0.00</td>';   
      }
      else{
      //Сумма остатка основного долга
      echo '<td>'.number_format($ostat,2).'</td>';
      }
      $ost = $ostatok;
      }
      
      //Метод для передачи данных в базу
      public function databaseUpdate($s,$pr,$n){ 
      $this->dbc = mysqli_connect("localhost","root","","credit_calculator");
      $query = "INSERT INTO history(summ,percent,month_count) VALUES('$s','$pr','$n')";
      mysqli_query($this->dbc,$query);
 }
 }

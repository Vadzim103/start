<?php
require "methods.php";
$ii = trim(htmlspecialchars(($_POST["date_2"]/12)/100));
$n = trim(htmlspecialchars($_POST["date_3"]));
$s = trim(htmlspecialchars($_POST["date_1"]));
$pr = trim(htmlspecialchars($_POST["date_2"]));

if(!empty($_POST["date_1"]) AND !empty($_POST["date_2"]) AND !empty($_POST["date_3"])){
    
$model = new CreditCalc();
//Вызов метода для получения итоговой суммы выплат
$total = $model->getMonthPay($ii,$n,$s);
echo '<h3>Итоговая выплата, руб:  '.$total.'</h3>';
echo '<h3>График платежей:</h3>';

echo '<table>';
echo '<tr><th>номер платежа</th><th>дата платежа</th><th>к оплате в месяц, руб</th><th>проценты, руб</th><th>погашение основного долга, руб</th><th>остаток основного долга, руб</th></tr>'; 
for($i=1; $i<=(int)$n;$i++){
echo '<tr>';
//Номера платежей
echo '<td>'.$i.'</td>';
$months_to_plus = $i;
$today = date("d-m-Y");
$date = new DateTime($today);
$date->modify('+' . (string)$months_to_plus . 'month');
$new_date = $date->format('d.m.Y');
//Даты выплат
echo '<td>'.$new_date.'</td>';
//Вызов метода для получения сумм месячных оплат, сумм процентов, сумм погашения основного долга, сумм остатков основного долга
$model->getPercent($ii,$n,$s);
}
echo '</tr>'; 
echo '</table>';
//Вызов метода для передачи данных в базу
$model->databaseUpdate($s,$pr,$n);
}
else{
echo '<h2>Пожалуйста заполните все поля</h2>';    
}


<?php
$dbc = mysqli_connect("localhost","root","","new_base");
$query = "SELECT*FROM tablica_2 ORDER BY rank ASC";
$data = mysqli_query($dbc,$query);

echo '<table>';
echo '<tr><th>id</th><th>name</th><th>rank</th><th>picture</th></tr>';

while($row = mysqli_fetch_array($data)){
echo '<tr>'; 
echo '<td>'.$row['house_id'].'</td>';
echo '<td>'.$row['firstname'].'</td>';
echo '<td>'.$row['rank'].'</td>';
echo '<td><img src="'.$row['picture'].'"/></td>';
echo '</tr>'; 
}
echo '</table>';
?>
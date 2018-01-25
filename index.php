<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>КРЕДИТНЫЙ КАЛЬКУЛЯТОР</h1>
<script src='jquery-3.2.1.min.js'></script>
<div id="calculator">
    <form method="POST" id="formx" action="javascript:void(null);" onsubmit="call()">
        <label>Введите размер кредита, руб   </label><input type="number" min="1" max="999999999" name="date_1" class="lab" id="date_1" required/></br>   
        <label>Введите процентную ставку, руб   </label><input type="number" min="1" max="999999999" name="date_2" class="lab" id="date_2" required/></br>  
        <label>Введите срок кредита, мес   </label><input type="number" min="1" max="999999999" name="date_3" class="lab" id="date_3" required/></br>
    <button id="calc">Рассчитать</button>
    </form>
</div>
<div id="results">
</div>
</body>
</html>

<script type="text/javascript" language="javascript">
 	function call() {
 	  var msg   = $('#formx').serialize();
        $.ajax({
          type: 'POST',
          url: 'calculate.php',
          data: msg,
          success: function(data) {
            $('#results').html(data);
          },
          error:  function(xhr, str){
	    alert('Возникла ошибка: ' + xhr.responseCode);
          }
        });
 
    }
</script>

<style>
table {    
border: thin solid black;    
caption-side: bottom; } 
td, th {    
border: thin dotted gray;    
padding: 5px;
text-align: center;
} 
body{
margin-left: 20px;    
margin-right: 20px;    
}
.lab{
position: absolute;
left: 250px;
}
</style>

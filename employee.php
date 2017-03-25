<?php

if(isset($_POST['AddEmployee']))
{

$xml=new DomDocument("1.0","UTF-8");
$xml->load('employee.xml');
$nameE=$_POST['emname'];
$genderE=$_POST['emgender'];
$phoneE=$_POST['emphone'];
$emailE=$_POST['emEmail'];


if(preg_match("/^[A-Za-z0-9]+@[a-zA-Z]+.[com-org-net]+$/",$emailE)
  && preg_match("/^[0-9]+$/",$phoneE)
  && preg_match("/^[a-zA-Z_]+$/",$nameE)
  &&
  $genderE=='male'||$genderE=='female'
  )

{




$root=$xml->getElementsByTagName("employees")->item(0);

$employee=$xml->createElement("employee");
$empname=$xml->createElement("name",$nameE);
$empgender=$xml->createElement("gender",$genderE);
$empphone=$xml->createElement("phone",$phoneE);
$empemail=$xml->createElement("email",$emailE);

$employee->appendChild($empname);
$employee->appendChild($empgender);
$employee->appendChild($empphone);
$employee->appendChild($empemail);
$root->appendChild($employee);
$xml->save('employee.xml');
header("Location:employee2.php");
}
else


{
	

echo "<script>
alert('Data not vaild please enter a valid data ');
window.location.href='employee.php';
</script>";


}

}

?>

<html>
<head>

</head>
<header>

<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/mystyle.css"/>

<script type="text/javascript"  src="node_modules/tether/dist/js/tether.js"></script>
<script type="text/javascript" src="node_modules/jquery/dist/jquery.js"></script>
<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>






<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Mywebsite</a>
    </div>

    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="employee2.php">Home <span class="sr-only">(current)</span></a></li>
        
        
      
      
    </div>
  </div>
</nav>



</header>




<body style="color:black;background-color:LightSalmon ">

<!-- AntiqueWhite
powderblue -->

</center>
<table border="10" class="container" style="background-color:LightSeaGreen ">
	<tr>
		<td>

<form method="post" action="employee.php" class="container">
EmployeeName:	
<input type="text" name="emname" width="48" height="48" placeholder="Employeename" required><br>
EmployeeGender:
<input type="text" name="emgender"  width="48" height="48"placeholder="Gender"><br>
EmployeePhone:
<input type="text" name="emphone" width="48" height="48" placeholder="YourPhone"><br>
EmployeeEmail:
<input type="text" name="emEmail" width="48" height="48" placeholder="E-mail" required><br>
<center>
<input class="btn-danger" type="submit" name="AddEmployee" value="add" width="48" height="48">
</center>


</form>
</td>
</tr>
</table>
</center>


<div>
<hr>
<center>
  &copy; EsraaMahmoud
</center>
<hr>

</div>


</body>
</html>
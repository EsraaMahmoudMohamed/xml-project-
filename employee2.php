<?php
if(!$xml=simplexml_load_file("employee.xml")) {
    trigger_error('Error reading XML file',E_USER_ERROR);}

    $num = 1; 
    if(!isset($_GET["page"])){
    	        $page = 1;

    	    }else{
    $page = $_GET["page"];
    
    }
    $count = 0;

    // Finds children of given node
    foreach($xml->children() as $employee) { 
        $count++;
        if ($count >= $page && $count < $page + $num) {
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
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Mywebsite</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="employee2.php">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="http://localhost/php/project/employee.php">AddEmp</a></li>
        
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

</header>
<body style="color:black;background-color:LightSalmon " >














<table border="10" style="background-color:LightSeaGreen " class="container">

<tr><td>

             <form method="post" action="" width="48" height="48">
            EmployeeName:<input type="text" name="emname" value="<?php echo $employee->name;?>" required> </br>
            EmployeeGender:<input type="text"  name="emgender" value="<?php echo $employee->gender;?>"></br>
            EmployeePhone:<input type="text" name="emphone" value="<?php echo $employee->phone;?>"></br>
            EmployeeEmail:<input type="text" name="emEmail" value="<?php echo $employee->email;?>" required></br>
          <!--  <input type="submit" name="AddEmployee" value="add"> -->
<!-- <a href="localhost/php/project/delete.php"> <button type="sumbit"> delete</button></a>
 -->
   <input type="submit" name="SearchEmployee" value="search">
    <input type="submit" name="DelEmployee" value="Delete">
<input type="submit" name="EditEmployee" value="Edit">
        </form>


    <!-- </body>
    </html> -->
       
            <?php

    

    if ($page >= 1 && $page!=0) {

        echo " <a href='employee2.php?page=" . ($page - $num) . "'>Previous</a>";}
     // else {
     //    $pageno=1;
     //      echo " &nbsp; &nbsp; <a href='employee2.php?page=".($pageno)."'>Previous</a>";

    // echo " &nbsp; &nbsp; <a href='employee2.php?page=" . ($count-1) . "'>prev</a>";
    //     echo " &nbsp; &nbsp; <a href='employee2.php?page=".next($page)."'>prev</a>";
        
     // }
    if($page< 1)  
    {
     
      echo"<a href='employee2.php?page=" . ($page +$num) . "'>prev</a>";

    


    }  
    if( $page >$xml->children()->count()-1){

     echo " no next";
}else{
    echo " &nbsp; &nbsp; <a href='employee2.php?page=" . ($page + $num) . "'>next</a>";
}
?>
<?php
if(isset($_POST['DelEmployee'])){
$xml=new DomDocument("1.0","UTF-8");
    $xml->load("employee.xml");
    $nameE=$_POST['emname'];
    // Evaluates the given XPath expression 
    $xpath=new DOMXPATH($xml);

    foreach($xpath->query("/employees/employee[name = '$nameE']") as $node){

       // returns the parent node of the specified node
        $node->parentNode->removeChild($node);
    }
    $xml->formateoutput=true;
    $xml->save('employee.xml');
        header("Location:employee2.php");


}

if(isset($_POST['EditEmployee'])){
    $name=$_POST['emname'];
    $gender=$_POST['emgender'];
    $phone=$_POST['emphone'];
    $email=$_POST['emEmail'];


if(preg_match("/^[A-Za-z0-9]+@[a-zA-Z]+.[com-org-net]+$/",$email)
  && preg_match("/^[0-9]+$/",$phone)
  && preg_match("/^[a-zA-Z_]+$/",$name)
  &&
  $gender=='male'||$gender=='female'
  )

{




    $employee->name=$name;
    $employee->gender=$gender;
    $employee->phone=$phone;
    $employee->email=$email;


//  asxml()->return a well-formed XML string (XML version 1.0) from a SimpleXML object:
// file_put_contents->Write a string to a file
    file_put_contents('/var/www/html/php/project/employee.xml',$xml->asXML());
    header("Location:employee2.php");
}



else


{
    

echo "<script>
alert('Data not vaild please enter a valid data ');
window.location.href='employee2.php';
</script>";


}
}











// if(isset($_POST['SearchEmployee'])){
// $xml=new DomDocument("1.0","UTF-8");
//     $xml->load("employee.xml");
//     $nameE=$_POST['emname'];
//     $xpath=new DOMXPATH($xml);
//     foreach($xpath->query("/employees/employee[name = '$nameE']") as $node){
//        echo $node->nodeValue;
//         // $node->gender=$gn;
//         // $node->phone=$ph;
//         // $node->email=$em;
//     }
//     $xml->formateoutput=true;
//     $xml->save('employee.xml');
//         header("Location:display2.php");


    // foreach($xml->children() as $employee)
    // {
    //     if($employee->name == $_POST['emname'])


    //       echo $employee->name;
    //   echo $employee->gender;
    //   echo $employee->phone;
    //   echo $employee->email;

    // }


// if(isset($_POST['SearchEmployee'])){
//     $xml=simplexml_load_file("employee.xml");
// $nameE=$_POST['emname'];

// $nodes = $data->xpath("/employees/employee[name = '$nameE']");
// $result = $nodes[0];
// echo "name: " . $result->name. "\n";
// echo "phone: " . $result->phone. "\n";
// }
//-----------------------
// if(isset($_POST['SearchEmployee'])){
// $data = new SimpleXMLElement("employee.xml");
// foreach ($data->employee as $item)
// {
//     if ($item->name == $_POST['emname'])
//     {
//         echo "ID: " . $item->name . "\n";
//         echo "Title: " . $item->phone . "\n";
//     }
// }


// }

//-----------------

// if(isset($_POST['SearchEmployee'])){
// $xml = simplexml_load_file('employee.xml');
// $nameE=$_POST['emname'];
    
//     $employees = $xml->xpath("/employees/employee[name = '$nameE']");

//     foreach($employees as $employee) {
//         echo "Found {$employee->name}<br />";
//     }

// }



// echo $employee->name;
       //  echo $employee->gender;
       // echo $employee->phone;
       // echo $employee->email;
//---------------

if(isset($_POST['SearchEmployee'])){
     $noofnode=0;
    foreach($xml->children() as $employee) {
         $noofnode++;
        if($employee->name==$_POST['emname']){
       
        header("Location:employee2.php?page=" . $noofnode . "");

        }
    }
}








//-------------------------
    }
    }
?>
</td></tr>
</table>
<div>
<hr>
<center>
  &copy; EsraaMahmoud
</center>
<hr>

</div>

</body>
</html>
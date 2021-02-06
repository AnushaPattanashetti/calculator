<?php
 $connect = mysqli_connect("localhost","root","","calculator");
 if(!$connect)
 {
     die("Error connecting DB : ". mysqli_error($connect));
 }
 else
 {
    $val1 = $_POST['op1'];
    $val2 = $_POST['op2'];

    $login_id = $_POST['id'];
    $phone = $_POST['phno'];
    $op = "";
    $res = "";
    if($_POST['plus']){
        $op = "+";
        $res = $val1 + $val2;
        
    }
    elseif($_POST['min']){
        $op = "-";
        $res = $val1 - $val2;

    }
    elseif($_POST['mul']){
        $op = "*";
        $res = $val1 * $val2;

    }
    elseif($_POST['div']){
        $op = "/";
        $res = $val1 / $val2;

    }
   
    $operation = $val1." ".$op." ".$val2."= ".$res;
   
    

    $query = "INSERT INTO operations(login_id,operations)VALUES('$login_id','$operation')";
    $result = mysqli_query($connect,$query);
    if($result){
        $url = $_SERVER['HTTP_REFERER'];
        header('Location: '.$url );
    }

}
?>
<?php
    $connect = mysqli_connect("localhost","root","","calculator");
    if(!$connect)
    {
        die("Error connecting DB : ". mysqli_error($connect));
    }
    else
    {
        if($_GET['phno'])
        {
            $id="";

        $phone = $_GET["phno"] ;
        $query = "SELECT * FROM login WHERE phonenumber =".$phone."";
        
        $result = mysqli_query($connect,$query);

        $history ="<br>";

        if(mysqli_num_rows($result)>0){
            
           while($rows = mysqli_fetch_assoc($result)){
                $id= $rows['id'];
                

                $op_query = "SELECT * FROM operations WHERE login_id = ".$id."";

                $op_result = mysqli_query($connect,$op_query);
                if(mysqli_num_rows($op_result) > 0){

                    while($op_rows = mysqli_fetch_assoc($op_result)){
                        $history .= $op_rows["operations"]."<br>";
                        

                    }
                }
           }

        }
        else{
            $query1 = "INSERT INTO login(phonenumber)VALUES (".$phone.")";
            $res1 = mysqli_query($connect,$query1);
            if($res1){
               echo "New User Registered Please Refresh page ! <br>";
            }
        }
       
        
        echo " History : \n".$history;
        echo "<html>
            <head> </head>
            <body> 
                <form action ='cal.php' method='POST'>
                    Values1: <input type='text' id ='op1' name='op1' />
                    Values2: <input type='text' id ='op2' name='op2' />

                    <input type='hidden' name ='phno' value='".$phone."'/>
                    <input type='hidden' name ='id' value='".$id."'/>
    
                    <input type='submit' value='+' name='plus' />
                    <input type='submit' value='-' name='min' />
                    <input type='submit' value='*' name='mul' />
                    <input type='submit' value='/' name='div' />

                </form>
                <a href ='login.html'>goto login </a>
            </body>
        </html>";

    }
    else{
        echo "KILL";
    }
    
} 
    mysqli_close($connect);  


?>
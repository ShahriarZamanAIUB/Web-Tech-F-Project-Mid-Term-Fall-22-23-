<?php
     session_start();
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $retypedPassword = trim($_POST['retypedPassword']);

    $userType= 'customer';

    $address = trim($_POST['address']);
    $balance = 10000;
    $already_exists_flag;
   // $record;
    $record_elements;
     

    if($username == "" || $password == "" || $email == "" ||$retypedPassword==""||$address==""){
        //echo "Null values"; 
        
        header('location: customerRegistration.php?err=null');

        
    }

    else if(substr_count($username,'|')>0|| substr_count($password,'|')>0 || substr_count($retypedPassword,'|')>0|| substr_count($address,'|')>0)
    {
        header('location: customerRegistration.php?err=|_instance');
 
    }

  //  else if(var_dump(checkdate($month,$day,$year))==false)
  //  {
   //     header('location: registration.php?err=invalid_date');
 
   // }

   else if(substr_count($username,'|')>0 || substr_count($password,'|')>0 || substr_count($email,'|')>0 || substr_count($retypedPassword,'|')>0 || substr_count($address,'|')>0)
    {
        header('location: registration.php?err=|_instance');
 
    }
    
    else if($password!=$retypedPassword){
     
      // echo "Passwords do not match!";

      header('location: customerRegistration.php?err=passwords_unmatched');

    }
    
    else{ 
              $already_exists_flag=0;
         
        $file=fopen('allCustomers.txt','r');

        while(!feof($file))
        {
            $record=trim(fgets($file));

            $record_elements=explode("|",$record);

             //print($record_elements[2]);

            if(strcmp($username,$record_elements[0])==0 || $email==$record_elements[2])
            {   echo "\r\nMatch found!\r\n";
                $already_exists_flag=1;

                 break;

            }




        }

        if($already_exists_flag==1)
        {


            header('location: customerRegistration.php?err=already_taken');


        }



        else{

             $user_record=$username."|".$password."|".$email."|".$address."|".$balance;


        
         $file =fopen('allCustomers.txt','a');
         fwrite($file,  $user_record."\r\n");    
        

         fclose($file);

         $user = ['username'=> $username, 'password'=>$password, 'email'=>$email, 'adress'=>$address, 'balance'=>$balance, 'userType'=>$userType ];

         $_SESSION['user'] = $user;

         

        setcookie('status', 'true', time()+60*60*72, '/');

        setcookie('username', $username, time()+60*60*72, '/');

        setcookie('password', $password, time()+60*60*72, '/');

        setcookie('email', $email, time()+60*60*72, '/');

        setcookie('userType', $userType, time()+60*60*72, '/');

        setcookie('address', $address, time()+60*60*72, '/');

       /* echo "Hello\r\n";

        echo $_COOKIE['username'];

        echo $_COOKIE['password'];

        echo $_COOKIE['email'];

        echo $_COOKIE['userType'];*/

        //echo  $_SESSION['user']['userType'];  

        header('location: customerDashboard.php?message=reg_success');

       
        }
    }

?>
<?php
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];
    $loginStatus=false;

    if($username == "" || $password == "" || $userType==""){
        header('location: home.php?err=null');
    } 

    else
    {  $filename;
        $php_filename;
        
        switch ($userType) {

         case 'admin':
                $txt_filename='allAdmins.txt';  $php_filename='adminDashboard.php';
          break;

        case 'foodCourtManager':
            $txt_filename='allFoodCourtManagers.txt';  $php_filename='foodCourtManagerDashboard.php';
          break;

        case 'restaurantManager':
            $txt_filename='allRestaurantManagers.txt'; $php_filename='restaurantManagerDashboard.php';
          break;

        case  'restaurantOwner':
           $txt_filename='allRestaurantOwners.txt';    $php_filename='restaurantOwnerDashboard.php';
          break;

        case  'customer':
            $txt_filename='allCustomers.txt';          $php_filename='customerDashboard.php';
            break;
           
           
        default:
        header('location: home.php?err=null');
      }





        $file=fopen($txt_filename,'r');

        while(!feof($file))
        {
            $record=fgets($file);

            $record_elements=explode("|",$record);

            if($username==$record_elements[0] && $password==$record_elements[1])
            {
                $loginStatus=true;

                 break;

            }




        }fclose($file);

        if($loginStatus==true)
        { 
            $user = ['username'=> trim($record_elements[0]), 'password'=>trim($record_elements[1]), 'email'=>trim($record_elements[2])  ];

            $_SESSION['user'] = $user;

             
            setcookie('status', 'true', time()+60*60*72, '/');

            setcookie('username', trim($record_elements[0]), time()+60*60*72, '/');

            setcookie('password', trim($record_elements[1]), time()+60*60*72, '/');

            setcookie('email', trim($record_elements[2]), time()+60*60*72, '/');

            setcookie('userType', $userType, time()+60*60*72, '/');

            if($userType=='customer')
            {
                setcookie('address', trim($record_elements[3]), time()+60*60*72, '/');

                setcookie('balance', trim($record_elements[4]), time()+60*60*72, '/');


            }

            else if($userType=='restaurantOwner')
           { setcookie('restaurantName', trim($record_elements[3]), time()+60*60*72, '/');

            setcookie('restaurantAddress', trim($record_elements[4]), time()+60*60*72, '/');

            setcookie('restaurantBalance', trim($record_elements[5]), time()+60*60*72, '/');

           }
            
           //$_SESSION['user']['selectedUserType']=$userType;

            header('location: '.$php_filename.'?message=log_in_success');
           
             
        }

        else
        {
            header('location: home.php?err=login_failed');

        }





    }

?>
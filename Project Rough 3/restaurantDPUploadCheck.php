<?php 

    //print_r($_FILES);
    
    $src = $_FILES['myfile']['tmp_name'];
    
     $des ="restaurantDP/".$_COOKIE['restaurantName'].".jpg";  
  
     
      
      

    if(move_uploaded_file($src, $des)){
        header('location: '.$_COOKIE['userType'].'Dashboard.php?message=restaurant_pic_set_successfully');
    }
    
    else{
        header('location:  '.$_COOKIE['userType'].'Dashboard.php?message=restaurant_pic_setting_failed');
    }  
?>
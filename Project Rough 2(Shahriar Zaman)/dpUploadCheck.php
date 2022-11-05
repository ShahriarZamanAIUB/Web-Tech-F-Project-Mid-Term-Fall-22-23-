<?php 

    //print_r($_FILES);
    
    $src = $_FILES['myfile']['tmp_name'];
    
    if($_COOKIE['userType']=='restaurantOwner'){   $des ="restaurantDP/".$_COOKIE['restaurantName'].".jpg";  }
    else{
    $des =$_COOKIE['userType']."DP/".$_COOKIE['username'].".jpg";}
      
      

    if(move_uploaded_file($src, $des)){
        header('location: '.$_COOKIE['userType'].'Dashboard.php?message=profile_picture_change_success');
    }
    
    else{
        header('location:  '.$_COOKIE['userType'].'Dashboard.php?message=profile_picture_change_failed');
    }  
?>
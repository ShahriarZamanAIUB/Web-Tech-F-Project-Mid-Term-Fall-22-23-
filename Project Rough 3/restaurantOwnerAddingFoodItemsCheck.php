<?php
session_start();
$foodItemName=trim($_POST['foodItemName']);
$foodItemPrice=trim($_POST['foodItemPrice']);

 
$restaurantName=$_COOKIE['restaurantName'];

$already_exists=false;

if($foodItemName=="" || $foodItemPrice <= 0 || !isset($restaurantName)){
    //echo "Null values"; 
    
    header('location: restaurantOwnerAddingFoodItems.php?err=null');

    
}

else{
    

    $file=fopen('allFoods/'.$restaurantName.'/allFoodNames.txt','r');
      
    while(!feof($file))
    {
        $record=trim(fgets($file));

        $record_elements=explode("|",$record);

         //print($record_elements[2]);

        if(isset($record_elements[0]) && isset($record_elements[1]))
       { 
        if($foodItemName==$record_elements[0] || $foodItemPrice==$record_elements[1])
        {  // echo "\r\nMatch found!\r\n";
            $already_exists=true;

             break;

        }
       }



    }

    if( $already_exists==true){

        header('location: restaurantOwnerAddingFoodItems.php?err=already_taken');
    }

    else{

$food_item_record=$foodItemName.'|'.$foodItemPrice; 


$file =fopen('allFoods/'.$restaurantName.'/allFoodNames.txt','a');




 
fwrite($file,  $food_item_record."\r\n");    
        

fclose($file);

 
    
 

 

  
 

header('location: restaurantOwnerDashboard.php?message=food_item_added');

    }
}
?>
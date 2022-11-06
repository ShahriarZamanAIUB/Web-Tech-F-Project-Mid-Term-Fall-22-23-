 <?php
$restaurantName="KFC";

$order_count=0;
$items_ordered;
 

$file=fopen('allOrders.txt','r');
echo "<form method='post' action='restaurantOwnerVerifyingOrders.php' enctype=''>";

echo "<html><head></head><body><table width='500px'><tr><th>Orders</th></tr>";
while(!feof($file))
{
 
$record=fgets($file);
$record_elements=explode('|',$record);

if(isset($record_elements[0]) && isset($record_elements[1]))
   { if($record_elements[1]==$restaurantName && $record_elements[2]=='pending')
    { $total_price=0;
         $record_line_no=$record_elements[0];
    echo "<tr><td><table border='1' width='100%'>";

    echo "<tr><th colspan='4'>Order No. ".strval($order_count+1)." "; $order_count=$order_count+1;

    echo " ---(Select : <input type='radio' name='selectedOrder' value='".$record_line_no."' >)</th></tr>";
    echo "<tr><td><hr></td><td colspan='3'><hr></td></tr>";  

    echo "<tr><th align='center' width='200px'>Customer : </td><td align='center' colspan='3'>".$record_elements[3]."</td></tr>"; 
    echo "<tr><th align='center' width='200px'>Address : </td><td align='center' colspan='3'>".$record_elements[4]."</td></tr>"; 
    echo "<tr><td><hr></td><td colspan='3'><hr></td></tr>";  
    $items_ordered=(count($record_elements)-5)/4;
    

    echo "<tr><th align='center'><u>Food Item Name</u></th><th><u>Quantity</u></th><th><u>Unit Price</u></th><th><u>Net Price</u></th></tr>";

    for($i=5; $i<=4+$items_ordered*4;$i=$i+4)
    {
        echo "<tr><td align='center'>".$record_elements[$i]."</td><td align='center'>".$record_elements[$i+1]."</td><td align='center'>".$record_elements[$i+2]."</td><td align='center'>".$record_elements[$i+3]."</td></tr>";

        $total_price=$total_price+$record_elements[$i+3];  
    }

     echo "<tr><td align ='center'>Total Price</td><td align='center' colspan='3'> Tk.".$total_price."</td></tr>";
    

   

   

    echo "</table></td></tr>";

    echo "<tr><td colspan='4'>&nbsp</td></tr>"; 
    echo "<tr><td colspan='4'>&nbsp</td></tr>"; 

   }

}
 
}
echo "<tr><td align='center'><input type='submit' value='Approve Order'></input></td></tr>";
echo "</table></body></html>";

 
 

?>
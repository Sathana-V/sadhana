<?php 
include('db.php');
$sql = "select * from model where model_status='active'";  
   
$result = $conn->query($sql);
$count=mysqli_num_rows($result);
$i=0;

 while($row=$result -> fetch_assoc())
 {
   
    $sqli = "select * from product where model_id='".$row['model_id']."'"; 
   
    $result2 = $conn->query($sqli);
    
    $j=0;
    $array[$i]=array();
    while($row2=$result2 -> fetch_assoc()){
        $data=[
            'model_id'=>$row2['model_id'],
            'model_name'=>$row['model_name'],
            'product_description'=>$row2['product_description'],
            'product_id'=>$row2['product_id'],
            'product_name'=>$row2['product_name'],
            'available_size'=>unserialize($row2['available_size']),
            'attachments'=>unserialize($row2['attachments'])[0],
        ];
        array_push($array[$i],$data);
       
    
    }
   $i=$i+1;
 }

?>
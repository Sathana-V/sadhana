<?php 
include('db.php');
$sql = "select * from model where model_status='active'";  
$sql2 = "SELECT * FROM colors";
$result = $conn->query($sql);
$colorResult = $conn->query($sql2);
$count=mysqli_num_rows($result);
$sqli = "select * from product where product_id='".$_GET['id']."'"; 


function mapValueHere ($colorResult, $id) {
    while($row = $colorResult -> fetch_assoc()) {
       if($row['color_id'] == $id) {
        return $row['color_hexvalue'];
       }
    }
}
    $result2 = $conn->query($sqli);
    $array=array();
    $colorArr = array();
    while($row2=$result2 -> fetch_assoc()){
        foreach(unserialize($row2['colors_available']) as $color) {
            array_push($colorArr, mapValueHere($colorResult, $color));
        }
        $data=[
            'model_id'=>$row2['model_id'],
            'model_name'=>$row2['model_name'],
            'product_id'=>$row2['product_id'],
            'product_name'=>$row2['product_name'],
            'product_description'=>$row2['product_description'],
            'available_size'=>unserialize($row2['available_size']),
            'available_color'=>$colorArr,
            'attachments'=>unserialize($row2['attachments']),
        ];
        array_push($array,$data);
    }
?>
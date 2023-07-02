<?php 
include('db.php');
$sql = "select * from product where product_id=".$_GET['id'];
$sql2 = "SELECT * FROM colors";
$result = $conn->query($sql);
$colorResult = $conn->query($sql2);
$count=mysqli_num_rows($result);
$backgroundColor = [
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
];
function mapValue ($colorResult, $id) {
    while($row = $colorResult -> fetch_assoc()) {
       if($row['color_id'] == $id) {
        return $row['color_hexvalue'];
       }
    }
}

   
    $array=array();
    $colorArr=array();
    while($row2=$result -> fetch_assoc())   {
        foreach(unserialize($row2['colors_available']) as $color) {
            array_push($colorArr, mapValue($colorResult, $color));
        }
        $data=[
            'model_id'=>$row2['model_id'],
            'model_name'=>$row['model_name'],
            'product_description'=>$row2['product_description'],
            'product_id'=>$row2['product_id'],
            'product_name'=>$row2['product_name'],
            'available_size'=>unserialize($row2['available_size']),
            'available_color'=>array_slice($colorArr, 0, 12),
            'attachments'=>unserialize($row2['attachments'])[0],
        ];
          
        array_push($array,$data);
    }


?>
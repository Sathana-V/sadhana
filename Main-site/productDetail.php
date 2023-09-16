<?php 
include('db.php');
$sql = "select * from product where product_id=".$_GET['id'];
$sql3 = "select * from product";
$sql2 = "SELECT * FROM colors";
$result = $conn->query($sql);
$colorResult = $conn->query($sql2);
$suggestions = $conn->query($sql3);
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
    $suggestionsList = array();
    while($row2=$result -> fetch_assoc())   {
        foreach(unserialize($row2['colors_available']) as $color) {
            array_push($colorArr, mapValue($colorResult, $color));
        }
        $data=[
            'model_id'=>$row2['model_id'],
            'model_name'=>$row2['model_name'],
            'product_description'=>$row2['product_description'],
            'product_id'=>$row2['product_id'],
            'product_name'=>$row2['product_name'],
            'available_size'=>unserialize($row2['available_size']),
            'available_color'=>'haii',
            'attachments'=>unserialize($row2['attachments'])[0],
        ];
          
        array_push($array,$data);
    }
    while($row3=$suggestions -> fetch_assoc())   {
        foreach(unserialize($row3['colors_available']) as $color) {
            array_push($colorArr, mapValue($colorResult, $color));
        }
        // print_r($row3['colors_available']);
        $data=[
            'model_id'=>$row3['model_id'],
            'model_name'=>$row3['model_name'],
            'product_description'=>$row3['product_description'],
            'product_id'=>$row3['product_id'],
            'product_name'=>$row3['product_name'],
            'available_size'=>unserialize($row3['available_size']),
            'available_color'=>'haii',
            'attachments'=>unserialize($row3['attachments'])[0],
        ];
          
        array_push($suggestionsList,$data);
    }
    // print_r($array[0]);

?>
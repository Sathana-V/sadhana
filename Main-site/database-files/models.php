<?php

include('db.php');
$queryToFetchModal = "select * from model where model_status='active'";
$queryToFetchColors = "SELECT * FROM colors";
$modalResult = $conn->query($queryToFetchModal);
$colorListFromBackend = $conn->query($queryToFetchColors);
$count=mysqli_num_rows($modalResult);
$backgroundColor = [
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
    'linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%)',
];
$i=0;
$colorList = [];
while ($cr = $colorListFromBackend->fetch_assoc()) {
    $colorList[] = $cr;
}

      
 while($modalRow=$modalResult -> fetch_assoc())
 {
   
    $queryToFetchProductOfOarticularModel = "select * from product where model_id='".$modalRow['model_id']."' AND status='Despatched' limit 4"; 
   
    $productResults = $conn->query($queryToFetchProductOfOarticularModel);
   
    $array[$i]=array();
    
    
    while($productRow=$productResults -> fetch_assoc()){
        $minPrice = 99999;
        $maxPrice = -1;
        $colorArr=array();
       
       
        foreach(unserialize($productRow['colors_available']) as $color) {
            $colorToAdd = null; 
            foreach ($colorList as $cr) {
                if ($cr['color_id'] == $color) {
                    $colorToAdd = [
                        'color_hexvalue' => $cr['color_hexvalue'],
                        'color_name' => $cr['color_name']
                    ];
                    
                }
            }

            if ($colorToAdd !== null) {
                array_push($colorArr, $colorToAdd);
            }
        }
        if(isset($productRow['price']) && unserialize($productRow['price']) !=null) {
          
        foreach(unserialize($productRow['price']) as $hey) {
           foreach($hey as $o => $p) {
           
            if(str_contains($o, 'price')) {
                
                if($p!='' && $p!=0 && $p < $minPrice) {
                    $minPrice = $p;
                }
                if($p > $maxPrice) {
                    $maxPrice = $p;
                }
            }
           }
        }
    }
    if($minPrice ==99999 ) {
        $minPrice = 0;
    }
    if($maxPrice == -1 ) {
        $maxPrice = 0;
    }
        $data=[
            'model_id'=>$productRow['model_id'],
            'model_name'=>$modalRow['model_name'],
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'product_description'=>$productRow['product_description'],
            'product_id'=>$productRow['product_id'],
            'product_name'=>$productRow['product_name'],
            'available_size'=>unserialize($productRow['price']),
            'available_color'=> $colorArr,
            'attachments'=> is_array(unserialize($productRow['attachments'])) ? unserialize($productRow['attachments'])[0] : null ,
        ];
        
        array_push($array[$i],$data);
       
    
    }
   
   $i=$i+1;
 }

?>
<?php 
include('db.php');

  
$suggestionProducts = "select * from product where  status='Despatched'";


    $suggestionsList = array();
    while($row2=$result -> fetch_assoc())   {
        
            $colors_available = unserialize($row2['colors_available']);
            foreach(unserialize($row2['colors_available']) as $color) {
                array_push($colorarrayForAll, mapValueHere($color));
            }
        
        
        $data=[
            'model_id'=>$row2['model_id'],
            'model_name'=>$row2['model_name'],
            'product_description'=>$row2['product_description'],
            'product_id'=>$row2['product_id'],
            'product_name'=>$row2['product_name'],
            'available_size'=>unserialize($row2['price']),
            'available_color'=>$colorarrayForAll,
            'attachments'=> is_array(unserialize($row2['attachments'])) ? unserialize($row2['attachments'])[0] : null ,
        ];
          
        array_push($array,$data);
    }
   
    while($row3=$suggestions -> fetch_assoc())   {
       
        $colorArr=array();
        $minPrice = 99999;
        $maxPrice = -1;
       
        $colors_available = unserialize($row3['colors_available']);
        foreach(unserialize($row3['colors_available']) as $color) {
            array_push($colorArr, mapValueHere($color));
        }
       
        foreach(unserialize($row3['price']) as $hey) {
           
           foreach($hey as $o => $p) {
           
            if(str_contains($o, 'price')) {
                
                if($p < $minPrice) {
                    $minPrice = $p;
                }
                if($p > $maxPrice) {
                    $maxPrice = $p;
                }
            }
           }
        }
        $data=[
            'model_id'=>$row3['model_id'],
            'model_name'=>$row3['model_name'],
            'product_description'=>$row3['product_description'],
            'product_id'=>$row3['product_id'],
            'product_name'=>$row3['product_name'],
            'available_size'=>unserialize($row3['price']),
            'available_color'=>$colorArr,
            'attachments'=> is_array(unserialize($row3['attachments'])) ? unserialize($row3['attachments'])[0] : null ,
        ];
          
        array_push($suggestionsList,$data);
    }

?>
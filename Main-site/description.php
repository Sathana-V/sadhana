<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="style3.css">
    <!-- Bootstrap CSS --> 
    <script src="Header.js" type="text/javascript" defer></script>
    <script src="Footer.js" type="text/javascript" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/logo-222.png" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  
    <title>mypitch.xyz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <title>mini</title>
  </head>
<script>
  function changeImage (img) {
    document.getElementById('mainImage').src = "../backend/public/uploads/"+ img
  }
  function moveto(value) {
    console.log("vakue",value)
    window.location.href="description.php?id="+value
  }
</script>
 <header-component></header-component>
  <body>
   
  <div class="container">
  <?php include('brandProducts.php') ?>
  
    <h1 class="main-heading"><?php  echo $array[0]['model_name']; ?></h1>
    <div class="card">
        <div class="product">
            <div class="product-image-slider">
               <?php echo '<img id="mainImage" src="../backend/public/uploads/'.$array[0]["attachments"][0].'" alt="haiii" srcset="">'; ?>
            </div>
            <div class="product-image-description">
               <p class="price">Rp. 7000</p>
                <h4><?php  echo $array[0]['product_name']; ?></h4>
                <p class="product-image-description-content"><?php  echo $array[0]['product_description']; ?></p>
                <hr>
                <?php 
                  if(isset($array[0]['available_size'])&&$array[0]['available_size']!=' ')
                  {
                    echo '<div class="size">
                    <h6>SIZE : </h6>
                    <div class="size-list">';
                    foreach($array[0]['available_size'] as $size) {
                      echo '<p>'.$size.'</p>';
                    }
                    echo '</div>
                    </div>';
                  }
                ?>
                <hr>
                <?php 
                  if(isset($array[0]['available_color'])&&$array[0]['available_color']!=' ')
                  {
                    echo '<div class="color">
                    <h6>COLOR : </h6>
                    <div class="color-list">';
                    foreach($array[0]['available_color'] as $color) {
                      echo '<p style="background-color:'.$color.'"></p>';
                    }
                    echo '</div>
                    </div>';
                  }
                ?>
            </div>
            <?php 
             if(isset($array[0]['attachments'])&&$array[0]['attachments']!=' ')
             {
               echo '<div class="product-image-lists">';
               foreach($array[0]['attachments'] as $color) {
                 echo '<img onclick="changeImage(`'.$color.'`)" src="../backend/public/uploads/'.$color.'" alt="" srcset="">';
               }
               echo '</div>';
             }
            ?>
        </div>
    </div>
  </div>
  <h4 class="others">View Other Products: </h4>
  <?php include('productDetail.php') ?>
  <div class="container-fluid">
    <div class="row suggestions">
      <?php 
       foreach($suggestionsList as $value) {
        echo '<div class="col-sm-4 col-md-3 col-lg-3">
        <div class="card">
            <img src="../backend/public/uploads/'.$value["attachments"].'" alt="" srcset="">
            <div class="description">
                <h4>'.$value['model_name'].'</h4>
                <h6>'.$value['product_name'].'</h6>
                <p>'.$value['product_description'].'</p>
                 <button onclick="moveto('.$value['product_id'].')"> See More</button>
            </div>
        </div>
    </div>  ';
       }
      ?> 
    </div>
  </div>
    

     <!-- Optional JavaScript; choose one of the two! -->
 
     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   </body>
 </html>
<style>

</style>
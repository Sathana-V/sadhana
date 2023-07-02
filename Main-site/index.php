<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
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
 function moveto(value) {
    console.log("vakue",value)
    window.location="http://localhost/sadhana/1/sadhana/Main-site/brand.php?id="+value
  }
 </script>
 <header-component></header-component>
  <body>
    <div id="jumbo" class="jumbotron jumbotron-fluid">
      <div class="container-fluid">
        <img width="100%"  height="auo" src="images/jumbo.png" alt="" srcset="">
      </div>
    </div>
   <div class="container">
   <?php include('models.php')?>
      <?php for($i=0;$i<$count;$i++): ?>
      <div class="row">
        <h3><?php if(isset($array[$i][0])){echo $array[$i][0]['model_name']; } ?></h3>
          <?php
          foreach($array[$i] as $value) {
            echo '<div class="col-lg-4 col-md-6 col-sm-6" class="index-rows">
            <div class="card">
            <img class="card-img-top" src="../dashboard/backend/public/uploads/'.$value['attachments'].'" alt="Card image" style="width:100%">

           
              <h4 class="card-title">'.$value['product_name'].'</h4>
              <div class="card--text">
              <p>'.$value['product_description'].'</p>
              <h5>Available sizes</h5>

              ';
              // echo $value['available_size']; 
              ?>
              <?php
              if(isset($value['available_size'])&&$value['available_size']!=' ')
              {
                echo '<ul class="available">';
          foreach($value['available_size'] as $size) {
             echo '<li class="sizes" style="display:inline-block;">
             '.$size.'
             </li>';
          }
          echo '</ul>';
        }
              echo '
              <button onclick="moveto('.$value['product_id'].')" class="btn btn-primary view-more">View more</button>
      
            </div>
            </div>
            </div>';
      
            }
            ?>
           
      </div>
       
      <?php endfor; ?>
   </div>
    
    

     <!-- Optional JavaScript; choose one of the two! -->
 
     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
     <!-- Option 2: Separate Popper and Bootstrap JS -->
     <!--
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
     -->
   </body>
 </html>
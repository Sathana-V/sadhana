<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style2.css" />
    <!-- Bootstrap CSS -->
    <script src="Header.js" type="text/javascript" defer></script>
    <script src="Footer.js" type="text/javascript" defer></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      rel="icon"
      type="image/png"
      href="images/logo-222.png"
      sizes="16x16"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <title>mypitch.xyz</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <title>mini</title>
  </head>

  <header-component></header-component>
  <body>
  <div id="jumbo" class="jumbotron jumbotron-fluid">
      <div class="container-fluid">
        <img width="100%"  height="auo" src="images/jumbo.png" alt="" srcset="">
      </div>
    </div>
    <div class="container">
     <div class="quality">
      <img src="./images/icons8-quality.gif" alt="img" />
      <h6>High quality, Unbeatable value</h6>
        <p>Our high-end fabric is everything you <br>
            desire for your everyday comfort<br>
            and fashion declaration.</p>
     </div>
    </div>
    <div class="container">
      <?php include('models.php')?>
      <?php for($i=0;$i<$count;$i++): ?>
        <?php echo '<div class="row" style="background:whitesmoke">'; ?>
      <h3 class="main-heading"><?php if(isset($array[$i][0])){echo $array[$i][0]['model_name']; } ?></h3>
      <?php
          foreach($array[$i] as $value) {
            echo '
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card">
            <div class="card-image">
              <img
                src="../backend/public/uploads/'.$value['attachments'].'"
                alt=""
                srcset=""
              />
            </div>
            <div class="card-description">
              <h4 class="product-name">'.$value['product_name'].'</h4>
              <p class="product-description">
              '.$value['product_description'].'
              </p>';
              ?>
                 <?php
                if(isset($value['available_size'])&&$value['available_size']!=' ')
                {
                  echo ' <div class="product-size">
                  <p>SIZE</p>
                  <div class="product-size-list">';
                  foreach($value['available_size'] as $size) {
                    echo '<span>'.$size.'</span>';
                  }
                  echo '</div>
                  </div>';
                }
                  
              echo '<div class="product-color">
                <p>COLOR</p>
                <div class="product-color-list">';
                foreach($value['available_color'] as $color) {
                  echo '<span style="background-color:'.$color.'"></span>';
                }
      
             echo '</div></div>
              <div onclick="moveto('.$value['product_id'].')" class="product-button">See More</div>
            </div>
            </div>
            </div>';  
          }

            ?>
         </div>
        <?php if ($i === 0) {
          echo '<div class="container">
          <div class="quality shipping-icon">
           <img src="./images/shipping.gif" alt="img" />
           <h6>Shipping & Delivery</h6>
             <p>We deliver our products right at <br>
             your doorstep with the utmost care <br>
              , love, not to mention free shipping.</p>
          </div>
         </div>';
        } ?>
        <?php endfor; ?>
         </div>
         <div class="container my-5">

<footer class="text-white text-center text-lg-start" style="background-color: #23242a;">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row mt-4">
      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">About company</h5>

        <p>
          At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
          voluptatum deleniti atque corrupti.
        </p>

        <p>
          Blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas
          molestias.
        </p>

        <div class="mt-4">
          <!-- Facebook -->
          <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-facebook-f"></i></a>
          <!-- Dribbble -->
          <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-dribbble"></i></a>
          <!-- Twitter -->
          <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-twitter"></i></a>
          <!-- Google + -->
          <a type="button" class="btn btn-floating btn-warning btn-lg"><i class="fab fa-google-plus-g"></i></a>
          <!-- Linkedin -->
        </div>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4 pb-1">Search something</h5>

        <div class="form-outline form-white mb-4">
          <input type="text" id="formControlLg" class="form-control form-control-lg">
          <label class="form-label" for="formControlLg" style="margin-left: 0px;">Search</label>
        <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 48.8px;"></div><div class="form-notch-trailing"></div></div></div>

        <ul class="fa-ul" style="margin-left: 1.65em;">
          <li class="mb-3">
            <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">Tirupur, Tamil Nadu, India</span>
          </li>
          <li class="mb-3">
            <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">sadhanagarments2013@gmail.com</span>
          </li>
          <li class="mb-3">
            <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">+91 9994284722</span>
          </li>
          <li class="mb-3">
            <span class="fa-li"><i class="fas fa-print"></i></span><span class="ms-2">+91 9994284722</span>
          </li>
        </ul>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-4">Opening hours</h5>

        <table class="table text-center text-white">
          <tbody class="font-weight-normal">
            <tr>
              <td>Mon - Thu:</td>
              <td>8am - 9pm</td>
            </tr>
            <tr>
              <td>Fri - Sat:</td>
              <td>8am - 10pm</td>
            </tr>
            <tr>
              <td>Sunday:</td>
              <td>9am - 5pm</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2023 Copyright:
    <a class="text-white" >Sadhana Garments</a>
  </div>
  <!-- Copyright -->
</footer>

</div>
<!-- End of .co
C:\xampp\htdocs\sadhana\1\sadhana\github\sadhana\Main-site\products.php
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script>
 function moveto(value) {
    console.log("vakue",value)
    window.location.href="description.php?id="+value
  }
 </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
  </body>
</html>
<style>
  .quality {
    text-align: center;
    height: 100px;
  }
  .quality img {
    height: 50px;
    width: 50px;
  }
  .shipping-icon {
    height: 300px;
  }
  .shipping-icon img{
    width: 50%;
    height: 200px;
  }
  .container.my-5 {
    margin: 0;
    padding: 0;
}
  .container {
    margin-top: 66px;
    max-width: 100%;
  }
  .card {
    margin-top: 20px;
    display: -webkit-box;
    height: 220px;
  }
  .card-image {
    width: 50%;
    height: 220px;
  }
  .card img {
    width: 100%;
    height: 220px;
  }
  .card-description {
    padding: 8px;
    width: 50%;
    height: 220px;
  }
  .product-name {
    font-size: 16px;
    font-weight: 700;
  }
  .product-description {
    font-size: 0.8rem;
    margin: 0;
    padding-left: 3px;
    min-height: 30px;
    display: -webkit-box;
    max-width: 200px;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .product-size p,
  .product-color p {
    font-size: 12px;
    font-weight: 800;
    margin: 0px;
  }
  .product-size-list span {
    margin: 0px 6px;
    font-size: 12px;
    color: brown;
    font-weight: bold;
  }
  .product-color-list {
    display: flex;
    flex-wrap: wrap;
    height: 33px;
    justify-content: start;
  }
  .product-color span {
    background-color: brown;
    color: white;
    margin: 1px 2px;
    height: 10px;
    padding: 0px 8px;
    border-radius: 50%;
  }
  .product-button {
    margin-top: 8px;
    border-radius: 8px;
    padding: 4px;
    cursor: pointer;
    position: absolute;
    bottom: 8px;
    width: 45%;
    text-align: center;
    background-color: blueviolet;
    color: white;
  }
  .row .main-heading{
        text-align: center;
        text-decoration: underline;
    }
  .row{
      margin: -8px;
      margin-top: 20px;
      border-radius: 20px;
      padding-bottom: 20px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
  @media only screen and (max-width: 600px) {
    .product-size-list span {
      font-size: 9px;
    }
    
    
  }
</style>
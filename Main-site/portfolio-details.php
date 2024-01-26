<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sadhana garments</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Ninestars
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
    body {
  font-family: Arial;
  margin: 0;
}

* {
  box-sizing: border-box;
}

img {
  vertical-align: middle;
}

.container {
  position: relative;
  // max-width: 1000px;
  // margin: 0 auto;
}

.holder {
  display: flex;
  justify-content: center;
}

.holder::-webkit-scrollbar {
  display: none;
}

/* Hide the images by default */
.slides {
  display: none;
  width: 600px;
  height: 600px;
  /* max-width: 1000px; */
  /* width: 100%;
  flex-shrink: 0;
  height: 100%; */
}
@media (max-width: 500px) {
    .slides {
        width: 400px;
  height: 400px;
  }
}


.slides img {
  width: 100%;
  height: 100%;
}

/* Smartphones (portrait and landscape) ----------- */

.prevContainer,
.nextContainer {
  background-color: rgba(0, 0, 0, 0.3);
  position: absolute;
  top: 50%;
  transform: translate(0, calc(-50% - 54px));
  height: 54px;
  width: 54px;
  cursor: pointer;
}

.prevContainer {
  margin-left: 26px;
  left: 0;
  border-radius: 30px 0 0 30px;
}

.prev {
  position: relative;
  top: 50%;
  transform: translate(0, -50%);
  height: 34px;
  width: 32px;
  float: left;
  margin-left: 12px
}

.prev svg,
.next svg {
  fill: white;
}

.nextContainer {
  margin-right: 26px;
  right: 0;
  border-radius: 0 30px 30px 0;
}

.next {
  position: relative;
  top: 50%;
  transform: translate(0, -50%);
  height: 34px;
  width: 32px;
  float: right;
  margin-right: 12px;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 12px 4px 1px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  margin-top: 2%;
  float: left;
  width: 16.66%;
}
@media (max-width: 500px) {
    .column {
  margin-top: 2%;
  float: left;
  width: 19.66%;
}
}

/* Add a transparency effect for thumbnail images */
.slide-thumbnail {
  width: 100%;
  opacity: 0.6;
  cursor: pointer;
}

.active,
.slide-thumbnail:hover {
  opacity: 1;
}
    </style>


<script>
   
    var slideIndex = 1;

    addEventListener("DOMContentLoaded", (event) => {
        showSlides(slideIndex);
      var slides = document.getElementsByClassName("slides");
var touchStartX;
setInterval(() => plusSlides(1), 10000);

for (var i = 0; i < slides.length; i++) {
    slides[i].addEventListener('touchstart', handleTouchStart);
    slides[i].addEventListener('touchmove', handleTouchMove);
    slides[i].addEventListener('touchend', handleTouchEnd);
}

    });
   
   function handleTouchStart(event) {
    touchStartX = event.touches[0].clientX;
}
function handleTouchMove(event) {
    // Prevent default to avoid scrolling while swiping
    event.preventDefault();
}

function handleTouchEnd(event) {
    var touchEndX = event.changedTouches[0].clientX;
    var swipeDistance = touchEndX - touchStartX;

    // Adjust the threshold as needed based on how far the user needs to swipe to trigger an action
    var swipeThreshold = 50;

    if (swipeDistance > swipeThreshold) {
        // Swipe right
        plusSlides(1);
    } else if (swipeDistance < -swipeThreshold) {
        // Swipe left
        // Adjust the value as needed
        plusSlides(-1);
    }
}



function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("slides");
  var dots = document.getElementsByClassName("slide-thumbnail");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  console.log(slideIndex);

  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
      // slides[i].style.display = "inline";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  // slides[slideIndex-1].style.display = "inline";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
 function moveto(value) {
    console.log("vakue",value)
    window.location.href="portfolio-details.php?id="+value
  }
 </script>
<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
            <img style="cursor:pointer;" onclick="moveHome()" class="office-logo" src="assets/img/2.jpg"
                    alt="">
                <!-- <h1 class="text-light"><a href="index.php"><span>Ninestars</span></a></h1> -->
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="index.php#about">About Us</a></li>
                    <li><a class="nav-link scrollto" href="index.php#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="index.php#portfolio">Products</a></li>
                    <li><a class="nav-link scrollto" href="index.php#team">Team</a></li>
                    <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                        class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li> -->
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="getstarted scrollto" href="#about">Get Started</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <main id="main">

        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Product Details</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="portfolio.html">Products</a></li>
                        <li>Product Details</li>
                    </ol>
                </div>

            </div>
        </section><!-- Breadcrumbs Section -->
        <?php include('database-files/brandProducts.php') ?>
        <!-- ======= Portfolio Details Section ======= -->
        <section id="portfolio-details" class="portfolio-details">
            <div class="container-fluid">

                <div class="row gy-4">

                    <div class="col-lg-8">
                    <div class="container">
  <!-- main images -->
  <div class="holder">
    
    
   <?php 
   
   if(isset($productDetailArray[0]['attachments'])&&$productDetailArray[0]['attachments']!=null)
   {
     foreach($productDetailArray[0]['attachments'] as $color) {
     echo '<div   class="slides">
<img class="img-fluid" src="../backend/public/uploads/'.$color.'" alt="" />
</div>';
     }
   }
   
   ?>
      
   
  </div>

  <div class="prevContainer"><a class="prev" onclick="plusSlides(-1)">
    <svg viewBox="0 0 24 24">
    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"></path>
</svg>
    </a></div>
  <div class="nextContainer"><a class="next" onclick="plusSlides(1)">
    <svg viewBox="0 0 24 24">
  <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
</svg>
    </a></div>

  <div class="caption-container">
    <p id="caption"></p>
  </div>

  <!-- thumnails in a row -->
  <div class="row">
  <?php 
                                  if(isset($productDetailArray[0]['attachments'])&&$productDetailArray[0]['attachments']!=null)
                                  {
                                    $index=1;
                                    foreach($productDetailArray[0]['attachments'] as $color) {
                                    echo '<div class="column">
                                    <img style="text-align:center;"  class="slide-thumbnail" src="../backend/public/uploads/'.$color.'"  onclick="currentSlide(' . $index . ')" alt="'.$productDetailArray[0]["product_name"].'">
                                  </div>';
                                  $index++;
                                    }
                                  }
                                  ?>
    
   
   
  </div>
</div>
                        
                    </div>

                    <div class="col-lg-4">
                        <div class="portfolio-info">
                            <h3>Product information</h3>
                            <ul>
                                <li><strong>Category</strong>:  <?php  echo $productDetailArray[0]['model_name']; ?></li>
                                <li><strong>Model</strong>: <?php  echo $productDetailArray[0]['product_name']; ?></li>
                                
  
 
                <?php 
                  if(isset($productDetailArray[0]['available_size'])&&$productDetailArray[0]['available_size']!=' ')
                  {
                    $firstCharacter = '';
                    foreach($productDetailArray[0]['available_size'][0] as $size) {
                       $firstCharacter = $size;
                        break;
                    }
                    $firstCharacter = trim($firstCharacter);
$isNumeric = is_numeric($firstCharacter) || is_numeric(str_replace([' ', ',', '.'], '', $firstCharacter));
$mySizeChart = ['70', '75', '80', '85', '90', '95', '100'];
                    echo '<li><strong>Available Sizes</strong>: 
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Size</th>
            <th scope="col">' . (in_array($firstCharacter,$mySizeChart) ? "Price Per Piece" : "Age Group"). '</th>
            <th scope="col">' . (in_array($firstCharacter,$mySizeChart) ? "Price Per Bundle" : "Price"). '</th>
          </tr>
        </thead>
        <tbody>';
        
                  
                    foreach($productDetailArray[0]['available_size'] as $size) {

                        echo ' <tr>';
                        foreach ($size as $key => $value) {
                           
                         if($key=='label') {
                            echo '
     
                            <td>'.$value.'</td>';
                         } else {
                            if($value == '0' || $value == 0 || $value == null ) {
                                echo ' <td>- </td> ';
                            } else {
                                echo ' <td>' . $value .' </td> ';
                            }
                           
                         }
                        
                     
                        }
                        echo '</tr>';
                   
                    }
                    echo ' </tbody>
                    </table>';
                  }
                ?>
               </li>
                                <li><strong>Available Colors</strong>:</li>
                            
                                <?php 
                  if(isset($productDetailArray[0]['available_color'])&&$productDetailArray[0]['available_color']!=' ')
                  {
                    
                    foreach($productDetailArray[0]['available_color'] as $color) {
                        if($color!=null && $color['color_hexvalue']!=null)
                       
                      echo '<span class="badge badge-primary mx-2" style="background-color:'.$color['color_hexvalue'].'">'.$color['color_name'].'</span>';
                    }
                    
                  }
                ?>
                              </ul>
                        </div>
                        <div class="portfolio-description">
                            <h2> <?php  echo $productDetailArray[0]['model_name']; ?></h2>
                            <p>
                            <?php  echo $productDetailArray[0]['product_description']; ?>
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Portfolio Details Section -->

    </main><!-- End #main -->
   
    <?php include('database-files/models.php')?>
        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Our Products</h2>
                    <p>Check out our product samples</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <?php for($i=0;$i<$count;$i++): ?>
                            <li
                                data-filter=".filter-<?php if(isset($array[$i][0])){echo $array[$i][0]['model_name']; } ?>">
                                <?php if(isset($array[$i][0])){echo $array[$i][0]['model_name']; } ?></li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    <?php
                      for($i=0;$i<$count;$i++) {
                      
                foreach ($array[$i] as $value) {
                  if($value) {
                    
                    echo '<div onclick="moveto('.$value['product_id'].')" class="col-lg-4 col-md-6 portfolio-item filter-' . (isset($array[$i][0]) ? $array[$i][0]['model_name'] : '') . '">
                        <div  class="portfolio-wrap">
                        <div class="custom-card pb-4">
                        <img src="../backend/public/uploads/'.$value['attachments'].'" width="100%"  height="300"   alt="">
                        <div class="custom-card-container">
                          <div class=" d-flex justify-content-between">
                          <h4 class="float-right mt-3" class="mt-2"><b><i>' . (isset($array[$i][0]) ? $array[$i][0]['model_name'] : '') . '</i></b></h4>';
                          if( $value['minPrice'] != 0 && $value['maxPrice'] !=0 && $value['minPrice'] != $value['maxPrice']) 
                          echo'
                          <p class="mt-3 mr-6 mb-0" style="color: red"><strong>₹'.$value['minPrice'].' - ₹'.$value['maxPrice'].'</strong></p>';
                          
                          else if( $value['minPrice'] != 0 && $value['maxPrice'] !=0)
                          echo '<p class="mt-3 mr-6" style="color: red"><strong>₹'.$value['minPrice'].'</strong></p>';
                         
                          echo'
                          </div>
                          <p style="color: grey" >' . ($value ? $value['product_name'] : '') . '</p>
                          <div class="swiper-pagination"></div>' ;
                          
                          if(isset($value['available_size'])&&$value['available_size']!='')
                  {
                    echo '<p class="mb-0"><b>Sizes: </b></p>';
                          foreach($value['available_size'] as $size) {
                           
                                foreach ($size as $key) {
                                   
                               echo '<span style="color: grey" >'.$key.',  </span>';
                               break;        
                             
                                }
                           
                               
                       
                        }
                    }
                          
                          
                          
                            
                               
                  if(isset($value['available_color'])&&$value['available_color']!=' ')
                  {
                    $availColor = $value['available_color'];
                    $lrngth = 0;
                    $count = count($value['available_color']);
                    // $count = count($value['available_color']) > 6 ? 6 : count($value['available_color']);
                    // $balance = (count($value["available_color"]) - 6) > 1 ? count($value["available_color"]) - 6 : -1;
                    $balance= 0;
                    echo '<p class="mb-0 mt-2 mb-1"><strong>Available Colors</strong>:</p> <div class="container"><div class="row">';
                    
                    for($j=0; $j < $count ; $j++) {
                        if($availColor[$j] != null && $availColor[$j]['color_hexvalue'])
                        echo '<div class="col-lg-2 rounded-colors mx-1 my-1" style="background-color:'.$availColor[$j]['color_hexvalue'].'"></div>';
                    }
                     if($balance > 0)
                    echo '<div class="px-2"  style="background-color: grey; color: white;">'. $balance.' colors</div>';
                    
                  };
                
                          echo '
                          </div>
                          </div>
                        </div>
                      </div>
                            <div class="portfolio-links">
                             <button class="default-button" onclick="moveto('.$value['product_id'].')"> See More </button>
                            
                            </div>
                           
                        </div>
                    </div>';
                  }
                }
                      }
                ?>

                </div>

            </div>
        </section><!-- End Portfolio Section -->

        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact Us</h2>
                    <p>Contact us the get started</p>
                </div>

                <div class="row">

                    <div class="col-lg-5 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>  8, 1550 nalappa nagar <br> Pandian Nagar <br>Tiruppur <br> Chettipalayam <br> Tamil Nadu -641602</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>sadhanagarments2013@gmail.com</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>+91 9994284722</p>
                            </div>

                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
                                frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                        </div>

                    </div>

                    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="200">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Your Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Your Name" required>
                                </div>
                                <div class="form-group col-md-6 mt-3 mt-md-0">
                                    <label for="name">Your Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="name">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subject" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="name">Message</label>
                                <textarea class="form-control" name="message" rows="10" required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Us Section -->
     <!-- ======= Footer ======= -->
     <footer id="footer">

<div class="footer-newsletter">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h4>Join Our Newsletter</h4>
                <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                <form action="" method="post">
                    <input type="email" name="email"><input type="submit" value="Subscribe">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="footer-top">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-6 footer-contact">
                <h3>Sadhana Garments</h3>
                <p>
                8, 1550 nalappa nagar <br> Pandian Nagar <br>Tiruppur <br> Chettipalayam <br> Tamil Nadu -641602
                <br>
                    <strong>Phone:</strong> +91 9994284722<br>
                    <strong>Email:</strong>sadhanagarments2013@gmail.com<br>
                </p>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                    <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
                <h4>Our Social Networks</h4>
                <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                <div class="social-links mt-3">
                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container py-4">
    <div class="copyright">
        &copy; Copyright <strong><span>Sadhana Garments</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/ -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    </div>
</div>
</footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
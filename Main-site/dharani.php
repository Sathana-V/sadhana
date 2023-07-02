<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />

    <link rel="stylesheet" href="adminpage.css" />

    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="sidebar">
      <div class="logo-details">
        <i class=""></i>
        <span class="logo_name">National Insurance</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="adminpage.php">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="approved.php">
            <i class="bx bx-box"></i>
            <span class="links_name">Approved Policies</span>
          </a>
        </li>
        <li>
          <a href="query.php">
            <i class="bx bx-message"></i>
            <span class="links_name">Queries</span>
          </a>
        </li>
        <li class="log_out">
          <a href="">
            <i class="bx bx-log-out"></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
    </div>
    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">Dashboard</span>
        </div>
        <div class="search-box">
          <input type="text" placeholder="Search..." />
          <i class="bx bx-search"></i>
        </div>
        <div class="profile-details">
          <img src="ntol.jpg"/></a>  
         
         
        </div>
      </nav>

      <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Approved customers</div>
              <div class="number">76</div> 
              
            </div>
            <i class="bx bxs-cart-add cart two"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Unapproved customers</div>
              <div class="number">86</div>
            </div>
            <i class="bx bx-cart cart three"></i>
          </div>

          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total number of customers</div>
              <div class="number">200</div>
           
            </div>
            <i class="bx bx-cart-alt cart"></i>
          </div>
        </div>

        <div class="sales-boxes">
          <div class="recent-sales box">
        
            <div class="title">Requests</div>
            <div class="sales-details">
                <table>
                    <thead>
                        <tr>
                        <th>Registration Date</th>
                        <th>Customer Name</th>
                        <th>Vechicle Number</th>
                        <th>Vechicle Type</th>
                        <th>Policy Type</th>
                        <th></th>
                        </tr>
                    </thead>
                
           
<?php

include "db.php"; // Using database connection file here

$records = mysqli_query($conn,"select * from request"); // fetch data from database
$serial = 1;
echo '<tbody>';

while($data = mysqli_fetch_array($records))
{
               echo '<tr><td>'. $data['registered_date'].'<td><td>'. $data['customer_name'].'</td><td>'.
               $data['vehicle_number'].'</td><td>'.$data['vehicle_type'].'</td><td>'. $data['policy_type'].'</td></tr>';
              

}
echo '</tbody>';
?>
            </table>

                    
            </div>
          </div>
        
        </div>
          </div>
        
    </section>

    <script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };
    </script>
  </body>
</html>

<?php
include_once('include/head.php');
?>



<body class="index-two">
  <!-- header style two -->


  <div class="header-header-two">
    <!-- header- solaric two -->
    <div class="header-two-solari header-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="header-top-m">
              <div class="left">
                <div class="inf">
                  <i class="fa-regular fa-clock"></i>
                  <p>Mon - Fri 8:00 - 18:00 / Sunday 8:00 - 14:00</p>
                </div>
                <div class="inf">
                  <i class="fa-regular fa-envelope"></i>
                  <a href="tel:+4733378901">info@drill-solar.com</a>
                </div>
              </div>
              <div class="right">
                <div class="social-header-top-h2">
                  <span>Free Consultation:</span>
                  <ul>
                    <li>
                      <a href="#"><i class="fa-light fa-phone"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- header- solaric two end -->
    <!-- header man start -->
    <div class="header-main-h2 header--sticky">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="main-haeder-wrapper-h2">
              <a href="index.php" class="logo-area" style="width: 24.2rem">
                <img src="assets/images/logo/logo03.png" alt="logo" />
              </a>

              <!-- navigation area start -->
              <div class="header-nav main-nav-one">
                <nav>
                  <ul>
                    <li class="has-dropdown">
                      <a class="nav-link" href="#">Company</a>
                      <ul class="submenu">
                        <li><a href="aboutus.php">About us</a></li>
                        <li><a href="aboutus.php">Who we are</a></li>
                        <li><a href="team.php">Team</a></li>
                        <li><a href="aboutus.php">Our Milestone</a></li>
                        <li><a href="#">Clients</a></li>
                        <li><a href="blog.php">Blogs</a></li>
                        <li><a href="location.php">Location</a></li>
                        <li><a href="#">Download</a></li>
                      </ul>
                    </li>

                    <li class="has-dropdown">
                      <a class="nav-link" href="#">Solution</a>
                      <ul class="submenu">
                        <?php
                        include('admin/inc/config.php');
                        $statement = $pdo->prepare('SELECT * FROM tbl_top_category');
                        $statement->execute();

                        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                          <li class="has-submenu">
                            <a href="<?php echo $row['slug']; ?>.php?id=<?php echo $row['tcat_id'] ?>"><?php echo $row['tcat_name']; ?></a>
                            <ul class="nested-submenu">
                              <?php
                              $statement1 = $pdo->prepare('SELECT * FROM tbl_product WHERE category=?');
                              $statement1->execute([$row['tcat_id']]);

                              while ($row1 = $statement1->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                                <li><a href="product-details.php?=<?php echo $row1['p_id'] ?>"><?php echo $row1['p_name']; ?></a></li>
                              <?php } ?>
                            </ul>
                          </li>
                        <?php } ?>
                      </ul>
                    </li>

                    <li class="has-dropdown">
                      <a class="nav-link" href="#">Service</a>
                      <ul class="submenu">
                        <li><a href="service-details.php">CAPEX</a></li>
                        <li><a href="service-details.php">RESCO</a></li>
                        <li><a href="service-details.php">OSNQ</a></li>
                        <li><a href="service-details.php">OPEX</a></li>
                      </ul>
                    </li>
                    <li><a class="nav-link" href="#">Career</a></li>
                    <li><a class="nav-link" href="project.php">Project</a></li>
                    <li><a class="nav-link" href="contact.php">Contact Us</a></li>
                    <li><a class="nav-link book-a-call" href="appoinment.php">Book a call</a></li>
                  </ul>
                </nav>

              </div>
              <!-- navigation area end -->
              <div class="actions-area">
                <div class="menu-btn" id="menu-btn">
                  <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect y="14" width="20" height="2" fill="#010052" />
                    <rect y="7" width="20" height="2" fill="#010052" />
                    <rect width="20" height="2" fill="#010052" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- header man end -->
  </div>
  <!-- header style two End -->

  <!-- header style two -->
  <div id="side-bar" class="side-bar header-two">
    <button class="close-icon-menu"><i class="far fa-times"></i></button>
    <!-- inner menu area desktop start -->
    <div class="inner-main-wrapper-desk">
      <div class="thumbnail">
        <img src="assets/images/banner/04.jpg" alt="elevate" />
      </div>
      <div class="inner-content">
        <h4 class="title">We Provide The Power of Renewable Energy.</h4>
        <p class="disc">
          We successfully cope with tasks of varying complexity, provide
          long-term guarantees and regularly master new technologies.
        </p>
        <div class="footer">
          <h4 class="title">Got a project in mind?</h4>
          <a href="contact.php" class="rts-btn btn-primary">Let's talk</a>
        </div>
      </div>
    </div>
    <!-- mobile menu area start -->
    <div class="mobile-menu-main">
      <nav class="nav-main mainmenu-nav mt--30">
        <ul class="mainmenu metismenu" id="mobile-menu-active">
          <li class="has-droupdown">
            <a href="#" class="main">Company</a>
            <ul class="submenu mm-collapse">
              <li><a class="mobile-menu-link" href="aboutus.php">About us</a></li>
              <li><a class="mobile-menu-link" href="aboutus.php">Who we are</a></li>
              <li><a class="mobile-menu-link" href="team.php">Team</a></li>
              <li><a class="mobile-menu-link" href="aboutus.php">Our Milestone</a></li>
              <li><a class="mobile-menu-link" href="#">Clients</a></li>
              <li><a class="mobile-menu-link" href="blog.php">Blogs</a></li>
              <li><a class="mobile-menu-link" href="location.php">Location</a></li>
              <li><a class="mobile-menu-link" href="#">Download</a></li>
            </ul>
          </li>
          <li class="has-droupdown">
            <a href="#" class="main">Solution</a>
            <ul class="submenu mm-collapse">
              <li class="has-droupdown">
                <a href="#">Solar</a>
                <ul class="submenu mm-collapse">
                  <li><a href="product-details.php">Rooftop</a></li>
                  <li><a href="product-details.php">Hybrid</a></li>
                  <li><a href="product-details.php">Carport</a></li>
                  <li><a href="product-details.php">Ground Mounted</a></li>
                  <li><a href="product-details.php">Offgrid</a></li>
                  <li><a href="product-details.php">Solar Kit</a></li>
                </ul>
              </li>
              <li><a href="product-details.php">BESS</a></li>
              <li class="has-droupdown">
                <a href="#">LED Light</a>
                <ul class="submenu mm-collapse">
                  <li><a href="product-details.php">Solar Light</a></li>
                  <li><a href="product-details.php">AC Light</a></li>
                  <li><a href="product-details.php">Flood Light</a></li>
                </ul>
              </li>
              <li><a href="product-details.php">Ev Charging</a></li>
              <li><a href="product-details.php">Hydrogen</a></li>
              <li><a href="product-details.php">Wind</a></li>
              <li><a href="product-details.php">Solar Pump</a></li>
            </ul>
          </li>
          <li class="has-droupdown">
            <a href="#" class="main">Service</a>
            <ul class="submenu mm-collapse">
              <li><a href="service-details.php">CAPEX</a></li>
              <li><a href="service-details.php">Hybrid</a></li>
              <li><a href="service-details.php">OSNQ</a></li>
              <li><a href="service-details.php">OPEX</a></li>
            </ul>
          </li>
          <li><a class="main" href="#">Career</a></li>
          <li><a class="main" href="project.php">Project</a></li>
          <li><a class="main" href="contact.php">Contact Us</a></li>
        </ul>
      </nav>

      <div class="rts-social-style-one pl--20 mt--10">
        <ul>
          <li>
            <a href="#">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa-brands fa-twitter"></i>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa-brands fa-youtube"></i>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa-brands fa-linkedin-in"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- mobile menu area end -->
  </div>
  <!-- header style two End -->
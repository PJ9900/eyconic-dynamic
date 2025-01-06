<?php
include_once('include/header.php');
?>



    
<div style="position: relative; text-align: center; color: white;">
<img class="w-100 d-none d-md-block  mt--125" src="assets/images/banner/breadcrumb/01.jpg" alt="Background" style="width: 100%; height: auto;">
<img class="w-100 d-block d-md-none  mt--65" src="assets/images/mobile-ban (2).webp" alt="Background" style="width: 100%; height: auto;">
  <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
  <div class="row">
      <div class="col-lg-12">
        <div class="con-tent-main">
          <div class="wrapper">
            <div class="title skew-up">
              <a href="#">APPOINMENT</a>
            </div>
            <div class="slug skew-up">
              <a href="index.php">HOME /</a>
              <a class="active" href="#">APPOINMENT</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


    <!-- rts appoinment area start -->
    <div class="rts-make-an-appoinemtn-area rts-section-gap reveal">
      <div class="container">
        <div class="row align-items-center g-0 bg-appoinment">
          <div class="col-lg-5 pr--80 pr_md--0 pr_sm--0">
            <!-- appoinment thumbnail area start -->
            <div class="thumbnail appoinment-m-thumb">
              <img
                src="assets/images/appoinment/01.jpg"
                alt="appoinment-area"
              />
              <div class="inner-wrapper">
                <h6>25</h6>
                <span
                  >Years <br />
                  Experience</span
                >
              </div>
            </div>
            <!-- appoinment thumbnail area end -->
          </div>
          <div class="col-lg-7">
            <!-- appoinment inner content area start -->
            <div class="appoinment-inner-content-wrapper">
              <h3 class="title animated fadeIn">Make An Appointment</h3>
              <form action="#" class="appoinment-form mt--40">
                <div class="input-half-wrapper">
                  <div class="single-input">
                    <input type="text" placeholder="Your Name" required="" />
                  </div>
                  <div class="single-input">
                    <input
                      type="email"
                      placeholder="Email Address"
                      required=""
                    />
                  </div>
                </div>
                <select>
                  <option data-display="Select">Select an option</option>
                  <option value="1">Some option</option>
                  <option value="2">Another option</option>
                  <option value="3" disabled="">A disabled option</option>
                  <option value="4">Potato</option>
                </select>
                <div class="input-half-wrapper mt--25 mb--30">
                  <div class="single-input">
                    <input
                      placeholder="Select your date"
                      type="text"
                      name="checkIn"
                      id="datepicker"
                      value=""
                      class="calendar"
                    />
                  </div>
                  <div class="single-input">
                    <input
                      type="text"
                      id="timepicker"
                      placeholder="Select Time"
                      class="ui-timepicker-input"
                      autocomplete="off"
                    />
                  </div>
                </div>
                <button type="submit" class="rts-btn btn-primary">
                  SUBMIT MESSAGE
                </button>
              </form>
            </div>
            <!-- appoinment inner content area end -->
          </div>
        </div>
      </div>
    </div>
    <!-- rts appoinment area end -->

    <!-- what  customers says start -->
    <div
      class="rts-customers-says-area rts-section-gap bg_image bg-testimonials-1 reveal"
    >
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="title-area-center title-g">
              <p class="pre"><span>Quality Handyman</span> Solution</p>
              <h2 class="title">What Customers Says</h2>
            </div>
          </div>
        </div>
        <div class="row g-24 mt--10">
          <div class="col-lg-4">
            <!-- single testimonials start -->
            <div class="rts-single-testimonials-one">
              <div class="logo">
                <img src="assets/images/testimonials/logo/01.png" alt="" />
              </div>
              <p class="disc">
                “According to the council of supply chain professionals the
                council of logistics management logistics is the process of
                planning, implementing and controlling procedures”
              </p>
              <div class="awener-area">
                <a href="#" class="author">
                  <img src="assets/images/testimonials/02.png" alt="images" />
                </a>
                <div class="main">
                  <a href="#">
                    <h6 class="title">Andrew D. Smith</h6>
                  </a>
                  <span>Manager</span>
                </div>
              </div>
            </div>
            <!-- single testimonials end -->
          </div>
          <div class="col-lg-4">
            <!-- single testimonials start -->
            <div class="rts-single-testimonials-one">
              <div class="logo">
                <img src="assets/images/testimonials/logo/01.png" alt="" />
              </div>
              <p class="disc">
                “According to the council of supply chain professionals the
                council of logistics management logistics is the process of
                planning, implementing and controlling procedures”
              </p>
              <div class="awener-area">
                <a href="#" class="author">
                  <img src="assets/images/testimonials/03.png" alt="images" />
                </a>
                <div class="main">
                  <a href="#">
                    <h6 class="title">Andrew D. Smith</h6>
                  </a>
                  <span>Manager</span>
                </div>
              </div>
            </div>
            <!-- single testimonials end -->
          </div>
          <div class="col-lg-4">
            <!-- single testimonials start -->
            <div class="rts-single-testimonials-one">
              <div class="logo">
                <img src="assets/images/testimonials/logo/01.png" alt="" />
              </div>
              <p class="disc">
                “According to the council of supply chain professionals the
                council of logistics management logistics is the process of
                planning, implementing and controlling procedures”
              </p>
              <div class="awener-area">
                <a href="#" class="author">
                  <img src="assets/images/testimonials/04.png" alt="images" />
                </a>
                <div class="main">
                  <a href="#">
                    <h6 class="title">Andrew D. Smith</h6>
                  </a>
                  <span>Manager</span>
                </div>
              </div>
            </div>
            <!-- single testimonials end -->
          </div>
        </div>
      </div>
    </div>
    <!-- what  customers says end -->
    <?php
    include_once("include/footer.php")
    ?>
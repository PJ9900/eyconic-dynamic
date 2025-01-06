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
              <a href="#">TEAM DETAILS</a>
            </div>
            <div class="slug skew-up">
              <a href="index.php">HOME /</a>
              <a class="active" href="#">TEAM DETAILS</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <div class="personal-info-area-start rts-section-gapTop pb--100">
      <div class="container">
        <div class="row g-0 align-items-center">
          <div class="col-lg-5">
            <div class="thumbnail m-img">
              <img src="assets/images/team/07.jpg" alt="team-image" />
            </div>
          </div>
          <div class="col-lg-7">
            <div class="personal-info-team">
              <div
                class="inner-content sal-animate"
                data-sal="slide-up"
                data-sal-delay="150"
                data-sal-duration="900"
              >
                <span class="pre-title"> Business Expert </span>
                <h3 class="title animated fadeIn">David X. Smith</h3>
                <p class="disc">
                  Vehicula duis tempus porttitor lacus morbi pharetra neque
                  pretium enim urna riiculus nibh, mus class arcu magna ornare
                  orci mollis. Posuere quam eget non mollis platea habitasse
                  cras feugiat.
                </p>
                <!-- ingle information start -->
                <div class="single-info">
                  <div class="icon">
                    <i class="fa-light fa-envelope"></i>
                  </div>
                  <div class="info">
                    <span>Email Address</span>
                    <a href="mailto:name@email.com" class="mail"
                      >support@david.com</a
                    >
                  </div>
                </div>
                <!-- ingle information end -->
                <!-- ingle information start -->
                <div class="single-info">
                  <div class="icon">
                    <i class="fa-solid fa-phone-volume"></i>
                  </div>
                  <div class="info">
                    <span>Phone Number</span>
                    <a href="tel:+18475555555" class="mail">+259 2154.21568</a>
                  </div>
                </div>
                <!-- ingle information end -->
                <!-- ingle information start -->
                <div class="single-info">
                  <div class="icon">
                    <i class="fa-light fa-location-dot"></i>
                  </div>
                  <div class="info">
                    <span>Office Location</span>
                    <a href="#" class="mail"
                      >24/DA, Hilton Street, United State</a
                    >
                  </div>
                </div>
                <!-- ingle information end -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="rts-make-an-appoinemtn-area rts-section-gapBottom">
      <div class="container">
        <div class="row align-items-center g-0 bg-appoinment ptb--50">
          <div class="col-lg-8 offset-lg-2">
            <!-- appoinment inner content area start -->
            <div class="appoinment-inner-content-wrapper">
              <h3 class="title animated fadeIn text-center">Contact With Me</h3>
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
                      class="calendar hasDatepicker"
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

    <?php
    include_once("include/footer.php")
    ?>
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
              <a href="#">BLOG</a>
            </div>
            <div class="slug skew-up">
              <a href="index.php">HOME /</a>
              <a class="active" href="#">BLOG</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="blog-post-area rts-section-gap">
  <div class="container">
    <div class="row g-24 mt--20">
      <?php
      include('admin/inc/config.php');
      $statement = $pdo->prepare('SELECT * FROM blogs');
      $statement->execute();

      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
          <!-- blog-single area start -->
          <div class="blog-single-one text-center">
            <a href="blogs/<?= $row['slug'] ?>" class="thumbnail">
              <div class="inner">
                <img src="admin/assets/images/blog-image/<?php echo $row['banner'] ?>" alt="blog-image" />
              </div>
            </a>
            <div class="head">
              <div class="date-area single-info">
                <i class="fa-light fa-calendar-days"></i>
                <p>March 15, 2022 <?php echo $row['created_at']; ?></p>
              </div>
            </div>
            <div class="body text-start">
              <a href="blogs/<?= $row['slug'] ?>">
                <h5 class="title">
                  <?php echo $row['title']; ?>
                </h5>
              </a>
              <a
                href="blogs/<?= $row['slug'] ?>"
                class="rts-btn btn-border radious-0">
                Read Details
                <i class="fa-regular fa-arrow-up-right"></i>
              </a>
            </div>
          </div>
          <!-- blog-single area end -->
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</div>
<?php
include_once("include/footer.php")
?>
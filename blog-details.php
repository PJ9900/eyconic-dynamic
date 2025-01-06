<?php
include_once('include/header.php');
?>

<?php
include('admin/inc/config.php');
$statement = $pdo->prepare('SELECT * FROM blogs Where slug = ?');
$statement->execute([$_REQUEST['slug']]);
$row = $statement->fetch(PDO::FETCH_ASSOC);
?>

<div style="position: relative; text-align: center; color: white;">
  <img class="w-100 d-none d-md-block  mt--125" src="admin/assets/images/blog-image/<?php echo $row['banner']; ?>" alt="Background" style="width: 100%; height: auto;">
  <img class="w-100 d-block d-md-none  mt--65" src="admin/assets/images/blog-image/<?php echo $row['banner']; ?>" alt="Background" style="width: 100%; height: auto;">
  <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <div class="row">
      <div class="col-lg-12">
        <div class="con-tent-main">
          <div class="wrapper">
            <div class="title skew-up">
              <a href="#">BLOG DETAILS</a>
            </div>
            <div class="slug skew-up">
              <a href="index.php">HOME /</a>
              <a class="active" href="#">BLOG DETAILS</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- blog details area start -->
<div class="rts-blog-list-area rts-section-gap">
  <div class="container">
    <div class="row g-5">
      <!-- rts blo post area -->
      <div class="col-xl-8 col-md-12 col-sm-12 col-12">
        <!-- single post -->
        <div class="blog-single-post-listing details mb--0">
          <div class="thumbnail">
            <img src="admin/assets/images/blog-image/<?php echo $row['banner']; ?>" alt="Business-Blog" />
          </div>
          <div class="blog-listing-content">
            <div class="user-info">
              <!-- single info -->
              <div class="single">
                <i class="far fa-user-circle"></i>
                <span>by David Smith</span>
              </div>
              <!-- single infoe end -->
              <!-- single info -->
              <div class="single">
                <i class="far fa-clock"></i>
                <span>15 Jan, 2023</span>
              </div>
              <!-- single infoe end -->
            </div>
            <h3 class="title animated fadeIn">
              <?php echo $row['name'] ?>
            </h3>
            <p class="disc para-1">
              <?php echo $row['short_description']; ?>
            </p>
            <p class="disc">
              <?php echo $row['description']; ?>
            </p>
          </div>
        </div>
        <!-- single post End-->
      </div>
      <!-- rts-blog post end area -->
      <!--rts blog wizered area -->
      <div class="col-xl-4 col-md-12 col-sm-12 col-12">

        <div class="rts-single-wized Recent-post">
          <div class="wized-header">
            <h5 class="title">Recent Posts</h5>
          </div>
          <div class="wized-body">
            <!-- recent-post -->
            <div class="recent-post-single">
              <div class="thumbnail">
                <a href="#"><img src="assets/images/blog/19.jpg" alt="Blog_post" /></a>
              </div>
              <div class="content-area text-start">
                <div class="user">
                  <i class="fal fa-clock"></i>
                  <span>15 Jan, 2023</span>
                </div>
                <a class="post-title" href="#">
                  <h6 class="title">
                    We would love to share a similar experience
                  </h6>
                </a>
              </div>
            </div>
            <!-- recent-post End -->
            <!-- recent-post -->
            <div class="recent-post-single">
              <div class="thumbnail">
                <a href="#"><img src="assets/images/blog/20.jpg" alt="Blog_post" /></a>
              </div>
              <div class="content-area text-start">
                <div class="user">
                  <i class="fal fa-clock"></i>
                  <span>15 Jan, 2023</span>
                </div>
                <a class="post-title" href="#">
                  <h6 class="title">
                    We would love to share a similar experience
                  </h6>
                </a>
              </div>
            </div>
            <!-- recent-post End -->
            <!-- recent-post -->
            <div class="recent-post-single">
              <div class="thumbnail">
                <a href="#"><img src="assets/images/blog/21.jpg" alt="Blog_post" /></a>
              </div>
              <div class="content-area text-start">
                <div class="user">
                  <i class="fal fa-clock"></i>
                  <span>15 Jan, 2023</span>
                </div>
                <a class="post-title" href="#">
                  <h6 class="title">
                    We would love to share a similar experience
                  </h6>
                </a>
              </div>
            </div>
            <!-- recent-post End -->
          </div>
        </div>
      </div>
      <!-- rts- blog wizered end area -->
    </div>
  </div>
</div>
<!-- blog details area end -->
<?php
include_once("include/footer.php")
?>
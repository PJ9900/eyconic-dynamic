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
              <a href="#">PRODUCT DETAILS</a>
            </div>
            <div class="slug skew-up">
              <a href="index.php">HOME /</a>
              <a class="active" href="#">PRODUCT DETAILS</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<main class="ms-main pt--60">
  <div class="container">
    <div id="primary" class="content-area single-product">
      <div class="site-main">
        <div class="woocommerce-notices-wrapper"></div>
        <div id="product-470"
          class="ms-single-product product type-product post-470 status-publish first instock product_cat-run product_tag-life product_tag-move product_tag-sport product_tag-trainers has-post-thumbnail shipping-taxable purchasable product-type-simple">
          <?php
          include('admin/inc/config.php');
          $statement = $pdo->prepare('SELECT * FROM tbl_product where id = ?');
          $statement->execute([$_REQUEST['id']]);

          $row = $statement->fetch(PDO::FETCH_ASSOC);
          ?>
          <div class="row">
            <div class="col-md-6">
              <div class="banner-horizental">
                <div class="swiper swiper-container-h1">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="slider-inner">
                        <img src="admin/assets/images/product-image/<?php echo $row['p_featured_photo'] ?>" alt="full_screen-image" />
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="slider-inner">
                        <img src="admin/assets/images/product-image/<?php echo $row['p_featured_photo'] ?>" alt="full_screen-image" />
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="slider-inner">
                        <img src="admin/assets/images/product-image/<?php echo $row['p_featured_photo'] ?>" alt="full_screen-image" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="slider-pagination-area">
                  <div class="swiper-pagination swiper-pagination-horizontal">
                    <span class="swiper-pagination-bullet"></span>
                    <span class="swiper-pagination-bullet two"></span>
                    <span class="swiper-pagination-bullet three"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="ms-single-product__content">
                <h2 class="ms-single-product_title"><?php echo $row['p_name'] ?></h2>
                <!-- <p class="price">
                  <span class="woocommerce-Price-amount amount">
                    <bdi><span class="woocommerce-Price-currencySymbol">$</span>29.00</bdi>
                  </span>
                </p> -->
                <div class="woocommerce-product-details__short-description">
                  <p>
                    <?php echo $row['p_description']; ?>
                  </p>
                </div>
                <div class="product_meta">
                  <span class="sku_wrapper"><strong>SKU:</strong>
                    <span class="sku">161056</span></span>
                  <span class="posted_in"><strong>Category:</strong>
                    <a href="#0" rel="tag">For Running</a></span>
                  <span class="tagged_as"><strong>Tags:</strong> <a href="#0" rel="tag">Life</a>,
                    <a href="#0" rel="tag">Move</a>,
                    <a href="#0" rel="tag">Sport</a>,
                    <a href="#0" rel="tag">Trainers</a>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-12 tab-area rts-section-gap">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                    type="button" role="tab" aria-controls="home" aria-selected="true">
                    Description
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">
                    Additional Information
                  </button>
                </li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                  <?php echo $row['description']; ?>
                </div>
                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                  <div class="ms-section-title">
                    <h3 class="ms-heading-title">Additional information</h3>
                    <table class="woocommerce-product-attributes shop_attributes">
                      <tbody>
                        <tr
                          class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_size">
                          <th class="woocommerce-product-attributes-item__label">
                            Size
                          </th>
                          <td class="woocommerce-product-attributes-item__value">
                            <p>39*44</p>
                          </td>
                        </tr>
                        <tr
                          class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_collection">
                          <th class="woocommerce-product-attributes-item__label">
                            Collection
                          </th>
                          <td class="woocommerce-product-attributes-item__value">
                            <p>Most Sport Pro</p>
                          </td>
                        </tr>
                        <tr
                          class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_upper-material">
                          <th class="woocommerce-product-attributes-item__label">
                            Upper Material
                          </th>
                          <td class="woocommerce-product-attributes-item__value">
                            <p>Ceremic</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
include_once("include/footer.php")
?>
<?php require_once('header.php'); ?>

<?php
//Change Logo
if(isset($_POST['form1'])) {
    $valid = 1;

    $path = $_FILES['photo_logo']['name'];
    $path_tmp = $_FILES['photo_logo']['tmp_name'];

    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {
        // removing the existing photo
        $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
        foreach ($result as $row) {
            $logo = $row['logo'];
            unlink('assets/images/'.$logo);
        }

        // updating the data
        $final_name = 'logo'.'.'.$ext;
        move_uploaded_file( $path_tmp, 'assets/images/'.$final_name );

        // updating the database
        $statement = $pdo->prepare("UPDATE tbl_settings SET logo=? WHERE id=1");
        $statement->execute(array($final_name));

        $success_message = 'Logo is updated successfully.';
        
    }
}
// Change Favicon
if(isset($_POST['form2'])) {
    $valid = 1;

    $path = $_FILES['photo_favicon']['name'];
    $path_tmp = $_FILES['photo_favicon']['tmp_name'];

    if($path == '') {
        $valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {
        // removing the existing photo
        $statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
        foreach ($result as $row) {
            $favicon = $row['favicon'];
            unlink('assets/images/theme/'.$favicon);
        }

        // updating the data
        $final_name = 'favicon'.'.'.$ext;
        move_uploaded_file( $path_tmp, 'assets/images/theme/'.$final_name );

        // updating the database
        $statement = $pdo->prepare("update tbl_settings SET favicon=? WHERE id=1");
        $statement->execute(array($final_name));

        $success_message = 'Favicon is updated successfully.';
        
    }
}

if(isset($_POST['form10'])) {
    // updating the database
    $statement = $pdo->prepare("UPDATE tbl_settings SET before_head=?, after_body=?, before_body=? WHERE id=1");
    $statement->execute(array($_POST['before_head'],$_POST['after_body'],$_POST['before_body']));

    $success_message = 'Head and Body Script is updated successfully.';
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Website Settings</h1>
    </div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
foreach ($result as $row) {
    $logo                            = $row['logo'];
    $favicon                         = $row['favicon'];
    $footer_about                    = $row['footer_about'];
    $footer_copyright                = $row['footer_copyright'];
    $contact_address                 = $row['contact_address'];
    $contact_email                   = $row['contact_email'];
    $contact_phone                   = $row['contact_phone'];
    $contact_map_iframe              = $row['contact_map_iframe'];
    $receive_email                   = $row['receive_email'];
    $receive_email_subject           = $row['receive_email_subject'];
    $receive_email_thank_you_message = $row['receive_email_thank_you_message'];
    $forget_password_message         = $row['forget_password_message'];
    $total_featured_product_home     = $row['total_featured_product_home'];
    $total_latest_product_home       = $row['total_latest_product_home'];
    $total_popular_product_home      = $row['total_popular_product_home'];
    $meta_title_home                 = $row['meta_title_home'];
    $meta_keyword_home               = $row['meta_keyword_home'];
    $meta_description_home           = $row['meta_description_home'];
    $banner_login                    = $row['banner_login'];
    $banner_registration             = $row['banner_registration'];
    $banner_forget_password          = $row['banner_forget_password'];
    $banner_reset_password           = $row['banner_reset_password'];
    $banner_search                   = $row['banner_search'];
    $banner_cart                     = $row['banner_cart'];
    $banner_checkout                 = $row['banner_checkout'];
    $banner_product_category         = $row['banner_product_category'];
    $featured_product_title          = $row['featured_product_title'];
    $featured_product_subtitle       = $row['featured_product_subtitle'];
    $latest_product_title            = $row['latest_product_title'];
    $latest_product_subtitle         = $row['latest_product_subtitle'];
    $popular_product_title           = $row['popular_product_title'];
    $popular_product_subtitle        = $row['popular_product_subtitle'];
    $newsletter_text                 = $row['newsletter_text'];
    $paypal_email                    = $row['paypal_email'];
    $bank_detail                     = $row['bank_detail'];
    $before_head                     = $row['before_head'];
    $after_body                      = $row['after_body'];
    $before_body                     = $row['before_body'];
    $home_service_on_off             = $row['home_service_on_off'];
    $home_welcome_on_off             = $row['home_welcome_on_off'];
    $home_featured_product_on_off    = $row['home_featured_product_on_off'];
    $home_latest_product_on_off      = $row['home_latest_product_on_off'];
    $home_popular_product_on_off     = $row['home_popular_product_on_off'];
    $newsletter_on_off               = $row['newsletter_on_off'];
}
?>


<section class="content" style="min-height:auto;margin-bottom: -30px;">
    <div class="row">
        <div class="col-md-12">
            <?php if($error_message): ?>
            <div class="callout callout-danger">
            
            <p>
            <?php echo $error_message; ?>
            </p>
            </div>
            <?php endif; ?>

            <?php if($success_message): ?>
            <div class="callout callout-success">
            
            <p><?php echo $success_message; ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="content">

    <div class="row">
        <div class="col-md-12">
                            
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Logo</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Favicon</a></li>
                        <li><a href="#tab_10" data-toggle="tab">Head & Body Scripts</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">


                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Existing Photo</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="assets/images/<?php echo $logo; ?>" class="existing-photo" style="height:80px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">New Photo</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="photo_logo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form1">Update Logo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>

                            


                        </div>
                        <div class="tab-pane" id="tab_2">

                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Existing Photo</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="assets/images/theme/<?php echo $favicon; ?>" class="existing-photo" style="height:40px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">New Photo</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="photo_favicon">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form2">Update Favicon</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                        </div>
                        <div class="tab-pane" id="tab_3">

                            <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <!--<div class="form-group">-->
                                    <!--    <label for="" class="col-sm-2 control-label">Newsletter Section </label>-->
                                    <!--    <div class="col-sm-3">-->
                                    <!--        <select name="newsletter_on_off" class="form-control" style="width:auto;">-->
                                    <!--            <option value="1" <?php if($newsletter_on_off == 1) {echo 'selected';} ?>>On</option>-->
                                    <!--            <option value="0" <?php if($newsletter_on_off == 0) {echo 'selected';} ?>>Off</option>-->
                                    <!--        </select>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Footer - Copyright </label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="footer_copyright" value="<?php echo $footer_copyright; ?>">
                                        </div>
                                    </div>                              
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Contact Address </label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" name="contact_address" style="height:140px;"><?php echo $contact_address; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Contact Email </label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="contact_email" value="<?php echo $contact_email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Contact Phone Number </label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="contact_phone" value="<?php echo $contact_phone; ?>">
                                        </div>
                                    </div>
                                 <!-- <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Contact Fax Number </label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="contact_fax" value="<?php echo $contact_fax; ?>">
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Contact Map iFrame </label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="contact_map_iframe" style="height:200px;"><?php echo $contact_map_iframe; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form3">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                        </div>

                        <div class="tab-pane" id="tab_4">

                            <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Contact Email Address</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="receive_email" value="<?php echo $receive_email; ?>">
                                        </div>
                                    </div>                                  
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Contact Email Subject</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="receive_email_subject" value="<?php echo $receive_email_subject; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Contact Email Thank you message</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="receive_email_thank_you_message"><?php echo $receive_email_thank_you_message; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Forget password Message</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="forget_password_message"><?php echo $forget_password_message; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-success pull-left" name="form4">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                        </div>

                        <div class="tab-pane" id="tab_5">

                            <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <!--<div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Footer (How many recent posts?)<span>*</span></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="total_recent_post_footer" value="<?php echo $total_recent_post_footer; ?>">
                                        </div>
                                    </div>      
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Footer (How many popular posts?)<span>*</span></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="total_popular_post_footer" value="<?php echo $total_popular_post_footer; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Sidebar (How many recent posts?)<span>*</span></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="total_recent_post_sidebar" value="<?php echo $total_recent_post_sidebar; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Sidebar (How many popular posts?)<span>*</span></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="total_popular_post_sidebar" value="<?php echo $total_popular_post_sidebar; ?>">
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Home Page (How many featured product?)<span>*</span></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="total_featured_product_home" value="<?php echo $total_featured_product_home; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Home Page (How many latest product?)<span>*</span></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="total_latest_product_home" value="<?php echo $total_latest_product_home; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Home Page (How many popular product?)<span>*</span></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="total_popular_product_home" value="<?php echo $total_popular_product_home; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form5">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                        </div>




                        <div class="tab-pane" id="tab_6">


                        	<h3>Sections On and Off</h3>
                            <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Service Section </label>
                                        <div class="col-sm-4">
                                            <select name="home_service_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($home_service_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($home_service_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>      
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Welcome Section </label>
                                        <div class="col-sm-4">
                                            <select name="home_welcome_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($home_welcome_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($home_welcome_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Featured Product Section </label>
                                        <div class="col-sm-4">
                                            <select name="home_featured_product_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($home_featured_product_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($home_featured_product_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Latest Product Section </label>
                                        <div class="col-sm-4">
                                            <select name="home_latest_product_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($home_latest_product_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($home_latest_product_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Popular Product Section </label>
                                        <div class="col-sm-4">
                                            <select name="home_popular_product_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($home_popular_product_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($home_popular_product_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                   <!-- <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Testimonial Section </label>
                                        <div class="col-sm-4">
                                            <select name="home_testimonial_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($home_testimonial_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($home_testimonial_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Blog Section </label>
                                        <div class="col-sm-4">
                                            <select name="home_blog_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($home_blog_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($home_blog_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>-->
                                    
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_0">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>

                            
                            <h3>Meta Section</h3>
                            <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Meta Title </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="meta_title_home" class="form-control" value="<?php echo $meta_title_home ?>">
                                        </div>
                                    </div>      
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Meta Keyword </label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="meta_keyword_home" style="height:100px;"><?php echo $meta_keyword_home ?></textarea>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Meta Description </label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="meta_description_home" style="height:200px;"><?php echo $meta_description_home ?></textarea>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>



                           <!-- <h3>Call to Action Section</h3>
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">                                          
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Title<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="cta_title" value="<?php echo $cta_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Content<span>*</span></label>
                                        <div class="col-sm-8">
                                            <textarea name="cta_content" class="form-control" cols="30" rows="10" style="height:120px;"><?php echo $cta_content; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Read More Text<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="cta_read_more_text" value="<?php echo $cta_read_more_text; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Read More URL<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="cta_read_more_url" value="<?php echo $cta_read_more_url; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Existing Call to Action Background</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="assets/uploads/<?php echo $cta_photo; ?>" class="existing-photo" style="height:80px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">New Background</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="cta_photo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_7">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>-->





                            <h3>Featured Product Section</h3>
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">                                          
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Featured Product Title<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="featured_product_title" value="<?php echo $featured_product_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Featured Product SubTitle<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="featured_product_subtitle" value="<?php echo $featured_product_subtitle; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_4">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                            <h3>Latest Product Section</h3>
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">                                          
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Latest Product Title<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="latest_product_title" value="<?php echo $latest_product_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Latest Product SubTitle<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="latest_product_subtitle" value="<?php echo $latest_product_subtitle; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_5">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                            <h3>Popular Product Section</h3>
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">                                          
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Popular Product Title<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="popular_product_title" value="<?php echo $popular_product_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Popular Product SubTitle<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="popular_product_subtitle" value="<?php echo $popular_product_subtitle; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_6">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                            <!--
                            <h3>Testimonial Section</h3>
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">                                          
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Testimonial Section Title<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="testimonial_title" value="<?php echo $testimonial_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Testimonial Section SubTitle<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="testimonial_subtitle" value="<?php echo $testimonial_subtitle; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Existing Testimonial Background</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="assets/uploads/<?php echo $testimonial_photo; ?>" class="existing-photo" style="height:80px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">New Background</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="testimonial_photo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_1">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                            <h3>Blog Section</h3>
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">                                          
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Blog Section Title<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="blog_title" value="<?php echo $blog_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Blog Section SubTitle<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="blog_subtitle" value="<?php echo $blog_subtitle; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_2">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>

                                    -->
                            

                            <h3>Newsletter Section</h3>
                            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">                                          
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Newsletter Text</label>
                                        <div class="col-sm-8">
                                            <textarea name="newsletter_text" class="form-control" cols="30" rows="10" style="height: 120px;"><?php echo $newsletter_text; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_3">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                        </div>



                        <div class="tab-pane" id="tab_7">

                            <table class="table table-bordered">
                                <tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Existing Login Page Banner</h4>
                                        <p>
                                            <img src="<?php echo 'assets/uploads/'.$banner_login; ?>" alt="" style="width: 100%;height:auto;"> 
                                        </p>                                        
                                    </td>
                                    <td style="width:50%">
                                        <h4>Change Login Page Banner</h4>
                                        Select Photo<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form7_1">
                                    </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Existing Registration Page Banner</h4>
                                        <p>
                                            <img src="<?php echo 'assets/uploads/'.$banner_registration; ?>" alt="" style="width: 100%;height:auto;">  
                                        </p>                                        
                                    </td>
                                    <td style="width:50%">
                                        <h4>Change Registration Page Banner</h4>
                                        Select Photo<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form7_2">
                                    </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Existing Forget Password Page Banner</h4>
                                        <p>
                                            <img src="<?php echo 'assets/uploads/'.$banner_forget_password; ?>" alt="" style="width: 100%;height:auto;">   
                                        </p>                                        
                                    </td>
                                    <td style="width:50%">
                                        <h4>Change Forget Password Page Banner</h4>
                                        Select Photo<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form7_3">
                                    </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Existing Reset Password Page Banner</h4>
                                        <p>
                                            <img src="<?php echo 'assets/uploads/'.$banner_reset_password; ?>" alt="" style="width: 100%;height:auto;">   
                                        </p>                                        
                                    </td>
                                    <td style="width:50%">
                                        <h4>Change Reset Password Page Banner</h4>
                                        Select Photo<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form7_4">
                                    </td>
                                    </form>
                                </tr>
                                
                                <tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Existing Search Page Banner</h4>
                                        <p>
                                            <img src="<?php echo 'assets/uploads/'.$banner_search; ?>" alt="" style="width: 100%;height:auto;">  
                                        </p>                                        
                                    </td>
                                    <td style="width:50%">
                                        <h4>Change Search Page Banner</h4>
                                        Select Photo<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form7_6">
                                    </td>
                                    </form>
                                </tr>


                                <tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Existing Cart Page Banner</h4>
                                        <p>
                                            <img src="<?php echo 'assets/uploads/'.$banner_cart; ?>" alt="" style="width: 100%;height:auto;">  
                                        </p>                                        
                                    </td>
                                    <td style="width:50%">
                                        <h4>Change Cart Page Banner</h4>
                                        Select Photo<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form7_7">
                                    </td>
                                    </form>
                                </tr>


                                <tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Existing Checkout Page Banner</h4>
                                        <p>
                                            <img src="<?php echo 'assets/uploads/'.$banner_checkout; ?>" alt="" style="width: 100%;height:auto;">  
                                        </p>                                        
                                    </td>
                                    <td style="width:50%">
                                        <h4>Change Checkout Page Banner</h4>
                                        Select Photo<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form7_8">
                                    </td>
                                    </form>
                                </tr>

                                <tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Existing Product Category Page Banner</h4>
                                        <p>
                                            <img src="<?php echo 'assets/uploads/'.$banner_product_category; ?>" alt="" style="width: 100%;height:auto;">  
                                        </p>                                        
                                    </td>
                                    <td style="width:50%">
                                        <h4>Change Product Category Page Banner</h4>
                                        Select Photo<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form7_9">
                                    </td>
                                    </form>
                                </tr>

                               <!-- <tr>
                                    <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Existing Blog Page Banner</h4>
                                        <p>
                                            <img src="<?php echo 'assets/uploads/'.$banner_blog; ?>" alt="" style="width: 100%;height:auto;">  
                                        </p>                                        
                                    </td>
                                    <td style="width:50%">
                                        <h4>Change Blog Page Banner</h4>
                                        Select Photo<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Change" style="margin-top:10px;" name="form7_10">
                                    </td>
                                    </form>
                                </tr>-->
                            </table>

                        </div>



                    
<!-- PAYMENT METHODS TAB -->



                        <div class="tab-pane" id="tab_9">
                            <form class="form-horizontal" action="" method="post">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">PayPal - Business Email </label>
                                            <div class="col-sm-5">
                                                <input type="text" name="paypal_email" class="form-control" value="<?php echo $paypal_email; ?>">
                                            </div>
                                        </div>
                                      <!-- <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Stripe - Public Key </label>
                                            <div class="col-sm-5">
                                                <input type="text" name="stripe_public_key" class="form-control" value="<?php echo $stripe_public_key; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Stripe - Secret Key </label>
                                            <div class="col-sm-5">
                                                <input type="text" name="stripe_secret_key" class="form-control" value="<?php echo $stripe_secret_key; ?>">
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Bank Information </label>
                                            <div class="col-sm-5">
                                                <textarea name="bank_detail" class="form-control" cols="30" rows="10"><?php echo $bank_detail; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-success pull-left" name="form9">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="tab-pane" id="tab_10">
                            <form class="form-horizontal" action="" method="post">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Code before &lt;/head&gt; tag </label>
                                            <div class="col-sm-8">
                                                <textarea name="before_head" class="form-control" cols="30" rows="10"><?php echo $before_head; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Code after &lt;body&gt; tag </label>
                                            <div class="col-sm-8">
                                                <textarea name="after_body" class="form-control" cols="30" rows="10"><?php echo $after_body; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label">Code before &lt;/body&gt; tag </label>
                                            <div class="col-sm-8">
                                                <textarea name="before_body" class="form-control" cols="30" rows="10"><?php echo $before_body; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-success pull-left" name="form10">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


<!--
                        <div class="tab-pane" id="tab_11">
                            <h3>Advertisements On and Off</h3>
                            <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Above Welcome </label>
                                        <div class="col-sm-4">
                                            <select name="ads_above_welcome_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($ads_above_welcome_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($ads_above_welcome_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>      
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Above Featured Product </label>
                                        <div class="col-sm-4">
                                            <select name="ads_above_featured_product_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($ads_above_featured_product_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($ads_above_featured_product_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Above Latest Product </label>
                                        <div class="col-sm-4">
                                            <select name="ads_above_latest_product_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($ads_above_latest_product_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($ads_above_latest_product_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Above Popular Product </label>
                                        <div class="col-sm-4">
                                            <select name="ads_above_popular_product_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($ads_above_popular_product_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($ads_above_popular_product_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Above Testimonial </label>
                                        <div class="col-sm-4">
                                            <select name="ads_above_testimonial_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($ads_above_testimonial_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($ads_above_testimonial_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Category Page Sidebar </label>
                                        <div class="col-sm-4">
                                            <select name="ads_category_sidebar_on_off" class="form-control" style="width:auto;">
                                            	<option value="1" <?php if($ads_category_sidebar_on_off == 1) {echo 'selected';} ?>>On</option>
                                            	<option value="0" <?php if($ads_category_sidebar_on_off == 0) {echo 'selected';} ?>>Off</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form11">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>

-->

                    </div>
                </div>

                

            </form>
        </div>
    </div>

</section>

<?php require_once('footer.php'); ?>
<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

	
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' && $ext!='webp' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif, webp or png file<br>';
        }
    }
    $mpath = $_FILES['mphoto']['name'];
    $mpath_tmp = $_FILES['mphoto']['tmp_name'];
    
    if($mpath!='') {
        $mext = pathinfo( $mpath, PATHINFO_EXTENSION );
        $mfile_name = basename( $mpath, '.' . $mext );
        if( $mext!='jpg' && $mext!='png' && $mext!='jpeg' && $mext!='gif' && $mext!='webp' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif, webp or png file<br>';
        }
    }

	if($valid == 1) {

		if($path == '') {
			$statement = $pdo->prepare("UPDATE tbl_slider SET heading=?, content=? WHERE id=?");
    		$statement->execute(array($_POST['heading'],$_POST['content'],$_REQUEST['id']));
		} else {

// 			unlink('assets/images/slider-image/'.$_POST['photo']);
// 			unlink('assets/images/slider-image/'.$_POST['mphoto']);
			

			$final_name = 'slider-'.$_REQUEST['id'].'.'.$ext;
			$mfinal_name = 'mob-slider-'.$_REQUEST['id'].'.'.$mext;
        	move_uploaded_file( $path_tmp, 'assets/images/slider-image/'.$final_name );
        	move_uploaded_file( $mpath_tmp, 'assets/images/slider-image/'.$mfinal_name );

        	$statement = $pdo->prepare("UPDATE tbl_slider SET photo=?, heading=?, content=?,mphoto=? WHERE id=?");
    		$statement->execute(array($final_name,$_POST['heading'],$_POST['content'],$_POST['mphoto'],$_REQUEST['id']));
		}	   
		if($mpath!='') {

			
			unlink('../assets/imgs/slider/'.$_POST['m_photo']);
			$mfinal_name = 'mob-slider-'.$_REQUEST['id'].'.'.$mext;
        	move_uploaded_file( $mpath_tmp, 'assets/images/slider-image/'.$mfinal_name );
        	$statement = $pdo->prepare("UPDATE tbl_slider SET mphoto=? WHERE id=?");
    		$statement->execute(array($mfinal_name,$_REQUEST['id']));
		}	   
	    $success_message = 'Slider is updated successfully!';
	}
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_slider WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit About Us</h1>
	</div>
	<div class="content-header-right">
		<a href="slider.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_slider WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$photo       = $row['photo'];
	$mphoto       = $row['mphoto'];
	$heading     = $row['heading'];
	$content     = $row['content'];
	$button_text = $row['button_text'];
	$button_url  = $row['button_url'];
	$position    = $row['position'];
}
?>

<section class="content">

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

			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="current_photo" value="<?php echo $photo; ?>">
				<input type="hidden" name="m_photo" value="<?php echo $mphoto; ?>">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Existing Photo</label>
							<div class="col-sm-9" style="padding-top:5px">
								<img src="assets/images/slider-image/<?php echo $photo; ?>" alt="Slider Photo" style="width:400px;">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Photo </label>
							<div class="col-sm-6" style="padding-top:5px">
								<input type="file" name="photo">(Only jpg, jpeg, gif and png are allowed)
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Existing Mobile Photo</label>
							<div class="col-sm-9" style="padding-top:5px">
								<img src="assets/images/slider-image/<?php echo $mphoto; ?>" alt="Slider Photo" style="width:400px;">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Mobile Photo </label>
							<div class="col-sm-6" style="padding-top:5px">
								<input type="file" name="mphoto">(Only jpg, jpeg, gif and png are allowed)
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Heading </label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="heading" value="<?php echo $heading; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Content </label>
							<div class="col-sm-6">
								<textarea class="form-control" name="content" style="height:140px;"><?php echo $content; ?></textarea>
							</div>
						</div>
										
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>
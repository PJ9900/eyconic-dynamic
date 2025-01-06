<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
	$valid = 1;

	if (empty($_FILES['image']['name'])) {
		$final_name = $_POST['oimage'];
	} else {
		$path = $_FILES['image']['name'];
		$path_tmp = $_FILES['image']['tmp_name'];
		if ($path != '') {
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$file_name = basename($path, '.' . $ext);
			if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'webp') {
				$valid = 0;
				$error_message .= 'You must have to upload jpg, jpeg, gif or png file  cc<br>';
			}
		} else {
			$valid = 0;
			$error_message .= 'You must have to select a  Banner<br>';
		}
		$final_name = $path;
		unlink('assets/images/banner-image/' . $_POST['oimage']);
		move_uploaded_file($path_tmp, 'assets/images/banner-image/' . $final_name);
	}

	if (empty($_FILES['mimage']['name'])) {
		$mfinal_name = $_POST['omimage'];
	} else {
		$mpath = $_FILES['mimage']['name'];
		$mpath_tmp = $_FILES['mimage']['tmp_name'];
		if ($mpath != '') {
			$mext = pathinfo($mpath, PATHINFO_EXTENSION);

			$mfile_name = basename($mpath, '.' . $mext);
			if ($mext != 'jpg' && $mext != 'png' && $mext != 'jpeg' && $mext != 'gif' && $mext != 'webp') {
				$valid = 0;
				$error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
			}
		} else {
			$valid = 0;
			$error_message .= 'You must have to select a mobile Banner<br>';
		}
		$mfinal_name = $mpath;
		unlink('assets/images/banner-image/' . $_POST['omimage']);
		move_uploaded_file($mpath_tmp, 'assets/images/banner-image/' . $mfinal_name);
	}
	if ($valid == 1) {
		// Saving data into the main table tbl_top_category
		$statement = $pdo->prepare("update  banners set page_name=?,banners=?,mbanner=? where id=?");
		$statement->execute(array($_POST['page_name'], $final_name, $mfinal_name, $_REQUEST['id']));
		$success_message = 'Banner has been Updated successfully.';
	}
}
?>
<section class="content-header">
	<div class="content-header-left">
		<h1>Add Banners</h1>
	</div>
	<div class="content-header-right">
		<a href="banners.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>
<?php
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM banners WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if ($total == 0) {
		header('location: logout.php');
		exit;
	}
}
foreach ($result as $row) {
	$p_name = $row['page_name'];
	$banner = $row['banners'];
	$mbanner = $row['mbanner'];
}

?>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<?php if ($error_message): ?>
				<div class="callout callout-danger">
					<p>
						<?php echo $error_message; ?>
					</p>
				</div>
			<?php endif; ?>
			<?php if ($success_message): ?>
				<div class="callout callout-success">
					<p><?php echo $success_message; ?></p>
				</div>
			<?php endif; ?>
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Select Page <span>*</span></label>
							<div class="col-sm-4">
								<select class="form-control" name="page_name">
									<option <?php if ($p_name == 'home') {
												echo "selected";
											} else {
												echo "";
											} ?> value="home">Home</option>
									<option <?php if ($p_name == 'about') {
												echo "selected";
											} else {
												echo "";
											} ?> value="about">About Us</option>
									<option <?php if ($p_name == 'blog') {
												echo "selected";
											} else {
												echo "";
											} ?> value="blog">News & Blogs</option>
									<option <?php if ($p_name == 'contact') {
												echo "selected";
											} else {
												echo "";
											} ?> value="contact">Contact Us</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Existing Banner</label>
							<div class="col-sm-9" style="padding-top:5px">
								<img src="assets/images/banner-image/<?php echo $banner; ?>" alt=" banner" style="width:400px;">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Select Banner Image <span>*</span></label>
							<div class="col-sm-4">
								<input type="file" class="form-control" name="image">
								<input type="hidden" class="form-control" value="<?php echo $banner; ?>" name="oimage">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Existing Mobile Banner</label>
							<div class="col-sm-9" style="padding-top:5px">
								<img src="assets/images/banner-image/<?php echo $mbanner; ?>" alt="Mobile banner" style="width:400px;">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Select Mobile Banner Image <span>*</span></label>
							<div class="col-sm-4">
								<input type="file" class="form-control" name="mimage">
								<input type="hidden" class="form-control" value="<?php echo $mbanner; ?>" name="omimage">
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
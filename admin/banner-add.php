<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
	$valid = 1;
	$statementc = $pdo->prepare("SELECT count(*) as total FROM banners where page_name=?");
	$statementc->execute((array($_POST['page_name'])));
	$cresult = $statementc->fetchAll();
	foreach ($cresult as $row) {
		$max = $row['total'];
	}
	$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'banners'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		$ai_id = $row[10];
	}
	$path = $_FILES['image']['name'];
	$path_tmp = $_FILES['image']['tmp_name'];
	if ($path != '') {
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$file_name = basename($path, '.' . $ext);
		if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'webp') {
			$valid = 0;
			$error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
		}
	} else {
		$valid = 0;
		$error_message .= 'You must have to select a  Banner<br>';
	}
	$final_name = $path;
	$final_name = 'banner-' . $ai_id . '.' . $ext;
	move_uploaded_file($path_tmp, 'assets/images/banner-image/' . $final_name);


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
	// 	$mfinal_name = $mpath;
	$mfinal_name = 'mobile-banner-' . $ai_id . '.' . $mext;
	move_uploaded_file($mpath_tmp, 'assets/images/banner-image/' . $mfinal_name);
	if ($valid == 1) {
		// Saving data into the main table tbl_top_category
		// $statementd = $pdo->prepare("DELETE FROM banners where page_name=?");
		// $statementd->execute(array($_POST['page_name']));	
		$statement = $pdo->prepare("INSERT INTO banners (page_name,banners,mbanner) VALUES (?,?,?)");
		$statement->execute(array($_POST['page_name'], $final_name, $mfinal_name));
		$success_message = 'Banner is added successfully.';
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
									<option value="home">Home</option>
									<option value="about">About Us</option>
									<option value="blog">News & Blogs</option>
									<option value="contact">Contact Us</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Select Banner Image <span>*</span></label>
							<div class="col-sm-4">
								<input type="file" class="form-control" name="image">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Select Mobile Banner Image <span>*</span></label>
							<div class="col-sm-4">
								<input type="file" class="form-control" name="mimage">
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
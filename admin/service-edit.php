<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
	$valid = 1;

	if (empty($_POST['s_name'])) {
		$valid = 0;
		$error_message .= 'Name can not be empty<br>';
	}

	if (empty($_POST['s_short_description'])) {
		$valid = 0;
		$error_message .= 'Short description can not be empty<br>';
	}

	if (empty($_POST['s_long_description'])) {
		$valid = 0;
		$error_message .= 'Long description can not be empty<br>';
	}

	if (empty($_POST['s_description'])) {
		$valid = 0;
		$error_message .= 'Description can not be empty<br>';
	}

	if (empty($_POST['slug'])) {
		$valid = 0;
		$error_message .= 'Slug can not be empty<br>';
	}

	$path = $_FILES['photo']['name'];
	$path_tmp = $_FILES['photo']['tmp_name'];
	if ($path != '') {
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$file_name = basename($path, '.' . $ext);
		if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
			$valid = 0;
			$error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
		}
	}

	$name = $_POST['s_name'];
	$slug = $_POST['slug'];
	$s_description = $_POST['s_description'];
	$s_long_description = $_POST['s_long_description'];
	$s_short_description = $_POST['s_short_description'];
	$s_is_active = $_POST['s_is_active'];

	if ($valid == 1) {
		if ($path == '') {
			$statement = $pdo->prepare("UPDATE tbl_service SET name=?, slug=?,s_description=?, s_long_description=?, s_short_description=?, s_is_active=? WHERE id=?");
			$statement->execute(array($name, $slug, $s_description, $s_long_description, $s_short_description, $s_is_active, $_REQUEST['id']));
		} else {
			unlink('assets/images/services-image/' . $_POST['current_photo']);
			$final_name = 'service-' . $_REQUEST['id'] . '.' . $ext;
			move_uploaded_file($path_tmp, 'assets/images/services-image/' . $final_name);
			$statement = $pdo->prepare("UPDATE tbl_service SET name=?, slug=?,s_description=?, s_long_description=?, s_short_description=?, s_is_active=?, photo=? WHERE id=?");
			$statement->execute(array($name, $slug, $s_description, $s_long_description, $s_short_description, $s_is_active, $final_name, $_REQUEST['id']));
		}
		$success_message = 'Service is updated successfully!';
	}
}
?>

<?php
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_service WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if ($total == 0) {
		header('location: logout.php');
		exit;
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Service</h1>
	</div>
	<div class="content-header-right">
		<a href="service.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_service WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$name = $row['name'];
	$slug = $row['slug'];
	$s_short_description = $row['s_short_description'];
	$s_long_description = $row['s_long_description'];
	$s_description = $row['s_description'];
	$s_is_active = $row['s_is_active'];
	$photo = $row['photo'];
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
				<input type="hidden" name="current_photo" value="<?php echo $photo; ?>">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-3 control-label"> Name <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" name="s_name" id="name" class="form-control" value="<?Php echo $name; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label"> slug <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" name="slug" class="form-control" value="<?Php echo $slug; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Short Description</label>
							<div class="col-sm-8">
								<textarea name="s_short_description" class="form-control" id="editor3" cols="30" rows="6"><?Php echo $s_short_description; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Description</label>
							<div class="col-sm-8">
								<textarea name="s_description" class="form-control" cols="30" rows="10" id="editor1"><?Php echo $s_description; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Long Description</label>
							<div class="col-sm-8">
								<textarea name="s_long_description" class="form-control" cols="30" rows="10" id="editor2"><?Php echo $s_long_description; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Is Active?</label>
							<div class="col-sm-8">
								<select name="s_is_active" class="form-control" style="width:auto;">
									<option value="0" <?php if ($s_is_active == '0') {
															echo 'selected';
														} ?>>No</option>
									<option value="1" <?php if ($s_is_active == '1') {
															echo 'selected';
														} ?>>Yes</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Existing Photo</label>
							<div class="col-sm-9" style="padding-top:5px">
								<img src="assets/images/services-image/<?php echo $photo; ?>" alt="Service Photo" style="width:180px;">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Photo <span>*</span></label>
							<div class="col-sm-8">
								<input type="file" name="photo">(Only jpg, jpeg, gif and png are allowed)
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
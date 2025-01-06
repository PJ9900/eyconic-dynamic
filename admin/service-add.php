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
	} else {
		$valid = 0;
		$error_message .= 'You must have to select a photo<br>';
	}

	if ($valid == 1) {

		// // getting auto increment id
		// $statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_service'");
		// $statement->execute();
		// $result = $statement->fetchAll();
		// foreach($result as $row) {
		// 	$ai_id=$row[10];
		// }

		if ($valid == 1) {
			$final_name = 'service' . $ext;
			move_uploaded_file($path_tmp, 'assets/images/services-image/' . $final_name);

			$statement = $pdo->prepare("INSERT INTO tbl_service (name,slug,s_short_description,s_description,s_long_description,s_is_active,photo) VALUES (?,?,?,?,?,?,?)");
			$statement->execute(array($_POST['s_name'], $_POST['slug'], $_POST['s_short_description'], $_POST['s_description'], $_POST['s_long_description'], $_POST['s_is_active'], $final_name));

			$success_message = 'Service is added successfully!';

			unset($_POST['s_name']);
			unset($_POST['slug']);
		}
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Service</h1>
	</div>
	<div class="content-header-right">
		<a href="service.php" class="btn btn-primary btn-sm">View All</a>
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
							<label for="" class="col-sm-3 control-label"> Name <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" name="s_name" id="name" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label"> slug <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" name="slug" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Short Description</label>
							<div class="col-sm-8">
								<textarea name="s_short_description" class="form-control" id="editor3" cols="30" rows="6"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Description</label>
							<div class="col-sm-8">
								<textarea name="s_description" class="form-control" cols="30" rows="10" id="editor1"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Long Description</label>
							<div class="col-sm-8">
								<textarea name="s_long_description" class="form-control" cols="30" rows="10" id="editor2"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Is Active?</label>
							<div class="col-sm-8">
								<select name="s_is_active" class="form-control" style="width:auto;">
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
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
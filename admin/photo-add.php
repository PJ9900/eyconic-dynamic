<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
	$valid = 1;

	$path = $_FILES['upload_caption']['name'];
	$path_tmp = $_FILES['upload_caption']['tmp_name'];

	$fileType = $_FILES['upload_caption']['type'];

	if ($path == '') {
		$valid = 0;
		$error_message .= "You must have to select a caption<br>";
	} else {
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		if (strpos($fileType, 'image') !== false) {
			$file_name = basename($path, '.' . $ext);
			if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'webp') {
				$valid = 0;
				$error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
			}
		} elseif (strpos($fileType, 'video') !== false) {
			$file_name = basename($path, '.' . $ext);
			if ($ext != 'mp4' && $ext != 'avi' && $ext != 'mov' && $ext != 'mkv' && $ext != 'webm') {
				$valid = 0;
				$error_message .= 'You must have to upload mp4, avi, mov, mkv or webm file<br>';
			}
		}
	}

	if ($valid == 1) {

		// getting auto increment id for photo renaming
		$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_photo'");
		$statement->execute();
		$result = $statement->fetchAll();
		foreach ($result as $row) {
			$ai_id = $row[10];
		}

		// uploading the photo into the main location and giving it a final name
		$final_name = 'caption-' . $ai_id . '.' . $ext;
		move_uploaded_file($path_tmp, 'assets/images/gallery/' . $final_name);

		// saving into the database
		$statement = $pdo->prepare("INSERT INTO tbl_photo (caption,photo,url) VALUES (?,?,?)");
		$statement->execute(array($_POST['caption'], $final_name, $_POST['c_url']));

		$success_message = 'Caption is added successfully.';
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Gallery</h1>
	</div>
	<div class="content-header-right">
		<a href="photo.php" class="btn btn-primary btn-sm">View All</a>
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
							<label for="" class="col-sm-2 control-label">Choose Caption <span>*</span></label>
							<div class="col-sm-4">
								<select name="caption" class="form-control" style="width:100px;">
									<option value="image">Image</option>
									<option value="video">Video</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Upload caption <span>*</span></label>
							<div class="col-sm-4" style="padding-top:6px;">
								<input type="file" name="upload_caption" required>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Caption url <span>*</span></label>
							<div class="col-sm-4" style="padding-top:6px;">
								<input type="text" name="c_url" required>
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
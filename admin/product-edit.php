<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
	$valid = 1;
	function clean($string)
	{
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
	// 	  $slug= clean(strtolower($_POST['p_name']));
	// if(empty($_POST['tcat_id'])) {
	//     $valid = 0;
	//     $error_message .= "You must have to select a top level category<br>";
	// }

	if (empty($_POST['p_name'])) {
		$valid = 0;
		$error_message .= "Product name can not be empty<br>";
	}

	// if(empty($_POST['p_current_price'])) {
	//     $valid = 0;
	//     $error_message .= "Current Price can not be empty<br>";
	// }

	if (isset($_FILES['photo']["name"]) && isset($_FILES['photo']["tmp_name"])) {
		$photo = array();
		$photo = $_FILES['photo']["name"];
		$photo = array_values(array_filter($photo));

		$photo_temp = array();
		$photo_temp = $_FILES['photo']["tmp_name"];
		$photo_temp = array_values(array_filter($photo_temp));

		$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_product_photo'");
		$statement->execute();
		$result = $statement->fetchAll();
		foreach ($result as $row) {
			$next_id1 = $row[10];
		}
		$z = $next_id1;

		$m = 0;
		for ($i = 0; $i < count($photo); $i++) {
			$my_ext1 = pathinfo($photo[$i], PATHINFO_EXTENSION);
			if ($my_ext1 == 'jpg' || $my_ext1 == 'png' || $my_ext1 == 'jpeg' || $my_ext1 == 'gif' || $my_ext1 == 'webp') {
				$final_name1[$m] = $z . '.' . $my_ext1;
				move_uploaded_file($photo_temp[$i], "assets/images/product-image/" . $final_name1[$m]);
				$m++;
				$z++;
			}
		}
		if (isset($final_name1)) {
			for ($i = 0; $i < count($final_name1); $i++) {
				$statement = $pdo->prepare("INSERT INTO tbl_product_photo (photo,p_id) VALUES (?,?)");
				$statement->execute(array($final_name1[$i], $_REQUEST['id']));
			}
		}
	}
	$statement = $pdo->prepare("UPDATE tbl_product SET 
        							p_name=?, 
									category=?,
									p_long_description=?,
        							p_description=?,
        							p_short_description=?,
        							p_is_featured=?,
        							p_is_active=?,
        							slug=?
        							WHERE p_id=?");
	$statement->execute(array(
		$_POST['p_name'],
		$_POST['lcat_id'],
		$_POST['p_long_description'],
		$_POST['p_description'],
		$_POST['p_short_description'],
		$_POST['p_is_featured'],
		$_POST['p_is_active'],
		$_POST['slug'],
		$_REQUEST['id']
	));

	$success_message = 'Product is updated successfully.';
}
?>

<?php
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
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
		<h1>Edit Product</h1>
	</div>
	<div class="content-header-right">
		<a href="product.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$p_name = $row['p_name'];
	$category_id = $row['category'];
	$p_size = $row['p_size'];
	$p_old_price = $row['p_old_price'];
	$weight = $row['weight'];
	$p_current_price = $row['p_current_price'];
	$p_qty = $row['p_qty'];
	$p_featured_photo = $row['p_featured_photo'];
	$p_description = $row['p_description'];
	$p_short_description = $row['p_short_description'];
	$p_long_description = $row['p_long_description'];
	$p_additional = $row['additional_info'];
	$p_condition = $row['p_condition'];
	$p_sku = $row['p_sku'];
	$p_vendor = $row['p_vendor'];
	$p_delivery = $row['p_delivery'];
	$p_return_policy = $row['p_return_policy'];
	$p_is_featured = $row['p_is_featured'];
	$p_is_active = $row['p_is_active'];
	$tcat_id = $row['top_id'];
	$ecat_id = $row['ecat_id'];
	$coll = $row['collection'];
	$color = $row['color'];
	$slug = $row['slug'];
	$video = $row['video'];

	$mid = $row['mid_id'];
}

$statement = $pdo->prepare("SELECT * from tbl_mid_category t2 JOIN tbl_top_category t3 ON t2.tcat_id = t3.tcat_id WHERE t2.tcat_id=?");
$statement->execute(array($top_id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	// 	$ecat_name = $row['ecat_name'];
	$mcat_id = $row['mcat_id'];
	$tcat_id = $row['tcat_id'];
}
$statement = $pdo->prepare("SELECT * FROM tbl_product_size WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$size_id[] = $row['size_id'];
}
$statement = $pdo->prepare("SELECT * FROM tbl_product_color WHERE p_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$color_id[] = $row['color_id'];
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
							<label for="" class="col-sm-3 control-label">Category Name <span>*</span></label>
							<div class="col-sm-4">
								<select name="lcat_id" class="form-control select2 low-cat">
									<!-- <option value="">Select Category</option> -->
									<?php
									$stmt = $pdo->prepare("SELECT * FROM tbl_top_category");
									$stmt->execute();
									while ($rowin = $stmt->fetch(PDO::FETCH_ASSOC)) {
									?>
										<option value="<?php echo $rowin['tcat_id'] ?>" <?php if ($category_id == $rowin['tcat_id']) {
																							echo "selected";
																						}  ?>><?php echo $rowin['tcat_name'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Product Name <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" name="p_name" class="form-control" value="<?php echo $p_name; ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Slug</label>
							<div class="col-sm-4">
								<input type="text" name="slug" value="<?php echo $slug; ?>" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Other Photos</label>
							<div class="col-sm-4" style="padding-top:4px;">
								<table id="ProductTable" style="width:100%;">
									<tbody>
										<?php
										$statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
										$statement->execute(array($_REQUEST['id']));
										$result = $statement->fetchAll(PDO::FETCH_ASSOC);
										foreach ($result as $row) {
										?>
											<tr>
												<td data-id="<?php echo $row['pp_id'] ?>" dname="<?php echo $row['photo']; ?>">
													<img src="assets/images/product-image/<?php echo $row['photo']; ?>" onclick="change_function(this)" alt="" style="cursor:pointer;width:150px;margin-bottom:5px;">
													<input type="file" id="myfile" onchange="img_change(this)" class="myfile d-none">
												</td>
												<td style="width:28px;">
													<a onclick="return confirmDelete();" href="product-other-photo-delete.php?id=<?php echo $row['pp_id']; ?>&id1=<?php echo $_REQUEST['id']; ?>" class="btn btn-danger btn-xs">X</a>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<div class="col-sm-2">
								<input type="button" id="btnAddNew" value="Add Item" style="margin-top: 5px;margin-bottom:10px;border:0;color: #fff;font-size: 14px;border-radius:3px;" class="btn btn-warning btn-xs">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Short Description</label>
							<div class="col-sm-8">
								<textarea name="p_short_description" class="form-control" cols="30" rows="10" id="editor1"><?php echo $p_short_description; ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Description</label>
							<div class="col-sm-8">
								<textarea name="p_description" class="form-control" cols="30" rows="10" id="editor2"><?php echo $p_description; ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Long Description</label>
							<div class="col-sm-8">
								<textarea name="p_long_description" class="form-control" cols="30" rows="10" id="editor3"><?php echo $p_long_description; ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Is Popular?</label>
							<div class="col-sm-8">
								<select name="p_is_featured" class="form-control" style="width:auto;">
									<option value="0" <?php if ($p_is_featured == '0') {
															echo 'selected';
														} ?>>No</option>
									<option value="1" <?php if ($p_is_featured == '1') {
															echo 'selected';
														} ?>>Yes</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Is Active?</label>
							<div class="col-sm-8">
								<select name="p_is_active" class="form-control" style="width:auto;">
									<option value="0" <?php if ($p_is_active == '0') {
															echo 'selected';
														} ?>>No</option>
									<option value="1" <?php if ($p_is_active == '1') {
															echo 'selected';
														} ?>>Yes</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Update</button>
							</div>
						</div>
					</div>
				</div>
			</form>


		</div>
	</div>

</section>

<?php require_once('footer.php'); ?>
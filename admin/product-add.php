<?php require_once('header.php'); ?>
<?php
if (isset($_POST['form1'])) {
	$valid = 1;
	function clean($string)
	{
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
	// $slug= clean(strtolower($_POST['p_name']));
	// if(empty($_POST['tcat_id'])) {
	//     $valid = 0;
	//     $error_message .= "You must have to select a top level category<br>";
	// }

	// if(empty($_POST['mcat_id'])) {
	//     $valid = 0;
	//     $error_message .= "You must have to select a mid level category<br>";
	// }   
	if (empty($_POST['p_name'])) {
		$valid = 0;
		$error_message .= "Product name can not be empty<br>";
	}
	// if(empty($_POST['p_current_price'])) {
	//     $valid = 0;
	//     $error_message .= "Current Price can not be empty<br>";
	// }


	if ($valid == 1) {
		$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_product'");
		$statement->execute();
		$result = $statement->fetchAll();
		foreach ($result as $row) {
			$ai_id = $row[10];
		}
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
					$statement->execute(array($final_name1[$i], $ai_id));
				}
			}
		}
		$final_name = 'product-featured-' . $ai_id . '.' . $ext;

		move_uploaded_file($path_tmp, 'assets/images/product-image/' . $final_name);
		//Saving data into the main table tbl_product


		$p_name =  $_POST['p_name'];
		$p_category =  $_POST['lcat_id'];
		$p_short_description = 	$_POST['p_short_description'];
		$p_long_description = 	$_POST['p_short_description'];
		$p_is_featured =	$_POST['p_is_featured'];
		$p_is_active =	$_POST['p_is_active'];
		$tcat_id =	$_POST['tcat_id'];
		$p_description =	$_POST['p_description'];
		$slug = $_POST['slug'];

		if (empty($p_category)) {
			$valid = 0;
			$error_message .= 'Please select the category!';
		}

		if ($valid == 1) {
			$statement = $pdo->prepare("INSERT INTO tbl_product(
				p_name,
				category,
				p_long_description,
				p_short_description,
				p_is_featured,
				p_is_active,
				p_description,
				slug
			) VALUES (?,?,?,?,?,?,?,?)");
			$statement->execute(array(
				$p_name,
				$p_category,
				$p_long_description,
				$p_short_description,
				$p_is_featured,
				$p_is_active,
				$p_description,
				$slug
			));

			$success_message = 'Product is added successfully.';
		}
	}
}

?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Product</h1>
	</div>
	<div class="content-header-right">
		<a href="product.php" class="btn btn-primary btn-sm">View All</a>
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

			<form class="form-horizontal" name="myForm" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">

				<div class="box box-info">
					<div class="box-body">

						<!--<div class="form-group">-->
						<!--	<label for="" class="col-sm-3 control-label">Mid Level Category Name <span>*</span></label>-->
						<!--	<div class="col-sm-4">-->
						<!--		<select name="mcat_id" class="form-control select2 mid-cat">-->
						<!--			<option value="">Select Mid Level Category</option>-->
						<!--		</select>-->
						<!--	</div>-->
						<!--</div>-->
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Category Name <span>*</span></label>
							<div class="col-sm-4">
								<select name="lcat_id" class="form-control select2 low-cat">
									<option value="">Select Category</option>
									<?php
									$stmt = $pdo->prepare("SELECT * FROM tbl_top_category");
									$stmt->execute();
									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
									?>
										<option value="<?php echo $row['tcat_id'] ?>"><?php echo $row['tcat_name'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label"> Name <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" name="p_name" id="name" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label"> slug <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" name="slug" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label"> Photos</label>
							<div class="col-sm-4" style="padding-top:4px;">
								<table id="ProductTable" style="width:100%;">
									<tbody>
										<tr>
											<td>
												<div class="upload-btn">
													<input type="file" name="photo[]" style="margin-bottom:5px;">
												</div>
											</td>
											<!--<td style="width:28px;"><a href="javascript:void()" class="Delete btn btn-danger btn-xs">X</a></td>-->
										</tr>
									</tbody>
								</table>
							</div>
							<!--<div class="col-sm-2">-->
							<!--                <input type="button" id="btnAddNew" value="Add Item" style="margin-top: 5px;margin-bottom:10px;border:0;color: #fff;font-size: 14px;border-radius:3px;" class="btn btn-warning btn-xs">-->
							<!--            </div>-->
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Short Description</label>
							<div class="col-sm-8">
								<textarea name="p_short_description" class="form-control" id="editor3" cols="30" rows="6"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Description</label>
							<div class="col-sm-8">
								<textarea name="p_description" class="form-control" cols="30" rows="10" id="editor1"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Long Description</label>
							<div class="col-sm-8">
								<textarea name="p_long_description" class="form-control" cols="30" rows="10" id="editor2"></textarea>
							</div>
						</div>
						<!--<div class="form-group">-->
						<!--	<label for="" class="col-sm-3 control-label">Additional Information</label>-->
						<!--	<div class="col-sm-8">-->
						<!--		<textarea name="add_description" class="form-control" cols="30" rows="10" id="editor2"></textarea>-->
						<!--	</div>-->
						<!--</div>					-->
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Is Popular?</label>
							<div class="col-sm-8">
								<select name="p_is_featured" class="form-control" style="width:auto;">
									<option value="0">No</option>
									<option value="1">Yes</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Is Active?</label>
							<div class="col-sm-8">
								<select name="p_is_active" class="form-control" style="width:auto;">
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Add Product</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<?php require_once('footer.php'); ?>
<script>
	$("form.form-horizontal #name").on("keyup", function() {
		var val = $(this).val();
		var sanitizedInput = val.replace(/[^a-zA-Z0-9\-]/g, ''); // removes all non-alphanumeric and non-hyphen characters
		val = sanitizedInput; // updates input field value
		$("form.form-horizontal #slug").val(val);
		// console.log(val);
	})

	function validateForm() {
		var input = $("form.form-horizontal #slug").val();
		$("form.form-horizontal #slug").val(input.replace(/[^a-zA-Z0-9\-]/g, ''));
	}
</script>
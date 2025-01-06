<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;
     function clean($string) {
  $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

  return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
    $sstatement = $pdo->prepare("SELECT count(*) as total FROM tbl_product where variant=?");
	$sstatement->execute(array($_REQUEST['id']));
	$sresult = $sstatement->fetchAll();
	foreach($sresult as $srow) {
		$vc=$srow['total']+1;
		
	}
    $slug= clean(strtolower($_POST['p_name']."-variant-".$vc));
    if(empty($_POST['tcat_id'])) {
        $valid = 0;
        $error_message .= "You must have to select a top level category<br>";
    }

    // if(empty($_POST['mcat_id'])) {
    //     $valid = 0;
    //     $error_message .= "You must have to select a mid level category<br>";
    // }   
    if(empty($_POST['p_name'])) {
        $valid = 0;
        $error_message .= "Product name can not be empty<br>";
    }
    if(empty($_POST['p_current_price'])) {
        $valid = 0;
        $error_message .= "Current Price can not be empty<br>";
    }
	if(empty($_POST['p_sku'])) {
        $valid = 0;
        $error_message .= "SKU can not be empty<br>";
    }
   
    if($valid == 1) {
    	$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_product'");
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row) {
			$ai_id=$row[10];
		}
    	if( isset($_FILES['photo']["name"]) && isset($_FILES['photo']["tmp_name"]) )
        {
        	$photo = array();
            $photo = $_FILES['photo']["name"];
            $photo = array_values(array_filter($photo));

        	$photo_temp = array();
            $photo_temp = $_FILES['photo']["tmp_name"];
            $photo_temp = array_values(array_filter($photo_temp));

        	$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_product_photo'");
			$statement->execute();
			$result = $statement->fetchAll();
			foreach($result as $row) {
				$next_id1=$row[10];
			}
			$z = $next_id1;
            $m=0;
            for($i=0;$i<count($photo);$i++)
            {
                $my_ext1 = pathinfo( $photo[$i], PATHINFO_EXTENSION );
		        if( $my_ext1=='jpg' || $my_ext1=='png' || $my_ext1=='jpeg' || $my_ext1=='gif' || $my_ext1=='webp' ) {
		            $final_name1[$m] = 'varient'.$z.'.'.$my_ext1;
                    move_uploaded_file($photo_temp[$i],"../assets/images/product-image/".$final_name1[$m]);
                    $m++;
                    $z++;
		        }
            }

            if(isset($final_name1)) {
            	for($i=0;$i<count($final_name1);$i++)
		        {
		        	$statement = $pdo->prepare("INSERT INTO tbl_product_photo (photo,p_id) VALUES (?,?)");
		        	$statement->execute(array($final_name1[$i],$ai_id));
		        }
            }            
        }
		 $final_name = 'product-featured-'.$ai_id.'.'.$ext; 
		
        move_uploaded_file( $path_tmp, '../assets/images/product-image/'.$final_name );
		//Saving data into the main table tbl_product

		$statement = $pdo->prepare("INSERT INTO tbl_product(
										p_name,
										p_old_price,
										p_current_price,
										p_short_description,
										p_is_featured,
										p_is_active,
										p_sku,
										p_vendor,
										p_delivery,
										mid_id,
										top_id,
										p_description,
										additional_info,
										collection,
										color,
										p_size,
										p_qty,
										variant,
										slug,
										video
										
									) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$statement->execute(array(
										$_POST['p_name'],
										$_POST['p_old_price'],
										$_POST['p_current_price'],									
										$_POST['p_short_description'],											
										$_POST['p_is_featured'],
										$_POST['p_is_active'],
										$_POST['p_sku'],
										$_POST['p_vendor'],
										$_POST['p_delivery'],
										$_POST['mcat_id'],
										$_POST['tcat_id'],
										$_POST['p_description'],
										$_POST['add_description'],
										$_POST['collection'],
										$_POST['color'],
										$_POST['size'],
									    $_POST['quant'],
									    $_REQUEST['id'],
										$slug,
										$_POST['video']
									));
           
    	$success_message = 'Product is added successfully.';
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
	$p_size = $row['p_size'];
	$p_old_price = $row['p_old_price'];
	$p_current_price = $row['p_current_price'];
	$p_qty = $row['p_qty'];
	$p_featured_photo = $row['p_featured_photo'];
	$p_description = $row['p_description'];
	$p_short_description = $row['p_short_description'];
	$p_additional = $row['additional_info'];
	$p_condition = $row['p_condition'];
	$p_sku = $row['p_sku'];
	$p_vendor = $row['p_vendor'];
	$p_delivery = $row['p_delivery'];
	$p_return_policy = $row['p_return_policy'];
	$p_is_featured = $row['p_is_featured'];
	$p_is_active = $row['p_is_active'];
	$tcat_id = $row['top_id'];
	$coll = $row['collection'];
	$color = $row['color'];
	
	$mid=$row['mid_id'];
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
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Top Level Category Name <span>*</span></label>
							<div class="col-sm-4">
								<select name="tcat_id" class="form-control select2 top-cat">
		                            <option value="">Select Top Level Category</option>
		                            <?php
		                            $statement = $pdo->prepare("SELECT * FROM tbl_top_category ORDER BY tcat_name ASC");
		                            $statement->execute();
		                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);   
		                            foreach ($result as $row) {
		                                ?>
		                                <option value="<?php echo $row['tcat_id']; ?>" <?php  if($row['tcat_id'] == $tcat_id){echo 'selected';} ?>><?php echo $row['tcat_name']; ?></option>
		                                <?php
		                            }
		                            ?>
		                        </select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Mid Level Category Name <span>*</span></label>
							<div class="col-sm-4">
								<select name="mcat_id" class="form-control select2 mid-cat">
		                            <option value="">Select Mid Level Category</option>
		                            <?php
		                            $statement = $pdo->prepare("SELECT * FROM tbl_mid_category WHERE tcat_id = ? ORDER BY mcat_name ASC");
		                            $statement->execute(array($tcat_id));
		                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);   
		                            foreach ($result as $row) {
		                                ?>
		                                <option value="<?php echo $row['mcat_id']; ?>" <?php  if($row['mcat_id'] == $mid){echo 'selected';} ?>><?php echo $row['mcat_name']; ?></option>
		                                <?php
		                            }
		                            ?>
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
							<label for="" class="col-sm-3 control-label">Collection</label>
							<div class="col-sm-4">
							<select name="collection" class="form-control select2">
									<option value="">Select Collection</option>
									<?php
									$statement = $pdo->prepare("SELECT * FROM collection ORDER BY id ASC");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);	
									foreach ($result as $row) {
										?>
										<option value="<?php echo $row['id']; ?>" <?php if($coll==$row['id']){ echo "selected";} ?>><?php echo $row['collection']; ?></option>
										<?php
									}
									?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Size</label>
							<div class="col-sm-4">
							<select name="size" class="form-control select2">
									<option value="">Select Size</option>
									<?php
									$statement = $pdo->prepare("SELECT * FROM tbl_size where status='1' ORDER BY size_id ASC");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);	
									foreach ($result as $row) {
										?>
										<option value="<?php echo $row['size_id']; ?>" <?php if($p_size==$row['size_id']){ echo "selected";} ?>><?php echo $row['size_name']; ?></option>
										<?php
									}
									?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Color</label>
							<div class="col-sm-4">
								<select name="color" class="form-control select2">
									<option value="">Select Color</option>
									<?php
									$statement = $pdo->prepare("SELECT * FROM tbl_color ORDER BY color_id ASC");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);	
									foreach ($result as $row) {
										?>
										<option value="<?php echo $row['color_id']; ?>" <?php if($color==$row['color_id']){ echo "selected";} ?>><?php echo $row['color_name']; ?></option>
										<?php
									}
									?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Old Price<br><span style="font-size:10px;font-weight:normal;">(In Rs.)</span></label>
							<div class="col-sm-4">
								<input type="text" name="p_old_price" class="form-control" value="<?php echo $p_old_price; ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Current Price <span>*</span><br><span style="font-size:10px;font-weight:normal;">(In Rs.)</span></label>
							<div class="col-sm-4">
								<input type="text" name="p_current_price" class="form-control" value="<?php echo $p_current_price; ?>"> 
							</div>
						</div>	
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">SKU <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" name="p_sku" value="<?php echo $p_sku; ?>" class="form-control">
							</div>
						</div>	
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Vendor </label>
							<div class="col-sm-4">
								<input type="text" name="p_vendor" value="<?php echo $p_vendor; ?>" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Quantity </label>
							<div class="col-sm-4">
								<input type="text" name="quant" value="1" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Delivery Time </label>
							<div class="col-sm-4">
								<input type="text" name="p_delivery" value="<?php echo $p_delivery; ?>" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Video Link</label>
							<div class="col-sm-4">
								<input type="text" name="video" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Other Photos</label>
							<div class="col-sm-4" style="padding-top:4px;">
								<table id="ProductTable" style="width:100%;">
			                        <tbody>
			                            <tr>
			                                <td>
			                                    <div class="upload-btn">
			                                        <input type="file" name="photo[]" style="margin-bottom:5px;">
			                                    </div>
			                                </td>
			                                <td style="width:28px;"><a href="javascript:void()" class="Delete btn btn-danger btn-xs">X</a></td>
			                            </tr>
			                        </tbody>
			                    </table>
							</div>
							<div class="col-sm-2">
			                    <input type="button" id="btnAddNew" value="Add Item" style="margin-top: 5px;margin-bottom:10px;border:0;color: #fff;font-size: 14px;border-radius:3px;" class="btn btn-warning btn-xs">
			                </div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Description</label>
							<div class="col-sm-8">
								<textarea name="p_description" class="form-control" cols="30" rows="10" id="editor1"><?php echo $p_description; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Short Description</label>
							<div class="col-sm-8">
								<textarea name="p_short_description" class="form-control" cols="30" rows="10" id="editor1"><?php echo $p_short_description; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Additional Info</label>
							<div class="col-sm-8">
								<textarea name="p_additional" class="form-control" cols="30" rows="10" id="editor3"><?php echo $p_additional; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Is Popular?</label>
							<div class="col-sm-8">
								<select name="p_is_featured" class="form-control" style="width:auto;">
									<option value="0" <?php if($p_is_featured == '0'){echo 'selected';} ?>>No</option>
									<option value="1" <?php if($p_is_featured == '1'){echo 'selected';} ?>>Yes</option>
								</select> 
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Is Active?</label>
							<div class="col-sm-8">
								<select name="p_is_active" class="form-control" style="width:auto;">
									<option value="0" <?php if($p_is_active == '0'){echo 'selected';} ?>>No</option>
									<option value="1" <?php if($p_is_active == '1'){echo 'selected';} ?>>Yes</option>
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
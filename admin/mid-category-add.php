<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;
    
	// echo "<pre>";
	// print_r($_POST);
	// die;

    if(empty($_POST['tcat_id'])) {
        $valid = 0;
        $error_message .= "You must have to select a top level category<br>";
    }
        $statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_mid_category'");
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row) {
			$ai_id=$row[10];
		}
    if(empty($_POST['mcat_name'])) {
        $valid = 0;
        $error_message .= "Mid Level Category Name can not be empty<br>";
    }
    
    $bpath = $_FILES['banner']['name']; 
    $bpath_tmp = $_FILES['banner']['tmp_name'];
    if($bpath!='') {
        $bext = pathinfo( $bpath, PATHINFO_EXTENSION );
        $bfile_name = basename( $bpath, '.' . $bext );
        if( $bext!='jpg' && $bext!='png' && $bext!='jpeg' && $bext!='gif' && $bext!='webp' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif, webp or png file<br>';
        }
    } else {
    // 	$valid = 0;
    //     $error_message .= 'You must have to select a Category photo<br>';
    }
        // $bfinal_name = 'cat-banner-'.$ai_id.'.'.$bext;
        move_uploaded_file( $bpath_tmp,'assets/images/mid-category/'.$bpath );
    if($valid == 1) {

		// Saving data into the main table tbl_mid_category
		function clean($string) {
          $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
          return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        }
        $slug=clean(strtolower($_POST['mcat_name']));
		$statement = $pdo->prepare("INSERT INTO tbl_mid_category (mcat_name,banner,tcat_id,meta_title,meta_keyword,meta_description,show_home,slug) VALUES (?,?,?,?,?,?,?,?)");
		$statement->execute(array($_POST['mcat_name'],$bpath,$_POST['tcat_id'],$_POST['mtitle'],$_POST['mkey'],$_POST['mdesc'],$_POST['show_on_home'],$slug));	
    	$success_message = 'Mid Level Category is added successfully.';
    }
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Mid Level Category</h1>
	</div>
	<div class="content-header-right">
		<a href="mid-category.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


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
								<select name="tcat_id" class="form-control select2">
									<option value="">Select Top Level Category</option>
									<?php
									$statement = $pdo->prepare("SELECT * FROM tbl_top_category ORDER BY tcat_name ASC");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);	
									foreach ($result as $row) {
										?>
										<option value="<?php echo $row['tcat_id']; ?>"><?php echo $row['tcat_name']; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Show on homepage <span>*</span></label>
							<div class="col-sm-4">
								<select name="show_on_home" class="form-control" style="width:auto;">
									<option value="0">No</option>
									<option value="1">Yes</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Mid Level Category Name <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="mcat_name">
							</div>
						</div>
							<div class="form-group">
							<label for="" class="col-sm-3 control-label">Banner<span>*</span></label>
							<div class="col-sm-4">
							<input type="file" class="form-control" name="banner">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Meta Title <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="mtitle">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Meta Keyword <span>*</span></label>
							<div class="col-sm-4">
								<textarea type="text" class="form-control" rows="5" name="mkey"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Meta Description <span>*</span></label>
							<div class="col-sm-4">
								<textarea type="text" class="form-control" rows="5" name="mdesc"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label"></label>
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
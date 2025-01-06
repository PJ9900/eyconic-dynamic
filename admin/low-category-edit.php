<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;
    if(empty($_POST['tcat_id'])) {
        $valid = 0;
        $error_message .= "You must have to select a top level category<br>";
    }
    if(empty($_POST['mcat_name'])) {
        $valid = 0;
        $error_message .= "Mid Level Category Name can not be empty<br>";
    }
    if($valid == 1) {    	
		// updating into the database
        $slug=strtolower($_POST['slug']);
		$statement = $pdo->prepare("UPDATE tbl_low_category SET home_img=?,show_home=?,lcat_name=?,tcat_id=?,mcat_id=?,meta_title=?,meta_keyword=?,meta_description=?,slug=?,content_add=? WHERE lcat_id=?");
		$statement->execute(array($final_name,$_POST['show_on_home'],$_POST['mcat_name'],$_POST['tcat_id'],$_POST['mcat_id'],$_POST['mtitle'],$_POST['mkey'],$_POST['mdescr'],$slug,$_POST['description'],$_REQUEST['id']));  
    	$success_message = 'low Level Category is updated successfully.';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_low_category WHERE lcat_id=?");
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
		<h1>Edit low Level Category</h1>
	</div>
	<div class="content-header-right">
		<a href="low-category.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<?php							
foreach ($result as $row) {
	$mcat_name = $row['lcat_name'];
    $tcat_id = $row['tcat_id'];
    $mcat_id = $row['mcat_id'];
    $slug = $row['slug'];
    $mdesc = $row['meta_description'];
    $mtitle = $row['meta_title'];
    $mkey=$row['meta_keyword'];
    $ban=$row['banner'];
    $hban=$row['home_img'];
    $show_home=$row['show_home'];
    $content=$row['content_add'];
    
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
                        <select name="tcat_id" class="form-control select2">
                            <option value="">Select Top Level Category</option>
                            <?php
                            $statement = $pdo->prepare("SELECT * FROM tbl_top_category ORDER BY tcat_name ASC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);   
                            foreach ($result as $row) {
                                ?>
                                <option value="<?php echo $row['tcat_id']; ?>" <?php if($row['tcat_id'] == $tcat_id){echo 'selected';} ?>><?php echo $row['tcat_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Mid Level Category Name <span>*</span></label>
                    <div class="col-sm-4">
                        <select name="mcat_id" class="form-control select2">
                            <option value="">Select Mid Level Category</option>
                            <?php
                            $statement = $pdo->prepare("SELECT * FROM tbl_mid_category ORDER BY mcat_name ASC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);   
                            foreach ($result as $row) {
                                ?>
                                <option value="<?php echo $row['mcat_id']; ?>" <?php if($row['mcat_id'] == $mcat_id){echo 'selected';} ?>><?php echo $row['mcat_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Low Level Category Name <span>*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="mcat_name" value="<?php echo $mcat_name; ?>">
                    </div>
                </div>
               <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Show on Homepage? <span>*</span></label>
                    <div class="col-sm-4">
                        <select name="show_on_home" class="form-control" style="width:auto;">
                            <option value="0" <?php if($show_home == 0) {echo 'selected';} ?>>No</option>
                            <option value="1" <?php if($show_home == 1) {echo 'selected';} ?>>Yes</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
							<label for="" class="col-sm-3 control-label">Meta Title <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $mtitle; ?>" class="form-control" name="mtitle">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Meta Keyword <span>*</span></label>
							<div class="col-sm-4">
								<textarea type="text" class="form-control" rows="5" name="mkey"><?php echo $mkey; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Meta Description <span>*</span></label>
							<div class="col-sm-4">
								<textarea type="text" class="form-control" rows="5" name="mdescr"><?php echo $mdesc; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Slug <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" rows="5" value="<?php echo $slug; ?>" name="slug">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label">Content <span>*</span></label>
							<div class="col-sm-8">
								<textarea name="description" id="editor1" class="form-control" cols="30" rows="6"
                                    id=""><?php echo $content; ?></textarea>
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

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;
    if(empty($_POST['tcat_name'])) {
        $valid = 0;
        $error_message .= "Top Category Name can not be empty<br>";
    } else {
		// Duplicate Top Category checking
    	// current Top Category name that is in the database
    	$statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE tcat_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$current_tcat_name = $row['tcat_name'];
		}
		$statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE tcat_name=? and tcat_name!=?");
    	$statement->execute(array($_POST['tcat_name'],$current_tcat_name));
    	$total = $statement->rowCount();							
    	if($total) {
    		$valid = 0;
        	$error_message .= 'Top Category name already exists<br>';
    	}
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
        move_uploaded_file( $bpath_tmp,'assets/images/category/'.$bpath); 
    //  if($_POST['banner']==''){
    //   $bpath=$_POST['obanner'];
    // }   
    
    if($valid == 1) {    	
		$slug=strtolower($_POST['slug']);
		
	$tcat_name = $_POST['tcat_name'];
	$show_on_menu = $_POST['show_on_menu'];
	$mtitle = $_POST['mtitle'];
	$mkey = $_POST['mkey'];
	$mdesc = $_POST['mdesc'];
	$id = $_REQUEST['id'];
	$description = $_POST['description'];

		
// 	echo $bpath;	

// 	echo "UPDATE tbl_top_category SET content='$description',banner='$bpath',tcat_name='$tcat_name',show_on_menu=$show_on_menu,meta_title='$mtitle',meta_keyword='$mkey',meta_description='$mdesc',slug='$slug' WHERE tcat_id=$id";
// 		exit;
		$statement = $pdo->prepare("UPDATE tbl_top_category SET content=?,tcat_name=?,banner=?,show_on_menu=?,meta_title=?,meta_keyword=?,meta_description=?,slug=? WHERE tcat_id=?");
		  $statement->execute(array($_POST['description'],$_POST['tcat_name'],$bpath,$_POST['show_on_menu'],$_POST['mtitle'],$_POST['mkey'],$_POST['mdesc'],$_POST['slug'],$_REQUEST['id']));
// echo $statement;
// 		exit;
    	$success_message = 'Top Category is updated successfully.';
    }
}
?>
<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE tcat_id=?");
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
        <h1>Edit Top Level Category</h1>
    </div>
    <div class="content-header-right">
        <a href="top-category.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>


<?php							
foreach ($result as $row) {
	$tcat_name = $row['tcat_name'];
    $show_on_menu = $row['show_on_menu'];
    $show_on_menu=$row['show_on_menu'];
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
                            <label for="" class="col-sm-2 control-label">Top Category Name <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tcat_name"
                                    value="<?php echo $tcat_name; ?>">
                            </div>
                        </div>
                        
                        	<div class="form-group">
							<label for="" class="col-sm-2 control-label">Existing Image</label>
							<div class="col-sm-9" style="padding-top:5px">
								<img src="assets/images/category/<?php echo $row['banner']; ?>" alt="Category Image" style="width:400px;">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Image<span>*</span></label>
							<div class="col-sm-8">
							<input type="file" class="form-control" name="banner">
							<input type="hidden" class="form-control" value="<?php echo $banner; ?>" name="obanner">
							</div>
						</div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Show on Menu? <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="show_on_menu" class="form-control" style="width:auto;">
                                    <option value="1" <?php if($show_on_menu == 1) {echo 'selected';} ?>>Yes</option>
                                    <option value="0" <?php if($show_on_menu == 0) {echo 'selected';} ?>>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"> Content</label>
                            <div class="col-sm-8">
                                <textarea name="description" id="editor1" class="form-control" cols="30" rows="6"
                                    id=""><?php echo $row['meta_description']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Title <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?php echo $row['meta_title']; ?>"
                                    name="mtitle">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Keyword <span>*</span></label>
                            <div class="col-sm-4">
                                <textarea type="text" class="form-control" rows="5"
                                    name="mkey"><?php echo $row['meta_keyword']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Description <span>*</span></label>
                            <div class="col-sm-4">
                                <textarea type="text" class="form-control" rows="5"
                                    name="mdesc"><?php echo $row['meta_description']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Slug <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" rows="5" value="<?php echo $row['slug']; ?>"
                                    name="slug">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
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

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
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
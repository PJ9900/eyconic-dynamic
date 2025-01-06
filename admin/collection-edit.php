<?php require_once('header.php'); ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(isset($_POST['form1'])) {
	$valid = 1;
    if(empty($_POST['coll_name'])) {
        $valid = 0;
        $error_message .= "Collection Name can not be empty<br>";
    } else {
			$statement = $pdo->prepare("SELECT * FROM collection WHERE id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$current_coll_name = $row['collection'];
		}

		$statement = $pdo->prepare("SELECT * FROM collection WHERE collection=? and collection!=?");
    	$statement->execute(array($_POST['coll_name'],$current_coll_name));
    	$total = $statement->rowCount();							
    	if($total) {
    		$valid = 0;
        	$error_message .= 'Collection name already exists<br>';
    	}
    }

    if($valid == 1) {    	
		// updating into the database
		$statement = $pdo->prepare("UPDATE collection SET collection=?,Status=? WHERE id=?");
		$statement->execute(array($_POST['coll_name'],$_POST['cs'],$_REQUEST['id']));

    	$success_message = 'Collection is updated successfully.';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM collection WHERE id=?");
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
		<h1>Edit Color</h1>
	</div>
	<div class="content-header-right">
		<a href="collection.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<?php							
foreach ($result as $row) {
	$coll_name = $row['collection'];
	$cs = $row['Status'];
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

        <form class="form-horizontal" action="" method="post">

        <div class="box box-info">

            <div class="box-body">
                <div class="form-group">
							<label for="" class="col-sm-2 control-label">Collection Name <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" value="<?php echo $coll_name ?>" name="coll_name" required>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Status<span>*</span></label>
							<div class="col-sm-4">
								<select class="form-control" name="cs">
								    <option value="1" <?php if($cs==1){ echo "selected";} ?>>Active</option>
								    <option value="0" <?php if($cs==0){ echo "selected";} ?>>Inactive</option>
								</select>
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
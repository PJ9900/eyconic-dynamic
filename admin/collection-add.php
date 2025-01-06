<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['coll_name'])) {
        $valid = 0;
        $error_message .= "Collection Name can not be empty<br>";
    } else {
    	// Duplicate Category checking
    	$statement = $pdo->prepare("SELECT * FROM collection WHERE collection=?");
    	$statement->execute(array($_POST['coll_name']));
    	$total = $statement->rowCount();
    	if($total)
    	{
    		$valid = 0;
        	$error_message .= "Collection already exists<br>";
    	}
    }

    if($valid == 1) {

		// Saving data into the main table tbl_color
		$statement = $pdo->prepare("INSERT INTO collection (collection,Status) VALUES (?,?)");
		$statement->execute(array($_POST['coll_name'],$_POST['cs']));
	
    	$success_message = 'Collection is added successfully.';
    }
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Collection</h1>
	</div>
	<div class="content-header-right">
		<a href="collection.php" class="btn btn-primary btn-sm">View All</a>
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

			<form class="form-horizontal" action="" method="post">

				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Collection Name <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="coll_name" required>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Status<span>*</span></label>
							<div class="col-sm-4">
								<select class="form-control" name="cs">
								    <option value="1">Active</option>
								    <option value="0">Inactive</option>
								</select>
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
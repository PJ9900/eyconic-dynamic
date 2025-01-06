<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;
	

    if(empty($_POST['url'])) {
        $valid = 0;
        $error_message .= "Url can not be empty<br>";
    } else {
    	// Duplicate Category checking
    	$statement = $pdo->prepare("SELECT * FROM meta_tag WHERE page_name=?");
    	$statement->execute(array($_POST['url']));
    	$total = $statement->rowCount();
    	if($total)
    	{
    		$valid = 0;
        	$error_message .= "Meta Details already exists<br>";
    	}
    }	
	
    if($valid == 1) {
		// Saving data into the main table tbl_top_category
		$statement = $pdo->prepare("INSERT INTO meta_tag (page_name,meta_title,meta_keyword,meta_description) VALUES (?,?,?,?)");
		$statement->execute(array($_POST['url'],$_POST['mtitle'],$_POST['mkey'],$_POST['mdesc']));	
    	$success_message = 'Meta details has been added successfully.';
    }
}
?>
<section class="content-header">
	<div class="content-header-left">
		<h1>View Meta Details</h1>
	</div>
	<div class="content-header-right">
		<a href="meta_tag.php" class="btn btn-primary btn-sm">View All</a>
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
							<label for="" class="col-sm-2 control-label">Enter Page Url <span>*</span></label>
							<div class="col-sm-4">
							<input type="text" class="form-control" name="url">
							</div>
						</div>						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Title <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="mtitle">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Keyword <span>*</span></label>
							<div class="col-sm-4">
								<textarea type="text" class="form-control" rows="5" name="mkey"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Description <span>*</span></label>
							<div class="col-sm-4">
								<textarea type="text" class="form-control" rows="5" name="mdesc"></textarea>
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
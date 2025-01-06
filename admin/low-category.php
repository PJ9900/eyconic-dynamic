<?php 
require_once('header.php');
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Low Level Categories</h1>
	</div>
	<div class="content-header-right">
		<a href="low-category-add.php" class="btn btn-primary btn-sm">Add New</a>
	</div>
</section>


<section class="content">

  <div class="row">
    <div class="col-md-12">


      <div class="box box-info">
        
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-hover table-striped">
			<thead>
			    <tr>
			        <th>#</th>
			        <th>Low Level Category Name</th>
			        <th>Mid Level Category Name</th>
                    <th>Top Level Category Name</th>
			        <th>Action</th>
			    </tr>
			</thead>
            <tbody>
            	<?php
            	$i=0;
            	$statement = $pdo->prepare("SELECT * 
                                    FROM tbl_low_category 
                                    ORDER BY lcat_id DESC");
            	$statement->execute();
            	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
            	foreach ($result as $row) {
            		$i++;
            		$id = $row['mcat_id'];
            		$top = $row['tcat_id'];
            		?>
					<tr>
	                    <td><?php echo $i; ?></td>
	                    <td><?php echo $row['lcat_name']; ?></td>
	                    <td>
	                       <?php
	                       $det = $pdo->prepare("SELECT * FROM tbl_mid_category where mcat_id='$id';");
	                       $det->execute();
            	           $result = $det->fetchAll(PDO::FETCH_ASSOC);
            	           foreach ($result as $rowe) {
            	           
            	               $mcat = $rowe['mcat_name'];
            	           }
            	           echo $mcat;
	                       ?>
	                   </td>
                        <td>
                            <?php
	                       $det = $pdo->prepare("SELECT * FROM tbl_top_category where tcat_id='$top';");
	                       $det->execute();
            	           $result = $det->fetchAll(PDO::FETCH_ASSOC);
            	           foreach ($result as $rowe) {
            	           
            	               $mcat = $rowe['tcat_name'];
            	           }
            	           echo $mcat;
	                       ?>
                        </td>
                        
	                    <td>
	                        <a href="low-category-edit.php?id=<?php echo $row['lcat_id']; ?>" class="btn btn-primary btn-xs">Edit</a>
	                        <a href="#" class="btn btn-danger btn-xs" data-href="low-category-delete.php?id=<?php echo $row['lcat_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
	                    </td>
	                </tr>
            		<?php
            	}
            	?>
            </tbody>
          </table>
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
                <p>Are you sure want to delete this item?</p>
                <p style="color:red;">Be careful! All products and end level categories under this mid level category will be deleted from all the tables like order table, payment table, size table, color table, rating table etc.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>
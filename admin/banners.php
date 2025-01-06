<?php require_once('header.php'); ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Products</h1>
	</div>
	<div class="content-header-right">
		<a href="banner-add.php" class="btn btn-primary btn-sm">Add New</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
						<thead class="thead-dark">
							<tr>
								<th width="10">#</th>
								<th>Banner</th>
								<th>Mobile Banner</th>
								<th width="160">Page Name</th>
								<th width="80">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 0;
							$statement = $pdo->prepare("SELECT * FROM banners ORDER BY id ");
							$statement->execute();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);
							//print_r($result); exit;
							foreach ($result as $row) {
								$i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td style="width:82px;"><img src="assets/images/banner-image/<?php echo $row['banners']; ?>" alt="<?php echo $row['p_name']; ?>" style="width:80px;"></td>
									<td style="width:82px;"><img src="assets/images/banner-image/<?php echo $row['mbanner']; ?>" alt="<?php echo $row['p_name']; ?>" style="width:80px;"></td>
									<td><?php echo $row['page_name']; ?></td>
									<td>
										<a href="banner-edit.php?id=<?php echo $row['id']; ?>" class=" btn-primary btn-xs">Edit</a>
										<a href="#" class="btn btn-danger btn-xs" data-href="delete-banner.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
									</td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
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
				<p style="color:red;">Be careful! This product will be deleted from the order table, payment table, size table, color table and rating table also.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<a class="btn btn-danger btn-ok">Delete</a>
			</div>
		</div>
	</div>
</div>
<?php require_once('footer.php'); ?>
<?php
include 'inc/config.php';
if($_POST['id'])
{
	$id = $_POST['id'];
	
	$statement = $pdo->prepare("SELECT * FROM tbl_low_category WHERE mcat_id=?");
	$statement->execute(array($id));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	?><option value="">Select Low Level Category</option><?php						
	foreach ($result as $row) {
		?>
        <option value="<?php echo $row['lcat_id']; ?>"><?php echo $row['lcat_name']; ?></option>
        <?php
	}
}
<?php require_once('header.php'); ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_low_category WHERE lcat_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php



	// Delete from tbl_mid_category
	$statement = $pdo->prepare("DELETE FROM tbl_low_category WHERE lcat_id=?");
	$statement->execute(array($_REQUEST['id']));

	header('location: low-category.php');
?>
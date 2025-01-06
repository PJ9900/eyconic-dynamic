<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['ides'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_customer_review WHERE id=?");
	$statement->execute(array($_REQUEST['ides']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	} else {
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) {
			$cust_status = $row['cust_status'];
		}
	}
}
?>

<?php
if($cust_status == 0) {$final = 1;} else {$final = 0;}
$statement = $pdo->prepare("UPDATE tbl_customer_review SET cust_status=? WHERE id=?");
$statement->execute(array($final,$_REQUEST['ides']));

header('location: customer-review.php');
?>
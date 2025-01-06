<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM banners WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	unlink('assets/images/banner-image/' . $row['banners']);
	unlink('assets/images/banner-image/' . $row['mbanner']);
	$total = $statement->rowCount();
	if ($total == 0) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php
// Delete from tbl_faq
$statement = $pdo->prepare("DELETE FROM banners WHERE id=?");
$statement->execute(array($_REQUEST['id']));

header('location: banners.php');
?>
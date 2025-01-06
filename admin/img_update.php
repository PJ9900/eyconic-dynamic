<?php
include 'inc/config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_id = $_POST['data_id'];
    $dn = $_POST['dn'];
$fileInfo = pathinfo($dn);
$fn = basename($fileInfo['filename']);
    if (!empty($_FILES['file'])) {
        $file = $_FILES['file'];
        $uploadDir = "img/";
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFileName = $fn . '.' . $fileExtension; // Include the file extension in the new name
        $destination = "../assets/images/product-image/" . $newFileName;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $statement = $pdo->prepare("UPDATE tbl_product_photo SET photo=? where pp_id=?");
        	$statement->execute(array($newFileName,$data_id));
            echo $destination;
        } else {
            // Error handling if file upload fails
            echo "File upload failed.";
        }
    } else {
        echo "No file selected for upload.";
    }
} else {
    echo "Invalid request.";
}
?>


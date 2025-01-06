<?php require_once('header.php');
if (isset($_POST['add'])) {
    // echo "ewwe";exit;
    $valid = 1;
    $path = $_FILES['mim']['name'];
    $path_tmp = $_FILES['mim']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'webp') {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif, webp or png file<br>';
        }
    }
    if ($valid == 1) {



        // 			unlink('assets/images/category-banner/'.$_POST['current_photo']);



        $final_name = 'mob-cat-banner-' . $_POST['bid'] . '.' . $ext;
        move_uploaded_file($path_tmp, 'assets/images/category-banner/' . $final_name);
        $statement = $pdo->prepare("UPDATE tbl_top_category SET mbanner=? WHERE tcat_id=?");
        $statement->execute(array($final_name, $_POST['bid']));


        $success_message = 'Slider is updated successfully!';
    }
}


?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Blog</h1>
    </div>
    <div class="content-header-right">
        <a href="blog-add.php" class="btn btn-primary btn-sm">Add New</a>
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
                                <th>Name</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Short Description</th>
                                <th>Slug</th>
                                <th>Meta Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * FROM blogs ORDER BY id DESC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['name']; ?></td>

                                    <td>
                                        <?php
                                        if ($row['status'] == 1) {
                                            echo 'Active';
                                        } else {
                                            echo 'Deactive';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['short_description']; ?></td>
                                    <td><?php echo $row['slug']; ?></td>
                                    <td><?php echo $row['meta_description']; ?></td>
                                    <td>
                                        <a href="blog-edit.php?id=<?php echo $row['id']; ?>" class=" btn-primary btn-xs">Edit</a>
                                        <a href="#" class="btn-danger btn-xs" data-href="blog-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
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
                <!-- <p style="color:red;">Be careful! All products, mid level categories and end level categories under this top lelvel category will be deleted from all the tables like order table, payment table, size table, color table, rating table etc.</p> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" href="blog-delete.php?id=<?php echo $row['id']; ?>">Delete</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>
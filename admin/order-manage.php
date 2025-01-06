<?php
include("inc/config.php");
$statement = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
        $statement->execute(array($_POST['payment_id']));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
        foreach ($result as $row) {
            $aws=$row['aws_no'];
            $dlink=$row['delivery_link'];
            $rtd=$row['rtd'];
            $os=$row['OrderStatus'];
        }
?>
<div class="form-group">
    <label>AWS Number</label>
    <input class="form-control" value="<?php echo $aws ?>" name="aws" type="text">
    <input class="form-control" value="<?php echo $_POST['payment_id']; ?>" name="pid" type="hidden">
</div>
<div class="form-group">
    <label>Delivery Link:</label>
    <input class="form-control" value="<?php echo $dlink; ?>" name="dlink" type="text">
</div>
<div class="form-group">
    <label>Ready to dispatch</label>
    <?php 
    if($rtd=='1')
    { 
    echo "<input type='text' class='form-control' readonly value='Dispached'>";
    ?>
        <input type="hidden" name="rtd" value="<?php echo $rtd ?>" ><?php
    }else{
    ?>
        <select name="rtd" class="form-control">
            <option value="0">No</option>
            <option value="1">yes</option>
        </select>
    <?php }    ?>
    
</div>
<div class="form-group">
    <label>Delivered</label>
        <?php
         if($os=='1')
    {
    echo "<input type='text' class='form-control' readonly value='Delivered'>";
    ?>
        <input type="hidden" name="status" value="<?php echo $os?>" ><?php
    }else{
    ?>
        <select name="status" class="form-control">
            <option value="0">Pending</option>
            <option value="1">Delivered</option>
            <option value="2">Cancelled</option>
        </select>
    <?php } ?>
</div>
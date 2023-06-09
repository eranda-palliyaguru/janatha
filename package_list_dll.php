
<table width='100%' id="my" class='table'>
    <tr>
        <th>Name</th>
        <th>QTY</th>
        <th>Cost</th>
        <th>O Price</th>
        <th>Price</th>
        <th>#</th>
    </tr>

<?php
session_start();
include('connect.php');
date_default_timezone_set("Asia/Colombo"); 
$id=$_GET['id'];

$result = $db->prepare("DELETE FROM package_list WHERE  id= '$id' ");
	$result->bindParam(':memid', $id);
	$result->execute();


    $result = $db->prepare("SELECT * FROM package_list WHERE package_id ='0' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?>

<tr class="pack_record">
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['qty']; ?></td>
        <td><?php echo $row['cost']; ?></td>
        <td>Rs.<?php echo $row['o_price']; ?></td>
        <td>Rs.<?php echo $row['price']; ?></td>
<td>
        <b class="btn btn-danger dllpack" id="<?php echo $row['id']; ?>" onclick="dll(<?php echo $row['id']; ?>)" ><i class="icon-trash">x</i></b></td>
    </tr>

    <?php } ?>
</table>
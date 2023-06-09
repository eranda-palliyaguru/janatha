<table width='100%' id="my" class='table'>
    <tr>
        <th>Name</th>
        <th>QTY</th>
        <th>Cost</th>
        <th>O Price</th>
        <th>Price</th>
        <th>#</th>
    </tr>

    <?php  include('connect.php');

$mat=$_GET['mat'];
$qty=$_GET['qty'];
$price=$_GET['price'];

$result = $db->prepare("SELECT * FROM product WHERE product_id='$mat'");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ $name=$row['name']; $o_price=$row['sell']; $cost=$row['cost']; }

$sql = "INSERT INTO package_list (name,qty,cost,o_price,price,product_id) VALUES (?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($name,$qty,$cost,$o_price,$price,$mat));


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



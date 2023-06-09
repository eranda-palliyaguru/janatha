
<table width='100%' class='table' >
<?php  include('connect.php');

$id=$_GET['id'];



$result = $db->prepare("DELETE FROM use_product WHERE  id= '$id' ");
	$result->bindParam(':memid', $id);
	$result->execute();


$result = $db->prepare("SELECT * FROM use_product WHERE main_product ='0' ");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?>


    <tr >
        <td><?php echo $row['product_name']; ?></td>
        <td><?php echo $row['qty']; ?></td>
        <td><b class="btn btn-danger dllpack" id="<?php echo $row['id']; ?>"  onclick="dll(<?php echo $row['id']; ?>)">
        <i class="icon-trash">x</i></b></td>
    </tr>

<?php } ?>
</table>
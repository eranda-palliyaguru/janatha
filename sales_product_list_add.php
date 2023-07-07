


<?php 
session_start();
include('connect.php');

$invo=$_GET["invo"];
$product_id=$_GET["id"];
$qty=$_GET["qty"];
$price=$_GET["price"];
$type=$_GET["type"];
$name=$_GET["name"];

if($product_id=='non'){
    echo '<h3 style="color: darkred;"> Please select a product </h3>';
}else{

$result = $db->prepare("SELECT * FROM product WHERE product_id='$product_id'");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
  //  $name=$row['name'];
}


$date=date('Y-m-d');
$sql = "INSERT INTO sales_list (product_id,name,invoice_no,price,qty,service_type,date,amount) VALUES (?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($product_id,$name,$invo,$price,$qty,$type,$date,$price*$qty));
}
?>

<table id="example2" class="table table-bordered table-hover">
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>QTY</th>
                                                    <th>Dic (Rs.)</th>
                                                    <th>Price (Rs.)</th>
                                                    <th>Amount (Rs.)</th>
                                                    <th>#</th>
                                                </tr>
                                                <tr style="background-color: #FFA245;">
                                                    <td colspan="6">
                                                        Supply
                                                    </td>

                                                </tr>
                                                <?php $total=0; $supTot=0; $style="";
                                            $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invo' AND service_type = 'supply'");
		                                    $result->bindParam(':userid', $res);
		                                    $result->execute();
		                                    for($i=0; $row = $result->fetch(); $i++){
			                                $pro_id=$row['product_id'];
                                            ?>

                                                <tr>
                                                    <td width="40%"><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td align="right"><?php echo $row['dic']; ?></td>
                                                    <td align="right"><?php echo $row['price']; ?></td>
                                                    <td align="right"><?php echo $row['amount']; ?></td>
                                                    <td width="5%"> <a
                                                            href="sales_dll.php?id=<?php echo $row['id']; ?>&invo=<?php echo $invo; ?>">
                                                            <button class="btn btn-danger"><i
                                                                    class="fa fa trash">X</i></button></a></td>
                                                    <?php  $supTot+=$row['amount']; $total+=$row['amount']; ?>
                                                </tr>
                                                <?php } ?>
                                                <tr style="background-color: #C8C8C8;">

                                                    <td align="right" colspan="4">Total</td>
                                                    <td>Rs.<?php echo $supTot; ?></td>
                                                    <td></td>

                                                </tr>

                                                <tr style="background-color: #FFA245; ">
                                                    <td colspan="6">
                                                        Remove & Refitting
                                                    </td>

                                                </tr>
                                                <?php  $supTot=0; $style="";
                                            $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invo' AND service_type = 'refit'");
		                                    $result->bindParam(':userid', $res);
		                                    $result->execute();
		                                    for($i=0; $row = $result->fetch(); $i++){
			                                $pro_id=$row['product_id'];
                                            ?>

                                                <tr>
                                                    <td width="50%"><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td align="right"><?php echo $row['dic']; ?></td>
                                                    <td align="right"><?php echo $row['price']; ?></td>
                                                    <td align="right"><?php echo $row['amount']; ?></td>
                                                    <td width="5%"> <a
                                                            href="sales_dll.php?id=<?php echo $row['id']; ?>&invo=<?php echo $invo; ?>">
                                                            <button class="btn btn-danger"><i
                                                                    class="fa fa trash">X</i></button></a></td>
                                                    <?php  $supTot+=$row['amount']; $total+=$row['amount']; ?>
                                                </tr>
                                                <?php } ?>
                                                <tr style="background-color: #C8C8C8;">

                                                    <td colspan="4" align="right">Total</td>
                                                    <td>Rs.<?php echo $supTot; ?></td>
                                                    <td></td>

                                                </tr>



                                                <tr style="background-color: #FFA245;">
                                                    <td colspan="6">
                                                        Repair
                                                    </td>

                                                </tr>
                                                <?php  $supTot=0; $style="";
                                            $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invo' AND service_type = 'repair'");
		                                    $result->bindParam(':userid', $res);
		                                    $result->execute();
		                                    for($i=0; $row = $result->fetch(); $i++){
			                                $pro_id=$row['product_id'];
                                            ?>

                                                <tr>
                                                    <td width="50%"><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td align="right"><?php echo $row['dic']; ?></td>
                                                    <td align="right"><?php echo $row['price']; ?></td>
                                                    <td align="right"><?php echo $row['amount']; ?></td>
                                                    <td width="5%"> <a
                                                            href="sales_dll.php?id=<?php echo $row['id']; ?>&invo=<?php echo $invo; ?>">
                                                            <button class="btn btn-danger"><i
                                                                    class="fa fa trash">X</i></button></a></td>
                                                    <?php  $supTot+=$row['amount']; $total+=$row['amount']; ?>
                                                </tr>
                                                <?php } ?>
                                                <tr style="background-color: #C8C8C8;">
                                                    <td colspan="4" align="right">Total</td>
                                                    <td>Rs.<?php echo $supTot; ?></td>
                                                    <td></td>

                                                </tr>




                                                <tr style="background-color: #FFA245;">
                                                    <td colspan="6"> Paint </td>

                                                </tr>
                                                <?php  $supTot=0; $style="";
                                            $result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no = '$invo' AND service_type = 'paint'");
		                                    $result->bindParam(':userid', $res);
		                                    $result->execute();
		                                    for($i=0; $row = $result->fetch(); $i++){
			                                $pro_id=$row['product_id'];
                                            ?>

                                                <tr>
                                                    <td width="50%"><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['qty']; ?></td>
                                                    <td align="right"><?php echo $row['dic']; ?></td>
                                                    <td align="right"><?php echo $row['price']; ?></td>
                                                    <td align="right"><?php echo $row['amount']; ?></td>
                                                    <td width="5%"> <a
                                                            href="sales_dll.php?id=<?php echo $row['id']; ?>&invo=<?php echo $invo; ?>">
                                                            <button class="btn btn-danger"><i
                                                                    class="fa fa trash">X</i></button></a></td>
                                                    <?php  $supTot+=$row['amount']; $total+=$row['amount']; ?>
                                                </tr>
                                                <?php } ?>
                                                <tr style="background-color: #C8C8C8;">
                                                    <td colspan="4" align="right">Total</td>
                                                    <td>Rs.<?php echo $supTot; ?></td>
                                                    <td></td>

                                                </tr>


                                            </table>

                                            <?php 
                                        $adv=0;
                                        $result1 = $db->prepare("SELECT * FROM sales WHERE invoice_number='$invo' ");
                                        $result1->bindParam(':userid', $a1);
                                        $result1->execute();
                                        for($i=0; $row1 = $result1->fetch(); $i++){
                                        $adv=$row1['advance'];
                                        $customer_id=$row1['customer_id'];
                                        $job_no=$row1['job_no'];
                            
                                        } ?>
                                            <table align="right" cellpadding="0" cellspacing="0" border="0" width="30%">
                                                <tr>
                                                    <td style="font-size:20px" align="right">Total:</td>
                                                    <td style="font-size:20px" align="right">
                                                        Rs.<?php echo number_format($total,2); ?></td>
                                                    <td width="15%"></td>
                                                </tr>

                                                <tr>
                                                    <td align="right">Advance:</td>
                                                    <td align="right">Rs.<?php echo number_format($adv,2); ?></td>
                                                    <td width="15%"></td>
                                                </tr>

                                                <tr>
                                                    <td align="right">Balance:</td>
                                                    <td align="right">Rs.<?php echo number_format($total-$adv,2); ?>
                                                    </td>
                                                    <td width="15%"></td>
                                                </tr>
                                            </table>

  <!-- Theme style -->
<?php 
session_start();
include('connect.php');


$area=$_GET["area"];
$type=$_GET["type"];
$invo=$_GET["invo"];

if($type=='supply'){$color="#0192A3";}
if($type=='repair'){$color="#08A301";}
if($type=='refit'){$color="#CE0000";}
if($type=='paint'){$color="#F0A301";}

if($area=='front'){$category=1;}
if($area=='rear'){$category=2;}
if($area=='eroom'){$category=3;}
if($area=='room'){$category=4;}


$result = $db->prepare("SELECT * FROM sales_list WHERE invoice_no='$invo' ");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
            $pro[]=$row['product_id'].'_'.$row['service_type'];
            
        }

		if(isset($_GET['serch'])){ 
			$serch=$_GET['serch'];
			$result = $db->prepare("SELECT * FROM product WHERE category='$category' AND $type > 0 AND name LIKE '$serch%' ");
		}else{
			$result = $db->prepare("SELECT * FROM product WHERE category='$category' AND $type > 0");
		}

		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
           $pro_id=$row['product_id'].'_'.$type;

if(in_array($pro_id, $pro)){}else{
	
?>

<div id="ls_<?php echo $row['product_id'] ?>" ondblclick="list_update(<?php echo $row['product_id'].','.$row[$type] ?>)" onclick="list_load(<?php echo $row['product_id'] ?>,<?php echo $row[$type] ?>)" style="border-radius: 15px; width:90%; background-color: <?php echo $color; ?>; color:aliceblue; text-align:center;margin: 10px; font-size:18px"><?php echo $row['name'] ?></div>
<?php } } ?>


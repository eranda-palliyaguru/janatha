
<!DOCTYPE html>
<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

</head>
<body>	

<?php
include("../connect.php");
$connect = $db;
$invoice_no=$_GET['id'];
date_default_timezone_set("Asia/Colombo");

	$result1 = $connect->prepare("SELECT * FROM sales WHERE  invoice_number='$invoice_no'  ");
		$result1->bindParam(':userid', $res);
		$result1->execute();
		for($i=0; $row1 = $result1->fetch(); $i++){
		$date=date("Y-m-d");
		$time=date("H.i");
		$job_no=$row1['job_no'];
		$cus_id=$row1['customer_id'];
		
		$result = $connect->prepare("SELECT * FROM job WHERE  id='$job_no'  ");
		$result->bindParam(":userid", $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){ $job_type=$row['job_type']; }
		
		$result = $connect->prepare("SELECT * FROM customer WHERE  customer_id='$cus_id'  ");
		$result->bindParam(":userid", $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){ $send_mail=$row['email']; $name=$row['customer_name']; }
		
		
		if($job_type==1){
		$h1="Vehicle no:";
		$h2="Mileage:";
		$h3="Next Service:";
		$vehicle_no=$row1['vehicle_no'];
		$km=$row1['km']." Km";
		$next_km=$row1['plus_km']+$row1['km']." Km";
		}else{
		$h1="Vehicle no:";
		$h2="Model:";
		$h3="";
		$vehicle_no=$row1['vehicle_no'];
		$km=$row1['model'];
		$next_km=" ";
		}

		$sales_list="";
		$result = $connect->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invoice_no'  ");
		$result->bindParam(":userid", $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
		    
		    
		    $u_to=$row['price']+$row['dic'];
			$u_pri=$u_to/$row['qty'];
			
			$sales_list.='
			         <tr>
						<td style="border-bottom: 1px solid #ccc;">'.$row["code"].'</td>
						<td style="border-bottom: 1px solid #ccc;">'.$row["name"].'</td>
						<td align="center" style="border-bottom: 1px solid #ccc;">'.$row["qty"].'</td>
						<td align="right" style="border-bottom: 1px solid #ccc;">'.number_format( $u_pri,2).'</td>
						<td align="right" style="border-bottom: 1px solid #ccc;">'.number_format($row["price"],2).'</td>
					 </tr>
			';
		}
$message = '';

	
	$output .= '
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
<style>
body {
  font-family: Poppins;
}
</style>
</head>
<body>
<table style="font-size: 12px;"  cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td>
				<table  cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td valign="top" width="50%">
							<img src="../RHN Logo.jpg" alt="Logo" style="max-width:150px;"><br>
							 <b style="font-family: '."'Poppins'".'; font-size:17px">STARTUP Auto Care</b>
         <p>52/B/1, 10th Mile Post,  <br>
		 Katuwawala,  <br>
		 Boralasgauwa <br><br>
         Call: 0112 150 400<br>
		 E-mail: startupautoare@gmail.com<br>
         www.rhntrading.com <br><br>
         <b style="font-size:20px">Bill To:</b><br>
         '.$row1["customer_name"].'<br>
         
						</td>
						<td align="right" valign="top" width="50%">
							<b style="font-family: '."'Poppins'".'; font-size:30px">INVOICE</b><br>
							<b>#'.$invoice_no.'</b>
							<p>Date: '.date('Y-M-d').' Time:'.date('H:m').'</p>
							
							
							<table align="right" cellpadding="0" cellspacing="0" border="0" width="70%">
							<tr>
							   <td align="right">'.$h1.'</td>
							   <td align="right">'.$vehicle_no.'</td>
							</tr>
							
							<tr>
							   <td align="right">'.$h2.'</td>
							   <td align="right">'.$km.'</td>
							</tr>
							
							<tr>
							   <td align="right">'.$h3.'</td>
							   <td align="right">'.$next_km.'</td>
							</tr>
							</table>
						</td>
					</tr>
					
				</table>
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
		</tr>
		<tr>
			<td>
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<th style="border-bottom: 1px solid #ccc;">ID</th>
						<th style="border-bottom: 1px solid #ccc;">Description</th>
						<th style="border-bottom: 1px solid #ccc;">Quantity</th>
						<th align="right" style="border-bottom: 1px solid #ccc;">Unit Price</th>
						<th align="right" style="border-bottom: 1px solid #ccc;">Total</th>
					</tr>
					
					'.$sales_list.'
					
					<tr>
						<td style="font-size:20px" colspan="4" align="right"><h3>Total:</h3></td>
						<td style="font-size:20px" align="right"><h3>Rs.'.number_format($row1["amount"],2).'</h3></td>
					</tr>
					<tr>
					    <td align="center"><img src="../img/cloud arm 2.png" width="40" alt=""></td>
						<td colspan="3" align="right">Pay Amount:</td>
						<td align="right">Rs.'.number_format($row1["amount"]+$row1["balance"],2).'</td>
					</tr>
					<tr>
					    <td align="center">CLOUD ARM</td>
						<td colspan="3" align="right">Balance:</td>
						<td align="right">Rs.'.number_format($row1["balance"],2).'</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	</body>
</html>
	';

function fetch_customer_data($output)
{		
	return $output;
}

//$send_mail="erandasampath2000@gmail.com";
$cc="";
//$name="RHN TRADING COMPANY (PVT) LTD";
				
	include('pdf.php');
	$file_name = 'pdf/'.date("Y-m-d"). '.pdf';
	$html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
	$html_code .= fetch_customer_data($output);
	$pdf = new Pdf();
	$pdf->load_html($html_code);
	$pdf->render();
	$file = $pdf->output();
	file_put_contents($file_name, $file);
	
	require 'class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->IsSMTP();								//Sets Mailer to send message using SMTP
	$mail->Host = 'mail.rhntrading.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '587';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'invoice@rhntrading.com';					//Sets SMTP username
	$mail->Password = 'gx~0e~X]Clr}';					//Sets SMTP password
	$mail->SMTPSecure = '';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'invoice@rhntrading.com';			//Sets the From email address for the message
	$mail->FromName = 'RHN TRADING COMPANY (PVT) LTD';			//Sets the From name of the message
	$mail->AddAddress($send_mail, $name);		//Adds a "To" address
	$mail->AddCC('info@rhntrading.com');
	//$mail->AddCC($cc);
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Invoice ';			//Sets the Subject of the message
	$mail->Body = 'Dear Sir / Madam,<br><br>
Thank you for your business.<br><br>

We truly value our loyal customers. Thanks for making us who we are!<br>

Pl’s find attach invoice for your kind consideration.<br><br><br>

Your feedback is important to us. Would you mind writing a short review of your last experience with us using below link. <br>
https://g.page/r/CYm-4ALu7PueEBI/review<br>
We appreciate your business and your loyalty. Hope to see you soon. <br><br>

Sincerely, <br>

RHN Car Wash Team <br>

Hot Line : 0707 485 485';				//An HTML or plain text message body
	if($mail->Send())								//Send an Email. Return true on success or false on error
	{
		$message = '<label class="text-success">Customer Details has been send successfully...</label>';
		
		
$sql = "INSERT INTO e_mail (customer_id,customer,email,cc,type,date,time,invoice_number) VALUES (?,?,?,?,?,?,?,?)";
$ql = $db->prepare($sql);
$ql->execute(array($cus_id,$name,$send_mail,$cc,'invoice',$date,$time,$invoice_no));
		
$sql = "UPDATE sales 
        SET email=?
		WHERE invoice_number=?";
$q = $db->prepare($sql);
$q->execute(array("2",$invoice_no));
	}
	unlink($file_name);

	}	 

//if(!$customer_id){header("location: index.php");}
?>

		<br />
		<div class="container">
			<h3 align="center">Create Dynamic PDF Send As Attachment with Email in PHP</h3>
			<br />
			<form method="post">
				<input type="submit" name="action" class="btn btn-danger" value="PDF Send" /><?php echo $message; ?>
			</form>
			<br />
			<?php
			echo fetch_customer_data($output);
			?>			
		</div>
		<br />
		<br />
		  <?php
$sec = "1";
?><meta http-equiv="refresh" content="<?php echo $sec;?>;URL='../index.php'">
	</body>
</html>






<?php
	session_start();
    include("condb.php");  
?>

<meta  charset=utf-8 >

<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php
	/**echo '<pre>';
	print_r($_SESSION);
	echo '</pre>';
	
	echo '<hr>';
	
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	**/
	
	$taxid = $_POST["Tax_id"];
	$name_com = $_POST["Name_com"];
	$phone = $_POST["phone"];
	$address = $_POST["address"];
	$total= $_POST["total"];
	$dttm = Date("Y-m-d G:i:s");
	//บันทึกการสั่งซื้อลงใน order_detail
	mysqli_query($con, "BEGIN"); 

	$sql1	= "INSERT INTO tax_com
	VALUES ( null, '$taxid','$name_com','$phone','$address',$total,'$dttm')";
	$query1	= mysqli_query($con, $sql1);
	//echo $sql1;
	
	//ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
	$sql2 = "SELECT MAX(o_id) AS o_id FROM tax_com WHERE Tax_id = '$taxid' AND Name_com = '$name_com'AND p_date = '$dttm' ";
	$query2	= mysqli_query($con, $sql2);
	$row = mysqli_fetch_array($query2);
	$o_id = $row["o_id"];

	//echo '<br>';
	//echo $sql2;
	//echo '<br>';
	//echo $o_id;

//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array

foreach($_SESSION['product_cart']as $p_id => $qty){
	$sql3	= "SELECT * FROM tbl_product WHERE p_id=$p_id";
		$query3	= mysqli_query($con, $sql3);
		$row3	= mysqli_fetch_array($query3);
		$pricetotal	= $row3['price']*$qty;
		/**echo '<pre>';
		echo $sql3;
		echo '<pre>';**/
		$sql4	= "INSERT INTO tax_product VALUES (null, $o_id, $p_id, $qty, $pricetotal)";
		$query4	= mysqli_query($con, $sql4);
		/**echo '<pre>';
		echo $sql4;
		echo '<pre>';**/
	}
		
	if($query1 && $query4){
		mysqli_query($con, "COMMIT");
		$msg = "บันทึกข้อมูลเรียบร้อยแล้ว ";
		foreach($_SESSION['product_cart']as $p_id)
		{
			unset($_SESSION['product_cart']);
		}
	}
	else{
		mysqli_query($con, "ROLLBACK");  
		$msg = "บันทึกข้อมูลไม่สำเร็จ ";	
	}
?>
<script type="text/javascript">
	alert("<?php echo $msg;?>");
	window.location ='product_list.php';
</script>

 
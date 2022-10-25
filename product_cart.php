<?php
session_start();
include('condb.php');
$ID = $_SESSION['p_id'];

$p_id = mysqli_real_escape_string($con, $_GET['p_id']);
$act = mysqli_real_escape_string($con, $_GET['act']);

if ($act == 'add' && !empty($p_id)) {
	if (isset($_SESSION['product_cart'][$p_id])) {
		$_SESSION['product_cart'][$p_id]++;
	} else {
		$_SESSION['product_cart'][$p_id] = 1;
	}
}

if ($act == 'remove' && !empty($p_id))  //ยกเลิกการสั่งซื้อ
{
	unset($_SESSION['product_cart'][$p_id]);
}

if ($act == 'update') {
	$amount_array = $_POST['amount'];
	foreach ($amount_array as $p_id => $amount) {
		$_SESSION['product_cart'][$p_id] = $amount;
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Shopping Cart</title>
</head>

<body>
	<form id="frmcart" name="frmcart" method="post" action="?act=update">
		<table width="600" border="0" align="center" class="square">
			<tr>
				<td colspan="5" bgcolor="#CCCCCC">
					<b>ตะกร้าสินค้า</span>
				</td>
			</tr>
			<tr>
				<td bgcolor="#EAEAEA">สินค้า</td>
				<td align="center" bgcolor="#EAEAEA">ราคา</td>
				<td align="center" bgcolor="#EAEAEA">จำนวน</td>
				<td align="center" bgcolor="#EAEAEA">รวม(บาท)</td>
				<td align="center" bgcolor="#EAEAEA">ลบ</td>
			</tr>
			<?php
			$total = 0;
			if (!empty($_SESSION['product_cart'])) {

				foreach ($_SESSION['product_cart'] as $p_id => $qty) {
					$sql = "SELECT * FROM tbl_product WHERE p_id=$p_id";
					$query = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($query);
					$sum = $row['price'] * $qty;
					$total += $sum;
					echo "<tr>";
					echo "<td width='334'>" . $row["p_name"] . "</td>";
					echo "<td width='46' align='right'>" . number_format($row["price"], 2) . "</td>";
					echo "<td width='57' align='right'>";
					echo "<input type='text' name='amount[$p_id]' value='$qty' size='2'/></td>";
					echo "<td width='93' align='right'>" . number_format($sum, 2) . "</td>";
					//remove product
					echo "<td width='46' align='center'><a href='product_cart.php?p_id=$p_id&act=remove'>ลบ</a></td>";
					echo "</tr>";
				}
				echo "<tr>";
				echo "<td colspan='3' bgcolor='#CEE7FF' align='center'><b>ราคารวม</b></td>";
				echo "<td align='right' bgcolor='#CEE7FF'>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
				echo "<td align='left' bgcolor='#CEE7FF'></td>";
				echo "</tr>";
			}
			?>
			<tr>
				<td><a href="product_list.php">กลับหน้ารายการสินค้า</a></td>
				<td colspan="4" align="right">
					<input type="submit" name="button" id="button" value="ปรับปรุง" />
					<input type="button" name="Submit2" value="สั่งซื้อ" onclick="window.location='product_cart_confirm.php';" />
				</td>
			</tr>
		</table>
	</form>
</body>

</html>
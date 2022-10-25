<?php
session_start();
include("condb.php");
?>
<html>

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#phone").change(function() {
				$("#phone").empty();
				
				$.post("returncustomer.php", {
					phone: $("#phone").val()
				}).done(function(data) {

					console.log('success jaa');
					console.log(JSON.parse(data), typeof data, data["Tax_id"]);

					if (!data) return;
					data = JSON.parse(data);

					$("#Tax_id").val(data["Tax_id"]);
					$("#Name_com").val(data["Name_com"]);
					$("#phone").val(data["Phone"]);
					$("#address").val(data["Address"]);
					// })
				}).fail(function(e) {
					console.log(e);
				})


			});
		});
	</script>

	<!DOCTYPE html>
	<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Checkout</title>

	</head>

<body>
	<form id="frmcart" name="frmcart" method="post" action="product_tax_save.php">
		<table width="600" border="0" align="center" class="square">
			<tr>
				<td width="1558" colspan="4" bgcolor="#FFDDBB">
					<strong>สั่งซื้อสินค้า</strong>
				</td>
			</tr>
			<tr>
				<td bgcolor="#F9D5E3">สินค้า</td>
				<td align="center" bgcolor="#F9D5E3">ราคา</td>
				<td align="center" bgcolor="#F9D5E3">จำนวน</td>
				<td align="center" bgcolor="#F9D5E3">รวม/รายการ</td>
			</tr>
			<?php
			$total = 0;
			foreach ($_SESSION['product_cart'] as $p_id => $qty) {
				$sql	= "SELECT * FROM tbl_product WHERE p_id=$p_id";
				$query	= mysqli_query($con, $sql);
				$row	= mysqli_fetch_array($query);
				$sum	= $row['price'] * $qty;
				$total	+= $sum;
				echo "<tr>";
				echo "<td>" . $row["p_name"] . "</td>";
				echo "<td align='right'>" . number_format($row['price'], 2) . "</td>";
				echo "<td align='right'>$qty</td>";
				echo "<td align='right'>" . number_format($sum, 2) . "</td>";
				echo "</tr>";
			}
			echo "<tr>";
			echo "<td  align='right' colspan='3' bgcolor='#F9D5E3'><b>รวม</b></td>";
			echo "<td align='right' bgcolor='#F9D5E3 id='total' name='total''>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
			echo "</tr>";
			?>
		</table>

		<p>

			<head>

				<table border="0" cellspacing="0" align="center">
					<tr>
						<td colspan="2" bgcolor="#CCCCCC">ใบกำกับภาษี</td>
					</tr>
					<tr>
						<td bgcolor="#EEEEEE">Tax ID</td>
						<td><input name="Tax_id" type="text" id="Tax_id"></td>
					</tr>
					<tr>
						<td bgcolor="#EEEEEE">Corparation Name</td>
						<td><input name="Name_com" type="text" id="Name_com"></td>
					</tr>
					<tr>
						<td bgcolor="#EEEEEE">Phone</td>
						<td><input name="phone" type="text" id="phone"></td>
					</tr>
					<tr>
						<td width="22%" bgcolor="#EEEEEE">ที่อยู่</td>
						<td width="78%">
							<textarea name="address" cols="35" rows="5" id="address"></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center" bgcolor="#CCCCCC">
							<input type="hidden" name="total" value="<?php echo $total ?>">
							<input type="submit" name="Submit" value="สั่งซื้อ" />
						</td>
					</tr>
				</table>
	</form>


</body>

</html>
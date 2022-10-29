<?php
include('h.php');
?>
<?php session_start(); 
include('condb.php');
 
  $ID = $_SESSION['ID'];
  $name = $_SESSION['name'];
  $level = $_SESSION['level'];
 	if($level!='admin'){
    Header("Location: ../logout.php");  
  }  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

</body>

</html>
<div>
  <form action="logout.php">
    <input type="submit" value="ออกจากระบบ">
</div>
<p></p>
<?php


?>
<?php
//1. เชื่อมต่อ database:
include('condb.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//2. query ข้อมูลจากตาราง 
$query = "SELECT * FROM tbl_product ORDER by p_id " ;

//3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result = mysqli_query($con, $query);
//4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:

echo  ' <table class="table table-hover">';
//หัวข้อตาราง
echo "<tr>
      <td width='5%'>ID</td>
      <td width=20%>Name</td>
      <td width=20%>Img</td>
      <td width=10%>Price</td>
      <td width=5%>เลือกสินค้า</td>
    </tr>";
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row["p_id"] .  "</td> ";
  echo "<td>" . $row["p_name"] .  "</td> ";
  echo "<td>" . "<img src='p_img/" . $row["p_img"] . "' width='100'>" . "</td>";
  echo "<td>" . $row["price"] .  "</td> ";


  echo "<td>" . "<a href='product_cart.php?p_id=$row[p_id]&act=add'> เพิ่มลงตะกร้า </a></td>";

  echo "</tr>";
}


echo "</table>";

?>
<div class="col-md-6">
  <a href="product_form_add.php">Add</a>
</div>
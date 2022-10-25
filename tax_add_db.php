<?php 
include 'condb.php';
?>

<?php
$Tax_id = $_POST['Tax_id'];
$Name_com = $_POST['Name_com'];
$Phone = $_POST['Phone'];
$Address = $_POST['Address'];

$sql = "INSERT INTO tax_com
(Tax_id, Name_com, Phone, Address)
VALUES
('$Tax_id', '$Name_com', '$Phone', '$Address')
";
$result = mysqli_query($con, $sql) or die("Error in sql : $sql" . mysqli_error($sql));
mysqli_close($con);

if($result){
    echo 'Insert Successfully';
}else{
    echo'Error!!';
}

//ทำฟอร์มสินค้าระบบคิดเงิน ทำค่าtran
//สร้างฐานข้อมูลเก็บประวิติการซื้อเก็บค่า tran
//ทำหน้า ออกtax ปุ่ม find ค่า tran เพื่อจะแสดงรายละเอียดประวัติการซื้อ
//ถ้า ลูกค้าเคยออก ทำปุ่ม search num phone เพื่อหาประวัติการออกใบกำกับภาษี

?>


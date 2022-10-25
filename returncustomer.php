<?php
include("condb.php");
$phone = $_POST["phone"];

if (!$phone) return;

$strSQL = "SELECT * FROM tax_com WHERE Phone = '" . $phone . "'";


$result = mysqli_query($con, $strSQL);

if (!$result) {
    echo "Could not successfully run query ($sql) from DB: ";
    exit;
}

if (mysqli_num_rows($result) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}

print_r(json_encode(mysqli_fetch_assoc($result)));

return json_encode(mysqli_fetch_assoc($result));

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</style>
<div class="container" style="padding-top:100px">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="background-color:#D6EAF8"> 
    <h3 align="center">
      
      Form Tax Invoice </h3>
    <form action="tax_add_db.php" method="post">
        Tax ID Corporation <br>
        <input type="text" name="Tax_id" required><br><br>
        Corporation Name <br>
        <input type="text" name="Name_com" required><br><br>
        Contact <br>
        <input type="tel" name="Phone" required><br><br>
        Address <br>
        <textarea type="text"class="form-control" style="height:100px; width:50%;" name="Address" required></textarea><br><br>
        <button type="submit" > Save </button>
        


    </form>
</body>
</html>
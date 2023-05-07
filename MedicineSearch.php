<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PERSONAL HEALTHCARE ASSISTANT">
    <meta name="author" content="Bethwel">

    <title>Search</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body style="background:url(admin/treatment.jpg);;background-repeat:no-repeat;background-size:cover">
<div id="content" class="col-md-9">
                <h2>Search Medicine</h2>
                <form class="form-horizontal" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="form-group">
                        <label class="control-label col-xs-4 col-sm-3 col-md-3 col-lg-3">Quick Search:</label>
                        <div class="col-xs-8 col-sm-7 col-md-6 col-lg-7">
                            <input type="text" class="form-control" id="symptoms" name="valueToSearch" placeholder="Write a single query!" autofocus><br />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-3 col-sm-offset-5 col-lg-offset-5 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <input style="background-color:#333;" type="submit" name="search" class="btn btn-primary" value="Search">
                            <input type="reset" class="btn btn-default" value="Reset">
                        </div>
                    </div>
                </form>
<?php

$connection=mysqli_connect('localhost','root','','cdis');


if(isset($_POST['search']))
{
$valueToSearch = $_POST['valueToSearch'];

$sql = "SELECT * FROM Medicine WHERE d_name='$valueToSearch'";
$result = mysqli_query( $connection,$sql);

?>
<table class="table table-striped">
                                <tbody>
<?php

if ($result)
 {
     $count=mysqli_num_rows($result);
     if($count>0)
  while($row = mysqli_fetch_array($result))
 {

?>

<tr><th>ID</th><th>Disease Name</th><th>Medicine</th></tr>
<tr>
<td><?php echo $row["id"]; ?></td>
<td><?php echo $row["d_name"]; ?></td>
<td><?php echo $row["Medicine"]; ?></td>
</tr>

<?php
 }
else{
    echo "Disease not found check your spellings";
}
 }
}
?>
</table>
</body>
</html>
<?php
require_once 'config.php';
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Complete Bootstrap 4 Website Layout</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link href="style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        textarea{ width: 600px; height: 200px;}
    </style>
    
</head>
<body>

	<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="img/logo.png">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
                    <a href="index.php" class="btn btn-primary">Home</a>
                    </li>
                    <li class="nav-item">
                    <a href="logout.php" class="btn btn-danger">Sign Out</a>
                    </li>
                    
				</ul>
			</div>
		</div>
	</nav>


    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>.</h1>
    </div>


    <h1>Create a new Post</h1>
<form action="new_script.php" method="post">
     <input type="text" name="title" placeholder="Post Title"/>
     <br>
     <br>
     <textarea name="post" placeholder="Write your post."></textarea>
     <br>
     
     <input type="submit" class="btn btn-primary" value="Add post"/>        
</form>

<h1>Public text</h1>


<form action="show.php"  method="post">

<?php
$con=mysqli_connect("localhost","root","","blog");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM blog_posts");
?>
<center><table border='1'>
<tr>
<th>ID</th>
<th>Title</th>
<th>Show</th>
</tr></center>

<?php
while($row = $result->fetch_assoc() )
{
?>
<tr>
<td> <?php echo $row['id_post'] ?>  </td>
<td><?php echo $row['title'] ?></td>
<td><input type="checkbox" name="<?php echo $row['id_post'] ?>" <?php $check=$row['public'];  if($check==1) echo "checked"; ?> value=1></td>
</tr>
<?php } ?>
</table>

<?php mysqli_close($con);  ?>
 <input type="submit" class="btn btn-primary" value="Save"/>           
</form>
<br>
<h1>Add image</h1>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <p>Select image to upload:</p>
        <input type="file" name="image"/>
        <input type="submit" name="submit" value="UPLOAD"/>
        </form>


<h1>Chose image to display</h1>

<form action="showp.php"  method="post">
<?php
$con=mysqli_connect("localhost","root","","blog");
$result= mysqli_query($con,"SELECT * FROM images");
?>
<center><table border='1'>
<tr>
<th>ID</th>
<th>Photo</th>
<th>Show</th>
</tr></center>
<?php
while($row = $result->fetch_assoc() )
{
?>
<tr>
<td> <?php echo $row['id'] ?>  </td>
<td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" width="50" height="50"/>'; ?> </td>
<td><input type="checkbox" name="<?php echo $row['id'] ?>" <?php $check=$row['public'];  if($check==1) echo "checked"; ?> value=1></td>
</tr>
<?php } ?>
</table>
<input type="submit" class="btn btn-primary" value="Save"/>           
</form>



<footer class="page-footer font-small blue pt-4 mt-4">
<!--Footer Links-->
<div class="container-fluid text-center text-md-left">
    <div class="row">

        <!--First column-->
        <div class="col-md-6">
            <h5 class="text-uppercase">Footer</h5>
            <p></p>
        </div>
        <!--/.First column-->

        <!--Second column-->
        <div class="col-md-6">
            <h5 class="text-uppercase"></h5>
            <ul class="list-unstyled">
                <li>
                    <a href="#!">#</a>
                </li>
                <li>
                    <a href="#!">#</a>
                </li>
                <li>
                    <a href="#!">#</a>
                </li>
                <li>
                    <a href="#!">#</a>
                </li>
            </ul>
        </div>
        <!--/.Second column-->
    </div>
</div>
<!--/.Footer Links-->

<!--Copyright-->
<div class="footer-copyright py-3 text-center">
    © 2018 Copyright:
    <a href="https://mdbootstrap.com/material-design-for-bootstrap/"> ME </a>
</div>
<!--/.Copyright-->

</footer>
</body>
</html>
<?php 
	session_start() ;
	$connect = mysqli_connect('localhost' , 'root' , '' , 'user') ;
	if(!isset($_SESSION['email'])){
		header('Location:index.php') ;
		exit();
	}
	$useremail = $_SESSION['email'];
	$usquery = mysqli_query($connect , "SELECT * FROM usertable WHERE email = '$useremail'");
		$usfetch = mysqli_fetch_assoc($usquery);
		$usemail = $usfetch['email'];
		$usname = $usfetch['name'];

	if(isset($_POST['delete'])){
		$deletequrey = mysqli_query($connect , "DELETE FROM usertable WHERE email = '$useremail'") ;
		if($deletequrey){
			header('location: logout.php') ;
		}
	}
	if(isset($_POST['update'])){
		$upname = $_POST['upname'] ;
		$upemail = $_POST['upemail'] ;
		$updatequery = mysqli_query($connect , "UPDATE usertable SET name = '$upname' , email = '$upemail' WHERE email = '$useremail'LIMIT 1") ;
		if($updatequery){
			header('location: login.php') ;
		}
	}

	 ?>
<!DOCTYPE html>
<html>
<head>
	<title>WELCOME</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
</head>
<body>
<h2>WELCOME TO OUR WEBSITE</h2>
<h1>HELLO 
	<?php 
	echo $usname;
	 ?>
</h1>
<a href="logout.php" class="btn btn-danger btn-lg">logout</a>
<div class="container">
	<form method="post"> 
		<div class="form-group">
			<input type="submit" name="delete" value="DELETE_ACCOUNT" class="btn-danger btn-lg">
		</div>
	</form>
	<div class="conainer">
		<form method="post"> 
			<div class="form-group">
				<input type="text" name="upname" value="<?php echo $usname ; ?>" class="form-control">
			</div>
			<div class="form-group">
				<input type="text" name="upemail" placeholder="email" value="<?php echo $usemail ; ?>" class="form-control">
			</div>
			<div class="form-group">
				<input type="submit" name="update" value="update" class="btn btn-primary btn-block">
			</div>
		</form>
	</div>
</div>
</body>
</html>

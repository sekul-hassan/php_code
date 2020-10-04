<?php 
session_start() ;
$connect = mysqli_connect('localhost' , 'root' , '' , 'user') ;
 $pas = $pass = "" ;

if(isset($_POST['submit'])){
	$name = $_POST['name'] ;
	$email = $_POST['email'] ;
	$password = md5($_POST['password']) ;

	
}
if(!empty($name) && !empty($email) && !empty($password)){
	$srcquery = mysqli_query($connect , " SELECT * FROM usertable WHERE email = '$email'") ;
	$numrou = mysqli_num_rows($srcquery) ;
	if($numrou > 0){
		echo "Email already taken";
	}else{
	$query = mysqli_query($connect , "INSERT INTO usertable(name,email,password) VALUES('$name' , '$email' , '$password')") ;
	if($query){
		$suss = "REGISTRATION SUCCESS";
	}
	}
}
if(isset($_POST['lgsubmit'])){
	$lgemail = $_POST['lgemail'];
	$lgpassword = md5($_POST['lgpassword']);
	if(!empty($lgemail)){
		$lgquery = mysqli_query($connect , "SELECT * FROM usertable WHERE email = '$lgemail'");
		$lgfetch = mysqli_fetch_assoc($lgquery);
		$email_fdb = $lgfetch['email'];
		$password_fdb = $lgfetch['password'];
		if($email_fdb == $lgemail && $password_fdb == $lgpassword){
			$_SESSION['email'] = $lgemail;
			header('Location:login.php');
		}else{
			echo "not match";
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>php</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min" >
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<h1 class="text-success">
					<?php 
					if(isset($suss)){
						echo $suss ;
					}
					 ?>
				</h1>
				<h1>REGISTRATION HERE</h1>
				<form method="post">
					<div class="form-group">
						<label>User Name</label>
						<input type="text" name="name" placeholder="Enter Your Full Name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>User E-mail</label>
						<input type="email" name="email" placeholder="Enter Your E-mail" class="form-control" required>
					</div>
					<div class="form-group">
						<label>User Password</label>
						<input type="password" name="password" placeholder="Enter A Password" class="form-control" required <?php if(isset($pas)){ echo $pas ;} ?> >
					</div>
					<input type="submit" name="submit" value="REGISTER" class="btn btn-info">
				</form>
			</div>
			<div class="col-md-5">
				<h2>LOGIN HERE</h2>
				<form action="" method="post">
					<div class="form-group">
						<label>User E-mail</label>
						<input type="email" name="lgemail" placeholder="Enter Your E-mail" class="form-control" required>
					</div>
					<div class="form-group">
						<label>User Password</label>
						<input type="password" name="lgpassword" placeholder="Enter A Password" class="form-control">
					</div>
					<input type="submit" name="lgsubmit" value="LOGIN" class="btn btn-info">
				</form>
			</div>
		</div>
	</div>
</body>
</html>

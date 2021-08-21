<?php
	$fname = $_POST['cust_fname'];
	$lname = $_POST['cust_lname'];
	$addr = $_POST['cust_address'];
	$phone = $_POST['cust_phone'];
	$email = $_POST['cust_email'];
	
if(!empty($fname)|| !empty($lname) || !empty($addr) || !empty($phone) || !empty($email)){
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "joe's chops";
	
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	
	if (mysqli_connect_error()){
		die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
	}else{
		$SELECT = "SELECT email From register Where email = ? Limit 1";
		$INSERT = "INSERT Into register (cust_fname, cust_lname, cust_address,cust_phone, cust_email) values (?,?,?,?,?)";
		
		$stmt = $conn->prepare($SELECT);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		
		if($rnum==0){
			$stmt->close();
			
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("sssis", $fname,$lname,$addr,$phone,$email);
			$stmt->execute();
			echo "Registration completed succesfully";
		}else{
			echo "This is email is already being used, please try a different one";
		}
		$stmt->close();
		$conn->close();
	}
	
}else{
	echo "All fields are required";
	die();
}
?>
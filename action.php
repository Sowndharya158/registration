<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email= $_POST['email'];
$gender = $_POST['gender'];
$phno = $_POST['phno'];
$password= $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
if (!empty($firstname) || !empty($lastname) || !empty($email) || !empty($gender) || !empty($phno) || !empty($password)|| !empty($confirmpassword)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "registration form";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (firstname,lastname,email,gender,phno,password,confirmpassword) values(?, ?, ?, ?, ?, ?,?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssiss",$firstname,$lastname,$email,$gender,$phno,$password,$confirmpassword);
      $stmt->execute();
      echo "New record inserted sucessfully";
     }
     
    else{
            echo "This email is already being registered";
        }
     
      
     }
     $stmt->close();
     $conn->close();
    }
 else {
 echo "All field are required";
 die();
}

?>
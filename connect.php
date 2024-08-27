<?php
$name = filter_input(INPUT_POST,'name');
$email = filter_input(INPUT_POST,'email');
$number = filter_input(INPUT_POST,'number');
$food = filter_input(INPUT_POST,'food');
$address = filter_input(INPUT_POST,'address');

if(!empty($name)|| !empty($email)|| !empty($email)|| !empty($food)|| !empty($address)) { 
    $host='localhost';
    $user='root';
    $pass='';
    $db='food website';

// Database connection here 
$conn = new mysqli($host,$user,$pass,$db);
if(mysqli_connect_error()){
    die('connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
} else {
    $SELECT ="SELECT email from order place where email = ? limit 1";
    $INSERT ="INSERT Into order placec(name,number,food name,address) values(?,?,?,?,?)";
    // prepare statement 
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    if($rnum==0){
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssssi",$name,$email,$number,$food,$address);
        $stmt->execute();
        echo"New record inserted successfully";

        $stmt->close();
        $conn->close();

    }
}

} else {
    echo "All field are required";
    die();
}
     
?>
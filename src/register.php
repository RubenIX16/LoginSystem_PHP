<?php
include 'connect.php';

if (isset($_POST['signUp'])) {
    $FirstName = $_POST['fName'];
    $LastName = $_POST['lName'];
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    $Password = md5($Password);

    $checkEmail = "SELECT * FROM users WHERE email = '$Email'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        echo "Email already Exists !";
    } else {
        $sql = "INSERT INTO users (FirstName, LastName, Email, Password) VALUES ('$FirstName', '$LastName', '$Email', '$Password')";
        if ($conn->query($sql) === TRUE) {
            header("location: index.php");
            echo "New record created successfully";
        } else {
            echo "Error:" . $conn->error;
        }
    }
}

if (isset($_POST['signIn'])) {
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    $Password = md5($Password);

    $sql = "SELECT * FROM users WHERE Email='$Email' AND Password='$Password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['Email'] = $row['Email'];
        header("Location: homepage.php");
        exit();
    } else {
        echo "Login Failed, Incorrect Name or Password:";
    }
}

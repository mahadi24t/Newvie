<?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost','root','','test');
    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {
        // Perform login validation logic here
        // You can compare the username and password with your database records
        // Example:
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            // Handle successful login
            // Redirect to home page
            echo "Login successful...";
            header('Location: index.html');
            exit;
        } else {
            // Handle login error
            echo "Login failed. Please try again.";
        }
        $stmt->close();
        $conn->close();
    }
?>

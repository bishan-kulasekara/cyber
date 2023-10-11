<?php
session_start();
include 'config.php';
// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

include 'config.php';

// Fetch user details
$user = null;
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }

    $sql="SELECT u.username AS UserName, r.reportDescription AS ReportMessage FROM `user` u JOIN `reports` r ON u.id = r.userID;";
    $stmt = $conn->prepare($sql);
}
// if(isset($_POST['message'])){
    
//     // $stmt->bind_param('is', $id,$message);
//     // if ($stmt->execute()) {
//     //     echo "successfully sent $message to admin";
//     // }
// }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">BrandName</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="posts.php">posts</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="contactadmin.php">Contact Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Profile Section -->
    <section id="contact" class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Contact Admin</h2>
                <form id="contactForm" method="POST" action="contactadmin.php">
                    <div class="form-group">
                        <label ><?php echo $_SESSION['username']?></label>
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" name="message" id="message" placeholder="Enter your message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Bootstrap & jQuery JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        #profile {
            padding: 40px 0;
        }
    </style>
</body>
</html>
<?php
session_start();

// Logging function to write messages to a log file
function writeLog($message) {
    $file = 'log.txt'; // Change to your preferred log file path
    $current = file_get_contents($file);
    $current .= date("Y-m-d H:i:s") . " - " . $message . "\n";
    file_put_contents($file, $current);
}

include 'config.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    
    writeLog("Attempting login for user: " . $_POST['username']);

    // UNSAFE: Directly using POST data (You should change this to use prepared statements)
    $username = $_POST['username'];  
    $password = $_POST['password'];  

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];
        writeLog("Login successful for user: " . $row['username']);
        
        // Redirecting to profile.php
        header("Location: profile.php");
        exit; // This ensures that the script stops executing after redirection
    } else {
        writeLog("Login failed for user: " . $_POST['username']);
        echo "Invalid login credentials.". $_POST['username'].'~'. $_POST['password'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
                <!-- <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li> -->
                <li class="nav-item active">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li> -->
            </ul>
        </div>
    </nav>

    <!-- Login Form -->
    <section id="login" class="container mt-5" >
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Login</h2>
                <form id="loginForm" action="index.php" method="post">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Bootstrap & jQuery JS -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #login {
            background-color: #f7f7f7;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>


    
</body>
</html>
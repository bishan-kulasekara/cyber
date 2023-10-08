<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

// Fetch user details
$user = null;
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = ?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param('s', $username);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
}
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
                    <a class="nav-link" href="/posts.php">posts</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <section class="container mx-auto py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Post 1 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2">Post Title 1</h2>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nisl id ultrices tincidunt, erat mauris aliquet neque, sed tincidunt enim lacus non nisi.</p>
                </div>
                <div class="bg-gray-200 px-6 py-4">
                    <span class="text-sm text-gray-600">Author: John Doe</span>
                </div>
            </div>
 
            <!-- Post 2 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2">Post Title 2</h2>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nisl id ultrices tincidunt, erat mauris aliquet neque, sed tincidunt enim lacus non nisi.</p>
                </div>
                <div class="bg-gray-200 px-6 py-4">
                    <span class="text-sm text-gray-600">Author: Jane Smith</span>
                </div>
            </div>
 
            <!-- Post 3 -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2">Post Title 3</h2>
                    <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nisl id ultrices tincidunt, erat mauris aliquet neque, sed tincidunt enim lacus non nisi.</p>
                </div>
                <div class="bg-gray-200 px-6 py-4">
                    <span class="text-sm text-gray-600">Author: Mark Johnson</span>
                </div>
            </div>
        </div>
    </section>
    <!-- Profile Section -->
    <section id="profile" class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Profile</h2>
                <?php if ($user): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $user['username'] ?></h5>
                        <!-- You can display more details if you add them to the database -->
                    </div>
                </div>
                <?php else: ?>
                <p>No user details found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Bootstrap & jQuery JS -->

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


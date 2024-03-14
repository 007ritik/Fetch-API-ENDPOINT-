<?php
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $user_details_url = "https://jsonplaceholder.typicode.com/users/{$user_id}";
    $user_details_json = file_get_contents($user_details_url);
    $user_details = json_decode($user_details_json);
    if ($user_details) {
        echo "<h2>User Details</h2>";
        echo "<p>ID: {$user_details->id}</p>";
        echo "<p>Name: {$user_details->name}</p>";
        echo "<p>Username: {$user_details->username}</p>";
        echo "<p>Email: {$user_details->email}</p>";
        echo "<p>Phone: {$user_details->phone}</p>";
    } else {
        echo "<p>Error fetching user details</p>";
    }
} else {
    echo "<p>User ID not provided</p>";
}
?>

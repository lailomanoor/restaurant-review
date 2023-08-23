<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] == 'moderator') {
    // Moderator is logged in, proceed with adding the restaurant and branches

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = mysqli_connect("localhost", "root", "", "restaurant_review");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get the restaurant details from the form
        $name = $_POST['name'];
        $category = $_POST['category'];
        $branches = $_POST['branches'];

        // Check if the restaurant already exists in the restaurant table
        $sql = "SELECT * FROM restaurant WHERE restaurant_name = '$name' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Restaurant already exists, get the restaurant ID
            $row = mysqli_fetch_assoc($result);
            $restaurant_id = $row['restaurant_id'];
        } else {
            // Restaurant does not exist, insert it into the restaurant table
            $sql = "INSERT INTO restaurant (restaurant_name, restaurant_category) VALUES ('$name', '$category')";
            if (mysqli_query($conn, $sql)) {
                // Get the restaurant ID
                $restaurant_id = mysqli_insert_id($conn);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                mysqli_close($conn);
                exit();
            }
        }

        // Split the branches by comma and insert each into the branch table
        $branch_arr = explode(",", $branches);
        foreach ($branch_arr as $branch) {
            // Check if the branch already exists for the restaurant
            $sql = "SELECT * FROM branch WHERE restaurant_id = '$restaurant_id' AND branch_location = '$branch' LIMIT 1";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                // Branch does not exist, insert it into the branch table
                $sql = "INSERT INTO branch (restaurant_id, branch_location) VALUES ('$restaurant_id', '$branch')";
                mysqli_query($conn, $sql);
            }
        }

        // Close the database connection
        mysqli_close($conn);

        // Redirect after successful insertion
        header("Location: moderator_duties.php");
        exit();
    }
} else {
    // Moderator is not logged in, redirect to login page
    header("Location: moderatorlogin.php");
    exit();
}
?>

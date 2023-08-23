<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Moonrocks&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


    <title>ctrl + alt + deli </title>

    <!--CSS -->
    <link rel="stylesheet" href="style.css">

    <style>
        * {
            overflow-x: visible;
        }

        nav {
            overflow-x: hidden;
        }

        .containers {
            margin: auto auto;
            width: 600px;
        }

        .r-container {
            display: grid;
            gap: px;
            padding: 5px;
            align-items: center;
        }

        .r-container>div {
            text-align: left;
            padding: 10px 10px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto;
            grid-template-columns: 1fr 2fr;
            gap: px;
            padding: 5px;
            align-items: center;
        }

        .grid-container>div {
            text-align: left;
            padding: 20px 20px;
            font-size: 20px;

        }

        .item1 {
            grid-row: 1 / 5;
            display: flex;
            align-items: center;
        }

        .container {
            display: flex;
            align-items: center;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            text-align: center;
        }

        .item1>h1 {
            padding: 20px;
            background-color: silver;
            border-radius: 10px;
            overflow: visible;

        }

        .item3-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .item3 {
            display: flex;
            justify-content: space-between;
        }

        .item3-rating {
            background-color: silver;
            padding: 4px;
            border-radius: 4px;
        }

        .item3-rating::before,
        .item3-rating::after {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: silver;
            border-radius: 50%;
            margin-right: 4px;
        }

        .item3-title {
            flex-basis: 50%;
        }

        .input-centered {
            margin-left: auto;
            margin-right: auto;
        }

        .no-hover-blue:hover {
            color: white;
            text-decoration: none;
        }

        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            color: white;
            text-decoration: none;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .center-content {
            text-align: center;
        }
    </style>


</head>

<body>

    <nav>
        <div class="logo" id="logo">
            <span>ctrl + alt + deli </span>
        </div>
        <ul>
            <li><a href="web.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="browse.php">Browse</a></li>

            <div class="buttons">
                <?php

                if (isset($_SESSION['username'])) {
                    // If user is logged in, display logout button
                    echo '<a class="button-1" href="logout.php">Log out</a>';
                } else {
                    // If user is not logged in, display login and signup buttons
                    echo '<a class="button-1" href="login.php">Log in</a>';
                    echo '<a class="button-2" href="signup.php">Sign Up</a>';
                }
                ?>
            </div>
        </ul>
    </nav>



    <body>
        <div class="pt-5 text-center">
            <div class="font">
                <?php
                // Connect to the database
                $dbhost = 'localhost';
                $dbuser = 'root';
                $dbpass = '';
                $dbname = 'restaurant_review';
                $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Get the branch details from the URL
                $restaurant_name = $_GET['restaurant_name'] ?? '';
                $branch_location = $_GET['branch_location'] ?? '';
                $branch_id = $_GET['branch_id'] ?? '';
                echo "<header>
                <h1><strong>$restaurant_name, $branch_location</strong></h1>
            </header>";
                $query = "SELECT average_rating FROM branch WHERE branch_id='$branch_id'";
                // Execute the query and store the result in a variable
                $result = mysqli_query($conn, $query);

                $row = mysqli_fetch_assoc($result);
                $average_rating = $row['average_rating'];

                echo "<br><br><h3>Average Rating: $average_rating</h3><br><br>";
                // Close the database connection
                mysqli_close($conn);
                ?>
                <br>
                <hr><br><br><br>
            </div>
        </div>

        <div class="card text-black bg-light mb-3 mx-auto" style="max-width: 40rem;">
            <h4 class="pt-5 px-5 input-centered">Write your own review</h4>
            <div class="containers">
                <div class="r-container">
                    <form id="review-form" method="post"
                        action="submitreview_php.php?restaurant_name=<?php echo urlencode($restaurant_name); ?>&branch_location=<?php echo urlencode($branch_location); ?>">
                        <input type="hidden" name="branch_id" value="<?php echo $_GET['branch_id']; ?>">
                        <div class="item3-container">
                            <div class="item3">
                                <span class="item3-title fs-6">QUALITY:</span>
                            </div>
                            <div class="item3 p-0">
                                <span class="item3-title input-centered">
                                    <input type="number" name="food-quality-input" id="food-quality-input"
                                        class="form-control w-100 input-centered" min="1" max="5">
                                </span>
                            </div>
                            <div class="item3">
                                <span class="item3-title fs-6">CUSTOMER SERVICE:</span>
                            </div>
                            <div class="item3">
                                <span class="item3-title input-centered">
                                    <input type="number" name="customer-service-input" id="customer-service-input"
                                        class="form-control w-100 input-centered" min="1" max="5">
                                </span>
                            </div>
                            <div class="item3">
                                <span class="item3-title fs-6">AMBIENCE:</span>
                            </div>
                            <div class="item3">
                                <span class="item3-title input-centered">
                                    <input type="number" name="ambience-input" id="ambience-input"
                                        class="form-control w-100 input-centered" min="1" max="5">
                                </span>
                            </div>
                            <div class="item3">
                                <span class="item3-title fs-6">PRICING:</span>
                            </div>
                            <div class="item3">
                                <span class="item3-title input-centered">
                                    <input type="number" name="pricing-input" id="pricing-input"
                                        class="form-control w-100 input-centered" min="1" max="5">
                                </span>
                            </div>
                            <br>

                            <div class="item3">
                                <span class="item3-title fs-6">YOUR REVIEW: </span><br>
                            </div>
                            <div class="item3">
                                <span class="item3-title input-centered">
                                    <textarea name="review-input" class="input-centered" id="review-input" rows="4"
                                        cols="40"></textarea>
                                </span>
                            </div>
                            <br>
                            <input type="submit" value="Submit" onclick="return validateForm()"> <br><br><br>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <br>
        <hr><br><br><br>
        <h3><strong>User Ratings</strong></h3>
        <br><br><br>

        <?php
        $branch_id = $_GET['branch_id'];

        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "restaurant_review";

        // Create connection
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {

            $stmt = $conn->prepare("SELECT * FROM review WHERE branch_id = ?");
            $stmt->bind_param("s", $branch_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $review_id = $row['review_id'];
                    $reviewer_username = $row['reviewer_username'];
                    $r_food_quality = $row['r_food_quality'];
                    $r_pricing = $row['r_pricing'];
                    $r_customer_service = $row['r_customer_service'];
                    $r_ambience = $row['r_ambience'];
                    $overall_rating = $row['overall_rating'];
                    $comment = $row['recommendation'];

                    // Check if the current user is allowed to delete the review
                    $delete_button = '<button class="btn btn-outline-secondary btn-sm" onclick="deleteReview(' . $review_id . ', ' . $branch_id . ')" style="width: 70px; margin-left: 15px;">Delete</button>';


                    echo '<div class="card text-black bg-light mb-3 mx-auto" style="max-width: 40rem;">
                <p class="p-3"><strong>' . $reviewer_username . ':</strong>' . $comment . '</p>
                ' . $delete_button . '
                <div class="containers">
                    <div class="grid-container">
                        <div class="item1 card-title">
                            <h1>' . $overall_rating . '</h1>
                        </div>
                        <div class="item3-container">
                            <div class="item3">
                                <span class="item3-title">Quality:</span>
                                <span class="item3-rating">' . $r_food_quality . '</span>
                            </div>
                            <div class="item3">
                                <span class="item3-title">Customer service:</span>
                                <span class="item3-rating">' . $r_customer_service . '</span>
                            </div>
                            <div class="item3">
                                <span class="item3-title">Ambience:</span>
                                <span class="item3-rating">' . $r_ambience . '</span>
                            </div>
                            <div class="item3">
                                <span class="item3-title">Pricing:</span>
                                <span class="item3-rating">' . $r_pricing . '</span>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>';
                }
            } else {
                echo '<br><br>
                
                <div class="center-content">
                  No reviews found for this branch.
                </div>
              <br> <br> <br>';
            }

            $stmt->close();
            $conn->close();
        }
        ?>

        <script>
            function validateForm() {
                var foodQuality = document.getElementById("food-quality-input").value;
                var customerService = document.getElementById("customer-service-input").value;
                var ambience = document.getElementById("ambience-input").value;
                var pricing = document.getElementById("pricing-input").value;

                if (foodQuality > 5 || customerService > 5 || ambience > 5 || pricing > 5 ||
                    foodQuality < 1 || customerService < 1 || ambience < 1 || pricing < 1) {
                    alert("Please enter a value between 1 and 5.");
                    return false;
                }

                if (confirm('Do you want to submit the review?')) {
                    var formData = new FormData(document.getElementById('review-form'));
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'submitreview_php.php', true);
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                alert(response.message);
                                window.location.href = "branch.php?restaurant_name=<?php echo urlencode($restaurant_name); ?>&branch_location=<?php echo urlencode($branch_location); ?>&branch_id=<?php echo urlencode($branch_id); ?>";
                            } else {
                                alert(response.error);
                            }
                        }
                    };
                    xhr.send(formData);
                }

            }


            function deleteReview(review_id, branch_id) {
                if (confirm("Are you sure you want to delete this review?")) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', "deletereviewb_php.php?branch_id=" + branch_id + "&review_id=" + review_id, true);
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                alert(response.message);
                                window.location.href = "branch.php?restaurant_name=<?php echo urlencode($restaurant_name); ?>&branch_location=<?php echo urlencode($branch_location); ?>&branch_id=<?php echo urlencode($branch_id); ?>";
                            } else {
                                alert(response.message);
                            }
                        }
                    };
                    xhr.send();
                }
            }

        </script>
    </body>

</html>

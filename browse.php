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

    <title>ctrl + alt + deli</title>

    <!--CSS -->
    <link rel="stylesheet" href="style.css">

    <style>
        * {
            font-family: "Mitr", sans-serif;
        }


        body {
            /* font-family: Arial, sans-serif; */
            margin: 0;
            padding: 0;
        }

        header {

            color: black;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        main {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
        }

        .filters {
            width: 30%;
        }

        .filters h2 {
            font-size: 1.2rem;
            margin-top: 0;
        }

        .filters form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .filters label,
        .filters select {
            margin-left: 10px;
        }

        .filters input[type="text"],
        .filters select {
            padding: 5px;
            border-radius: 5px;
            border: none;
            box-shadow: 1px 1px 5px #ccc;
        }

        .filters button {
            padding: 5px;

            border-radius: 5px;
            border: none;
            background-color: #333;
            color: #fff;
        }

        .restaurant-list {
            width: 40%;
            margin-left: 10px;
        }

        .restaurant-list h2 {
            font-size: 1.2rem;
            margin-top: 0;
        }

        .restaurant-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .restaurant-list li {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 50px;
            margin-bottom: 25px;
        }

        .restaurant-list li h3 {
            margin-top: 0;
        }

        input {
            color: black;
            background-color: whitesmoke;
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
                session_start();
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

    <header>
        <h1>Browse Restaurants</h1>
    </header>

    <section class="filters">
        <form>
            <label for="search">Search:</label>
            <form class="search-form">
                <input type="text" id="search-input">
                <button type="button" id="search-button">Search</button>
            </form>
        </form>
    </section>

    <br><br>

    <section class="restaurant-list">
        <ul id="restaurant-list">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "restaurant_review");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $query = "SELECT r.restaurant_id, r.restaurant_name, r.restaurant_category, GROUP_CONCAT(b.branch_id) AS branch_ids, GROUP_CONCAT(b.branch_location SEPARATOR ',') AS branches FROM restaurant r LEFT JOIN branch b ON r.restaurant_id = b.restaurant_id GROUP BY r.restaurant_id, r.restaurant_name, r.restaurant_category";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['restaurant_name'];
                $category = $row['restaurant_category'];
                $branch_ids = explode(',', $row['branch_ids']);
                $branches = explode(',', $row['branches']);
                ?>
                <div class="rest">

                    <li class="restlist">
                        <h3>
                            <?php echo $name; ?>
                        </h3>
                        <p>Category:
                            <?php echo $category; ?>
                        </p>
                        <p>Branch:
                            <?php
                            for ($i = 0; $i < count($branches); $i++) {
                                $branch = $branches[$i];
                                $branch_id = $branch_ids[$i];
                                ?>
                                <a
                                    href="branch.php?restaurant_name=<?php echo urlencode($name); ?>&branch_location=<?php echo urlencode($branch); ?>&branch_id=<?php echo urlencode($branch_id); ?>">
                                    <?php echo $branch; ?>
                                </a>
                                <?php
                                if ($i < count($branches) - 1) {
                                    echo " , ";
                                }
                            }
                            ?>
                        </p>
                    </li>
                </div>
                <?php
            }
            ?>
        </ul>
    </section>

    <script>
        const searchButton = document.getElementById("search-button");
        const searchInput = document.getElementById("search-input");
        const restaurantList = document.getElementById("restaurant-list");

        // function to perform search
        function performSearch(searchTerm) {
            const restaurants = restaurantList.getElementsByTagName("li");
            for (let i = 0; i < restaurants.length; i++) {
                const restaurantName = restaurants[i].getElementsByTagName("h3")[0].textContent.toLowerCase();
                if (restaurantName.includes(searchTerm)) {
                    restaurants[i].style.display = "";
                } else {
                    restaurants[i].style.display = "none";
                }
            }
        }

        // event listener for search button click
        searchButton.addEventListener("click", () => {
            const searchTerm = searchInput.value.toLowerCase();
            performSearch(searchTerm);
        });

        // event listener for search input keydown
        searchInput.addEventListener("keydown", (event) => {
            if (event.key === "Enter") {
                event.preventDefault();
                const searchTerm = searchInput.value.toLowerCase();
                performSearch(searchTerm);
            }
        });
    </script>
</body>

</html>

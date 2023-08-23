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


    <title>ctrl + alt + deli</title>

    <!--CSS -->
    <link rel="stylesheet" href="style.css">

    <style>
        * {
            font-family: "Mitr", sans-serif;
        }

        input {
            color: white;
            background-color: rgba(255, 255, 255, 0.173);
        }

        .txt h1 {
            font-family: "Rubik Moonrocks", cursive;
        }
    </style>

</head>

<body>

    <!-- Front page -->
    <div class="bgimg">
        <nav>
            <div class="logo" id="logo">
                <span>ctrl + alt + deli
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

        <div class="txt">
            <h1>Ctrl + Alt + Deli</h1>
            <h5>Review restaurants</h5>

            <form id="search-form">
                <input type="text" id="search-input" placeholder="Search for a restaurant">
            </form>
        </div>

        <script>
            const searchForm = document.getElementById("search-form");

            searchForm.addEventListener("submit", (event) => {
                event.preventDefault();

                const searchTerm = document.getElementById("search-input").value.toLowerCase();
                window.location.href = `browse.php?search=${searchTerm}`;
            });
        </script>

</body>

</html>

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
            background-color: #f0f0f0;
        }

        .containers {
            background-color: rgba(0, 0, 0, 0.532);
            width: 450px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px #888888;
            color: white;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"],
        input[type="number"] {
            margin-top: 5px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: white;
            color: black;
        }

        input[type="submit"] {
            background-color: #ffffff00;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: 1px solid white;
        }

        p {
            font-size: xx-small;
        }
    </style>

</head>

<body>

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

        <div class="containers">
            <h1>Add a Restaurant</h1>
            <form action="addrest.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="category">Category:</label>
                <input type="text" id="category" name="category" required>

                <label for="branches">Branches: <p>(separate by comma)</p></label>

                <input type="text" id="branches" name="branches" required>

                <input type="submit" value="Add Restaurant">
            </form>
        </div>


    </div>
</body>

</html>

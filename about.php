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

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        a,
        ul,
        li,
        input {
            color: white;
        }

        section {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        section p {
            border: 2px solid white;
            padding: 10px;
            margin: 10px 0;
            max-width: 800px;
            background-color: #000;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 1);
            color: #fff;
            border-radius: 50%;
            height: 40px;
            width: 40px;
            margin-right: 10px;
            text-decoration: none;
        }

        .fab {
            font-size: 20px;
        }
    </style>

</head>

<body>

    <!-- Front page -->
    <div class="bgimg">
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
            <header>
                <h1>About Us</h1>
                <br>
            </header>
            <section>
                <h2>Who We Are</h2>
                <p>We are a team of food enthusiasts who love exploring new restaurants and trying out different
                    cuisines. Our goal is to provide a platform for people to share their dining experiences and help
                    others make informed decisions when choosing a restaurant.</p><br>
                <h2>What We Do</h2>
                <p>We have created a restaurant review system where users can search for restaurants, view ratings and
                    reviews, and leave their own reviews. Our system also includes a recommendation engine that suggests
                    restaurants based on a user's preferences and past reviews.</p><br>
                <h2>Get in Touch</h2>
                <p>If you have any questions or feedback, we would love to hear from you. You can reach us through our
                    social media channels or send us an email.</p><br>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fas fa-envelope"></i></a>
                </div>
            </section>
        </body>

</html>

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

        .login {
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
        input[type="password"],
        input[type="submit"] {
            margin-top: 5px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: white;
            color: black;
        }

        input[type="submit"] {
            background-color: #fffbfb00;
            border: 1px solid white;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .link {
            color: white;
            margin: auto;
        }

        .button-3 {
            background-color: #ffffff00;
            border: 1px solid #ffffff;
            color: white;
            border-radius: 8px;
            box-sizing: border-box;
            cursor: pointer;
            display: flex;
            font-family: Circular, -apple-system, BlinkMacSystemFont, Roboto,
                "Helvetica Neue", sans-serif;
            font-size: 16px;
            font-weight: 600;
            line-height: 20px;
            margin: 0;
            outline: none;
            padding: 7px 20px;
            justify-content: center;
            align-items: center;
            text-align: center;
            text-decoration: none;
            touch-action: manipulation;
            transition: box-shadow 0.2s, -ms-transform 0.1s, -webkit-transform 0.1s,
                transform 0.1s;
            user-select: none;
            -webkit-user-select: none;
            width: 130px;
        }

        .logouttxt {
            color: white;
        }

        .center-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 60vh;

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

        <?php
        

        if (!isset($_SESSION['username'])) {
            echo '<div class="login">
            <h1>Moderator Log In</h1>
            <form id="login-form" action="moderatorlogin_php.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" value="Login">

                <a class="link" href="login.php">User login</a>
            </form>
        </div>';
        } else {
            echo '<div class="center-container">
            <p class="logouttxt">You need to Log Out first</p>
            <br>
            <a class="button-3" onclick="logout()">Log out</a>
        </div>';
        }
        ?>
    </div>

    <script>
        function logout() {
            if (confirm("Are you sure you want to log out?")) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'logout_php.php', true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        alert("Log Out successful");
                        window.location.href = 'web.php';
                    }
                };
                xhr.send();
            }
        }

        //log in
        document.getElementById('login-form').addEventListener('submit', function (event) {
            event.preventDefault();
            var form = event.target;
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'moderatorlogin_php.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert("Login successful");
                    window.location.href = 'moderator_duties.php';
                } else {
                    alert("Incorrect username or password");
                }
            };
            xhr.send(formData);
        });
    </script>

</body>

</html>

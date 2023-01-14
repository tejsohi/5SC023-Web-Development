<head>
    <link rel="stylesheet" type="text/css" href="../../Components/nav-bar/styles/nav-bar.style.php" />
    <link rel="stylesheet" type="text/css" href="./styles/login.style.php" />
</head>




<body>
    <?php include "../../Components/nav-bar/nav-bar.php" ?>

    <section class="login-form">
        <h2>Login</h2>
        <form class="login-form-input" action="./login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username or Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="submit">Login</button>
        </form>
        <?php
        if(isset($_GET["error"])) {
            if($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all fields! </p>";
            } else if ($_GET["error"] == "wronglogin") {
                echo "<p class='login-form-error'>Login details are incorrect! </p>";
            } 
        }
    ?>
    </section>
</body>
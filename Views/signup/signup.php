<head>
    <link rel="stylesheet" type="text/css" href="../../Components/nav-bar/styles/nav-bar.style.php" />
    <link rel="stylesheet" type="text/css" href="./styles/signup.style.php" />
</head>




<body>
    <?php include "../../Components/nav-bar/nav-bar.php" ?>

    <section class="signup-form">
        <h2>Sign Up</h2>
        <form class=signup-form-input action="./signup.inc.php" method="post">
            <input type="text" name="name" placeholder="Full name">
            <input type="text" name="email" placeholder="Email">
            <input type="text" name="userid" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="passwordrepeat" placeholder="Repeat password">
            <button type="submit" name="submit">Sign Up</button>
        </form>

        <?php
        if(isset($_GET["error"])) {
            if($_GET["error"] == "emptyinput") {
                echo "<p class='signup-form-error'>Please fill in all fields! </p>";
            } else if ($_GET["error"] == "invalidUserId") {
                echo "<p class='signup-form-error'>Please choose a proper username! </p>";
            } else if ($_GET["error"] == "invalidEmail") {
                echo "<p class='signup-form-error'>Please choose a proper email! </p>";
            } else if ($_GET["error"] == "passwordsDontMatch") {
                echo "<p class='signup-form-error'>The typed passwords do not match! </p>";
            } else if ($_GET["error"] == "stmtfailed") {
                echo "<p class='signup-form-error'>Something went wrong, please try again! </p>";
            } else if ($_GET["error"] == "usernameTaken") {
                echo "<p class='signup-form-error'>Username is already in use, please choose another! </p>";
            } else if ($_GET["error"] == "none") {
                echo "<p class='signup-form-error'>You have successfully signed up! </p>";
            }
        }
    ?>
    </section>
</body>
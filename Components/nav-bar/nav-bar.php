<?php
session_start();
?>
<div class="topnav">
    <?php
    if (isset($_SESSION["useruid"])) {
        echo "<a href='http://mi-linux.wlv.ac.uk/~1926434/TaskTwo/index.php' id='home'>Home</a>";
        echo "<a href='http://mi-linux.wlv.ac.uk/~1926434/TaskTwo/includes/logout.inc.php' id='logout'>Log out</a>";
    } else {
        echo "<a href='http://mi-linux.wlv.ac.uk/~1926434/TaskTwo/index.php' id='home'>Home</a>";
        echo "<a href='http://mi-linux.wlv.ac.uk/~1926434/TaskTwo/Views/signup/signup.php' id='signup'>Sign Up</a>";
        echo "<a href='http://mi-linux.wlv.ac.uk/~1926434/TaskTwo/Views/login/login.php' id='login'>Login</a>";
    }
    ?>
</div>

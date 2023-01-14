<?php

session_start();


if (!isset($_SESSION["useruid"])) {
    echo "
            <div>
            <p class='edit-error' style='
                max-width: 40%;
                margin-left: 30%;
                background: #ff0000;
                border-radius: 5px;
                color: #000000;
                padding: 10px;
                font-weight: bold;'>
            You must be logged in or the owner of this comment to edit it</p>
            </div>";
} else {

    $query = $_POST['edit'];
    $mysqli = mysqli_connect("localhost", "1926434", "6ab25p", "db1926434");
    $sql =  mysqli_query($mysqli, "SELECT * FROM Comments WHERE _id LIKE '%$query%'");

    if ($sql->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $title = $row['Title'];
            $id = $row['_id'];
            $comment = $row['Comment'];
            if ($query === $id) {
                print_r("
                <div class='edit-review'>
                    <h1>Edit your review</h1>
                    <form method='post' class='edit-form'>
                        <input name='edit-comment-title' value='" . $title . "'>
                        <input type='hidden' name='edit-movie-id' value='" . $id . "' >
                        <textarea name='edit-comment-description'>" . $comment . "</textarea>
                        <button class='comment-update' type='submit'>update review</button>
                    </form>
                </div>
                ");
            }
        }
    }
}
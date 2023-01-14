<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reviewer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../Components/nav-bar/styles/nav-bar.style.php" />
    <link rel="stylesheet" type="text/css" href="./styles/movie.style.php" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="./Views/movie/movie.php"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<?php
error_reporting(E_ERROR | E_PARSE);


if ($_POST['edit-movie-id'] && ($_POST['edit-comment-title'] || $_POST['edit-comment-description'])) {

    $editMovieId = $_POST['edit-movie-id'];
    $editMovieTitle = $_POST['edit-comment-title'];
    $editMovieDescription = $_POST['edit-comment-description'];
    $mysqli = mysqli_connect("localhost", "1926434", "6ab25p", "db1926434");
    $res = mysqli_query($mysqli, "UPDATE Comments SET Title='$editMovieTitle', Comment='$editMovieDescription' WHERE _id=$editMovieId");

    if ($mysqli->query($res) === TRUE) {
        $s = "Record updated";
    } else {
        $err =  "Error: " . $res . "<br>" . $mysqli->error;
    }
}


function DeleteComments($reviewId, $movieImdbId)
{
    $mysqli = mysqli_connect("localhost", "1926434", "6ab25p", "db1926434");
    $res = "DELETE FROM Comments WHERE _id='$reviewId'";

    if ($mysqli->query($res) === TRUE) {
        $s = "New record created successfully";
    } else {
        $err = "Error: " . $res . "<br>" . $mysqli->error;
    }
}


function GetComments($movieImdbId)
{
    $mysqli = mysqli_connect("localhost", "1926434", "6ab25p", "db1926434");
    $res = mysqli_query($mysqli, "SELECT Title, Comment, imdbID, _id, Date FROM Comments");

    $databaseComments = [];

    while ($row = mysqli_fetch_assoc($res)) {
        $_id = $row['_id'];
        if ($movieImdbId === $row['imdbID']) {
            array_push($databaseComments, "
            <div class='existing-comments'>
                <div class='existing-comments-content'>
                    <h3 tabindex='0'>" . $row['Title'] . "</h3> 
                    <p tabindex='0'>Created on " . $row['Date'] . "</p> 
                    <p tabindex='0'>" . $row['Comment'] . "</p> 
                </div>
                <form class='comments-actions' method='post'>
                    <button name='edit-comment' class='edit-comment' value='" . $_id . "' >Edit review</button>  
                    <button name='delete-comment' value=" . $_id . ">Delete review</button>
                    <input type='hidden' name='delete-movie-imdbID'  value='" . $movieImdbId . "'>
                </form> 
            </div> 
                ");
        }
    }

    return $databaseComments = implode("", $databaseComments);
}


function AddComments($userCommentTitle, $userCommentDescription, $movieImdbId)
{
    $mysqli = mysqli_connect("localhost", "1926434", "6ab25p", "db1926434");
    $date = date("Y/m/d");
    $res = "INSERT INTO Comments(Title, Comment, imdbID, Date) VALUES('$userCommentTitle', '$userCommentDescription', '$movieImdbId', '$date')";

    if ($mysqli->query($res) === TRUE) {
        $s = "New record created successfully";
    } else {
        $err = "Error: " . $res . "<br>" . $mysqli->error;
    }
}

function SearchReviews($searchTerm, $movieImdbId, $date)
{
    $mysqli = mysqli_connect("localhost", "1926434", "6ab25p", "db1926434");

    if ($date !== '') {
        $multipleRes =  mysqli_query($mysqli, "SELECT * FROM Comments WHERE Title LIKE '%$searchTerm%' AND Date='$date'");
        while ($row = mysqli_fetch_assoc($multipleRes)) {
            $_id = $row['_id'];
            if ($movieImdbId === $row['imdbID']) {
                echo "
                <div class='search-database-comments'>
                    <div class='search-existing-comments'>
                        <div class='existing-comments-content'>
                            <h3>" . $row['Title'] . "</h3> 
                            <p>" . $row['Comment'] . "</p> 
                        </div>
                        <form class='comments-actions' method='post'>
                            <button name='edit-comment'>Edit review</button>  
                            <button name='delete-comment' value=" . $_id . ">Delete review</button>
                            <input type='hidden' name='delete-movie-imdbID' value='" . $movieImdbId . "'>
                        </form> 
                    </div> 
                </div>";
            }
        }
    } else {

        $titleRes = mysqli_query($mysqli, "SELECT * FROM Comments WHERE Title LIKE '%$searchTerm%'");
        $commentRes = mysqli_query($mysqli, "SELECT * FROM Comments WHERE Comment LIKE '%$searchTerm%'");

        if ($titleRes !== null) {
            while ($row = mysqli_fetch_assoc($titleRes)) {
                $_id = $row['_id'];
                if ($movieImdbId === $row['imdbID']) {
                    echo "
                    <div class='search-database-comments'>
                        <div class='search-existing-comments'>
                            <div class='existing-comments-content'>
                                <h3>" . $row['Title'] . "</h3> 
                                <p>" . $row['Comment'] . "</p> 
                            </div>
                            <form class='comments-actions' method='post'>
                                <button name='edit-comment'>Edit review</button>  
                                <button name='delete-comment' value=" . $_id . ">Delete review</button>
                                <input type='hidden' name='delete-movie-imdbID' value='" . $movieImdbId . "'>
                            </form> 
                        </div> 
                    </div>";
                }
            }
        }

        if ($commentRes !== null) {
            while ($row = mysqli_fetch_assoc($commentRes)) {
                $_id = $row['_id'];
                if ($movieImdbId === $row['imdbID']) {
                    echo "
                    <div class='search-database-comments'>
                        <div class='search-existing-comments'>
                            <div class='existing-comments-content'>
                                <h3>" . $row['Title'] . "</h3> 
                                <p>" . $row['Comment'] . "</p> 
                            </div>
                            <form class='comments-actions' method='post'>
                                <button name='edit-comment' >Edit review</button>  
                                <button name='delete-comment' value=" . $_id . ">Delete review</button>
                                <input type='hidden' name='delete-movie-imdbID' value='" . $movieImdbId . "'>
                            </form> 
                            " . (array_key_exists('edit-comment', $_POST) ? EditComments($row['Title'], $row['Comment'], $row['_id']) : null) . "
                        </div> 
                    </div>";
                }
            }
        }
    }
}


if (isset($_POST['comment-title']) && isset($_POST['comment-description'])) {

    AddComments($_POST['comment-title'], $_POST['comment-description'], $_POST['movie-imdbID']);
}

if (isset($_POST['delete-comment']) && isset($_POST['delete-movie-imdbID'])) {
    DeleteComments($_POST['delete-comment'], $_POST['delete-movie-imdbID']);
}

if (isset($_POST['searchTerm']) && isset($_POST['movie-imdbID'])) {
    $date = $_POST['datepicker'];
    $date;
    if ($date === null) {
        $date = '';
    }
    SearchReviews($_POST['searchTerm'], $_POST['movie-imdbID'], $date);
}

function GetMovie()
{
    $movieSearchTitle = ($_GET['movieSearch']);

    if ($movieSearchTitle != null) {
        $movieSearchTitle = explode('=', $movieSearchTitle);
        $movieSearchTitle = $movieSearchTitle[1];
        $movieSearchYear = $_GET['Year'];
        $movieSearchPoster = $_GET['Poster'];
        $movieSearchTitleQuery = str_replace(' ', '+', $movieSearchTitle);

        $ch = curl_init();
        $url = "https://www.omdbapi.com/?&apikey=4a3b711b&t=$movieSearchTitleQuery&plot=full";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($e = curl_error($ch)) {
            echo $e;
        } else {
            $response = json_decode($response, true);
            $moviePlot = $response['Plot'];
            $movieRating = $response['Rated'];
            $movieReleased = $response['Released'];
            $movieRuntime = $response['Runtime'];
            $movieGenre = $response['Genre'];
            $movieDirector = $response['Director'];
            $movieWriters = $response['Writer'];
            $movieActors = $response['Actors'];
            $movieImdbId = $response['imdbID'];
        }


        echo "
        <div class='wrap'>
        <form class='search' method='post'>
            <div class='search-input'>
                <input name='searchTerm' type='text' class='searchTerm' id='searchTerm' placeholder='Search for reviews'>
                <input type='hidden' name='movie-imdbID' value='" . $movieImdbId . "'>
                <button type='submit' class='searchButton'>
                    <i class='fa fa-search'></i>
                </button>
            </div>
            <div>
                <input name='datepicker' type='date' class='datepicker'>
            </div>
        </form>
        <div class='col-md-5'>
        <div class='list-group' id='show-list'>
        </div>
        </div>
    </div>
            <div class='content'>
                <div class='content-movie'>
                    <div class='content-image'>
                        <a>
                            <img alt='" . $movieSearchTitle . " poster' src=" . $movieSearchPoster . "/>
                        </a>
                        <p tabindex='0'>Released on " . $movieReleased . "</p>
                        <p tabindex='0'>Runtime: " . $movieRuntime . "</p>
                    </div>
                    <div class='content-brief'> 
                        <div class='content-header'> 
                            <h1 class='content-title' tabindex='0'>" . $movieSearchTitle . "</h1>      
                            <p class='content-year' tabindex='0'> " . $movieSearchYear . "</p>
                            <p tabindex='0'>Directed by " . $movieDirector . "</p>
                        </div>
                        <div class='content-plot'>
                            <h2 tabindex='0'>Plot</h2>
                            <p tabindex='0'>" . $moviePlot . "</p>
                        </div>
                        <div class='content-crew'>
                            <h2 tabindex='0'>Cast</h2>
                            <p tabindex='0'>" . $movieActors . "</p>
                        </div>
                    </div>
                </div>
                <div class='content-comments'>
                <div class='content-headers'>
                <div class='add-review'>
                    <h1 class='comments-header'> Reviews </h1>
                    <p>Add a review if you wish to</p>
                    <form class='comments-input' method='post'>
                        <input name='comment-title' placeholder='Enter Review Title'>
                        <input type='hidden' name='movie-imdbID' value='" . $movieImdbId . "'>
                        <textarea name='comment-description' placeholder='Enter your review description'></textarea>
                        <button class='comment-add' type='submit'>Add review</button>
                    </form>
                    </div>
                    <div id='show-edit'></div>
                    </div>
                    <div class='database-comments'>" . GetComments($movieImdbId) . "</div>               
                </div>
            </div>";
    } else {

        $movie = ($_GET['movie']);
        $movieTitle = ($_GET['movieTitle']);
        $moviePoster = ($movie['Poster']);
        $movieYear = ($movie['Year']);
        $movieTitleQuery = str_replace(' ', '+', $movieTitle);

        $ch = curl_init();
        $url = "https://www.omdbapi.com/?&apikey=4a3b711b&t=$movieTitleQuery&plot=full";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($e = curl_error($ch)) {
            echo $e;
        } else {
            $response = json_decode($response, true);
            $moviePlot = $response['Plot'];
            $movieRating = $response['Rated'];
            $movieReleased = $response['Released'];
            $movieRuntime = $response['Runtime'];
            $movieGenre = $response['Genre'];
            $movieDirector = $response['Director'];
            $movieWriters = $response['Writer'];
            $movieActors = $response['Actors'];
            $movieImdbId = $response['imdbID'];
        }

        echo "
        <div class='wrap'>
            <form class='search' method='post'>
                <div class='search-input'>
                <input name='searchTerm' type='text' class='searchTerm' id='searchTerm' placeholder='Search for reviews'>
                <input type='hidden' name='movie-imdbID' value='" . $movieImdbId . "'>
                <button type='submit' class='searchButton'>
                    <i class='fa fa-search'></i>
                </button>     
        </div>
        <div>
            <input name='datepicker' type='date' class='datepicker'>
        </div>
        </form>
        <div class='col-md-5'>
            <div class='list-group' id='show-list'>
        </div>
        </div>
        </div>  
            <div class='content'>
                <div class='content-movie'>
                    <div class='content-image'>
                        <a>
                            <img alt='" . $movieTitle . " poster' src=" . $moviePoster . "/>
                        </a>
                        <p tabindex='0'>Released on " . $movieReleased . "</p>
                        <p tabindex='0'>Runtime: " . $movieRuntime . "</p>
                    </div>
                    <div class='content-brief'> 
                        <div class='content-header'> 
                            <h1 class='content-title' tabindex='0'>" . $movieTitle . "</h1>      
                            <p class='content-year' tabindex='0'> " . $movieYear . "</p>
                            <p tabindex='0'>" . $movieDirector . "</p>
                        </div>
                        <div class='content-plot'>
                            <h2 tabindex='0'>Plot</h2>
                            <p tabindex='0'>" . $moviePlot . "</p>
                        </div>
                        <div class='content-crew'>
                            <h2 tabindex='0'>Cast</h2>
                            <p tabindex='0'>" . $movieActors . "</p>
                        </div>
                    </div>
                </div>
                <div class='content-comments'>
                    <div class='content-headers'>
                        <div class='add-review'>
                            <h1 class='comments-header'> Reviews </h1>
                            <p>Add a review if you wish to</p>
                            <form class='comments-input' method='post'>
                                <input name='comment-title' placeholder='Enter Review Title'>
                                <input type='hidden' name='movie-imdbID' value='" . $movieImdbId . "'>
                                <textarea name='comment-description' placeholder='Enter your review description'></textarea>
                                <button class='comment-add' type='submit'>Add review</button>
                            </form>
                        </div>
                        <div id='show-edit'></div>
                    </div>
                    <div class='database-comments'>" . GetComments($movieImdbId) . "</div>               
                </div>
            </div>";
    }
}


?>

<body>
    <?php
    include "../../Components/nav-bar/nav-bar.php" ?>
    <div><?php GetMovie(); ?></div>


    <script>
        $(document).ready(function() {
            $("#searchTerm").keyup(function() {
                let searchText = $(this).val();
                if (searchText != '') {
                    $.ajax({
                        url: 'action.php',
                        method: 'post',
                        data: {
                            query: searchText
                        },
                        success: function(response) {
                            $("#show-list").html(response);
                        }
                    })
                } else {
                    $("#show-list").html('');
                }
            });
            $(document).on("click", "a", function() {
                $("#searchTerm").val($(this).text());
                $("#show-list").html('');
            });
        });
    </script>

    <script>
        function doSomething(e) {
            console.log(e.target.value)
            $.ajax({
                url: 'edit.php',
                method: 'post',
                data: {
                    edit: e.target.value
                },
                success: function(response) {
                    $("#show-edit").html(response);
                }
            })
        }
        $('.edit-comment').on("click", function() {
            event.preventDefault();
            const nodeList = document.getElementsByName('delete-comment');
            var theParent = document.querySelector(".database-comments");
            theParent.addEventListener("click", doSomething, false);
        });
    </script>
</body>

</html>
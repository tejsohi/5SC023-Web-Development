<?php
error_reporting(E_ERROR | E_PARSE);
function getTheme()
{
  if (isset($_COOKIE['selectedStyle'])) {
    $style =  $_COOKIE['selectedStyle'];
    $style = explode("style/", $style);
    $finalStlye = $style[1];
    return $finalStlye;
  } else {

    return "main.style.php";
  }
}



function setTheme($theme)
{
  if (!isset($_COOKIE["selectedStyle"])) { // has the cookie already been set
    setcookie("selectedStyle", "style/main.style.php");
  } else {
    setcookie("selectedStyle", $theme . ".php"); // update or create the cookie
    header("Refresh:0");
  }
}

if (isset($_POST["themeSelect"])) {
  setTheme($_POST["themeSelect"]);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Reviewer</title>
  <link rel="stylesheet" type="text/css" href="./Components/nav-bar/styles/nav-bar.style.php" />
  <link id="themeStylesheet" rel="stylesheet" type="text/css" href="style/<?= getTheme() ?> " />
  <link rel="stylesheet" type="text/css" href="./Components/search-bar/styles/search-bar.style.php" />
  <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
  <script src="./Views/movie/movie.php"></script>
</head>

<?php
function GetData()
{
  $ch = curl_init();
  $url = "https://www.omdbapi.com/?&apikey=4a3b711b&s=man";
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  if ($e = curl_error($ch)) {
    echo $e;
  } else {
    $response = json_decode($response, true);
  }
  curl_close($ch);

  foreach ($response as $movies) {
    if (is_array($movies) || is_object($movies)) {
      foreach ($movies as $movie) {
        $movieTitle = ($movie['Title']);
        $movieTitleQuery = str_replace(' ', '%20', $movieTitle);
        $moviePoster = ($movie['Poster']);
        $movieYear = ($movie['Year']);
        $movieType = ($movie['Type']);
        $query = http_build_query(array('movie' => $movie));
        $query = str_replace('+', '%20', $query);

        echo "
        <div class='movie'>
            <h2 class='movie-title'>" . $movieTitle . "</h2>
            <div>
                <a href='http://mi-linux.wlv.ac.uk/~1926434/TaskTwo/Views/movie/movie.php?movie=$query&movieTitle=$movieTitleQuery'> 
                    <img class=' movie-poster' src=" . $moviePoster . " width='200' alt='$movieTitle $movieType poster'/>
                </a>
            </div>
            <p class='movie-year'>" . $movieYear . "</p>
        </div>";
      }
    }
  }
}
?>

<body>

  <?php include "./Components/nav-bar/nav-bar.php" ?>
  <?php include "./Components/search-bar/search-bar.php" ?>

  <form class="style-select" action="./" method="post">
    <?php
    $selectedStyle = $_COOKIE['selectedStyle'];
    if ($selectedStyle === "style/main.style.light.php") {
      echo "
    <h3 class='theme-header''>Change the theme of the home page</h3>
      <select name='themeSelect' id='themeSelect'>
          <option value='style/main.style'>Dark</option>
          <option selected='selected' value='style/main.style.light'>Light</option>
      </select>
    <input type='submit' value='Save Theme'>";
    } else {
      echo "
    <h3 class='theme-header'>Change the theme of the home page</h3>
      <select name='themeSelect' id='themeSelect'>
        <option selected='selected' value='style/main.style'>Dark</option>
        <option  value='style/main.style.light'>Light</option>
      </select>
    <input type='submit' value='Save Theme'>";
    }
    ?>
  </form>
  <div class="movies"><?php GetData(); ?></div>

  <script>
    const themeSelect = document.getElementById("themeSelect");
    const themeStylesheet = document.getElementById("themeStylesheet");

    themeSelect.addEventListener("change", function() {
      console.dir(this.value)
      themeStylesheet.setAttribute("href", this.value + ".php");
    });
  </script>
</body>



</html>
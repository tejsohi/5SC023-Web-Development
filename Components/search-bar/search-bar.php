<link rel="stylesheet" type="text/css" href="./styles/search-bar.style.php" />
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

<script>
function Search(event) {
    event.preventDefault();

    let searchValue = document.getElementById("searchTerm").value;

    console.log(searchValue);
    let movies = [];
    $.ajax({
            method: "GET",
            url: `https://www.omdbapi.com/?s=${searchValue}&apikey=4a3b711b&page=1`,
        })
        .done(function(response) {
            console.log(response);
            for (let movie of response.Search) {
                if (movie.Poster === "N/A") {
                    movie.Poster = "./images/not-found-image.jpg";
                }
                let movieQuery = encodeURIComponent(JSON.stringify(movie));
                let queryString = Object.keys(movie).map(key => key + '=' + movie[key]).join('&')
                movies.push(`<div class='movie'><h2 class='movie-title'>${movie.Title}</h2><div><a href='http://mi-linux.wlv.ac.uk/~1926434/TaskTwo/Views/movie/movie.php?movieSearch=${queryString}'> <img class='movie-poster' src=${movie.Poster} width='200 alt='${movie.Title} movie poster''/></a></div><p class='movie-year'>${movie.Year}</p></div></div>`)
            }
            $('.movies').html(movies.join(''));
            if (response.totalResults !== "10") {
                if (movies.length === 10) {
                    $.ajax({
                            method: "GET",
                            url: `https://www.omdbapi.com/?s=${searchValue}&apikey=4a3b711b&page=2`,
                        })
                        .done(function(response) {
                            for (let movie of response.Search) {
                                if (movie.Poster === "N/A") {
                                    movie.Poster = "./images/not-found-image.jpg";
                                }
                                let movieQuery = encodeURIComponent(JSON.stringify(movie));
                                let queryString = Object.keys(movie).map(key => key + '=' + movie[key]).join('&')
                                movies.push(`<div class='movie'><h2 class='movie-title'>${movie.Title}</h2><div><a href='http://mi-linux.wlv.ac.uk/~1926434/TaskTwo/Views/movie/movie.php?movieSearch=${queryString}'> <img class='movie-poster' src=${movie.Poster} width='200' ${movie.Title}/></a></div><p class='movie-year'>${movie.Year}</p></div></div>`)
                            }
                            $('.movies').html(movies.join(''));
                        });
                }
            }

        });


}
</script>

<div class="wrap">
    <form class="search">
        <input type="text" class="searchTerm" id="searchTerm" placeholder="Want more? Search for movies to review">
        <button type="submit" class="searchButton" onclick="Search(event)">
            <i class="fa fa-search"></i>
        </button>
    </form>
</div>
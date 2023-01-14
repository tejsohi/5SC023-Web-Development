<?php
  header('Content-type: text/css;');
?>

body{
    background-color:#ffffff;
    overflow-x: hidden;
}
.style-select {
  margin-top: 100px
}
.movies {
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
  margin-top:110px;
  margin-right: auto;
  margin-left: auto;
  max-width: 55%;
  align-items: flex-end;
  justify-content: space-between;
}

.movie {
  font-family: Arial;
  color: black;
  padding: 5px 25px 10px 25px;
  max-width: 20%;
  width: 19%;
  text-align: center;
}


@media screen and (min-width: 694px) and (max-width: 915px) {
  .movie {
    max-width: 33%;
  }
}

@media screen and (min-width: 652px) and (max-width: 693px) {
  .movie {
    max-width: 50%;
  }
}


@media screen and (max-width: 651px) {
  .movie {
    max-width: 100%;
    margin: auto;
  }
}


.theme-header {
  color: black;
  font-family: Arial;
}

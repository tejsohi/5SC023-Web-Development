<?php
  header('Content-type: text/css;');
?>

body{
    background-color:#1c2228;
    font-family: Arial;
    overflow-x: hidden;
}


.content {
  display: flex;
  flex-direction: row;
  color: white;
  left: 100px;
  padding: 90px 0px 90px 0px;
}

.content-movie {
  display: flex;
  flex-direction: row;
  color: #000000;
  left: 100px;
  margin-left: 3%;
  background: #8A8EAD;
  border-radius: 5px;
  max-width: 50%;
  padding: 20px 20px 20px 20px;
}

.content-brief {
  display: flex;
  flex-direction: column;
  align-items: baseline;
}

.content-header {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: baseline;
}

.content-title{
  margin-left: 20px;
  margin-right: 20px;
}

.content-year{
  margin-right: 20px;
}

.content-plot {
  margin-left:20px;
  max-width: 500px;
  text-align: center;
  max-width: fit-content;
}

.content-crew {
  margin-left:20px;
  max-width: 500px;
}

.content-comments {
  display: flex;
  flex-direction: column;
  color: white;
  left: 100px;
  margin-left: 3%;
  border-radius: 5px;
  width: 40%;
  height: 100px;
}

.content-headers {
  display: flex;
  flex-direction: row;
  align-items: baseline;
  padding-bottom: 10px;
}

.comments-header {
  padding-right: 2px;
}

.comment-add {
  cursor: pointer;
}

.comments {
  display: flex;
  flex-direction: column;
}

.comments-input {
  display: flex;
  flex-direction: column;
}

.database-comments{
 display:flex;
 flex-direction: column;
 width:90%;
 color: #000000;
}

.comments-actions {
  font-size: 15px;
  margin-left: 15px;
}

.existing-comments{
  display: flex;
  flex-direction: row;
  align-items: baseline;
  background-color: #8A8EAD;
  border-radius: 5px;
  margin-bottom: 20px;
  padding: 0px 10px 10px 10px;
}

button, input[type="submit"], input[type="reset"] {
	background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;
}

.search {
  width: 100%;
  position: relative;
  display: flex;
  flex-direction: row;
}

.searchTerm {
  width: 100%;
  border-right: none;
  padding: 5px;
  border-radius: 5px 0 0 5px;
  outline: none;
  color: #9DBFAF;
}

.searchTerm:focus{
  color: #00B4CC;
}

.searchButton {
  width: 40px;
  height: 36px;
  background: #F2AD0F;
  text-align: center;
  color: #fff;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  font-size: 20px;
}

.wrap{
  width: 30%;
  margin: auto;  
  margin-top: 120px;
}

.search-content-comments {
  display: flex;
  flex-direction: column;
  color: white;
  margin-top: 100px;
  left: 100px;
  margin-left: 3%;
  border-radius: 5px;
  width: 40%;
  height: 100px;
}

.search-database-comments{
  width: 25%;
  position: relative;
  color: white;
  top: 100px;
  left: 2%;
  color:#000000;
  margin:auto;
}

.search-existing-comments{
  display: flex;
  flex-direction: row;
  align-items: baseline;
  background-color: #8A8EAD;
  border-radius: 5px;
  margin-bottom: 20px;
  padding: 0px 10px 10px 10px;
}

.search-input {
  display: flex;
  flex-direction: row;
}


.datepicker {
   border: 1px solid #555;
}

.edit-review {
  display:flex;
  flex-direction: column;
  margin-left: 30%;
}

.edit-form {
  display:flex;
  flex-direction: column;
}
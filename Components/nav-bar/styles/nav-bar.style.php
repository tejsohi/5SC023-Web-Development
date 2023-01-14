<?php
  header('Content-type: text/css;');
?>

.topnav {
  background-color: #F2AD0F;
  font-family:Arial;
  position:absolute;
  left: 0;
  right: 0;
  top: 0;
  padding:15px;
  width:100%;
  text-align: center;
  justify-content: space-between;
}
  
.topnav a {
  justify-content: center;
  text-align: center;
  margin-top: 10px;
  padding: 14px 16px;
  font-size: 17px;
  color: #2E2E2E;
  text-decoration: none;
}
  
/* Change the color of links on hover */
.topnav a:hover {
  color: white;
  cursor: pointer;
}
  
/* Add a color to the active/current link */
.topnav a.active {
  color: white;
}

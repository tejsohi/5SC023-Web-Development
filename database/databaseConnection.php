<!-- <html>
	<head>
		<title>Ajax example</title>
		<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
		<script>
			function DoSearch()
			{
				// This is the Ajax call to "getdata.php"
				$.ajax({
				  method: "GET",
				  url: "https://www.omdbapi.com/?&apikey=4a3b711b&s=joker",
				  data: { searchValue: $('#searchValue').val() }
				})
				
				// And this handles the response
				.done(function( response ) {
					console.log(response)
					$( "#results" ).html(response);
				});		
                console.log(response)
			}
		</script>
	</head>
	<body>
		<h1>Ajax example</h1>
		Enter value: <input type="text" id="searchValue">
		<input type="button" value="Search" onclick="DoSearch();">
		<p id="results"></p>
	</body>
</html> -->
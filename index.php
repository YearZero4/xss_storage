<!DOCTYPE html>
<html>
<head>
	<title>LABORATORIO</title>
		<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="PGX">
	<link rel="stylesheet" type="text/css" href="src/style.css">
</head>
<body>


	<div class="container">
		<h2>DIFFICULTY LEVEL</h2>
<script>
fetch('https://ipapi.co/json/')
  .then(response => response.json())
  .then(data => console.log(data.ip)) 
  .catch(error => console.error('Error:', error));

</script>
<a href="src/difficulty/easy.php">Easy</a>
<a href="src/difficulty/medium.php">Medium</a>
<a href="src/difficulty/hard.php">Hard</a>


</div>
</body>
</html>
<!doctype html>

<html>
<head>
	<link rel="stylesheet" href="css/main.css">
	<script src='js/ajax.js'></script>
	<script src='js/state.js'></script>
</head>

<?php 

// get the output from the json .... [DONE]
// lets try and build a speckle tree ... [WIP]
// root object then search ids... [STARTED]
// think the speckle objects might need types ... 

?>
<body><code>

<h1>Agile Building Design 2019 v2</h1>

<?php 
	$count = 0;
	$state_data = json_decode(file_get_contents('state/state.json'));
	foreach($state_data as $state){?>
		<button id='butt' onclick="learn(<?php echo $count ?>)"> <?php echo $state->button_name;
			$count++;
		?>
		</button>
		<?php
	}
?>
<hr>

<div id='protospace'><mark>updating objects .... please wait ...</mark> <script>learn(0)</script></div>

<div id='feedback'></div>
</code></body>
</html>

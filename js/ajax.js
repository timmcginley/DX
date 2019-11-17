
	function getSpek() {
	  var xhttp;
	 var val = document.getElementById('speckleID').value;
	  xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		  
		if (this.readyState == 4 && this.status == 200) {
			
			// update logo (same)
			
			document.getElementById('feedback').innerHTML = 'Got stream from ID : '+val;
			document.getElementById('parts').innerHTML = this.responseText;
		}
	  };
	  console.log('id='+val);
	  xhttp.open("GET", 'includes/json.php?id='+val, true);
	  xhttp.send();  
	}

	
	
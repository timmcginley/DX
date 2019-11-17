	function learn(state) {
	  var xhttp;
	 xhttp = new XMLHttpRequest();
	 xhttp.onreadystatechange = function() {
		 
		if (this.readyState == 4) {
			if (this.status == 200) {
				document.getElementById('protospace').innerHTML = this.responseText;
				console.log('hey that worked perfectly');
			}
			else
			{
				document.getElementById('protospace').innerHTML = 'that broke something';
				console.log('probably should undo that last move - I think it broke something probably in state.php');
				alert('check the log I think you broke something');
			}
		}
		else if (this.readyState == 1) {
			console.log('state 1');
			document.getElementById('protospace').innerHTML = "<center><br><br><br><div class='loader'></div></center>";
			
		}
	  }; 
	  console.log('state:  = '+state);

	  xhttp.open("GET", 'includes/state.php?state='+state, true);
	  xhttp.send();
	}

<?php

/*  	ok lets get some things clear ...

		we should have three layers (reqs, sys, interop, validation)

		(1)	we have root, which we are kind of ignoring atm
		(2) that gives us (a) reqs and (b) design which are 'high'
		(3) these 'high objects' contain the s_ids for 'med objects'
		(4) these 'med objects' contain the object links to variables
		(5) 
		
		|  high objects |  med objects  |    low objects
		------------------------------------------------------
		|      reqs     -->   client   + >     Typology
									   '->    Total users
						-->    site    + >  Site Boundary
									   '->   Height Limit
						-->    f2f     + >     Total F2f
									   '->     Struct f2f
									   '->      MEP f2f
									   '->     Arch f2f
						->    IFC      + >      (IFC)Site  
									   '->	   (IFC)Project
						->   Money     + >     Total budget
									   '->      Price / m2
		|     design    ->   Space      |
						-> Structure 2
						-> Sturcture 1
						->    MEP
		|     Analysis  ->    LCA
*/
 
	$state_data = json_decode(file_get_contents('../state/state.json'));
	$state = $_REQUEST["state"];
	// this needs to show the name
	echo '<h1>'.$state_data[$state]->button_name.'</h1>';
	
	if ($state_data[$state]) 
	{
		// create an ordered list from the tasks stored in state.json
		echo $state_data[$state]->desc.' '; 
		echo '<i>To support you to acheive this learning outcome, this page tries to</i> ...';
		echo '<ol>';
		foreach ($state_data[$state]->tasks as $tasks) 
		{
			echo '<li>'.$tasks.'</li>';
		}
		echo '</ol>';
		echo '<hr>';
		$id = $state_data[$state]->speckle;
		getObjectFromStreamID($id);
		echo '<hr>';
	}
	
	function getObjectFromStreamID($id) {
		// so we have the speckle code and we presume its a stream ...
		$url = 'https://hestia.speckle.works/api/';
		$data = json_decode(file_get_contents($url.'streams/'.$id));
		echo '<h2>GH Object: '.$data->resource->name.'</h2>';
		
		// get number of objects...
		$o_len = count($data->resource->layers);
		
		// get a list of the objects...
		
		for ($x = 0; $x < $o_len; $x++) 
		{
			getSubObject($url,$data,$x);
		}
		echo '<br>';
	}
	

	function getSubObject($url,$data,$num){
		
		// the object name (from layers) and id
		$name = $data->resource->layers[$num]->name;
		// this works if we presume its SV
		$o_id = $data->resource->objects[$num]->_id;
		
		// get the object using the object id ($o_id)
		$obj = getObjectFromObjectID($url,$o_id);
		
		// this is the name of the sub object
		$s_id = $obj->resource->value;
		echo '<h2><a href="'.$url.'objects/'.$o_id.'">';
		echo '<mark>'.$name.'</mark>';
		echo '</h2></a>';
		
		// This is the 
		getTerminalObjectFromStreamID($s_id);
		
	}
	
	function getObjectFromObjectID($url,$o_id){
		
		// so the query to get the id would be
		$object = json_decode(file_get_contents($url.'objects/'.$o_id));
		return $object;
	}
	
	function getTerminalObjectFromStreamID($id) {
		// so we have the speckle code and we presume its a stream ...
		$url = 'https://hestia.speckle.works/api/';
		$data = json_decode(file_get_contents($url.'streams/'.$id));
		//echo '<h1>'.$data->resource->name.'</h1>';
		
		// get number of variables
		$o_len = count($data->resource->layers);
		
		// get a list of the variables
		
		 for ($x = 0; $x < $o_len; $x++) 
		{
			// talk about them - get their names etc.
			$name = $data->resource->layers[$x]->name;
			$o_id = $data->resource->objects[$x]->_id;
			$value = $data->resource->layers[$x]->objectCount;
			echo '<h3>'.$name.' = '.$value.' data objects</h3>';
			// this is the object id
			//echo $o_id.'<br>';
			
		}
		echo '<br>'; 
	}
	
	
?>
<?php 

	$url = 'https://hestia.speckle.works/api/';
	$id = $_REQUEST["id"];
	$data = json_decode(file_get_contents($url.'streams/'.$id));
	
	echo '<h1>'.$data->resource->name.'</h1><br><br>';
	
	// which could then be used to call a version of this...
	
	$o_len = count($data->resource->layers);
		
	// read through the layers and get the objects
	// in the first levels these objects are stream id's
	for ($x = 0; $x < $o_len; $x++) 
	{
		getObject($url,$data,$x);
	}
	echo '<br>';
	
	function getObject($url,$data,$num){
		
		// the object name (from layers) and id
		$name = $data->resource->layers[$num]->name;
		echo '<h2>'.$name.'</h2>';
		$o_id = $data->resource->objects[$num]->_id;
		echo $o_id.'<br>';
		
		// so the query to get the id would be
		$object = json_decode(file_get_contents($url.'objects/'.$o_id));
		$s_id = $object->resource->value;
		echo '<b>id: '.$s_id.'</b><br><br>';
	}
	
	foreach ($data->resource->layers as $layers)
	{
		echo $layers->name.'<br>';
		echo $layers->guid.'<br><br>';
	}

?>
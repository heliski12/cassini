<?php

return array (
	'host'    => '127.0.0.1',
	'port'    => 9312,
	'indexes' => array (
		//'profiles' => array ( 'table' => 'profiles', 'column' => 'id' ),
    'profiles' => array ( 'table' => 'profiles', 'column' => 'id', 'modelname' => 'Profile' ),
	)
);

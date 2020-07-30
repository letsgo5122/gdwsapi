<?php

$id = 1;
$name = 'My Name';
$stuff = ['sword', 'bow','dagger'];
$retdata = array(
    "id" => $id,
    "name" => $name,
	"stuff" => $stuff
);
echo json_encode($retdata);
?>
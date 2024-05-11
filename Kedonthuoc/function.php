<?php
require_once ('config.php');


function execute($sql) {
	//create connect
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	//query
	mysqli_query($conn, $sql);

	//disconnect
	mysqli_close($conn);
}

function executed($sql_1) {
	//create connect
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	//query
	mysqli_query($conn, $sql_1);

	//disconnect
	mysqli_close($conn);
}
function executeResult($sql) {
	//create
	$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

	//query
	$resultset = mysqli_query($conn, $sql);
	$list      = [];
	while ($row = mysqli_fetch_array($resultset, 1)) {
		$list[] = $row;
	}

	//disconnection
	mysqli_close($conn);

	return $list;
}    
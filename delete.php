<?php

// Take the subscriber id from the url
$assignment_id = $_GET['assignment_id'];

// Connect to database
require_once "config.php";


// Write and execute sql to delete the record selected
$sql = "DELETE FROM assignment WHERE assignment_id = $assignment_id";
$conn->exec($sql);

// Disconnect
$conn = null;

// Send back to projects.php
header ('location: projects.php');

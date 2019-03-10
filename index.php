<?php

require 'Collection.php';

$db = new PDO('mysql:host=localhost;dbname=collection', 'root', 'root');

$query = $db->query('SELECT * FROM article');
$items = $query->fetchAll(PDO::FETCH_OBJ);

$articles = new Collection($items);

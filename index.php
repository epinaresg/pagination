<?php

require_once __DIR__ . '/vendor/autoload.php';

$p = new Pagination\Pagination();

$currentPage = 1;
if (isset($_GET['page'])) {
	$currentPage = $_GET['page'];
}

$p->setPerPage(10);
$p->setTotalRows(150);
$p->setNumberOfLinks(3);

$p->setCurrentPage($currentPage);

$p->setUrlFriendly(false);

echo '<style> strong { color: red;} a { font-size: 50px; font-weight: bold; color: #000; text-decoration: none; font-family: monospace; border: 1px solid #ccc; height: 80px; display: inline-block; width: 80px; line-height: 80px; text-align: center; margin: 0 2px; } </style>';

echo $p->generatePagination();
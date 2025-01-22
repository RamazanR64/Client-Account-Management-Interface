<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Model/Account.php';
require_once __DIR__ . '/../src/Repository/AccountRepository.php';
require_once __DIR__ . '/../src/Controller/AccountController.php';

$db = Database::getInstance();
$repository = new AccountRepository($db);
$controller = new AccountController($repository);

$controller->handleRequest();
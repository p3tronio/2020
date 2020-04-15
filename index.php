<?php 
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\Model\User;

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {

	User::verifyLogin();
	$page = new Page();
	$page->setTpl("index");

});

$app->get('/login', function (){
	
	$page = new Page(["header"=>false, "footer"=>false]);
	$page->setTpl("login");

});

$app->post('/login', function (){
	
	User::login($_POST['login'], $_POST['password']);
	header("Location: /2020/");
	exit;

});

$app->get('/logout', function (){

	User::logout();
	header("Location: /2020/login");
	exit;

});

$app->run();

?>
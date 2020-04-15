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

$app->get('/users', function (){

	User::verifyLogin();
	$page = new Page();
	$page->setTpl('users');

});

$app->get('/users/create', function (){

	User::verifyLogin();
	$page = new Page();
	$page->setTpl('users-create');

});

$app->post('users/create', function (){

	User::verifyLogin();


});

$app->get('/users/:iduser', function ($iduser){

	User::verifyLogin();
	$page = new Page();
	$page->setTpl('users-update');

});

$app->post('/users/:iduser', function ($iduser){

	User::verifyLogin();

});

$app->delete('/users/:iduser', function ($iduser){

	User::verifyLogin();

});





$app->run();

?>
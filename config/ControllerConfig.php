<?php 

//container to return load controllers
/**
* 
* You have to list every new controller here
* 
*/
$container['HomeController'] = function($container){
	return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function($container){
	return new \App\Controllers\Auth\AuthController($container);
};

$container['PasswordController'] = function($container){
	return new \App\Controllers\Auth\PasswordController($container);
};

$container['UsersController'] = function($container){
	return new \App\Controllers\UsersController($container);
};

$container['PostsController'] = function($container){
	return new \App\Controllers\PostsController($container);
};
$container['RolesController'] = function($container){
	return new \App\Controllers\RolesController($container);
};


 
$container['TestsController.'] = function($container){
	return new \App\Controllers\TestsController.($container);
};
 
$container['TesterresController'] = function($container){
	return new \App\Controllers\TesterresController($container);
};
 
$container['Testerre2sController'] = function($container){
	return new \App\Controllers\Testerre2sController($container);
};
 
$container['StudentsController'] = function($container){
	return new \App\Controllers\StudentsController($container);
};
 
$container['CompaniesController'] = function($container){
	return new \App\Controllers\CompaniesController($container);
};
 
$container['SearchesController'] = function($container){
	return new \App\Controllers\SearchesController($container);
};
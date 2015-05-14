<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2012, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

/**
 * The routes file is where you define your URL structure, which is an important part of the
 * [information architecture](http://en.wikipedia.org/wiki/Information_architecture) of your
 * application. Here, you can use _routes_ to match up URL pattern strings to a set of parameters,
 * usually including a controller and action to dispatch matching requests to. For more information,
 * see the `Router` and `Route` classes.
 *
 * @see lithium\net\http\Router
 * @see lithium\net\http\Route
 */
use lithium\net\http\Router;
use lithium\core\Environment;

//use lithium\security\Auth;

// Examples

/*
    //Analytics
    Router::connect('/{:name:callback}/{:app_key:[0-9A-Z]{6}}/{:controller}/{:action}');

	//Tracking redirect wrapper
	Router::connect('/r/{:args}.{:type}', 'Request::url');
	Router::connect('/r/{:args}', 'Request::url');

	//RSS views (podcasts)
	Router::connect('/{:short_url:[0-9a-f]{7}}/{:format:podcast|video}.{:type:rss}', 'Lists::smart');
	
	//RSS feed converter
	Router::connect('/rss/converter/{:args}', array('controller' => 'blogs', 'action' => 'posts', 'type' => 'xml'));

	//App Migration Tab
	//Router::connect('/migrate/structure/{:app_key:[0-9A-Z]{6}}.{:type:xml}', 'Migrate::structure');
	Router::connect('/migrate/tab/{:app_key:[0-9A-Z]{6}}', 'Migrate::tab');

		
	Router::connect('/{:appid:[0-9]+}/{:controller}/{:id}/{:action}.{:type}');

	Router::connect('/{:appid:[0-9]+}/{:controller}/{:id}/{:action}/{:args}.{:type}');
	Router::connect('/{:appid:[0-9]+}/{:controller}/{:id}/{:action}/{:args}');

	Router::connect('/{:controller:app}/{:app_key}/{:action}.{:type}');	
	Router::connect('/{:controller:migrate}/{:app_key}/{:action}.{:type}');	

	Router::connect('/{:controller}/{:action}/{:args}.{:type}');
	Router::connect('/{:controller}/{:action}/{:args}');
	*/
Router::connect('/{:controller}/{:action}.{:type}');
Router::connect('/{:controller}/{:action}');
Router::connect('/{:controller}/{:action}/{:id:[0-9a-f]{24}}');
Router::connect('/{:controller}/{:action}/{:id:[0-9a-f]{24}}/{:args}');

//catch all
Router::connect('/{:controller}/{:action}/{:args}.{:type}');
Router::connect('/{:controller}/{:action}/{:args}');

Router::connect('/', 'Simulation::generate');
//Router::connect('/{:args}', array(), function($request) { header('Location: /login/url/'.str_replace('/','*',$request->url)); exit; });

?>

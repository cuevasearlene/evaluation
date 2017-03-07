<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['hostname'] 	= 'localhost';
$config['username'] 	= 'root';
$config['password'] 	= '';
$config['database'] 	= 'cvsu_evaluation';
$config['dbprefix'] 	= '';

if( $manual_connect == TRUE )
{
	$connection 	= @mysql_connect($config['hostname'], $config['username'], $config['password'], TRUE );
	
	$config['tempname'] 	= $tempname;
	$config['template'] 	= $template;
	
	if( ! function_exists('base_url'))
	{
		function base_url()
		{
			return BASEURL;	
		}
	}
	
	if( ! function_exists('site_url'))
	{
		function site_url($uri = '')
		{
			return base_url().$uri;	
		}
	}
}

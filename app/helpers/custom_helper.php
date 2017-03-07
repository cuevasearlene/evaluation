<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_country_by_ip'))
{
	function get_country_by_ip($ip_address = '')
	{
		$api_key  = 'c262293d7a59af37a5e81b095e05a430434dd1a2f0ffd68b6d477b2d1c2ad32e';
		return file_get_contents('http://api.ipinfodb.com/v3/ip-country/?key='.$api_key.'&ip='.$ip_address.'&format=json');
	}
}

if ( ! function_exists('debug'))
{
	function debug($str = '')
	{
		echo '<pre class="panel callout radius">';
		print_r($str);
		echo '</pre>';
	}
}

if ( ! function_exists('ip_location'))
{
	function ip_location($ip_address = '')
	{
		echo anchor('http://www.ipku.biz/?getip='.$ip_address, $ip_address, 'target="_blank"');
	}
}

if ( ! function_exists('num_format'))
{	
	function num_format($num = 0, $decimal = 0, $filesize = FALSE, $complex = FALSE)
	{
		if($complex == FALSE)
		{
			if($num >= 1000000000)
			{
				$num = ($num/1000000000);
				(!is_float($num)) ? $decimal = 0 : $decimal = 2;
				$title = 'B';
				
				if($filesize)
				{
					$title = 'GB';	
				}
			}
			if($num >= 1000000)
			{
				$num = ($num/1000000);
				(!is_float($num)) ? $decimal = 0 : $decimal = 2;
				$title = 'M';
				
				if($filesize)
				{
					$title = 'MB';	
				}
			}
			if($num >= 1000)
			{
				$num = ($num/1000);
				(!is_float($num)) ? $decimal = 0 : $decimal = 2;
				$title = 'K';
				
				if($filesize)
				{
					$title = 'KB';	
				}
			}
		}

		$num = number_format($num, $decimal, '.', ',');
		
		return $num.$title;
	}
}

if ( ! function_exists('bank_format'))
{	
	function bank_format($name = '', $account_no = '')
	{
		$name 		= trim($name);
		$account_no = trim($account_no);

		switch ($name) {
			case 'BCA':
				 if(strlen($account_no) != 10)
				 {
				 	return 'Nomor Rekening BCA harus 10 digit';
				 }
				break;
			case 'Bank Mandiri':
				 if(strlen($account_no) != 13)
				 {
				 	return 'Nomor Rekening Bank Mandiri harus 13 digit';
				 }
				break;
			case 'BRI':
				 if(strlen($account_no) != 15)
				 {
				 	return 'Nomor Rekening BRI harus 15 digit';
				 }
				break;
			case 'BNI':
				 if(strlen($account_no) != 10)
				 {
				 	return 'Nomor Rekening BNI harus 10 digit';
				 }
				break;
			default:
					return $name.' not available';
		}
	}
}

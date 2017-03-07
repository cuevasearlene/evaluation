<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('format_date'))
{
	function format_date($str_date = '', $format = 'full', $divider = ' ')
	{
		$CI =& get_instance();
		
		$default_lang = $CI->config->item('language');
		
		$CI->lang->load('date', $default_lang);
		
		$day_index 		= date('N', strtotime($str_date));
		$day_name		= date('l', strtotime($str_date));
		$date			= date('d', strtotime($str_date));
		$month			= date('m', strtotime($str_date));
		$month_index	= date('n', strtotime($str_date));
		$month_name		= date('F', strtotime($str_date));
		$full_year		= date('Y', strtotime($str_date));
		$small_year		= date('y', strtotime($str_date));
		$times			= date('h:i A', strtotime($str_date));
		
		switch( $format )
		{
			case 'short':
				$days_list 		= $CI->lang->line('short_days_list');
				$months_list 	= $CI->lang->line('short_month_list');
			break;
			
			case 'medium':
				$days_list 		= $CI->lang->line('full_days_list');
				$months_list 	= $CI->lang->line('short_month_list');
			break;
			
            case 'bb':
				$days_list 		= $CI->lang->line('full_days_list');
				$months_list 	= $CI->lang->line('short_month_list');
			break;
            
            case 'formal':
				$months_list 	= $CI->lang->line('short_month_list');
			break;
            
			default:
				$days_list 		= $CI->lang->line('full_days_list');
				$months_list 	= $CI->lang->line('full_month_list');
			break;
		}
		
		if( is_array($days_list))
		{
			$output_day = $days_list[$day_index];
		}
		else
		{
			$output_day = $day_name;
		}
		
		if( is_array($months_list))
		{
			$output_month = $months_list[$month_index];
		}
		else
		{
			$output_month = $month_name;
		}
		
		switch( $format )
		{
			case 'day':
				$formated = $output_day;
			break;
			
			case 'month':
				$formated = $output_month;
			break;
			
			case 'year':
				$formated = $full_year;
			break;
			
			case 'short':
				$formated = $date.$divider.$output_month.$divider.$small_year.' - '.$times;
			break;
			
			case 'medium':
				$formated = $output_day.', '.$date.$divider.$output_month.$divider.$small_year.' - '.$times;
			break;
			
			case 'short_date':
				$formated = date("d M Y", strtotime($str_date));
			break;
			
			case 'show_date':
				$formated = $date.$divider.$month.$divider.$full_year;
			break;
			
			case 'full_date':
				$formated = $output_day.', '.$date.$divider.$output_month.$divider.$full_year;
			break;
			
			case 'just_date':
				$formated = $date.$divider.$output_month.$divider.$full_year;
			break;
            
            case 'bb':
				$formated = $output_day.', '.$date.'/'.$month.'/'.$full_year.' '.$times;
			break;
			
            case 'formal':
				$formated   = date("d M Y", strtotime($str_date));
			break;
            
			default:
				$formated = $output_day.', '.$date.$divider.$output_month.$divider.$full_year.' - '.$times;
			break;
		}
		/*
		if( date('Y-m-d', strtotime($str_date)) == date('Y-m-d'))
		{
			$formated = $CI->lang->line('today');
		}
		*/
		return $formated;
	}
}

if( ! function_exists('facebook_timespan'))
{
	function facebook_timespan($datetime, $show = 'complex')
	{
		if( empty($datetime))
		{
			return FALSE;
		}

		date_default_timezone_set('Asia/Manila');
		
		$CI =& get_instance();
		
		$default_lang = $CI->config->item('language');
		
		$CI->lang->load('date', $default_lang);
			
		list($date, $time) = explode(' ', $datetime);
        list($year, $month, $day) = explode('-', $date);
        list($hour, $minute, $second) = explode(':', $time);
 
		$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
		
		$day_index 		= date('N', $timestamp);
		$day_name		= date('l', $timestamp);
		$date			= date('d', $timestamp);
		$month			= date('m', $timestamp);
		$month_index	= date('n', $timestamp);
		$month_name		= date('F', $timestamp);
		$full_year		= date('Y', $timestamp);
		$small_year		= date('y', $timestamp);
		$times			= date('h:i A', $timestamp);
		
		$days_list 			= $CI->lang->line('full_days_list');
		$short_days_list	= $CI->lang->line('short_days_list');
		$months_list 		= $CI->lang->line('full_month_list');
		
		// timespan dari CI's date helper
		$timespan = strtolower(timespan($timestamp));
		$timespan = str_replace(',','',$timespan);
		$exp = explode(' ',$timespan);
		$k = $exp[1];
		$v = $exp[0];
		
		$years = floor($datetime / 31536000);
		$lang_year = strtolower($CI->lang->line((($years > 1) ? 'date_years' : 'date_year')));
		
		$seconds -= $years * 31536000;
		$months = floor($seconds / 2628000);

		$lang_month = strtolower($CI->lang->line((($months > 1) ? 'date_months' : 'date_month')));
		
		$seconds -= $months * 2628000;

		$weeks = floor($seconds / 604800);
		$lang_week = strtolower($CI->lang->line((($weeks > 1) ? 'date_weeks' : 'date_week')));
		
		$seconds -= $weeks * 604800;

		$days = floor($seconds / 86400);
		$lang_day = strtolower($CI->lang->line((($days > 1) ? 'date_days' : 'date_day')));
	
		$seconds -= $days * 86400;
			
		$hours = floor($seconds / 3600);
		$lang_hour = strtolower($CI->lang->line((($hours > 1) ? 'date_hours' : 'date_hour')));
		
		$seconds -= $hours * 3600;

		$minutes = floor($seconds / 60);
		$lang_minute = strtolower($CI->lang->line((($minutes > 1) ? 'date_minutes' : 'date_minute')));

		$seconds -= $minutes * 60;
		$lang_second = strtolower($CI->lang->line((($seconds > 1) ? 'date_seconds' : 'date_second')));

		if($v > 0)
		{
			if( $show == 'complex' )
			{
				if (stristr($k, $lang_year ) || date('Y') > $full_year)
				{
					$_output = $days_list[$day_index].', '.$date.' '.$months_list[$month_index].' '.$full_year;
				}
				elseif (stristr($k, $lang_week) || stristr($k, $lang_month))
				{
					$_output = $days_list[$day_index].', '.$date.' '.$months_list[$month_index].' '.$CI->lang->line('time_at').' '.$times;
				}
				elseif (stristr($k, $lang_day) || stristr($k, $lang_hour) || stristr($k, $lang_minute) || stristr($k, $lang_second))
				{
					if($v >= 2 && stristr($k,'day'))
					{
						$_output = $days_list[$day_index].' '.$CI->lang->line('time_at').' '.$times;
					}
					elseif (date('j') - date('j', $timestamp) == 1)
					{
						$_output = $CI->lang->line('yesterday').' '.$CI->lang->line('time_at').' '.$times;
					}
					elseif ((date('D') == date('D', $timestamp)) && (($v >= 10) AND stristr($k, $lang_hour)))
					{
						$_output = $CI->lang->line('today').' '.$CI->lang->line('time_at').' '.$times;
					}
					elseif ((stristr($k, $lang_hour) && $v < 10) || stristr($k, $lang_minute) || stristr($k, $lang_second))
					{
						$_output = $v.' '.$k.' '.$CI->lang->line('time_ago');
						if(stristr($k, $lang_second) && $v <= 59)
						{
							$_output = $CI->lang->line('moment_ago');
						}
					}
					else
					{
						$_output = $days_list[$day_index].', '.$date.' '.$months_list[$month_index].' '.$CI->lang->line('time_at').' '.$times;
					}
				}
			}
			else
			if( $show == 'change_pass' )
			{
				if (stristr($k, $lang_year ) || date('Y') > $full_year)
				{
					$_output = $CI->lang->line('change_pass_long_time').' '.$days_list[$day_index].', '.$date.' '.$months_list[$month_index].' '.$full_year;
				}
				elseif (stristr($k, $lang_week) || stristr($k, $lang_month))
				{
					$_output = $CI->lang->line('change_pass_long_time').' '.$days_list[$day_index].', '.$date.' '.$months_list[$month_index].' '.$CI->lang->line('time_at').' '.$times;
				}
				elseif (stristr($k, $lang_day) || stristr($k, $lang_hour) || stristr($k, $lang_minute) || stristr($k, $lang_second))
				{
					if($v >= 2 && stristr($k,'day'))
					{
						$_output = $CI->lang->line('change_pass_long_time').' '.$days_list[$day_index].' '.$CI->lang->line('time_at').' '.$times;
					}
					elseif (date('j') - date('j', $timestamp) == 1)
					{
						$_output = $CI->lang->line('change_pass_long_time').' '.$CI->lang->line('yesterday').' '.$CI->lang->line('time_at').' '.$times;
					}
					elseif ((date('D') == date('D', $timestamp)) && (($v >= 10) AND stristr($k, $lang_hour)))
					{
						$_output = $CI->lang->line('change_pass_long_time').' '.$CI->lang->line('today').' '.$CI->lang->line('time_at').' '.$times;
					}
					elseif ((stristr($k, $lang_hour) && $v < 10) || stristr($k, $lang_minute) || stristr($k, $lang_second))
					{
						if(stristr($k, $lang_second) && $v <= 15)
						{
							$_output = $CI->lang->line('moment_ago');
						}
						$_output = $CI->lang->line('change_pass_short_time').' '.$v.' '.$k.' '.$CI->lang->line('time_ago');
					}
					else
					{
						$_output = $CI->lang->line('change_pass_long_time').' '.$days_list[$day_index].', '.$date.' '.$months_list[$month_index].' '.$CI->lang->line('time_at').' '.$times;
					}
				}
			}
			else
			if( $show == 'short' )
			{
				$_output = $v.' '.$k.' '.$CI->lang->line('time_ago');
			}
			
			return $_output;
		}
		else
		{
			return 'just now';
		}
	}
}


if( ! function_exists('interval_date'))
{
	function interval_date($from, $to)
	{
		$tgl_awal = strtotime($from);
		$tgl_akhir = strtotime($to);
		$offset = $tgl_akhir-$tgl_awal; 
		return floor($offset/60/60/24);
	}
}
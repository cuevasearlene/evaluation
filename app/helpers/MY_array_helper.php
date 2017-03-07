<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function array_search_multidimension($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, array_search_multidimension($subarray, $key, $value));
        }
    }

    return $results;
}

/**
 * Push Multidemension array
 */
if(!function_exists('array_push_multidimension'))
{	
	function array_push_multidimension($array_data = array(), $array_push = array())
	{
		$array = array();
		if(is_array($array_data))
		{
			foreach($array_data as $key => $val) 
			{
				$array[$key] = $val;
				foreach($array_push as $push_key => $push_val)
				{
					$array[$push_key] = $push_val;
					if(is_array($push_key))
					{
						return array_push_multidimension($array, $push_key);	
					}
				}
			}
		}
		else
		{
			foreach($array_push as $push_key => $push_val)
			{
				$array[$push_key] = $push_val;
				if(is_array($push_key))
				{
					return array_push_multidimension($array, $push_key);	
				}
			}
		}
		
		return ($array);
	}
}

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('delete_file'))
{
	function delete_file($_path, $_filename)
	{
		$files_path = @rtrim( $_path, '/' );

		if( ! is_dir($_path))
		{
			return show_error('Please select spesific folder to list file!');
		}		

		if( ! is_file($_path.'/'.$_filename))
		{
			return show_error('File not exists! '.$_path.'/'.$_filename);
		}				

		if( $dir_name 	= @opendir( $files_path ) )
		{
			$filedata = array();			

			while( FALSE !== ( $file = @readdir($dir_name) ))
			{
				if( $file == $_filename )
				{
					@chmod($_path.$_filename, 0666);
					return @unlink( $_path.$_filename );
				}
			}
		}
	}
}
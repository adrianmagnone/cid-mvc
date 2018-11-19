<?php

namespace Cid\Input;

class Post
{
	public static function getString($field)
	{
		return Post::get_value($field, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	}

	public static function getInteger($field)
	{
		return (int)Post::get_value($field, FILTER_SANITIZE_NUMBER_INT);
	}

	public static function getFloat($field)
	{
		return (float)Post::get_value($field, FILTER_SANITIZE_NUMBER_FLOAT);
	}

	public static function getMail($field)
	{
		$mail = Post::get_value($field, FILTER_VALIDATE_EMAIL);
		if ($mail)
		{
			return Post::get_value($field, FILTER_SANITIZE_EMAIL);
		}
		return false;
	}

	public static function getHtmlString($field)
	{
		return Post::get_value($field, FILTER_SANITIZE_SPECIAL_CHARS);
	}

	private static function get_value($field, $filter, $options = null)
	{
		// Se eligio filter_var en lugar de filter_input
		// por la posibilidad que da de realizar test de unidad
		if (! isset($_POST[$field]))
		{
			return false;
		}
		return trim(filter_var($_POST[$field], $filter, $options));
	}
}
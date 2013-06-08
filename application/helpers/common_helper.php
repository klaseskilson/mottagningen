<?php

/**
 * returns a random string
 * @param 	int 	$max 	string max length
 * @param 	int 	$min 	string min length
 * @return 	String 	the string
 */
function random($min = 5, $max = 7)
{
	$length = rand($min, $max);
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$str = '';

	for($i = 0; $i < $length; $i++)
		$str .= $chars[rand(0, strlen($chars)-1)];

	return $str;
}

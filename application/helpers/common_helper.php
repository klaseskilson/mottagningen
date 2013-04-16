<?php

/**
 * encrypts password using the strongest method available on the system
 * @param 	String 	$password 	the string to be encrypted
 */
function encrypt_password($password)
{
	$salt = 'L3G10NeN_swa!g';
	if(CRYPT_SHA512 == 1)
	{
		return substr(crypt($password, '$6$rounds=10000$'.$salt.'$'),33);
	}
	if (CRYPT_SHA256 == 1)
	{
	    return substr(crypt($password, '$5$rounds=10000$'.$salt.'$'),33);
	}
	if (CRYPT_MD5 == 1)
	{
	    return substr(crypt($password, '$1$'.$salt.'$'),12);
	}

	return false;
}

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

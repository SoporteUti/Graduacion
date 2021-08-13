<?php
namespace sispg\Utils;

use sispg\UserCredentials;
class UserCredentialGenerator
{
	
	private $pass_min = 8;
	private $pass_max = 15;
	private $user_min = 3;
	private $user_max = 12;
	private $user_case = FALSE;

	public function __construct()
	{
		
	}
	
	public function generateE( $prefix )
	{
		
		$password = $this->genPassword( $this->pass_min, $this->pass_max );
		return new UserCredentials(['password'=>$password]);
	}
	
	private function genUsername( $min, $max, $case_sensitive = false )
	{
		// Set length
		$length = rand($min, $max);
		
		// Set allowed chars (And whether they should use case)
		if ( $case_sensitive )
		{
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		}
		else
		{
			$chars = "abcdefghijklmnopqrstuvwxyz";
		}
			
		// Get string length
		$chars_length = strlen($chars);
		
		// Create username char for char
		$username = "";
		
		for ( $i = 0; $i < $length; $i++ )
		{
			$username .= $chars[mt_rand(1, $chars_length)-1];
		}
		
		return $username;
		
	}
	
	private function genPassword( $min, $max)
	{
		// Set length
		$length = rand($min, $max);
	
		// Set charachters to use
		$lower = 'abcdefghijklmnopqrstuvwxyz';
		$upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$chars = '1234567890';
		
		// Calculate string length
		$lower_length = strlen($lower);
		$upper_length = strlen($upper);
		$chars_length = strlen($chars);
	
		// Generate password char for char
		$password = '';
		$alt = time() % 2;
		for ($i = 0; $i < $length; $i++)
		{
			if ($alt == 0)
			{
				$password .= $lower[mt_rand(1, $lower_length)-1]; $alt = 1;
			}
			if ($alt == 1)
			{
				$password .= $upper[mt_rand(1, $upper_length)-1]; $alt = 2;
			}
			else
			{
				$password .= $chars[mt_rand(1, $chars_length)-1]; $alt = 0;
			}
		}
		return $password;
	}
}
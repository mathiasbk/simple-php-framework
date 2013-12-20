<?php

class DB
{
	//private $_config;
	
	private $DBhost, $DBusername, $DBpassword, $DBdatabase; 	//Defines the DB configs 
	
	public function __construct() 
	{
		global $DBconfig;		//Loades the configfile
		$this->DBhost = $DBconfig['DBhost'];
		$this->DBusername = $DBconfig['username'];
		$this->DBpassword = $DBconfig['password'];
		$this->DBdatabase = $DBconfig['database'];
	}
	
	public function Connect()
	{
		//echo $this->DBusername;
		$con = mysql_connect($this->DBhost, $this->DBusername, $this->DBpassword)or die(mysql_error());
		if(!$con) die("'Could not connect to mysql. Error message: " . mysql_error());
		
		mysql_select_db($this->DBdatabase) or die("Can't select DB!");
	}
	
	public function Query($querystring)
	{
			$mysql_result = mysql_query($querystring);
			
			return $mysql_result;
	}
	
	public function Close()
	{
		mysql_close();
	}
	
}


class Security
{
	public function String_verify($string)
	{
		/*****************************************************************************
		/*  Function:    Encryptstring
		/*  Description: Encrypts a string using sha1, md5 and sha1
		/*  Inputs:      String to encrypt
		/*  Outputs:     encrypted string
		*****************************************************************************/
		
		return mysql_real_escape_string($string);
	}
	
	public function Hash_String($string)
	{
		return sha1(md5(sha1($string)));
	}
	
	public function Validate_Array($array)	//Checks if there is a emptry string in a array
	{
		foreach($array as $value)
		{
			if($value[1] == NULL)
			{
				Return false;

			}
		}
		Return true;
	}
}

?>
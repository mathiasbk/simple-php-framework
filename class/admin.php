<?php

class users
{
	private $UsersTable;
	
	public function __construct()
	{
		global $DBtables;
		$this->UserTable = $DBtables['users'];
	}
	
	public function Login($username, $password)
	{
		/*****************************************************************************
		/*  Function:    Login
		/*  Description: Checks if the user is already logged in, if not, logs in.
		/*  Inputs:      $username, $password
		/*  Outputs:     Array.first object = status, 2. object = message. 
								[0] = successfully logged in
								[1] = Not successfull
		*****************************************************************************/
		$Security = new Security();
		if(isset($_SESSION['login']))
		{
			return array("1", "Already logged in");
		}
		
		$username =$Security->String_verify($username);
		$password = $Security->String_verify($Security->EncryptString($password));
		$Login_sql = "SELECT * FROM ".$this->UserTable." WHERE username='$username' and password='$password'";
		
		$result = mysql_query($Login_sql);
		
		if(mysql_num_rows($result) == 1)	//if the user exists
		{
			$_SESSION['login'] = md5('ok');
			$_SESSION['userinfo'] = mysql_fetch_array($result);
			return array("0", "Login successfully");
		}
		
		return array("1", "unknown error");
	}
	
	public function LogOut()
	{
		/*****************************************************************************
		/*  Function:    LogOut
		/*  Description: Destroys the logged in session
		/*  Inputs:      
		/*  Outputs:     
		*****************************************************************************/
		//session_start();
		session_destroy();
	}
	
	public function CreateUser($userconfig)
	{
		/*****************************************************************************
		/*  Function:    CreateUser
		/*  Description: Creates a user from a array of data
		/*  Inputs:      Two-dimension array with data for the user. First dimension 
						 is the ROW, and the secound dimension is the data to be put
						 in that row
		/*  Outputs:     Error message, or Successfull message 
		*****************************************************************************/
		
		$password;
		$username;
		$email;
		$Security = new Security(); 						//initialize the security class
		
		
		//START: Checks if the strings are accepted
		if(!$Security->Validate_Array($userconfig))
		{
			return("A field was empty!");
		}
		//END: Checks if the strings are accepted
		
		
		
		//START: Encrypts the password
		foreach($userconfig as &$value)
		{
			if($value[0] == "password")
			{
				
				$value[1] = $Security->EncryptString($value[1]);	//calls a security function to encrypt password
				$password = $value[1];
			}
			if($value[0] == "username") $username = $value[1];
			if($value[0] == "email") $email = $value[1];

		}
		//END: Encrypts the password
		
		
		//START: Checks if the user already exist
		
		$userquery = "SELECT * FROM ".$this->UserTable." WHERE username='$username'";
		$UserQueryResult = mysql_query($userquery) or die(mysql_error());
		if(mysql_num_rows($UserQueryResult) != 0)
		{
			Return "Username already exist!"; 
		}
		$Mailquery = "SELECT * FROM ".$this->UserTable." WHERE email='$email'";
		$MailQueryResult = mysql_query($Mailquery) or die(mysql_error());
		if(mysql_num_rows($MailQueryResult) != 0)
		{
			Return "Email already exist!"; 
		}
		
		
		//END: Check if the user already exist
		
		
		//Creats a single string from the array
		$tmpcolum = array(); //Temp array which stores the colum to insert it into
		$tmpvalue = array(); //Temp array whitch stores the values
		foreach($userconfig as $userconfigs){
			$tmpcolum[] = $userconfigs[0];
			$tmpvalue[] = "'".$userconfigs[1]."'";
		}
		$Formatted_output_Colum = implode(", ", $tmpcolum);
		$Formatted_output_Value = implode(", ", $tmpvalue);
	
		$sql = ("INSERT INTO users ($Formatted_output_Colum) VALUES ($Formatted_output_Value)");
		if(!mysql_query($sql)) die('Error: ' . mysql_error());	//checks if the creation of a new user was successfull.
		
		return "<br>Successfully created user!";
	}
	
	public function EditUser($userconfig, $id)
	{
		/*****************************************************************************
		/*  Function:    EditUser($id, $userarray)
		/*  Description: Edits the user in mysql
		/*  Inputs:      $id, $userconfig (array)
		/*  Outputs:     Array.first object = status, 2. object = message. 
								[0] = successfully logged in
								[1] = Not successfull
		*****************************************************************************/
		$password;
		$username;
		$email;
		$Security = new Security(); 						//initialize the security class
		
		
		//START: Checks if the strings are accepted
		if(!$Security->Validate_Array($userconfig))
		{
			return array(1, "A field was empty!");
		}
		//END: Checks if the strings are accepted
		
		
		
		//START: Encrypts the password
		foreach($userconfig as &$value)
		{
			if($value[0] == "password")
			{
				
				$value[1] = $Security->EncryptString($value[1]);	//calls a security function to encrypt password
				$password = $value[1];
			}
			if($value[0] == "username") $username = $value[1];
			if($value[0] == "email") $email = $value[1];

		}
		//END: Encrypts the password
		
		
		//Creats a single string from the array
		$tmpcolum = array(); //Temp array which stores the colum to insert it into
		$tmpvalue = array(); //Temp array whitch stores the values
		$teststring = "";
		$firstloop = true;
		foreach($userconfig as $userconfigs){
			$tmpcolum[] = $userconfigs[0];
			$tmpvalue[] = "'".$userconfigs[1]."'";
			
			if($firstloop) $firstloop = false;	//To prevent it from adding , at the start
			else $teststring.= ", ";
			
			$teststring .= "`".$userconfigs[0]."` = '" . $userconfigs[1]."'";
		}
		
		$sql = ("UPDATE ".$this->UserTable." SET ".$teststring . " WHERE ID=".$id);
		if(!mysql_query($sql)) die('Error: ' . mysql_error());	//checks if the creation of a new user was successfull.
		
		return array(0, "<br>Updated the user!");
	}
	
	public function DeleteUser($id)
	{
		/*****************************************************************************
		/*  Function:    DeleteUser($ID)
		/*  Description: Detes the user with ID=$ID
		/*  Inputs:      $ID
		/*  Outputs:     return - Success or errormessage
		*****************************************************************************/

		$DeleteQuery = "DELETE FROM ".$this->UserTable ." WHERE ID=$id";
		if(!mysql_query($DeleteQuery)) die('Error: ' . mysql_error());
		return "User deleted!";
	}
	
}



?>
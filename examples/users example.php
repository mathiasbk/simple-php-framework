<?php
session_Start();
include("../config.php");
include("../class/public.php");
include("../class/admin.php");

$db = new DB;
$users = new users;


echo $db->connect();


/*****************************************************************************
/*  Function:    CreateUser
/*  Description: Creates a user from a array of data
/*  Inputs:      Two-dimension array with data for the user. First dimension 
				 is the ROW, and the secound dimension is the data to be put
				 in that row
/*  Outputs:     Error message, or Successfull message 
*****************************************************************************/
/*
$userconf = array( 	array("username", "Msathias"),
					array("email", "mathias@test.no"),
					array("password", "hemmelig"));
					
echo $users->CreateUser($userconf);
*/


/*****************************************************************************
/*  Function:    DeleteUser($ID)
/*  Description: Detes the user with ID=$ID
/*  Inputs:      $ID
/*  Outputs:     return - Success or errormessage
*****************************************************************************/
//echo $users->DeleteUser(1); //ID



/*****************************************************************************
/*  Function:    Login
/*  Description: Checks if the user is already logged in, if not, logs in.
/*  Inputs:      $username, $password
/*  Outputs:     Array.first object = status, 2. object = message. 
						[0] = successfully logged in
						[1] = Not successfull
*****************************************************************************/

//echo $users->Login("Mathias", "hemmelig")[1];

//$users->LogOut();

/*****************************************************************************
/*  Function:    EditUser($id, $userarray)
/*  Description: Edits the user in mysql
/*  Inputs:      $id, $userconfig (array)
/*  Outputs:     Array.first object = status, 2. object = message. 
						[0] = successfully logged in
						[1] = Not successfull
*****************************************************************************/
/*
$userconf = array( 	array("username", "Mathias"),
					array("email", "mathias@test.no"),
					array("password", "hemmelig"));
echo $users->EditUser($userconf, 2)[1];
*/


/*****************************************************************************
/*  Function:    EditUser($id, $userarray)
/*  Description: Edits the user in mysql
/*  Inputs:      $OrderBy, $SortOrder
					$Orderby Example. "ID"
					$SortOrder can have "DESC" or "ASC".
/*  Outputs:     Twodimensional array with userdata
*****************************************************************************/
var_dump($users->ListUsers("ID", "DESC"));

?>
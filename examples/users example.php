<?php
session_Start();
include("../config.php");
include("../class/public.php");
include("../class/admin.php");

$db = new DB;
$users = new users;


echo $db->connect();

spacer("Creae User");
/*****************************************************************************
/*  Function:    CreateUser
/*  Description: Creates a user from a array of data
/*  Inputs:      Two-dimension array with data for the user. First dimension 
				 is the ROW, and the secound dimension is the data to be put
				 in that row
/*  Outputs:     Error message(BOOL), or Successfull message 
*****************************************************************************/

$userconf = array( 	array("username", "Mssathias"),
					array("email", "masathias@test.no"),
					array("password", "hemmelig"));
					



$resultCreate = $users->CreateUser($userconf);
if($resultCreate[0]) echo "Success: " . $resultCreate[1];
else Echo "Error: " . $resultCreate[1];


spacer("Delete User");
/*****************************************************************************
/*  Function:    DeleteUser($ID)
/*  Description: Detes the user with ID=$ID
/*  Inputs:      $ID
/*  Outputs:     return - Success or errormessage
*****************************************************************************/


$resultDelete = $users->DeleteUser(4); 				//4 is just a example ID for a user
if($resultDelete[0]) echo "Success: " . $resultDelete[1];
else Echo "Error: " . $resultDelete[1];

spacer("Login");
/*****************************************************************************
/*  Function:    Login
/*  Description: Checks if the user is already logged in, if not, logs in.
/*  Inputs:      $username, $password
/*  Outputs:     Array.first object = status, 2. object = message. 
						[0] = successfully logged in
						[1] = Not successfull
*****************************************************************************/

$resultLogin = $users->Login("Mathias", "hemmelig"); 				//4 is just a example ID for a user
if($resultLogin[0]) echo "Success: " . $resultLogin[1];
else Echo "Error: " . $resultLogin[1];



//$users->LogOut(); //if for logout

spacer("Edit User");
/*****************************************************************************
/*  Function:    EditUser($id, $userarray)
/*  Description: Edits the user in mysql
/*  Inputs:      $id, $userconfig (array)
/*  Outputs:     Array.first object = status, 2. object = message. 
						[0] = successfully logged in
						[1] = Not successfull
*****************************************************************************/

$userconf = array( 	array("username", "Mathias"),
					array("email", "mathias@test.no"),
					array("password", "hemmelig"));
					
//echo $users->EditUser($userconf, 2)[1];


$resultEdit = $users->EditUser($userconf, 2); 				//4 is just a example ID for a user
if($resultEdit[0]) echo "Success: " . $resultEdit[1];
else Echo "Error: " . $resultEdit[1];


spacer("List Users");
/*****************************************************************************
/*  Function:    ListUsers($id, $userarray)
/*  Description: Edits the user in mysql
/*  Inputs:      $OrderBy, $SortOrder
					$Orderby Example. "ID"
					$SortOrder can have "DESC" or "ASC".
/*  Outputs:     Twodimensional array with userdata
*****************************************************************************/
echo "<br><br> All users: <br>";

$UsersArray = $users->ListUsers("ID", "DESC");

echo "<table border=\"1\"><tr><th>ID </th><th>email</th><th>Username</th><th>password</th></tr>";

foreach($UsersArray as $v){
    echo "<tr>";
    foreach($v as $vv){
        echo "<td>{$vv}</td>";
    }
    echo "<tr>";
}
echo "</table>";


var_dump($UsersArray);



function spacer($action) //just a function to seperate each action done by this example file.
{
	echo "<br><br> -------------------------  $action   ------------------------------------- <br><br>";
}
?>
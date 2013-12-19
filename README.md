About {#index}
=====

**This is a very simple PHP library for making dynamic websites easy and fast.**

Already implemented:

User:

	- Login
	- Logout
	- Create user
	- Delete user
	- Edit user
	- ListUsers
	

----

Some of the rows in the usertable is static for now. Working on making it dynamic somehow.

Userrows to use:
users

	- password 		//to edit: $users->Createusers, $users->Login
	- email			//to edit: $users->Createusers,
	- username		//to edit: $users->Createusers, $users->Login
	

SESSIONS

	- $_SESSION['login']	//MD5 encrypted
	- $_SESSION['userinfo']	array with info about the logged in users
	
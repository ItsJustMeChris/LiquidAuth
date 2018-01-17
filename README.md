**Liquid Auth**


----------
Liquid Auth is an easy to use object oriented PHP user authentication.  
Liquid Auth offers secure features, and a fast to implement user authentication experience.  


----------
Current Usage:

    require_once __DIR__ . '/core/core.php';
Post request to: https://localhost/users/login.php with parameters 

    username=<username or email>&password=<password>
    
Post request to: https://localhost/users/register.php with parameters 

    username=<username>&password=<password>&email=<email>
    
Post request to: https://localhost/users/logout.php 
 


----------


User Advanced Usage   

    require_once __DIR__ . '/../users/users_class.php';
	$users = new Users;
User Class Functions:

    $users->loggedIn();
    Returns boolean value if user is currently logged in or not.  
    
    $users->logOut();
    Void immediately destroys the users session, logging them out.  

    $users->login(string $username, string $password);
    Void logs the user in if the username and password match.  
 
    $users->register(string $username, string $email, string $password);
    Void registers a new user if a user does not exist with the given username or email. 
  
  


----------
Database Advanced Usage

	require_once __DIR__ . '/../database/database_class.php';
	$db = new Database;

Database Class Functions:

    $db->query(string $query);
    Returns query results.   
    
    $db->escape(string $string);
    Returns escaped string using $mysqli->escape_string  


----------
TODO

	Automate installation.  
	Revive config file for database login and such. 
	More features, backend admin panel?
	Improve session security
	-Session Keys
	-CSRF Tokens
	-Cookies in the future

  

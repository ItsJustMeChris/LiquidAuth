<?php
namespace LiquidAuth\Classes;
class Users {
    public $loggedInError = 'Already Logged In';
    public $invalidLoginError = 'Invalid Username or Password';
    public $invalidFieldsError = 'Invalid Fields';
    public $notLoggedInError = 'Not Logged In';
    public $userExistsError = 'User Exists';
    public $registerError = 'Invalid Username, Email, or Password';
    public $logoutMessage = 'Logged Out';
    public $loggedInMessage = 'Logged In';
    public $userCreatedMessage = 'User Created';

    function loggedIn() {
        if (isset($_COOKIE['user']) && isset($_COOKIE['user']['userid']) && isset($_COOKIE['user']['usersession']) && $this->validateSession($_COOKIE['user']['userid'], $_COOKIE['user']['usersession'])) {
            return true;
        } else {
            return false;
        }
    }

    function logOut() {
        if ($this->loggedIn()) {
            setcookie('user[userid]', "" , time()-3600, "/");
            setcookie('user[usersession]', "" , time()-3600, "/");
            die(json_encode(["success" => $this->logoutMessage]));
        } else {
            die(json_encode(["error" => $this->notLoggedInError]));
        }
    }

    function currentUserID() {
        if (isset($_COOKIE['user']) && isset($_COOKIE['user']['userid']) && isset($_COOKIE['user']['usersession']) && $this->validateSession($_COOKIE['user']['userid'], $_COOKIE['user']['usersession'])) {
            return $_COOKIE['user']['userid'];
        } else {
            return 0;
        }
    }

    function validateSession($f_userid, $f_sessionkey) {
        $db = new \LiquidAuth\Classes\Database;
        $sessionKey = $db->escape($f_sessionkey);
        $userID = intval($f_userid);
        $result = $db->query("SELECT * FROM `users` WHERE `id`='$userID' AND `session`='$sessionKey'");
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function generateSessionString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 35; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function login($f_username, $f_password) {
        $db = new \LiquidAuth\Classes\Database;
        $username = $db->escape($f_username);
        $randomString = $this->generateSessionString();
        $result = $db->query("SELECT * FROM `users` WHERE UPPER(`username`)=UPPER('$username') OR UPPER(`email`)=UPPER('$username')");
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                if (password_verify($f_password,$row['password'])) {
                    $db->query("UPDATE users SET `session`='$randomString' WHERE UPPER(`username`)=UPPER('$username')");
                    setcookie('user[userid]',$row['id'],time()+3600, "/");
                    setcookie('user[usersession]',$randomString,time()+3600, "/");
                    die(json_encode(["success" => $this->loggedInMessage]));
                } else {
                    die(json_encode(["error" => $this->invalidLoginError]));
                }
            }
        } else {
            die(json_encode(["error" => $this->invalidLoginError]));
        }
    }

    function register($f_username, $f_email, $f_password) {
        $db = new \LiquidAuth\Classes\Database;
        $email = $db->escape($_POST['email']);
        $username = $db->escape($_POST['username']);
        $passwordHash = $db->escape(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 11]));
        $result = $db->query("SELECT * FROM `users` WHERE `username`='$username' OR `email`='$email'");
        $timeNow = new DateTime();
        $timeNow = $timeNow->format("Y-m-d H:i:s");
        if ( $result->num_rows > 0 ) {
            die(json_encode(["error" => $this->userExistsError]));
        } else {
            $db->query("INSERT INTO users (username, email, password, regdate) VALUES ('$username', '$email', '$passwordHash', '$timeNow')");
            die(json_encode(["success" => $this->userCreatedMessage]));
        }
    }
}
?>

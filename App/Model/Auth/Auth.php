<?php

require_once __DIR__ . '/../../../database/DatabaseConnection.php';

class Auth {
    private $conn;

    public function __construct() {
        // Call the connection function to create an instance class
        $this->conn = $this->getDatabaseConnection();
    }

    // Function to get the connection
    private function getDatabaseConnection() {
        $dbConnection = new DatabaseConnection();
        return $dbConnection->getConnection();
    }

    // Function to validate the data from the form
    public function validate_sane($value) {
        // Drop the unnecessary spaces at the beginning % end
        $value = trim($value);

        // Sanitize the value using mysqli_real_scape_string()
        $value = mysqli_real_escape_string($this->conn, $value);

        return $value;
    }

    /**
     *  Function to get the ideal cost
     *  to crypt the pass & get the best 
     *  speed of the server
     * 
     */
    function cryptPass($pass) {
        $timeTarget = 0.05; // 50 milliseconds 
        
        $cost = 8;
        do {
            $cost++;
            $start = microtime(true);
            password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
            $end = microtime(true);
        } while (($end - $start) < $timeTarget);
        
        $pass_crypt = password_hash($pass, PASSWORD_DEFAULT);
        
        return $pass_crypt;
    }

    public function searchUser($credentials) {
         // Validate the data
         $user = $this->validate_sane($credentials["username"]);
         $password = $this->validate_sane($credentials["pass"]);
         
         // Build the query
         $validate_user = "SELECT username, pass, role FROM users WHERE username = ?";
         // Prepare the query
         $stmtSelect = $this->conn->prepare($validate_user);
         // Bind th username provided value to the parameter
         $stmtSelect->bind_param("s", $user);
         
         // If the query it's successful
         if ($stmtSelect->execute()) {
            // Get the matches from USER PASS & ROLE
            $stmtSelect->bind_result($dbUsername, $dbPassword, $dbRole);
    
            // If the row is not null
            if ($stmtSelect->fetch()) {
                // If the username & pass matches
                if (password_verify($password, $dbPassword)) {
                    $message = 'authenticated';
                    session_name('logged');
                    session_start();
                    $_SESSION['authenticated'] = true;
                    $_SESSION['lastAccess'] = date("Y-n-j H:i:s");
                    $_SESSION['role'] = $dbRole;
                    $_SESSION['user'] = $dbUsername;
                    return $message;
                } else { // In case the pass no matches with the username
                    $message = 'credentialsNotMatch';
                    return $message;
                }
            } else { // In case the row is null
                $message = 'userNotFound';
                return $message;
            }
        } else { // In case the query fail
            $message = 'fail';
            return $message;
        }
    }

    public function searchPass($credentials) {
        // Validate the data
        $oldPass = $this->validate_sane($credentials['oldPass']);
        $newPass = $this->validate_sane($credentials['pass']);
        $username = $this->validate_sane($credentials['user']);

        // Build the query
        $validate_user = "SELECT username, pass FROM users WHERE username = ?";
        
        // Prepare the query
        $stmtSelect = $this->conn->prepare($validate_user);

        // Bind the parameter value to prepared parameters
        $stmtSelect->bind_param("s", $username);
        
        // If execute the query
        if ($stmtSelect->execute()) {
            $user_validated = $stmtSelect->get_result();
            if (mysqli_num_rows($user_validated) > 0) {
                if (password_verify($oldPass, $user_validated['pass'])) {
                    // Crypt the pass only if the Old Password its OK
                    $securePass = $this->cryptPass($newPass);
                    // Build the query to update the pass
                    $updatePass = "UPDATE users SET pass = ? WHERE username = ?";
                    // Prepare the query
                    $stmtInsert = $this->conn->prepare($updatePass);
                    // Bind provided 
                    $stmtInsert->bind_param("ss", $securePass, $username);

                    // If execute the query
                    if ($stmtInsert->execute()) {
                        $message = 'success';
                    } else {
                        $message = 'fail';
                    }
                    return $message;
                } else { // If the Old Password its wrong
                    $message = 'badPass';
                    return $message;
                }
            }
        } else {
        $message = 'fail';
        return $message;
        }
    }
}

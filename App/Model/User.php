<?php
require_once __DIR__ . '/../../database/DatabaseConnection.php';

class User {
    private $conn;

    public function __construct() {
        // Call the connection function to create an instance class
        $this->conn = $this->getDatabaseConnection();
    }

    /**
     * Function to get the connection
     */
    private function getDatabaseConnection() {
        $dbConnection = new DatabaseConnection();
        return $dbConnection->getConnection();
    }

    /** 
     * Function to validate the data from the form
     */
    public function validate_sane($valor) {
        // Drop the unnecessary spaces at the beginning & end
        $valor = trim($valor);

        // Sanitize the value using mysqli_real_escape_string()
        $valor = mysqli_real_escape_string($this->conn, $valor);

        return $valor;
    }

    /**
     * Function to get the ideal cost
     * crypt the pass & get the best 
     * speed of the server
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

    public function addUser($credentials) {
        // Validate the data
        $username = $this->validate_sane($credentials["username"]);
        $mail = $this->validate_sane($credentials["mail"]);
        $password = $this->validate_sane($credentials["pass"]);
        $role = $this->validate_sane($credentials["role"]);
        
        // Crypt the pass
        $securePass = $this->cryptPass($password);
        
        /**
         * Validate the user id UNIQUE
         */
        $validate_user = "SELECT username FROM users WHERE username = ?"; // Build the query
        $stmtSelect = $this->conn->prepare($validate_user); // Prepare the query
        $stmtSelect->bind_param("s", $username); // Bind provided value to prepared parameter

        // If execute the query
        if ($stmtSelect->execute()) {
            $user_validated = $stmtSelect->get_result();
            if (mysqli_num_rows($user_validated) > 0) {
                $message = "userDuplicated";

                    // Comment this in case of error
                    // CLose the connection
                    $this->conn->close();

                    return $message;
                    exit();
            } else {
                $sql = "INSERT INTO users (`username`, `mail`, `pass`, `role`)
                 VALUES (?, ?, ?, ?)";

                // Prepare the query
                $stmt = $this->conn->prepare($sql);

                // Bind provided values to prepared parameters
                $stmt->bind_param("ssss", 
                    $username,
                    $mail,
                    $securePass,
                    $role
                );

                // If execute the query
                if ($stmt->execute()) {
                    $message = "success";

                    // Comment this in case of error
                    // Close the connection
                    $this->conn->close();

                    return $message;
                } else {
                    $message = "fail";
                    die("Error: " . $this->conn->error);
                    return $message;
                }
            }
        } else {
            $message = "fail";
            die("Error: " . $this->conn->error);
            return $message;
        }
    }

}

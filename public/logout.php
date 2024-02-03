<?php
    session_name("logged");
    session_start();

    // Close the session
    session_destroy();

    // Send the request with a message
    http_response_code(200);
    echo json_encode(['message' => 'Logout successful']);
?>

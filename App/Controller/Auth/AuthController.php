<?php
require_once __DIR__ . '/../../Model/Auth/Auth.php';
require_once __DIR__ . '/../../View/Auth/AuthView.php';

class AuthController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function login($credentials) {
        // Get the message from the model
        $message = $this->model->searchUser($credentials);

        // Validate the request to send the message
        switch ($message) {
            case ($message === 'authenticated'):
                $this->view->messageAuthenticated();
                break;
            case ($message === 'credentialsNotMatch'):
                $this->view->messageErrorPassword();
                break;
            case ($message === 'userNotFound'):
                $this->view->messageUserNotFound();
                break;
            case ($message === 'fail'):
                $this->view->messageUserFail();
                break;
        }
    }

    public function updatePass($credentials) {
        // Get the message from the model
        $message = $this->model->searchPass($credentials);

        // Validate the request to send the message
        switch ($message) {
            case ($message === 'success'):
                $this->view->messageSuccess();
                break;
            case ($message === 'badPass'):
                $this->view->messageRetry();
                break;
            case ($message === 'fail'):
                $this->view->messageFail();
                break;
        }
    }
}
<?php
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../View/UserView.php';

class UserController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function createUser($data) {
        // Get the message of the model
        $message = $this->model->addUser($data);

        // Send the message to the view
        switch ($message) {
            case ($message === 'success'):
                $this->view->messageSuccess();
                break;
            case ($message === 'userDuplicated'):
                $this->view->messageDuplicatedUser();
                break;
            case ($message === 'fail'):
                $this->view->messageFail();
                break;
        }
    }

}
<?php

namespace Core;

use Models\User;

include '../vendor/autoload.php';

class Controller {
    protected function model($model) {
        $model = new User;
        return $model;
    }
}
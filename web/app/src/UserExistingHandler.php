<?php

namespace App;

use App\Mapper\User;
use App\Repository\UserRepository;

class UserExistingHandler extends Handler {

    private UserRepository $_userRepository;

    public function __construct() {
        $this->_userRepository = new UserRepository();
    }

    public function handle(User $user): void {
        $existingUser = $this->_userRepository->tryFindByLogin($user->login);
        if ($existingUser) {
            parent::handle($existingUser);
            echo "UserExistingHandler success <br/>";;
            return;
        }

        throw new \Exception("User {$user->login} is not exists");
    }

}
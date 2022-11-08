<?php

namespace App;

use App\Mapper\User;

class UserAdminRoleHandler extends Handler {

    public function handle(User $user): void {
        if ($this->_isAdmin($user)) {
            parent::handle($user);
            echo "UserRoleHandler success <br/>";
            return;
        }

        throw new \Exception("User {$user->login} is not an admin");
    }

    private function _isAdmin(User $user): bool {
        return $user->role === User::USER_ROLE_ADMIN;
    }
}
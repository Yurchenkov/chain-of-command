<?php

namespace App\Repository;

use App\Mapper\User;

class UserRepository {

    private const USER_COUNT = 10;

    /**
     * @var User[]
     */
    private array $_users;

    public function __construct() {
        $this->_generateUsers();
    }

    private function _generateUsers(): void {
        for ($i = 0; $i < self::USER_COUNT; $i++) {
            $this->_users[] = $this->_createUser($i);
        }

        $this->_users[] = $this->_createAdmin();
    }

    private function _createUser(int $number): User {
        $user = new User();
        $user->login = "User#{$number}";
        $user->permissions = [User::PERMISSION_VIEW];
        return $user;
    }

    private function _createAdmin(): User {
        $user = new User();
        $user->login = "Admin";
        $user->role = User::USER_ROLE_ADMIN;
        $user->permissions = $user->getPermissionsList();
        return $user;
    }

    public function tryFindByLogin(string $login): ?User {
        foreach ($this->_users as $user) {
            if ($user->login === $login) {
                return $user;
            }
        }

        return null;
    }
}
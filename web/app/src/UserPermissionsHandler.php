<?php

namespace App;

use App\Mapper\User;

class UserPermissionsHandler extends Handler {

    /**
     * @var string[]
     */
    private array $_permissionsToCheck;

    public function __construct(array $permissions) {
        $this->_permissionsToCheck = $permissions;
    }

    public function handle(User $user): void {
        if ($this->_hasPermission($user)) {
            parent::handle($user);
            echo "UserPermissionsHandler success <br/>";
            return;
        }

        throw new \Exception("User {$user->login} has no permission");
    }

    private function _hasPermission(User $user): bool {
        return count(array_diff($this->_permissionsToCheck, $user->permissions)) === 0;
    }
}
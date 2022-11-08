<?php

namespace App\Mapper;

class User {

    public const USER_ROLE_USER = 'user';
    public const USER_ROLE_ADMIN = 'admin';
    public const PERMISSION_EDIT = 'edit';
    public const PERMISSION_VIEW = 'view';

    public string $login;
    public string $role = self::USER_ROLE_USER;
    public array $permissions = [];

    /**
     * @return string[]
     */
    public function getPermissionsList(): array {
        return [
            self::PERMISSION_EDIT,
            self::PERMISSION_VIEW,
        ];
    }
}
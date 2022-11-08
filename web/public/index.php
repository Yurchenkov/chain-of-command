<?php

include '../app/vendor/autoload.php';

$userExistingHandler = new \App\UserExistingHandler();
$userAdminRoleHandler = new \App\UserAdminRoleHandler();
$userPermissionsHandler = new \App\UserPermissionsHandler([\App\Mapper\User::PERMISSION_VIEW, \App\Mapper\User::PERMISSION_EDIT]);
$userActivityHandler = new \App\UserActivityHandler(2);

//1. Простая проверка на существование пользователя
$user1 = new \App\Mapper\User();
$user1->login = 'User';

$user2 = new \App\Mapper\User();
$user2->login = 'User#2';

try {
    $userExistingHandler->handle($user1);
} catch (Exception $exception) {
    echo $exception->getMessage() . "<br/>";
}

try {
    $userExistingHandler->handle($user2);
} catch (Exception $exception) {
    echo $exception->getMessage() . "<br/>";
}


//2. Проверка на действие доступное только админу. Цепочка UserExistingHandler -> UserAdminRoleHandler

$userExistingHandler->bind($userAdminRoleHandler);

try {
    $userExistingHandler->handle($user1);
} catch (Exception $exception) {
    echo $exception->getMessage() . "<br/>";
}

try {
    $userExistingHandler->handle($user2);
} catch (Exception $exception) {
    echo $exception->getMessage() . "<br/>";
}

$user3 = new \App\Mapper\User();
$user3->login = 'Admin';

try {
    $userExistingHandler->handle($user3);
} catch (Exception $exception) {
    echo $exception->getMessage() . "<br/>";
}

//3. Более сложная проверка на существование пользователя, который является админом и у которого есть определённые разрешения

$userExistingHandler->bind($userAdminRoleHandler)->bind($userPermissionsHandler);

$user4 = new \App\Mapper\User();
$user4->login = 'User#1';

try {
    $userExistingHandler->handle($user4);
} catch (Exception $exception) {
    echo $exception->getMessage() . "<br/>";
}

$user5 = new \App\Mapper\User();
$user5->login = 'Admin';
try {
    $userExistingHandler->handle($user5);
} catch (Exception $exception) {
    echo $exception->getMessage() . "<br/>";
}
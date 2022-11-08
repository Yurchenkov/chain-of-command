<?php

namespace App;

use App\Mapper\User;

abstract class Handler {

    private ?Handler $_next = null;

    public function handle(User $user): void {
        if (!$this->_next)
            return;

        $this->_next->handle($user);
    }

    public function bind(Handler $next): Handler {
        $this->_next = $next;
        return $next;
    }
}
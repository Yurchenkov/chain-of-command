<?php

namespace App;

use App\Mapper\User;

class UserActivityHandler extends Handler {

    private int $_requestsLimit;
    private int $_requestsCount;
    private int $_currentTime;

    public function __construct(int $requestsLimit) {
        $this->_requestsLimit = $requestsLimit;
        $this->_currentTime = time();
    }

    public function handle(User $user): void {
        if (time() > $this->_currentTime + 60) {
            $this->_requestsCount = 0;
            $this->_currentTime = time();
        }

        $this->_requestsCount++;

        if ($this->_requestsCount > $this->_requestsLimit) {
            throw new \Exception('Requests limit exceeded');
        }

        parent::handle($user);
    }
}
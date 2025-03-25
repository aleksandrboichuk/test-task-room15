<?php

namespace App\Services\Resource;

use App\Repositories\UserRepository;

class UserResourceService extends BaseResourceService
{
    public function __construct()
    {
        $this->setRepository(new UserRepository);
    }
}

<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Providers;

use App\Module\Users\Business\Writer\UsersWriter;
use App\Module\Users\Business\Writer\UsersWriterInterface;
use App\Module\Users\Persistence\UserDetailsEntityManager\UserDetailsEntityManager;
use App\Module\Users\Persistence\UserDetailsEntityManager\UserDetailsEntityManagerInterface;
use App\Module\Users\Persistence\UsersEntityManager\UsersEntityManager;
use App\Module\Users\Persistence\UsersEntityManager\UsersEntityManagerInterface;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->bind(UsersWriterInterface::class, UsersWriter::class);
        $this->app->bind(UsersEntityManagerInterface::class, UsersEntityManager::class);
        $this->app->bind(UserDetailsEntityManagerInterface::class, UserDetailsEntityManager::class);
    }
}

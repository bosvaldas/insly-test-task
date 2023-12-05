<?php

declare(strict_types=1);

namespace App\Module\Users\Communication\Providers;

use App\Module\Users\Business\Reader\UsersReader;
use App\Module\Users\Business\Reader\UsersReaderInterface;
use App\Module\Users\Business\Writer\UsersWriter;
use App\Module\Users\Business\Writer\UsersWriterInterface;
use App\Module\Users\Persistence\UserDetailsEntityManager\UserDetailsEntityManager;
use App\Module\Users\Persistence\UserDetailsEntityManager\UserDetailsEntityManagerInterface;
use App\Module\Users\Persistence\UserDetailsQueryContainer\UserDetailsQueryContainer;
use App\Module\Users\Persistence\UserDetailsQueryContainer\UserDetailsQueryContainerInterface;
use App\Module\Users\Persistence\UsersEntityManager\UsersEntityManager;
use App\Module\Users\Persistence\UsersEntityManager\UsersEntityManagerInterface;
use App\Module\Users\Persistence\UsersQueryContainer\UsersQueryContainer;
use App\Module\Users\Persistence\UsersQueryContainer\UsersQueryContainerInterface;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->bind(UsersWriterInterface::class, UsersWriter::class);
        $this->app->bind(UsersEntityManagerInterface::class, UsersEntityManager::class);
        $this->app->bind(UserDetailsEntityManagerInterface::class, UserDetailsEntityManager::class);
        $this->app->bind(UsersQueryContainerInterface::class, UsersQueryContainer::class);
        $this->app->bind(UserDetailsQueryContainerInterface::class, UserDetailsQueryContainer::class);
        $this->app->bind(UsersReaderInterface::class, UsersReader::class);
    }
}

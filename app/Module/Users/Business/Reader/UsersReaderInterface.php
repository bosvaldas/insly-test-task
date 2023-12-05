<?php

declare(strict_types=1);

namespace App\Module\Users\Business\Reader;

use Illuminate\Support\Collection;

interface UsersReaderInterface
{
    /**
     * @return \Illuminate\Support\Collection<\App\Models\User>
     */
    public function list(): Collection;
}

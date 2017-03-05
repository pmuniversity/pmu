<?php
/**
 * Created by PhpStorm.
 * User: nagesh.rao
 * Date: 04-03-2017
 * Time: 21:07
 */

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Container\Container;

class UserRepository extends EloquentRepository
{
    /**
     * Instantiate repository object with required data
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(User::class)
            ->setRepositoryId('userRepo');
    }
}
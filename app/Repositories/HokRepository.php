<?php

namespace App\Repositories;

use App\Models\HallsofKnowledge;
use Illuminate\Contracts\Container\Container;

class HokRepository extends EloquentRepository
{
    /**
     * Instantiate repository object with required data
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(HallsofKnowledge::class)
            ->setRepositoryId('hokRepo');
    }
}
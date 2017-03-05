<?php


namespace App\Repositories;

use App\Models\Topic;
use Illuminate\Contracts\Container\Container;


class TopicRepository extends EloquentRepository
{
    /**
     * Instantiate repository object with required data
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(Topic::class)
            ->setRepositoryId('topicRepo');
    }

    /**
     * Fetch topics by level
     *
     * @param $title
     * @param string $sort
     * @param string $sortColumn
     * @return mixed
     */
    public function indexByLevel($title, $sort = 'desc', $sortColumn = 'created_at')
    {
        return $this->orderBy($sortColumn, $sort)->findWhere(['level_title', '=', $title]);
    }

    public function getBySlug($slug)
    {

        return $this->with(['articles' => function ($query) {
            $query->active()->orderBy('date', 'desc');
        }])->findBy('slug', $slug);
    }


}
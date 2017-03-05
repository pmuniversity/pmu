<?php


namespace App\Repositories;

use App\Models\Article;
use Illuminate\Contracts\Container\Container;


class ArticleRepository extends EloquentRepository
{
    /**
     * Instantiate repository object with required data
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->setContainer($container)
            ->setModel(Article::class)
            ->setRepositoryId('articleRepo');
    }

    /**
     * Get article collection
     *
     * @param $perPage
     * @param $topicId
     * @param string $type
     * @return mixed
     */
    public function page($topicId, $type = 'latest', $perPage = 10)
    {
        $query = $this->where('topic_id', $topicId);
        if ($type === 'top-10' or $type === 'latest') {
            if ($type === 'top-10') {
                $query->where('top', 1);
            }
            $query->orderBy('date', 'desc');
        } else {
            $query->where('type_title', $type);
        }
        return $query->paginate($perPage);
    }

    /**
     * Format article response
     */
    public function formatResponse($article)
    {
        if ($article->type_title === 'videos') {
            if (getVideoType($article->video_url) === 'youtube') {
                $article->video_url = 'https://www.youtube.com/embed/' . getYoutubeVideoId($article->video_url) . '?rel=0&amp;controls=0&amp;showinfo=0';
            }
        }
        $article->web_picture = $article->web_picture && $article->type_title !== 'videos' ? Storage::url($article->web_picture) : '';
        return $article;
    }


}
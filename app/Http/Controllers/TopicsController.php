<?php

namespace App\Http\Controllers;

use Agent;
use Cache;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Repositories\HokRepository;
use App\Repositories\TopicRepository;
use App\Repositories\ArticleRepository;

class TopicsController extends Controller
{
    protected $topic;
    protected $article;

    public function __construct(TopicRepository $topicRepo, ArticleRepository $article)
    {
        $this->topic = $topicRepo;
        $this->article = $article;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HokRepository $hok)
    {
        $this->topic->forgetCache();
        $bachelorTopics = $this->topic->indexByLevel('Bachelor\'s degree');

        $masterTopics = $this->topic->indexByLevel('Master\'s degree');

        $specTopics = $this->topic->indexByLevel('Specialization');
        $hallsofKnowledge = $hok->orderBy('created_at', 'desc')->first();
        $device = getUserDeviceType();
        if (Agent::isMobile()) {
            return view('mobile.home', compact('bachelorTopics', 'masterTopics', 'specTopics', 'device', 'hallsofKnowledge'));
        }

        return view('desktop.home', compact('bachelorTopics', 'masterTopics', 'specTopics', 'device', 'hallsofKnowledge'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $this->topic->forgetCache();
        $topic = $this->topic->getBySlug($slug);
        $articles = $this->article->page($topic->id);
        $nextTopic = Topic::find($topic->nextRecord());
        $previousTopic = Topic::find($topic->previousRecord());
        $device = getUserDeviceType();
        if (Agent::isMobile()) {
            return view('mobile.detail', compact('topic', 'articles', 'previousTopic', 'nextTopic', 'device'));
        }
        return view('desktop.detail', compact('topic', 'articles', 'previousTopic', 'nextTopic', 'device'));
    }

    public function indexArticles($type, Request $request)
    {
        $this->article->forgetCache();
        // Set pagination
        $perPage = $request->has('perPage') ? $request->input('perPage') : 5;
        $page = ( int )$request->input('page', 1);

        $topicId = $request->input('topic_id');

        $articles = $this->article->page($topicId, $type, $perPage);

        $formatArticles = [];

        if ($articles->total() === 0) {
            $data ['pagination']['hasMore'] = false;
            $data ['articles'] = '';
            return response()->json([
                'data' => $data
            ], 404);
        }

        foreach ($articles as $article) {
            $formatArticles [] = $this->article->formatResponse($article);
        }

        $data ['pagination'] = customizePaginator($articles, $page);
        $data ['articles'] = $formatArticles;
        return response()->json([
            'data' => $data,
        ]);
    }

}

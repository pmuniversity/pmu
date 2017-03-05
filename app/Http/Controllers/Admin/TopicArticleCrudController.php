<?php
/**
 * Created by PhpStorm.
 * User: nagesh.rao
 * Date: 26-02-2017
 * Time: 16:01
 */

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\Admin\ArticleCrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ArticleRequest as StoreRequest;
use App\Http\Requests\ArticleRequest as UpdateRequest;

class TopicArticleCrudController extends ArticleCrudController
{
    public function setup()
    {
        parent::setup();

        // get the topic_id parameter
        $topic_id = \Route::current()->parameter('topic_id');

        // set a different route for the admin panel buttons
        $this->crud->setRoute("admin/topic/" . $topic_id . "/article");

        $this->crud->removeButton('update');
        $this->crud->removeButton('delete');
        $this->crud->addButtonFromView('line', 'Edit', 'article.edit');
        $this->crud->addButtonFromView('line', 'Delete', 'article.delete', 'end');

        // show only that user's posts
        $this->crud->addClause('where', 'topic_id', $topic_id);
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }


}
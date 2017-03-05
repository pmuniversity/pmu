<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ArticleRequest as StoreRequest;
use App\Http\Requests\ArticleRequest as UpdateRequest;

class ArticleCrudController extends CrudController
{

    public function setUp()
    {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\Article");
        $this->crud->setRoute("admin/article");
        $this->crud->setEntityNameStrings('article', 'articles');

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/

        //$this->crud->setFromDb();
        $this->setFilters();

        // ------ CRUD FIELDS
        $this->setCrudFields();
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        $this->setCrudColumns();
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        $this->crud->removeButton('create');
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        $this->crud->orderBy('date', 'desc');
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $article = Article::find($request->input('id'));
        $url = url('/admin/topic/search/' . $article->topic_id . '/article');
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function setCrudFields()
    {
        $this->crud->addField([    // CHECKBOX
            'name' => 'top',
            'label' => '<b>Top 10</b>',
            'type' => 'checkbox',
            'tab' => 'Basic'
        ]);
        $this->crud->addField([    // ENUM
            'name' => 'type_title',
            'label' => 'Type <b style="color: red">*</b>',
            'type' => 'select2_from_array',
            'options' => ['books' => 'Books',
                'videos' => 'Videos',
                'interviews' => 'Interviews',
                'tools' => 'Tools'
            ],
            'allows_null' => false,
            'tab' => 'Basic'
        ]);
        $this->crud->addField([
            'name' => 'source_url',
            'label' => 'Source URL <b style="color: red">*</b>',
            'type' => 'text',
            'attributes' => [
                'placeholder' => 'Your source URL here',
            ],
            'tab' => 'Basic'
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'title',
            'label' => 'Title <b style="color: red">*</b>',
            'type' => 'text',
            'attributes' => [
                'placeholder' => 'Your title here',
            ],
            'tab' => 'Basic'

        ]);
        $this->crud->addField([    // WYSIWYG
            'name' => 'description',
            'label' => 'Description <b style="color: red">*</b>',
            'type' => 'ckeditor',
            'attributes' => [
                'placeholder' => 'Your description text here',
            ],
            'tab' => 'Basic'
        ]);

        $this->crud->addField([    // TEXT
            'name' => 'date',
            'label' => 'Publish Date',
            'type' => 'date',
            'tab' => 'Basic',
            'value' => date('Y-m-d'),

        ], 'create');

        $this->crud->addField([    // TEXT
            'name' => 'date',
            'label' => 'Publish Date',
            'type' => 'date',
            'tab' => 'Basic',
        ], 'update');
        $this->crud->addField([    // Image
            'name' => 'web_picture',
            'label' => 'Web picture',
            'type' => 'browse',
            'attributes' => [
                'placeholder' => 'Web image here',
            ],
            'tab' => 'Uploads',
        ]);
        $this->crud->addField([    // Image
            'name' => 'mobile_picture',
            'label' => 'Mobile picture',
            'type' => 'browse',
            'attributes' => [
                'placeholder' => 'Mobile image here',
            ],
            'tab' => 'Uploads',
        ]);
        $this->crud->addField([
            'name' => 'video_url',
            'label' => 'Video URL',
            'type' => 'text',
            'attributes' => [
                'placeholder' => 'Your video URL here',
            ],
            'tab' => 'Basic',

        ]);
        $this->crud->addField([    // ENUM
            'name' => 'status',
            'label' => 'Status <b style="color: red">*</b>',
            'type' => 'select2_from_array',
            'options' => [0 => 'DRAFT',
                1 => 'PUBLISHED'],
            'allows_null' => false,
            'tab' => 'Basic',
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'author_name',
            'label' => 'Name',
            'type' => 'text',
            'attributes' => [
                'placeholder' => 'Author title here',
            ],
            'tab' => 'Author',
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'author_location',
            'label' => 'Location',
            'type' => 'text',
            'attributes' => [
                'placeholder' => 'Author location here',
            ],
            'tab' => 'Author',
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'author_organization',
            'label' => 'Organization',
            'type' => 'text',
            'attributes' => [
                'placeholder' => 'Author organization here',
            ],
            'tab' => 'Author',
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'author_designation',
            'label' => 'Designation',
            'type' => 'text',
            'attributes' => [
                'placeholder' => 'Author designation here',
            ],
            'tab' => 'Author',
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'author_picture',
            'label' => 'Profile picture',
            'type' => 'browse',
            'tab' => 'Basic',
            'attributes' => [
                'placeholder' => 'Author image here',
            ],
            'tab' => 'Author',
        ]);

    }

    public function setCrudColumns()
    {
        $this->crud->addColumn([
            'name' => 'id',
            'label' => '#',
            'type' => 'text'
        ]);
        $this->crud->addColumn([
            'name' => 'topic_id',
            'label' => 'topic#',
            'type' => 'text'
        ]);

        $this->crud->addColumn([
            'name' => 'date',
            'label' => 'Date',
            'type' => 'date',
        ]);
        $this->crud->addColumn([
            'name' => 'type_title',
            'label' => 'Type',
        ]);
        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'radio',
            'options' => [
                0 => "Draft",
                1 => "Published"
            ]
        ]);
        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Title',
        ]);
    }

    public function setFilters()
    {
        $this->crud->addFilter([ // select2_multiple filter
            'name' => 'type_title',
            'type' => 'select2',
            'label' => 'Article type'
        ], function () {
            return [
                'books' => 'Books',
                'videos' => 'Videos',
                'tools' => 'Tools',
                'interviews' => 'Interviews'
            ];
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'type_title', $value);
        });
        $this->crud->addFilter([ // simple filter
            'type' => 'simple',
            'name' => 'top',
            'label' => 'Top'
        ],
            false,
            function () { // if the filter is active
                $this->crud->addClause('where', 'top', 1);
            });
        $this->crud->addFilter([ // add a "simple" filter called Draft
            'type' => 'select2',
            'name' => 'status',
            'label' => 'Status'
        ], function () {
            return [
                1 => 'PUBLISHED',
                0 => 'DRAFT'];
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'status', $value);
        });

        $this->crud->filters();
    }
}

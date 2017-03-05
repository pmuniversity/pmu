<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\HallsofKnowledgeRequest as StoreRequest;
use App\Http\Requests\HallsofKnowledgeRequest as UpdateRequest;

class HallsofKnowledgeCrudController extends CrudController
{

    public function setUp()
    {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\HallsofKnowledge");
        $this->crud->setRoute("admin/halls-of-knowledge");
        $this->crud->setEntityNameStrings('Halls of Knowledge', 'hallsofknowledge');

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/

        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->setCrudFields();
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        $this->crud->removeColumns(['image_1_web_picture','image_1_title', 'image_1_mobile_picture', 'image_1_url', 'image_1_open_new_window',
            'image_2_web_picture', 'image_2_title', 'image_2_mobile_picture', 'image_2_url', 'image_2_open_new_window',
            'image_3_web_picture', 'image_3_title', 'image_3_mobile_picture', 'image_3_url', 'image_3_open_new_window']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
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
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function setCrudFields()
    {
        $this->crud->addField([    // TEXT
            'name' => 'title',
            'label' => 'Title <b style="color: red">*</b>',
            'type' => 'text',
            'placeholder' => 'Your title here',
            'tab' => 'Basic'
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'description',
            'label' => 'description <b style="color: red">*</b>',
            'type' => 'textarea',
            'placeholder' => 'Your description here',
            'tab' => 'Basic'
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'image_1_title',
            'label' => 'Title <b style="color: red">*</b>',
            'type' => 'text',
            'placeholder' => 'Your title here',
            'tab' => 'Image 1'
        ]);
        $this->crud->addField([    // Image
            'name' => 'image_1_web_picture',
            'label' => 'Web picture <b style="color: red">*</b>',
            'type' => 'browse',
            'tab' => 'Image 1'
        ]);
        $this->crud->addField([    // Image
            'name' => 'image_1_mobile_picture',
            'label' => 'Mobile picture <b style="color: red">*</b>',
            'type' => 'browse',
            'tab' => 'Image 1'
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'image_1_url',
            'label' => 'URL <b style="color: red">*</b>',
            'type' => 'text',
            'placeholder' => 'URL here',
            'tab' => 'Image 1'
        ]);
        $this->crud->addField([    // CHECKBOX
            'name' => 'image_1_open_new_window',
            'label' => 'Open in new window',
            'type' => 'checkbox',
            'tab' => 'Image 1'
        ]);

        $this->crud->addField([    // TEXT
            'name' => 'image_2_title',
            'label' => 'Title <b style="color: red">*</b>',
            'type' => 'text',
            'placeholder' => 'Your title here',
            'tab' => 'Image 2'
        ]);
        $this->crud->addField([    // Image
            'name' => 'image_2_web_picture',
            'label' => 'Web picture <b style="color: red">*</b>',
            'type' => 'browse',
            'tab' => 'Image 2'
        ]);
        $this->crud->addField([    // Image
            'name' => 'image_2_mobile_picture',
            'label' => 'Mobile picture <b style="color: red">*</b>',
            'type' => 'browse',
            'tab' => 'Image 2'
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'image_2_url',
            'label' => 'URL <b style="color: red">*</b>',
            'type' => 'text',
            'placeholder' => 'URL here',
            'tab' => 'Image 2'
        ]);
        $this->crud->addField([    // CHECKBOX
            'name' => 'image_2_open_new_window',
            'label' => 'Open in new window',
            'type' => 'checkbox',
            'tab' => 'Image 2'
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'image_3_title',
            'label' => 'Title <b style="color: red">*</b>',
            'type' => 'text',
            'placeholder' => 'Your title here',
            'tab' => 'Image 3'
        ]);
        $this->crud->addField([    // Image
            'name' => 'image_3_web_picture',
            'label' => 'Web picture <b style="color: red">*</b>',
            'type' => 'browse',
            'tab' => 'Image 3'
        ]);
        $this->crud->addField([    // Image
            'name' => 'image_3_mobile_picture',
            'label' => 'Mobile picture <b style="color: red">*</b>',
            'type' => 'browse',
            'tab' => 'Image 3'
        ]);
        $this->crud->addField([    // TEXT
            'name' => 'image_3_url',
            'label' => 'URL <b style="color: red">*</b>',
            'type' => 'text',
            'placeholder' => 'URL here',
            'tab' => 'Image 3'
        ]);
        $this->crud->addField([    // CHECKBOX
            'name' => 'image_3_open_new_window',
            'label' => 'Open in new window',
            'type' => 'checkbox',
            'tab' => 'Image 3'
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
            'name' => 'title',
            'label' => 'Title',
        ]);
    }
}

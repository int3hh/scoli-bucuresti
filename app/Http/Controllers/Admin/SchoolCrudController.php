<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SchoolRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SchoolCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SchoolCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\School::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/school');
        CRUD::setEntityNameStrings('school', 'schools');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       
        CRUD::column('name');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SchoolRequest::class);

       $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Nume',
            ],
            [
                'name' => 'address',
                'label' => 'Adresa',
            ],
            [
                'name' => 'phoneNo',
                'label' => 'Telefon',
            ],
            [
                'name' => 'lat',
                'label' => 'Latitudine',
                'attributes' => ["step" => "any"],
                'type' => 'number',
            ],
            [
                'name' => 'lon',
                'label' => 'Longitudine',
                'attributes' => ["step" => "any"],
                'type' => 'number',
            ],
            [
                'name' => 'website',
                'label' => 'Website',
            ],
            [
                'name' => 'sector',
                'label' => 'Sector',
                'type' => 'select_from_array',
                'options' => [
                    '0' => '-',
                    '1' => 'Sector 1',
                    '2' => 'Sector 2',
                    '3' => 'Sector 3',
                    '4' => 'Sector 4',
                    '5' => 'Sector 5',
                    '6' => 'Sector 6',
                ]
            ],
            [
                'name' => 'privat',
                'label' => 'Privat',
                'type' => 'checkbox',
            ],
            [
                'name' => 'email',
                'label' => 'email',
            ],
            [
                'name' => 'nivel',
                'label' => 'Nivel',
                'type' => 'select_from_array',
                'options' => [
                    '0' => 'Necunoscut',
                    '1' => 'Primar',
                    '2' => 'Gimnazial',
                    '3' => 'Liceal',
                ]
            ],
            [
                'name' => 'total_rating',
                'label' => 'Rating total',
                'type' => 'select_from_array',
                'options' => [
                    '0' => '-',
                    '1' => '*',
                    '2' => '**',
                    '3' => '***',
                    '4' => '****',
                    '5' => '*****'
                ]
            ],
            [
                'name' => 'google_rating',
                'label' => 'Google rating',
                'type' => 'number',
            ]

       ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}

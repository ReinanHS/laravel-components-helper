<?php

namespace Reinanhs\LaravelComponentsHelper\Helpers\Table;

use Exception;
use Illuminate\Support\Facades\App;
use Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Table;

/**
 * Class EloquentTable
 * @package Reinanhs\LaravelComponentsHelper\Helpers\Table
 */
class EloquentTable extends TableGenerator
{
    /*
     *  Model for gerente table
     */
    protected $model;

    /**
     * EloquentTable constructor.
     * @param array|null $rows
     * @throws Exception
     */
    public function __construct(array $rows = [])
    {
        parent::__construct();

        $this->makeModel();

        $this->columns($this->getTable());
        $this->rows($rows);
    }

    /**
     * Method to create the model
     * @throws Exception
     */
    private function makeModel(): void
    {
        if (empty($this->model)) {
            throw new Exception("The model property has not been set.");
        }

        $this->model = App::make($this->model);
    }

    protected function columns(Table $table): void
    {
        foreach ($this->model->getFillable() as $attribute) {
            $this->column($attribute);
        }
    }
}

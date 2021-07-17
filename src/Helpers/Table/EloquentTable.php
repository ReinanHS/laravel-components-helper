<?php

namespace Reinanhs\LaravelComponentsHelper\Helpers\Table;

use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use LogicException;
use Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Actions\Actions;
use Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Table;

/**
 * Class EloquentTable
 * @package Reinanhs\LaravelComponentsHelper\Helpers\Table
 */
class EloquentTable extends TableGenerator
{
    /**
     * Model for gerente table
     *
     * @var string|object
     */
    protected $model;

    /**
     * EloquentTable constructor.
     * @param array|Collection|null $rows
     * @throws Exception
     */
    public function __construct($rows = null)
    {
        parent::__construct();

        $this->makeModel();
        $this->columns($this->getTable());
        $this->actions($this->getActions());
        $this->setRows($rows);
    }

    /**
     * @param array|Collection|null $rows
     */
    private function setRows($rows)
    {
        if (empty($rows)) {
            return;
        } elseif (is_array($rows)) {
            $this->rows(new Collection($rows));
            return;
        } elseif ($rows instanceof Collection) {
            $this->rows($rows);
            return;
        } elseif ($rows instanceof LengthAwarePaginator) {
            $this->rows($rows->getCollection());
            return;
        }

        throw new LogicException("Rows are not of a valid type");
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

    /**
     * Method for creating table columns
     *
     * @param Table $table
     */
    protected function columns(Table $table): void
    {
        foreach ($this->model->getFillable() as $attribute) {
            $this->column($attribute);
        }
    }

    /**
     * Method for creating table actions
     *
     * @param Actions $actions
     */
    protected function actions(Actions $actions): void
    {
    }
}

<?php


namespace Reinanhs\LaravelComponentsHelper\Helpers\Table;


use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Actions\Actions;
use Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Cell;
use Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Table;

abstract class TableGenerator
{
    private Table $table;
    private Actions $actions;
    protected bool $isEmptyActions = true;

    protected string $dataFormat = "Y-m-d";

    /**
     * TableGenerator constructor.
     */
    public function __construct()
    {
        $this->table = new Table();
        $this->actions = new Actions();
    }

    /**
     * @return Table
     */
    public function getTable(): Table
    {
        return $this->table;
    }

    /**
     * @return Actions
     */
    public function getActions(): Actions
    {
        return $this->actions;
    }

    /**
     * @return bool
     */
    public function isEmptyActions(): bool
    {
        return $this->isEmptyActions;
    }

    /**
     * @param string $attribute
     * @return Cell
     */
    private function createCellByAttribute(string $attribute): Cell
    {
        return new Cell($attribute, 'get' . Str::studly($attribute) . 'Attribute');
    }

    /**
     * @param string $attribute
     * @return Cell
     */
    public function column(string $attribute): Cell
    {
        $cell = $this->createCellByAttribute($attribute);

        $this->table->addColumn($cell);

        return $cell;
    }

    protected function rows(Collection $rows): void
    {
        $this->table->setRows($rows);
    }

    protected abstract function columns(Table $table): void;


    public function getColumns(): Collection
    {
        return $this->table->getColumns();
    }


    public function getRows(): Collection
    {
        return $this->table->getRows();
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        if ($this->isAttributeMethod($method)) {
            return $this->getValue($arguments[0] ?? '');
        }

        throw new \BadMethodCallException("Call to a member function {$method}() does not exist.");
    }

    /**
     * @param string $method
     * @return bool
     */
    private function isAttributeMethod(string $method): bool
    {
        $method = strtolower($method);

        if (strlen($method) >= 13 && substr($method, 0, 3) == 'get' && substr($method, -9) == 'attribute') {
            return true;
        }

        return false;
    }

    /**
     * @param $value
     * @return string
     */
    private function getValue($value): string
    {
        if ($value instanceof Carbon) {
            return $value->format($this->dataFormat);
        }

        return htmlentities($value, ENT_QUOTES, "UTF-8");
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $this->isEmptyActions = $this->getActions()->isEmptyActions();

        return $this->makeView()->render();
    }

    private function makeView(): View
    {
        return \Illuminate\Support\Facades\View::make('components_helper::table')
            ->with([
                'table' => $this
            ]);
    }
}

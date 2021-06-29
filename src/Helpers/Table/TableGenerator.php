<?php


namespace Reinanhs\LaravelComponentsHelper\Helpers\Table;


use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Cell;
use Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Table;

abstract class TableGenerator
{
    private Table $table;

    protected string $dataFormat = "Y-m-d";

    /**
     * TableGenerator constructor.
     */
    public function __construct()
    {
        $this->table = new Table();
    }

    /**
     * @return Table
     */
    public function getTable(): Table
    {
        return $this->table;
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

    protected function rows(array $rows): void
    {
        $this->table->setRows($rows);
    }

    protected abstract function columns(Table $table): void;

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->table->getColumns();
    }

    /**
     * @return array
     */
    public function getRows(): array
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

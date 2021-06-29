<?php


namespace Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure;


use Illuminate\Contracts\View\View;

/**
 * Class Table
 * @package Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure
 */
class Table
{
    private array $columns;
    private array $rows;

    /**
     * Table constructor.
     * @param array $columns
     * @param array $rows
     */
    public function __construct(array $columns = [], array $rows = [])
    {
        $this->columns = $columns;
        $this->rows = $rows;
    }

    /**
     * Method to add column
     *
     * @param Cell $cell
     * @return $this
     */
    public function addColumn(Cell $cell): Table
    {
        $this->columns[] = $cell;

        return $this;
    }

    /**
     * Method for adding row
     *
     * @param object $row
     * @return $this
     */
    public function addRow(object $row): Table
    {
        $this->rows[] = $row;

        return $this;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @param array $columns
     */
    public function setColumns(array $columns): void
    {
        $this->columns = $columns;
    }

    /**
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param array $rows
     */
    public function setRows(array $rows): void
    {
        $this->rows = $rows;
    }
}

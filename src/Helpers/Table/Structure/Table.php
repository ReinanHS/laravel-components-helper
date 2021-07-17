<?php


namespace Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure;


use Illuminate\Support\Collection;

/**
 * Class Table
 * @package Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure
 */
class Table
{
    /**
     * @var Collection
     */
    private $columns;

    /**
     * @var Collection
     */
    private $rows;

    /**
     * Table constructor.
     * @param Collection|null $columns
     * @param Collection|null $rows
     */
    public function __construct(?Collection $columns = null, ?Collection $rows = null)
    {
        $this->columns = $columns ?? new Collection([]);
        $this->rows = $rows ?? new Collection([]);
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
     * @return Collection
     */
    public function getColumns(): Collection
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
     * @return Collection
     */
    public function getRows(): Collection
    {
        return $this->rows;
    }

    /**
     * @param Collection $rows
     */
    public function setRows(Collection $rows): void
    {
        $this->rows = $rows;
    }
}

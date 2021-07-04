<?php


namespace Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Actions;

/**
 * Class Actions
 * @package Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Actions
 */
class Actions
{
    /**
     * The name of actions
     *
     * @var string
     */
    protected $name;

    /**
     * Items to create the actions
     *
     * @var array
     */
    protected $items = [];

    /**
     * Actions constructor.
     */
    public function __construct()
    {
        $this->name = "&nbsp;";
    }

    /**
     * Method to get all items
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Method to check if there are registered items
     *
     * @return bool
     */
    public function isEmptyActions(): bool
    {
        return sizeof($this->items) == 0;
    }

    /**
     * Method to get the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Method for defining a name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to add an action
     *
     * @param string|null $name
     * @return ActionBase
     */
    public function addAction(?string $name = null): ActionBase
    {
        $action = new Action($name);
        $this->items[] = $action;

        return $action;
    }
}

<?php


namespace Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure;

use Illuminate\Support\Collection;

/**
 * Class Cell
 * @package Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure
 */
class Cell
{
    /**
     * The name of key the row
     *
     * @var string
     */
    private $key;

    /**
     * Method name to get the information
     *
     * @var string
     */
    private $methodName;

    /**
     * Cell attributes
     *
     * @var array
     */
    private $attributes;

    /**
     * Cell constructor.
     * @param string $key
     * @param string $methodName
     * @param array $attributes
     */
    public function __construct(string $key, string $methodName, array $attributes = [])
    {
        $this->key = $key;
        $this->methodName = $methodName;
        $this->attributes = $attributes;
    }

    /**
     * Method to get the key the row
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Method to set the key the row
     *
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * Method to get the attribute method name
     *
     * @return string
     */
    public function getMethodName(): string
    {
        return $this->methodName;
    }

    /**
     * Method to set the attribute method name
     *
     * @param string $methodName
     */
    public function setMethodName(string $methodName): void
    {
        $this->methodName = $methodName;
    }

    /**
     * Method to get attributes
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Method for setting attributes
     *
     * @param array|Collection $attributes
     */
    public function setAttributes($attributes): void
    {
        $this->attributes = $attributes;
    }
}

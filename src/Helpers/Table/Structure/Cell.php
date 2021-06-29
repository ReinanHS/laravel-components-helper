<?php


namespace Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure;

/**
 * Class Cell
 * @package Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure
 */
class Cell
{
    private string $key;
    private string $methodName;
    private array $attributes;

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
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return $this->methodName;
    }

    /**
     * @param string $methodName
     */
    public function setMethodName(string $methodName): void
    {
        $this->methodName = $methodName;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }
}

<?php


namespace Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Actions;


use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

abstract class ActionBase
{
    /**
     * Check if you have permission
     *
     * @var bool|Closure
     */
    protected $hasPermission;

    /**
     * The type of action
     *
     * @var string
     */
    protected $type;

    /**
     * The name of action
     *
     * @var string|null
     */
    protected $name;

    /**
     * The icon of action
     *
     * @var string|null
     */
    protected $icon;

    /**
     * The route name of action
     *
     * @var string|null
     */
    protected $routerName;

    /**
     * The parameters of route
     *
     * @var array
     */
    protected $routerParameters;

    /**
     * The attribues of action
     *
     * @var array
     */
    protected $attributes;

    /**
     * ActionBase constructor.
     * @param string|null $name
     */
    public function __construct(?string $name = null)
    {
        $this->name = $name;
        $this->attributes = [];
        $this->icon = null;
        $this->type = ActionEnum::GET;
        $this->hasPermission = true;
    }

    /**
     * Method for getting the formatted attributes for the blade
     *
     * @return string
     */
    public function getAttributesFormatted(): string
    {
        $attributes = "";

        foreach ($this->attributes as $attribute => $value){
            $attributes .= $attribute.'="'.$value.'"';
        }

        return $attributes;
    }

    /**
     * Method for setting attributes
     *
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Method to define an icon
     *
     * @param string|null $icon
     * @return $this
     */
    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Method to check if you have permission
     *
     * @param array|object $row
     * @return bool
     */
    public function isHasPermission($row): bool
    {
        $hasPermission = $this->hasPermission;

        if ($hasPermission instanceof Closure) {
            $user = Auth::user();

            $hasPermission = $hasPermission($row, $user);
        }

        if (is_bool($hasPermission)) {
            return $hasPermission;
        }

        throw new \LogicException("Return value is not a boolean");
    }

    /**
     * Method for adding a permission
     *
     * @param bool|Closure $hasPermission
     * @return $this
     */
    public function setHasPermission($hasPermission): self
    {
        $this->hasPermission = $hasPermission;
        return $this;
    }

    /**
     * Method for defining a type
     *
     * @param string $type
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Method for defining a route
     *
     * @param string $name
     * @param array $parameters
     * @return $this
     */
    public function setRouter(string $name, array $parameters = []): self
    {
        $this->routerName = $name;
        $this->routerParameters = $parameters;

        return $this;
    }

    /**
     * Method for formatted route
     *
     * @param array|object $row
     * @return string
     */
    public function getRouterFormatted($row): string
    {
        if (empty($this->routerName)) {
            return '/#';
        }

        $parameters = [];

        foreach ($this->routerParameters as $parameter) {
            $parameters[] = $row[$parameter] ?? $parameter;
        }

        return route($this->routerName, $parameters);
    }

    /**
     * Method to get the view
     *
     * @param array|object $row
     * @return View
     */
    public function view($row): View
    {
        return \Illuminate\Support\Facades\View::make('components_helper::actions')
            ->with([
                'type' => $this->type,
                'route' => $this->getRouterFormatted($row),
                'name' => $this->name,
                'icon' => $this->icon,
                'attributes' => $this->getAttributesFormatted(),
            ]);
    }
}

@if($type == \Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Actions\ActionEnum::GET)
    <div>
        <a href="{{ $route }}" {!! $attributes !!}>
            <i class="{{ $icon }}"></i>
        </a>
    </div>
@elseif($type == \Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Actions\ActionEnum::DELETE)
    <div>
        <form action="{{ $route }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" {!! $attributes !!}>
                <i class="{{ $icon }}"></i>

            </button>
        </form>
    </div>
@endif

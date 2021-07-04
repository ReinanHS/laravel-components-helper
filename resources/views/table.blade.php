<?php
/**
 * @var \Reinanhs\LaravelComponentsHelper\Helpers\Table\TableGenerator $table
 */
?>
<table class="{{ config('components-helper.default_table_attributes.class') }}">
    <thead>
    <tr>
        <?php
        /**
         * @var \Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Cell $column
         */
        ?>
        @foreach($table->getColumns() as $column)
            <th scope="col">{{ __('columns.'.$column->getKey()) }}</th>
        @endforeach
        @if(!$table->isEmptyActions())
            <tr scope="col">{{ $table->getActions()->getName() }}</tr>
        @endif
    </tr>
    </thead>
    <tbody>
    <tr>
        @foreach($table->getRows() as $row)
            <tr>
                @foreach($table->getColumns() as $column)
                    <td>
                        {!! $table->{$column->getMethodName()}($row[$column->getKey()]) !!}
                    </td>
                @endforeach
                @if(!$table->isEmptyActions())
                    <td style="display: flex;">
                        <?php
                        /**
                         * @var \Reinanhs\LaravelComponentsHelper\Helpers\Table\Structure\Actions\Action $item
                         */
                        ?>
                        @foreach($table->getActions()->getItems() as $item)
                            @if($item->isHasPermission($row))
                                {!! $item->view($row)->render() !!}
                            @endif
                        @endforeach
                    </td>
                @endif
            </tr>
        @endforeach
    </tr>
    </tbody>
</table>

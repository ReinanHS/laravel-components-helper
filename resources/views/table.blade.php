<?php
/**
 * @var \Reinanhs\LaravelComponentsHelper\Helpers\Table\TableBase $table
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
            </tr>
        @endforeach
    </tr>
    </tbody>
</table>

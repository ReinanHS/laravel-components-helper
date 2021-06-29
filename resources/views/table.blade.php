<?php
/**
 * @var \Reinanhs\LaravelComponentsHelper\Helpers\Table\TableBase $table
 */
?>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<table class="table">
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

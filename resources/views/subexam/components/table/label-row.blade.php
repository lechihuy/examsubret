<tr>
    <th scope="col" class="col-checkbox cell-fixed" style="left: -1px; width: 49px;">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input check-all" id="table-check-all">
            <label class="custom-control-label" for="table-check-all"></label>
        </div>
    </th>

    @foreach ($table->columns() as $column)
        @if ($column['is_visible'])
            <th scope="col" 
                class="
                    {{ $column['primary'] ? 'cell-fixed primary-cell' : 'text-center d-none d-md-table-cell' }}
                " 
                style="
                    @isset($column['width'])
                        max-width: {{ $column['width'] }}px; width: {{ $column['width'] }}px;
                    @endisset 
                    @if ($column['primary'])
                        left: 48px;
                    @endif
                ">
                {{ ucfirst($column['label']) }}
            </th>
        @endif
    @endforeach
</tr>
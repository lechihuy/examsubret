<td class="cell-fixed primary-cell" style="left: 48px;">
    <div class="d-flex">
        <a href="{{ $link }}">{{ $department->name }}</a>

        {{-- Button toggle --}}
        <span class="ml-auto d-inline-block d-md-none toggle-cell pl-2" 
        data-toggle="collapse" data-target="#collapse-cell-{{ $department->id }}">
            <i class="fas fa-chevron-down"></i>
        </span>
        {{-- /Button toggle --}}
    </div>

    {{-- Data toggle --}}
    <div class="collapse d-md-none w-100" id="collapse-cell-{{ $department->id }}">
        <table class="table table-borderless table-sm mt-3">
            @foreach ($table->columns() as $column) 
                @if ($column['primary']) @continue @endif

                @if ($column['is_visible'])
                    <tr>
                        <td class="font-weight-bold pl-0 pr-1 border-0">{{ ucfirst($column['label']) }}</td>
                        <td class="pl-1 pr-0 border-0">
                            @include($column['render'])
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>

        <div>
            {{-- Action --}}
            <a href="{{ route('departments.edit', $department->id) }}" class="mr-3">Sửa</a>
        </div>
        {{-- /Action --}}

    </div>
    {{-- /Data toggle --}}
</td>
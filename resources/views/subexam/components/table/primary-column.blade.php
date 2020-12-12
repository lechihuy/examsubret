<td class="cell-fixed primary-cell" style="left: 48px;">
    <div class="d-flex">
        <a href="{{ $link }}">{{ $subexam->subject->name }}</a>

        {{-- Button toggle --}}
        <span class="ml-auto d-inline-block d-md-none toggle-cell pl-2" 
        data-toggle="collapse" data-target="#collapse-cell-{{ $subexam->id }}">
            <i class="fas fa-chevron-down"></i>
        </span>
        {{-- /Button toggle --}}
    </div>

    {{-- Data toggle --}}
    <div class="collapse d-md-none w-100" id="collapse-cell-{{ $subexam->id }}">
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
            @auth('teacher')
                <a href="{{ route('subexams.edit', $subexam->id) }}" class="mr-3">Sửa</a>
                <a class="text-danger btn-action" has-confirmed="true" 
                action="{{ route('subexams.destroy', $subexam->id) }}" method="DELETE" 
                data-redirect_to="RELOAD" role="button">Xóa</a>
            @endauth

            @auth('admin')
                <a href="{{ route('subexams.show', $subexam->id) }}" class="mr-3">Duyệt</a>
            @endauth
        </div>
        {{-- /Action --}}

    </div>
    {{-- /Data toggle --}}
</td>
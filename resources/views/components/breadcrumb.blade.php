<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent px-0 py-0 mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.home') }}">Dashboard</a>
        </li>

        @foreach($items ?? [] as $route => $label)
            <li class="breadcrumb-item">         
                @if ($loop->last)
                    {{ $label }}
                @else
                    <a href="{{ route($route) }}">{{ $label }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
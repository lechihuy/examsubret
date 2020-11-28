<div class="card border shadow-sm rounded-0 mt-4">
    <div class="card-header bg-white">
        <i class="{{ $icon }}"></i> {{ $title }}
    </div>

    <div class="card-body">
        <h4 class="mb-0">{{ $counter }}</h4>
        <p class="mb-0 text-muted">tất cả</p>
        <div class="progress mt-2">
            @if ($counter > 0)
            @foreach ($data ?? [] as $item)
                <div class="progress-bar bg-{{ $item['color'] }}" style="width: {{ $item['counter']*100/$counter }}%"></div>
            @endforeach
            @endif
        </div>
        <div class="mt-2">
            @foreach ($data ?? [] as $item)
                <p class="mb-0"><i class="fas fa-square text-{{ $item['color'] }}"></i>
                    <strong>{{ $item['counter'] }}</strong> {{ $item['label'] }}
                    @if (isset($item['link']))
                        <a href="{{ $item['link'] }}" class="ml-2">Đi đến</a>
                    @endif
                </p>
            @endforeach
        </div>
    </div>
</div>    
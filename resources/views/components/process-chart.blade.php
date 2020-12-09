 <div class="p-3">
    <div class="progress mt-2">
        @foreach ($counters as $counter)
            @php $width = ($counter['count'] / $all) * 100 @endphp
            <div class="progress-bar bg-{{ $counter['bg'] }}" style="width: {{ $width }}%">
                {{ round($width, 2) }}%
            </div>
        @endforeach
    </div>
    <div class="mt-2">
       
        @foreach ($counters as $counter)
            <p class="mb-0"><i class="fas fa-square text-{{ $counter['bg'] }}"></i>
                <strong>{{ $counter['count'] }}</strong> {{ $counter['label'] }}
            </p>
        @endforeach
    </div>
</div>
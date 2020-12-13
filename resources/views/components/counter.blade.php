<div class="px-3 py-2 counter {{ $class ?? ''}} shadow-sm {{ $class ?? '' }}">
    <p class="text-{{ $text_color }} mb-0">{{ $counter }}</h1>
    <span class="text-muted text-uppercase">{{ $label }}</span>
    <i class="{{ $icon }} text-{{ $text_color }}"></i>
</div>
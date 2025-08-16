<button
  class="button button--{{ $variant ?? 'default' }} button--size-{{ $size ?? 'default' }} {{ $class ?? '' }}"
>
  {!! $label ?? '' !!}
</button>

@resources('css/components/ui/button.css')

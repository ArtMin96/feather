@props(['disabled' => false, 'rows'=>'4', 'cols'=>'50'])

<textarea {{ $disabled ? 'disabled' : '' }} rows="{{ $rows }}" cols="{{ $cols }}" {!! $attributes->merge(['class' => 'form-input rounded-md shadow-sm']) !!}>{!! $value !!}</textarea>

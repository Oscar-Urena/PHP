@props(['href' => '/'])

<a href="{{ $href }}">
    <button type="button">{{$slot}}</button>
</a>

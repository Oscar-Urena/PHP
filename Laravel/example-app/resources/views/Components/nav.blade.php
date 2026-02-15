@props(['active' => false])

<a  class="{{ $active ? "bg-gray-950/50  text-white": ""}}block rounded-md  px-3 py-2 text-base font-medium text-white" {{$attributes}} >{{$slot}}</a>

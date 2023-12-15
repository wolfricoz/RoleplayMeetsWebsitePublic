<a  class="m-2.5 mx-0.5 text-sm bg-transparent  text-gray-700 font-semibold hover:text-white py-1 px-2 border border-gray-500
            hover:border-transparent hover:bg-indigo-900 rounded cursor-pointer"
   @isset($layout)
       x-on:click="layout = '{{$layout}}'"
   x-bind:class="{'bg-indigo-200': layout === '{{$layout}}'}"
    @endisset
    @isset($attributes['href'])
        href="{{$attributes['href']}}"
    @endisset
>
    {{ $slot }}
</a>

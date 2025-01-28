<x-app-layout>
    <x-self.base>
       <h3 class="text-center text-2xl mb-2">POSTS</h3>
       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
            @foreach ($posts as $item)
                <article @class([
                    'p-1 rounded-xl shadow-xl bg-cover bg-center bg-no-repeat h-80 ',
                    'md:col-span-2'=>$loop->first
                    ]) style="background-image:url({{Storage::url($item->imagen)}});">
                    <div class="flex flex-col justify-between h-full bg-opacity-40 bg-gray-50 hover:bg-opacity-80">
                        <div class="w-full text-center text-2xl font-semibold">
                            {{$item->titulo}}
                        </div>
                        <div class="font-semibold text-gray-700 w-full text-center">
                            "{{$item->contenido}}"
                        </div>
                        <div class="flex justify-between items-center mx-1">
                            <div class="text-green-700 text-lg italic">
                                {{$item->user->email}}
                            </div>
                            <div class="text-lg font-semibold">
                                {{$item->updated_at->format('d/m/Y H:i')}}
                            </div>
                        </div>

                    </div>

                </article>
            @endforeach
       </div>
       <div class="mt-1">
       {{$posts->links()}}
       </div>
       
    </x-self.base>
</x-app-layout>

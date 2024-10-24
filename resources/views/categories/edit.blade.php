<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form action="{{route('categories.update', $category)}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')
                        <b>Category Name: </b><br>
                        <input type="text" name="catname" value="{{$category->catname}}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" ><br><br>
                        
                        <b>description:</b><br>
                        <textarea name="description" id="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{$category->description}}</textarea><br><br>
                        
                        <b>Slug:</b><br>
                        <input type="text" name="slug" value="{{$category->slug}}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" ><br><br>

                        <b>Icon:</b><br>
                            @if ($category->icon)
                                <img src="{{ asset('storage/' . $category->icon) }}" alt="Icon" style="width: 100px; height: auto;"><br>
                            @else
                                No icon uploaded
                            @endif
                                            
                            <input type="file" name="icon" id="icon"><br><br>

                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Save</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

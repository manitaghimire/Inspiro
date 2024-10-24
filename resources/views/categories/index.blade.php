<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <a href="{{route('categories.create')}}">Add new categories</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Category Id</th>
                            <th>Category Name</th>
                            <th>Icon</th>
                            <th>Description</th>
                            <th>slug</th>
                            <th>Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->catname}}</td>
                        <td>
                            
                        @if($category->icon)
                        <img src="{{asset('storage/'.$category->icon)}}" style="width: 50px; height: auto;" >
                        @else
                        No icon uploaded
                        @endif
                        </td>
                        <td>{{$category->description}}</td>
                        <td>{{$category->slug}}</td>
                        <td><a href="{{route('categories.edit',$category)}}">Edit</a>/
                            <form action="{{route('categories.destroy',$category)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirm('Are you sure?')">Delete</button>
                            </form>
                        
                        </td>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

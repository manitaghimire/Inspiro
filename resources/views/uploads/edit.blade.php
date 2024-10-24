<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Uploads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form action="{{route('uploads.update',$upload)}}" method="post" enctype="multipart/form-data" >
                        @csrf    
                        @method('PUT')       
                        <b>Title:</b><br>
                        <input type="text" name="title" value="{{$upload->title}}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" ><br><br>      

                        <b>Description:</b><br>
                        <textarea name="caption" id="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{$upload->caption}}</textarea><br><br>                    
            

                        <b>Image: </b><br/>
                        @if ($upload->imageurl)
                                <img src="{{ asset('storage/' . $upload->imageurl) }}" alt="Icon" style="width: 100px; height: auto;"><br>
                            @else
                                No icon uploaded
                            @endif
                        <input type="file" name="imageurl" id="uploadimage"><br><br>

                        <b>Category</b>
                        <select name="category_id" >
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if($upload->category_id==$category->id) selected @endif >{{$category->catname}}</option>
                        @endforeach
                        </select><br><br>

                        

                        <b>Link:</b><br>
                        <input type="text" name="link" value="{{$upload->link}}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" ><br><br>

                        <b>Tags:</b><br>
                        <div id="tag-container">
                        @if ($tags && $tags->count() > 0)
                                @foreach ($tags as $tag)
                                <div style="margin-bottom: 10px;">
                                <input type="text" name="tags[]" value="{{$tag->tag}}" class="tag-input border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
</div>
                                @endforeach
                                @else
                            <input type="text" name="tags[]" class="tag-input border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Tag" />
                            @endif
                        </div>
                        <button type="button" id="add-tag" class="inline-flex items-center text-blue-600">
                            + Add Tag
                        </button><br><br>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Update Post
                    </button>
                    </form>
                    <script>
                        document.getElementById('add-tag').addEventListener('click', function() {
                            
                            const newTagContainer = document.createElement('div');
                            newTagContainer.style.marginTop = '10px'; 

                          
                            const newTagInput = document.createElement('input');
                            newTagInput.type = 'text';
                            newTagInput.name = 'tags[]'; 
                            newTagInput.className = 'tag-input border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
                            newTagInput.placeholder = 'Tag';

                          
                            newTagContainer.appendChild(newTagInput);

                           
                            document.getElementById('tag-container').appendChild(newTagContainer);

                        
                            newTagInput.focus();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

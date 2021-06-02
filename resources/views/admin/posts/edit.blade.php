<x-admin-master>

    @section('content')
        <h1>Edit Post</h1>

        <form method="post" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" 
                    name="title" 
                    id="title" 
                    class="form-control"
                    placeholder="Enter Title"
                    value="{{$post->title}}"
                    >
        </div>

        <div class="form-group">
        <div><img height="100px" src="{{$post->post_image}}" alt=""></div>
            <label for="file">File</label>
            <input type="file" 
                    name="post_image" 
                    id="post_image" 
                    class="form-control">
        </div>

        <div class="form-group">
            <textarea name="body" id="body" cols="30" class="form-control"rows="10">{{$post->body}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>


        </form>


    @endsection

</x-admin-master>
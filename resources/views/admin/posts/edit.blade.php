<x-admin-master>

    @section('content')
    
    <h1>Update Post</h1>
    
    <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter Title" value="{{ $post->title }}" >
       
    </div>
    <div class="form-group">

    <div class="card" style="width: 10rem;">
        <img src="{{$post->takeImage}}" class="card-img-top" alt="">
    </div>
     <label for="file">File</label>
    <input type="file" name="post_image" class="form-control-file" id="post_image">
    </div>
    <div class="form-group">
     <label for="body">Body</label>  
    <textarea name="body" class="form-control" id="body" cols="30" rows="10"  > {{$post->body}}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    </form> 

    @endsection
</x-admin-master>
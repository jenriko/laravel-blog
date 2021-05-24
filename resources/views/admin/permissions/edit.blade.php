<x-admin-master>
    @section('content')
        <h1>Edit Permission : {{ $permission->name }}</h1>
    <div class="row">
        <div class="col-sm-6">
        <form method="post" action="{{ route('permissions.update', $permission->id) }}">
        @csrf
        @method('PATCH')        
        <div class="form-group mb-2">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control " value="{{ $permission->name }}">
        </div>
        <button class="btn btn-primary">Update</button>
        </div>  
        </form>
        </div>
    @endsection
</x-admin-master>
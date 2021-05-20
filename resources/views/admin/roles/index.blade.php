<x-admin-master>
    @section('content')
    
    <div class="row">
        <div class="col-sm-3">
            <form method="post" action="{{ route('roles.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" >
                    @error('name')

                    <span><strong>{{ $message }}</strong></span>
                        
                    @enderror
                </div>
                <button class="btn btn-primary">Create</button>
            </form>
        </div>
        <div class="col-sm-9">
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($roles as $role)
                        <tr>
                           <td>{{ $role->id }}</td>
                           <td>{{ $role->name }}</td>
                           <td>{{ $role->slug }}</td>
                           <td>{{ $role->created_at }}</td>
                           <td>{{ $role->updated_at }}</td>
                          
                        </tr>
                      @endforeach
                  </tbody>
                
                </table>
              </div>
            </div>
          </div>

        </div>

    </div>

    @endsection
</x-admin-master>
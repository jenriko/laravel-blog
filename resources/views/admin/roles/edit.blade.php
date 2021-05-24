<x-admin-master>
    @section('content')
        <h1>Edit Role : {{ $role->name }}</h1>
    <div class="row">
        <div class="col-sm-6">
        <form method="post" action="{{ route('roles.update', $role->id) }}">
        @csrf
        @method('PATCH')        
        <div class="form-group mb-2">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control " value="{{ $role->name }}">
        </div>
        <button class="btn btn-primary">Update</button>
        </div>  
        </form>
        </div>

    <div class="row">
            <div class="col-lg-6 mt-2">
                @if($permissions->isNotEmpty())
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Options</th>
                      <th>id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Attach</th>
                      <th>Dettach</th>
                      
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($permissions as $permission)
                        <tr>
                            <td><input type="checkbox" 
                                @foreach($role->permissions as $role_permission)
                                @if($role_permission->slug == $permission->slug)
                                checked
                                @endif
                                @endforeach></td>
                           <td>{{ $permission->id }}</td>
                           <td>{{ $permission->name }}</td>
                           <td>{{ $permission->slug }}</td>
                           <td>
                              <form method="post" action="{{ route('role.permission.attach', $role) }}">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="permission" value="{{ $permission->id }}">
                                <button class="btn btn-primary" 
                                    @if($role->permissions->contains($permission))
                                        disabled
                                    @endif
                                >Attach</button>
                            </form>
                           </td>
                           <td>
                                <form method="post" action="{{ route('role.permission.detach', $role) }}">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="role" value="{{ $permission->id }}">
                                <button class="btn btn-danger" 
                                    @if(!$role->permissions->contains($permission
                                    ))
                                        disabled
                                    @endif
                                >Dettach</button>
                            </form>
                           </td>
                          
                        </tr>
                      @endforeach
                  </tbody>
                
                </table>
              </div>
            </div>
          </div>
        </div>
        @endif
    </div>    
    @endsection
</x-admin-master>
<x-admin-master>
    @section('content')

    <h1>Profile  {{$user->name}}</h1>

    <div class="row">
        <div class="col-sm-6">
            <form method="post" action="{{ route('user.profile.update', $user)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <img  height="100px" width="100px" class="img-profile rounded-circle" src="{{$user->TakeAvatar}}">
            </div>
            <div class="form-group">
                <input type="file" name="avatar">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{$user->username}}">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                       {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$user->name}}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{$user->email}}">
              @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

{{--             
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    {{$message}}
                </span>
                @enderror
            </div>

            
            <div class="form-group">
                <label for="password-confirmation">Confirm Password</label>
                <input type="password" name="password-confirmation" class="form-control @error('password-confirmation') @enderror" id="password-confirmation">
            @error('password-confirmation')
                <span class="invalid-feedback" role="alert">
                    {{$message}}
                </span>
                @enderror
            </div> --}}
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12 mt-2">
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
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
                      <th>Detach</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($roles as $role)
                        <tr>
                            <td><input type="checkbox" 
                                @foreach($user->roles as $user_role)
                                @if($user_role->slug == $role->slug)
                                checked
                                @endif
                                @endforeach></td>
                           <td>{{ $role->id }}</td>
                           <td>{{ $role->name }}</td>
                           <td>{{ $role->slug }}</td>
                           <td>
                               <form method="post" action="{{ route('user.role.attach', $user) }}">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="role" value="{{ $role->id }}">
                                <button class="btn btn-primary" 
                                    @if($user->roles->contains($role))
                                        disabled
                                    @endif
                                >Attach</button>
                            </form>
                        </td>
                            
                            
                           <td>
                            <form method="post" action="{{ route('user.role.detach', $user) }}">
                            @method('PUT')
                            @csrf

                            <input type="hidden" name="role" value="{{ $role->id }}">
                            <button class="btn btn-danger"
                                @if(!$user->roles->contains($role))
                                    disabled
                                @endif
                            >Detach</button>
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
    </div>

    @endsection
</x-admin-master>
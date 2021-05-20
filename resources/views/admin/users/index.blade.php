<x-admin-master>
    @section('content')

    <h1>Users</h1>
  @if(session('user-delete'))
    <div class="alert alert-danger">{{ session('user-delete') }}</div>
  @endif
    
     <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Username</th>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Registered date</th>
                      <th>Updated Profile date</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td><a href="{{ route('user.profile.show',$user->id) }}"> {{$user->username}}</a></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                <img height="40px" width="60px"  src="{{ $user->TakeAvatar }}">
                            </div>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>{{ $user->updated_at->diffForHumans() }}</td>
                            <td>
                              <form action="{{ route('user.destroy', $user->id) }}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger">Delete</button>

                            </form>
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                
                </table>
              </div>
            </div>
          </div>

    @endsection

     @section('script')
            <!-- Page level plugins -->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    @endsection
</x-admin-master>
<x-admin-master>

    @section('content')
    <h1>Users</h1>
    @if(session('user_deleted'))
      <div class="alert alert-danger">{{session('user_deleted')}}</div>

    @endif

    <!-- DataTales Example -->

                <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Registered date</th>
                      <th>Updated profile date</th>
                      <th>Delete</th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Registered date</th>
                      <th>Updated profile date</th>
                      <th>Delete</th>
                      
                    </tr>
                  </tfoot>
                  <tbody>
                  @foreach ($users as $user)
                    <tr>
                    <td>{{$user->id}}</td>
                    <td><a href="{{route('user.profile.show',$user->id)}}">{{$user->username}}</a></td>
                    <td><img width="100px" src="{{$user->avatar}}" alt=""></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                    <td>
                        <form method="post" action="{{route('user.destroy',$user->id)}}">
                          @csrf
                          @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                      </td>
                    </tr>

                  @endforeach
                  </tbody>
                </table>

    

    @endsection


    @section('scripts')

    <!-- Page level plugins -->
  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

    
    @endsection

</x-admin-master>
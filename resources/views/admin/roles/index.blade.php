<x-admin-master>

    @section('content')
    @if(Session::has('role_delete'))

     <div class="alert alert-danger">{{Session::get('role_delete')}}</div> 
    @elseif(Session::has('role_created'))
    <div class="alert alert-success">{{Session::get('role_created')}}</div> 
    @elseif(Session::has('role_updated'))
    <div class="alert alert-success">{{Session::get('role_updated')}}</div> 

    @endif

    <div class="row">
        <div class="col-sm-3">
            
                <form method ="post" action="{{route('roles.store')}}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                            <div>
                                @error('name')
                                    <span><strong>{{$message}}</strong></span>
                                @enderror
                            </div>
                    </div>     
                    <button  class="btn btn-primary btn-block" type="Submit">Create</button>      
                </form>
     </div>


        <div class="col-sm-9">
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Delete</th>
                          
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Delete</th>
                   
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($roles as $role)
                    <tr>
                    
                        <td>{{$role->id}}</td>
                        <td><a href="{{route('roles.edit',$role->id)}}">{{$role->name}}</a></td>
                        <td>{{$role->slug}}</td>
                        <td>
                        <form method="post" action="{{route('roles.destroy',$role->id)}}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
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

  

</x-admin-master>


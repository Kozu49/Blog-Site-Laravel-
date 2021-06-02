<x-admin-master>

    @section('content')
    @if(Session::has('permission_created'))

     <div class="alert alert-success">{{Session::get('permission_created')}}</div> 
    @elseif(Session::has('permission_delete'))
    <div class="alert alert-danger">{{Session::get('permission_delete')}}</div> 
    @elseif(Session::has('permission_updated'))
    <div class="alert alert-danger">{{Session::get('permission_updated')}}</div> 
    
    
    @endif

    <div class="row">
        <div class="col-sm-3">
            
                <form method ="post" action="{{route('permissions.store')}}">
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
              <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
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
                    @foreach($permissions as $permission)
                    <tr>
                    
                        <td>{{$permission->id}}</td>
                        <td><a href="{{route('permissions.edit',$permission->id)}}">{{$permission->name}}</a></td>
                        <td>{{$permission->slug}}</td>
                        <td>
                        <form method="post" action="{{route('permissions.destroy',$permission->id)}}">
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


<x-admin-master>
@section('content')

<h2>Edit Permission: {{$permission->name}}</h2>

    <div class='row'>
        <div class="col-sm-6">
        <form method="post" action="{{route('permissions.update',$permission->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text"
                name="name"
                class="form-control {{$errors->has('name') ? 'is-invalid': ' '}}"
                id="name"
                value="{{$permission->name}}"
                >
                @error('name')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        
                <button type="submit" class="btn btn-primary">Update</button>

                </form>

        </div>
</div>
    
  

@endsection

</x-admin-master>
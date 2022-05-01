@extends('admin.layouts.master')
@section('title', 'List Photo')
@section('content')

<div class="card">
    <div class="card-header">
      <h3>List  Photo</h3>
        <a href="{{ route('admin.photos.create') }}" class="btn btn-success">New</a>
    </div>


<table class="table table-bordered table-striped">
 <tr>
   <th>
        <input type="checkbox" class="checkbox_all">
    </th>    
  <th width="10%">Image</th>
  <th width="25%">First Name</th>
  <th width="35%">Last Name</th>
  <th width="30%">Action</th>
 </tr>
 @foreach($data as $row)
  <tr>
     <td><input type="checkbox" class="checkbox_delete" 
       name="entries_to_delete[]" value="{{ $row->id }}" /></td>
   <td><img src="{{ asset('/public/images/' . $row->image) }}" class="img-thumbnail" width="75" /></td>
   <td>{{ $row->first_name }}</td>
   <td>{{ $row->last_name }}</td>
<td>
        
    
          <a href="{{ route('admin.photos.show', $row->id) }}" class="btn btn-primary">Show</a>
          <a href="{{ route('admin.photos.edit', $row->id) }}" class="btn btn-warning">Edit</a>
         
                <!-- delete list -->    
  
        <form action="{{ route('admin.photos.destroy', $row->id)  }}" method="POST"
              style="display: inline"
              onsubmit="return confirm('Are you sure?');">
            <input type="hidden" name="_method" value="DELETE">
            {{ csrf_field() }}
            <button class="btn btn-danger">Delete</button>
        </form>
   
  
  
      </td>
  </tr>
 @endforeach
</table>
{!! $data->links() !!}



    </div>
</div>
 <script>
        function getIDs()
        {
            var ids = [];
            $('.checkbox_delete').each(function () {
                if($(this).is(":checked")) {
                    ids.push($(this).val());
                }
            });
            $('#ids').val(ids.join());
        }

        $(".checkbox_all").click(function(){
            $('input.checkbox_delete').prop('checked', this.checked);
            getIDs();
        });

        $('.checkbox_delete').change(function() {
            getIDs();
        });
    </script>  
       <script>
        $(".checkbox_all").click(function(){
            $('input.checkbox_delete').prop('checked', this.checked);
        });
    </script>  
@endsection



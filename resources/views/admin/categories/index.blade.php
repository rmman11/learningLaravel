@extends('admin.layouts.master')
@section('pageTitle', 'Categories')
@section('content')



<div class="card">

      <div class="card-body">


<p>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">New Category</a>

    </p>

<br/> <br/>
    <table  id="example" class="display" style="width:100%">
      <thead>
      <th>Nr</th>
      <th>Name</th>
      <th>Date Time</th>
      <th class="no-sort" name="prop_ref_no">Action</th>
    </thead>
    <tbody>
    @if (count($categories) > 0)
    @foreach ($categories as  $key => $category)
        <td><div>{{ ++$key }}</div></td>
        <td><div>{{ $category->title }}</div></td>
        <td><div>{{ $category->created_at }}</div></td>

        <td style="width:200px">




          {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.categories.destroy', $category->id])) !!}
                                    {!! Form::submit(trans('global.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}

                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>

  </table>
</div>
</div>

<script>
$(document).ready(function() {
    $('#example').DataTable( {

        "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],

    } );
} );
</script>
  @endsection

@section('javascript')
    <script>


        @can('category_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('categories.mass_destroy') }}'; @endif
        @endcan



    </script>
@endsection

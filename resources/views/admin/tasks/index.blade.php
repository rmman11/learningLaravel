@extends('admin.layouts.master')
@section('pageTitle', 'Tasks')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="card">
    <div class="card-header">

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
      <a class="btn btn-success" href="{{ route('admin.tasks.create') }}">
          New Task
      </a>
    </div>
</div>

<br/> <br/>
    <table id="example" class="display" style="width:100%">
      <thead>
      <th>Task</th>
      <th>Date Time</th>
      <th>Name</th>
      <th class="no-sort" name="prop_ref_no">Action</th>
    </thead>
    <tbody>
      @foreach ($tasks as $task)

        <td><div>{{ $task->name }}</div></td>
        <td><div>{{ $task->created_at }}</div></td>
        <td><div>{{ $task->display_name }}</div></td>
        <td style="width:200px">
          <a class="btn btn-xs btn-info" href="{{ route('admin.tasks.edit', $task->id) }}">
    <i class='fas fa-edit' style='font-size:24px'></i>
          </a>
      <a class="fa fa-eye" href="{{ route('admin.tasks.show', $task->id) }}"></a>


          <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button class="btn" value="{{ trans('global.delete') }}">
              <i class="fa fa-trash"></i>
            </button>
          </form>


        </td>
      </tr>
      @endforeach
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

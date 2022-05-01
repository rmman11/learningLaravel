@extends('admin.layouts.master')
@section('pageTitle', 'ClientStatus')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.clientStatuses.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.clientStatus.title_singular') }}
            </a>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.clientStatus.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Client">
                <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.clientStatus.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.clientStatus.fields.name') }}
                        </th>
                        <th  class="no-sort" name="prop_ref_no">
                    Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientStatuses as $key => $clientStatus)
                        <tr data-entry-id="{{ $clientStatus->id }}">

                            <td>
                                {{ $clientStatus->id ?? '' }}
                            </td>
                            <td>
                                {{ $clientStatus->name ?? '' }}
                            </td>
                            <td>

                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.clientStatuses.show', $clientStatus->id) }}">
                                        {{ trans('global.view') }}
                                    </a>


                                    <a class="btn btn-xs btn-info" href="{{ route('admin.clientStatuses.edit', $clientStatus->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>



                                    <form action="{{ route('admin.clientStatuses.destroy', $clientStatus->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>


                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.clientStatuses.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)


  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Client:not(.ajaxTable)').DataTable({
    buttons: dtButtons,
    "columnDefs": [ {
      "targets": 'no-sort',
      "orderable": false,
} ]
   })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection

@extends('admin.layouts.master')
@section('pageTitle', 'List Product')
@section('content')

<div class="card">

      <div class="card-body">

    <p>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">New product</a>

    </p>

    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

  <table id="example" class="display" style="width:100%">
    <thead>
  <tr>
  <th class="no-sort" name="prop_ref_no">Nr</th>
        <th>Name</th>
        <th>Categorie</th>
        <th>Slug</th>
         <th>description</th>
          <th>price</th>
           <th>image</th>
             <th class="no-sort" name="prop_ref_no">Action</th>
             </tr>
      </thead>
         <tbody>
@foreach ($products as $key => $product)
<tr>
<td style="width:25px">{{ ++$key }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->title }}</td>
            <td  style="width:25px">{{ $product->slug }}</td>
            <td style="width:50px">{{ $product->description }}</td>
             <td>{{ $product->price }}</td>
              <td ><div>
              <img src="{{ asset('/public/uploads/' . $product->image) }}" alt="product" class="img-responsive"
               width="100" height="100"> </div></td>
                 <td>
        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
        </form>



        <a   href="{{ route('admin.products.edit',$product->id) }}" title="edit">
        <i class="fa fa-edit" style="font-size:26px"></i></a>

        <a   href="{{ route('admin.products.show',$product->id) }}" title="details">
        <i class="fa fa-eye" style="font-size:26px; color:red"></i></a>



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

function edit(id)
  {
    var view_url = $("#hidden_view").val();

    $.ajax({
      url: view_url,
      type:"GET",
      data: {"id":id},
      success: function(result){
          //console.log(result);
          $("#id").val(result.id);
          $("#edit_name").val(result.name);
          $("#edit_price").val(result.price);
          $("#edit_slug").val(result.slug);
          $("#edit_description").val(result.description);

        }
      });
  }

  $(function () {
let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
let deleteButton = {
  text: deleteButtonTrans,
  url: "{{ route('admin.products.massDestroy') }}",
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
$('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
})


</script>
@endsection

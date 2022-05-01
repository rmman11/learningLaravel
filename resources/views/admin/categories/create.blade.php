@extends('admin.layouts.master')
@section('pageTitle', 'Create Categorie')
@section('content')
<div class="container"  style="background: #fff">


    <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h3>@lang('quickadmin.categories.title')</h3>
                </div>


    <div class="card-body">

    {!! Form::open(['method' => 'POST', 'route' => ['admin.categories.store']]) !!}


            <div class="form-group">
            <label>Select Parent Category</label>
                      <select  name="parent_id" class="form-control" >


                        @foreach ($categories as $cat)
                          <option value="{{ $cat->id }}">{{ $cat->title}}</option>
                        @endforeach
                      </select>
                    </div>

                <div class="form-group">
                    {!! Form::label('name', trans('quickadmin.categories.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
                {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
            </div></div>


    </div>
    </div>

    <script
   src="https://code.jquery.com/jquery-3.4.1.min.js"
   integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
   crossorigin="anonymous"></script>

         <script type="text/javascript">
           $('.edit-category').on('click', function() {
             var id = $(this).data('id');
             var name = $(this).data('name');
             var url = "{{ url('category') }}/" + id;

             $('#editCategoryModal form').attr('action', url);
             $('#editCategoryModal form input[name="name"]').val(name);
           });
         </script>

@stop

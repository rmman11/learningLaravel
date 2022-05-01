@extends('admin.layouts.master')
@section('pageTitle', 'Create Product')
@section('content')
<div class="container"  style="background: #fff">
<div class="row" style="padding:20px">

         <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
     <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">

<div class="form-group">
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    </div>
 <div class="form-group">
			<label class="col-md-4 control-label">Name</label>
				<input type="text" name="name" value="{{ old('name') }}">
		</div>

    <div class="form-group">
    <label class="col-md-4 control-label">Categorie</label>
    {!! Form::select('id', $categories, old('categories'), [
    'required' => '','name'=>'categorie']) !!}

                </div>

 <div class="form-group">
      <label class="col-md-4 control-label">Slug</label>
        <input type="text" name="slug" value="{{ old('slug') }}">
    </div>


    <div class="form-group">
      <label class="col-md-4 control-label">Price</label>
        <input type="text" name="price" value="{{ old('price') }}">
    </div>



		<div class="form-group">
			<label class="col-md-4 control-label">Description</label>
			     <textarea name="description"    value="{{ old('description') }}" rows="5"
								cols="28" >
           </textarea>
            </div>

               <div class="form-group row">

                            <label for="name" class="col-md-4 col-form-label text-md-right">Your Picture</label>
                      <div class="col-md-6">
                    <input type="file" class="form-control-file" name="image" id="image" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                </div>

              </div>


				<button type="submit" class="btn btn-primary" >
				Save
				</button>

    </form>
  </div>
</div>
@stop

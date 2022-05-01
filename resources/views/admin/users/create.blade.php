@extends('admin.layouts.master')
@section('pageTitle', 'Create Users')
@section('content')

<div class="card">
  <div class="card-header">
    {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
  </div>

  <div class="card-body">
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">


      <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
      @csrf



      <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
        <label for="name">{{ trans('cruds.user.fields.username') }}*</label>
        <input type="text" id="username" name="username" class="form-control" value="{{ old('username', isset($user) ? $user->username : '') }}" required>
        @if($errors->has('username'))
        <em class="invalid-feedback">
          {{ $errors->first('username') }}
        </em>
        @endif
        <p class="helper-block">
          {{ trans('cruds.user.fields.name_helper') }}
        </p>
      </div>

      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <label for="email">{{ trans('cruds.user.fields.email') }}*</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
        @if($errors->has('email'))
        <em class="invalid-feedback">
          {{ $errors->first('email') }}
        </em>
        @endif
        <p class="helper-block">
          {{ trans('cruds.user.fields.email_helper') }}
        </p>
      </div>
      <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        <label for="password">{{ trans('cruds.user.fields.password') }}</label>
        <input type="password" id="password" name="password" class="form-control" required>
        @if($errors->has('password'))
        <em class="invalid-feedback">
          {{ $errors->first('password') }}
        </em>
        @endif
        <p class="helper-block">
          {{ trans('cruds.user.fields.password_helper') }}
        </p>
      </div>


      <div class="form-group row">

        <label for="name" class="col-md-4 col-form-label text-md-right">Your Picture</label>
        <div class="col-md-6">
          <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
          <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
        </div>

      </div>
      <div>
        <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
      </div>
    </form>


  </div>
</div>
@endsection

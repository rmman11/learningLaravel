@extends('admin.layouts.master')
@section('pageTitle', 'Details')
@section('content')




<div class="card">

<div class="card-body">
    <div class="mb-2">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                       Name
                    </th>
                    <td>
                        {{ $product->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                      Categorie
                    </th>
                    <td>
                      {{ $product->title}}
                    </td>
                </tr>

                <tr>
                    <th>
                    Slug
                    </th>
                    <td>
                      {{ $product->slug}}
                    </td>
                </tr>

                <tr>
                    <th>
                Price
                    </th>
                    <td>
                      {{ $product->price}}
                    </td>
                </tr>

                <tr>
                    <th>
                Description
                    </th>
                    <td>
                      {{ $product->description}}
                    </td>
                </tr>

                <tr>
                    <th>
                Image
                    </th>
                    <td>
                    <img src="{{URL::asset('/public/uploads/'.$product->image)}}"  width="200" height="200">
                    </td>
                </tr>
                <tr>
                    <th>
                Date
                    </th>
                    <td>
                      {{ $product->created_at}}
                    </td>
                </tr>


            </tbody>
        </table>
        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
  </div>

</div>

@stop

@extends('admin.layouts.master')
@section('pageTitle', 'Details')
@section('content')

<div class="container"  style="background: #fff;">

<div class="pull-right">

<a class="btn btn-primary" href="{{ route('admin.products.index') }}"> Back</a>

</div>



<h1>Showing {{ $product->id }}</h1>

 <table border="1">
<thead>
<tr class="w3-blue">
 <th>Name</th>
  <th>Categorie</th>
  <th>Slug</th>
  <th>Price</th>
  <th>Decription</th>
  <th>Image</td>
  <th>Create Time</td>
</tr>
</thead>
<tr>
  <td>	<p>{{ $product->name }}</p></td>
  <td>{{ $product->title}}</td>
  <td>{{ $product->slug }}</td>
  <td>{{ $product->price }}</td>
  <td>{{ $product->description }}</td>
  <td>    <img src="{{URL::asset('/public/uploads/'.$product->image)}}"></td>
  <td> {{ $product->created_at }}   </td>
</tr>
</table>
</div>

  </div>

</div>

@stop

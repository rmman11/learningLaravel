@extends('frontend.layouts.app')
@section('title', 'result')
@section('content')


<div class="container">
	<div class="row">
		@if($product->isNotEmpty())
		@foreach ($product as $prod)
		<div class="prod-list">
			<p>Name :{{ $prod->name }}</p>
			Pictures :<img src="{{ asset('/public/uploads/' . $prod->image) }}" alt="product" class="img-responsive"
			width="100" height="100"> 
            <p>Categorie :{{ optional($prod->categories)->name }}</p>
			<p class="product-description">Description :{{ $prod->description}}</p>
			<p class="price">current price: <span>$ {{ $prod->price}}</span></p>
		</div>
		@endforeach
		@else 
		<div>
			<h2>No product found</h2>
		</div>
		@endif

	</div>
</div>
@endsection

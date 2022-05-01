@extends('admin.layouts.master')
@section('title')
@section('content')
<div class="card">
    <div class="app-title">
     <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.id') }}
                        </th>
                        <td>
                            {{ $order->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.customer_name') }}
                        </th>
                        <td>
                            {{ $order->customer_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.customer_email') }}
                        </th>
                        <td>
                            {{ $order->customer_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Products
                        </th>
                        <td>
                            @foreach($order->products as $id => $products)
                                <span class="label label-info label-many">{{ $products->name }}</span>
                            @endforeach
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
@endsection

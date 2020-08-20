@extends('layouts.app')
@section('title') keyshop - Orders @endsection
@section('informasi') Orders Page @endsection

@section('content')
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<form action="{{route('orders.index')}}">
    <div class="row mb-3">
        <div class="col-md-5">
            <input value="{{Request::get('buyer_email')}}" name="buyer_email" type="text" class="form-control"
                placeholder="Search by buyer email">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-control" id="status">
                <option value="">ANY</option>
                <option {{Request::get('status') == "SUBMIT" ? "selected" : ""}} value="SUBMIT">SUBMIT</option>
                <option {{Request::get('status') == "PROCESS" ? "selected" : ""}} value="PROCESS">PROCESS</option>
                <option {{Request::get('status') == "FINISH" ? "selected" : ""}} value="FINISH">FINISH</option>
                <option {{Request::get('status') == "CANCEL" ? "selected" : ""}} value="CANCEL">CANCEL</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="submit" value="Filter" class="btn btn-primary">
        </div>
    </div>
</form>

<table class="table table-striped table-responsive-md table-md">
    <thead>
        <tr>
            <th>NO</th>
            <th>INVOICE NUMBER</th>
            <th>STATUS</th>
            <th>BUYER</th>
            <th>TOTAL QUANTITY</th>
            <th>ORDER DATE</th>
            <th>TOTAL PRICE</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $key => $order)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $order->invoice_number }}</td>
            <td>
                @if ($order->status == 'SUBMIT')
                <span class="badge badge-warning text-align">{{ $order->status }}</span>
                @elseif ($order->status == 'PROCESS')
                <span class="badge badge-info text-align">{{ $order->status }}</span>
                @elseif ($order->status == 'FINISH')
                <span class="badge badge-success text-align">{{ $order->status }}</span>
                @elseif($order->status == 'CANCEL')
                <span class="badge badge-danger text-align">{{ $order->status }}</span>
                @endif
            </td>
            <td>
                {{ $order->user->name }}
                <span class="text-muted">{{ $order->user->email }}</span>
            </td>
            <td>{{ $order->totalQuantity }} pc (s)</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->total_price }}</td>
            <td>
                <!-- Button trigger modal edit -->
                <a href="#" value="{{ route('orders.edit', [$order->id]) }}" class="btn btn-sm btn-warning btn-sm"
                    title="Show Data" data-toggle="modal" data-target="#EditOrder{{ $order->id }}"><span
                        class="glyphicon glyphicon-eye-open"><i class='fas fa-edit'></i></span></a>

                <!-- Modal Edit User -->
                <div class="modal fade" id="EditOrder{{ $order->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="EditUser" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EditOrder">Edit Order Books</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form enctype="multipart/form-data" action="{{route('orders.update', [$order->id])}}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" value="PUT" name="_method">

                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="InvoiceNumber">Invoice Number</label>
                                            <input type="text" name="invoice_number" id="InvoiceNumber"
                                                value="{{ $order->invoice_number }}" class="form-control"
                                                placeholder="Invoice Number" required autofocus>
                                        </div>
                                        <div class="form-group col">
                                            <label for="buyer">Buyer</label>
                                            <input type="text" name="buyer" id="buyer" disabled
                                                value="{{ $order->user->name }}" class="form-control"
                                                placeholder="Buyer ...">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="created_at">Order Date</label>
                                        <input type="date" name="created_at" id="created_at" class="form-control"
                                            value="{{ $order->created_at }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="created_at">Books ({{$order->totalQuantity}})</label>
                                        <ul class="pl-3">
                                            @foreach($order->books as $book)
                                            <li>{{$book->title}} <b>({{$book->pivot->quantity}})</b></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" disabled value="{{ $order->total_price }}"
                                            class="form-control" name="price" id="price" placeholder="Rp." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label><br>
                                        <select class="form-control" name="status" id="status">
                                            <option {{$order->status == "SUBMIT" ? "selected" : ""}} value="SUBMIT">
                                                SUBMIT</option>
                                            <option {{$order->status == "PROCESS" ? "selected" : ""}} value="PROCESS">
                                                PROCESS</option>
                                            <option {{$order->status == "FINISH" ? "selected" : ""}} value="FINISH">
                                                FINISH</option>
                                            <option {{$order->status == "CANCEL" ? "selected" : ""}} value="CANCEL">
                                                CANCEL</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-md-12 justify-content-end">
        {{$orders->appends(Request::all())->links()}}
    </div>
</div>
@endsection
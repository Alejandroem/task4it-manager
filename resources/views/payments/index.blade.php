@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <a class="btn btn-primary pull-right" href="{{route('payments.create')}}">Add payment</a>
        <i class="fa fa-table"></i> Payments </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>PaymentID</th>
                  {{--        <th>Asset Id</th>
                        <th>Asset Name</th>
                        <th>Asset Type</th>  --}}
                        @hasanyrole('admin|projectm')
                        <th>User</th>
                        @endhasanyrole
                        <th>Description</th>
                        <th>Date registered</th>
                        <th>Amount</th>
                        <th>Attachment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{$payment->id}}</td>
           {{--               <td>{{$payment->assetName}}</td>
                        <td>{{$payment->asset_id}}</td>
                        <td>{{$payment->asset}}</td>  --}}
                        @hasanyrole('admin|projectm')
                        <td>{{$payment->user->email}}</td>
                        @endhasanyrole
                        <td>{{$payment->description}}</td>
                        <td>{{$payment->created_at->toFormattedDateString()}}</td>
                        <td>${{ number_format($payment->amount,2)}}</td>
                        <td><a href="{{$payment->attachment->public_resource_url}}">{{$payment->attachment->filename}}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
</div>
@stop
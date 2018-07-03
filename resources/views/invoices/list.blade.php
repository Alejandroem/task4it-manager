@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        
        <i class="fa fa-table"></i> Invoices for {{$project->name}} </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Check invoice
                            </th>
                        </tr>
                    </thead>
                    <hbody>
                        @foreach($project->invoices as $invoice)
                            <tr>
                                <td>
                                    {{$invoice->date}}
                                </td>   
                                <td>
                                    {{number_format($invoice->amount,2)}} €
                                </td>
                                <td>
                                    @if($invoice->file())
                                        <a href="{{$invoice->file()->public_resource_url}}">{{$invoice->file()->alias}}</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </hbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@stop
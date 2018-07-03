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
                            <th></th>
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
                                <td>
                                {{Form::open(array('route'=>array('invoices.destroy',$invoice->id),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                    {{csrf_field()}}
                                    <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete invoice">
                                        <i class="btn btn-danger fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                {{Form::close()}}
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
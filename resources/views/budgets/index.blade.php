@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <a class="btn btn-primary pull-right" href="{{route('budgets.create')}}">Add Budget</a>
        <i class="fa fa-table"></i> Budgets </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                Budget Name
                            </th>
                        </tr>
                    </thead>
                    <hbody>
                        <tr>
                            <td>
                                
                            </td>
                        </tr>
                    </hbody>
                </table>
            </div>
        </div>
        {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
    </div>
</div>
@stop
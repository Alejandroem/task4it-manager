@extends('layout.app') @section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Enquire {{$enquire->id}} <a class="btn btn-primary pull-right" href="{{route('enquires.index')}}">Regresar</a></div>
        
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            Option subject
                        </th>
                        <th>
                            Value selected
                        </th>
                        <th>
                            Current price of the value
                        </th>
                        <th>
                            Price of the value when user selected it
                        </th>
                    </tr>
                </thead>
                <hbody>
                    @foreach($enquire->options as $option)
                    <tr>
                        <td>
                            {{$option->current_option_subject}}
                        </td>
                        <td>
                            {{$option->value->name}}
                        </td>
                        <td>
                            {{number_format($option->value->value,2)}}€
                        </td>
                        <td>
                            {{number_format($option->current_option_value,2)}}€
                        </td>

                    </tr>
                    @endforeach
                </hbody>
            </table>
        </div>
    </div>
    {{--
    <div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
</div>
</div>
@stop
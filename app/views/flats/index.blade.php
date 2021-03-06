@extends('layouts.default')

@section('content')
    <div>

        @if(count($flats))


            <div class="panel-heading">


                <span class="pull-right">
                    <td><a href="{{ route('flats.create') }}"><button class="btn btn-success btn-xs btn-archive createBtn">Create New Flat</button></a></td>
                </span>




            </div>

            <table class="display table table-bordered table-striped" id="example">
                <thead>
                <tr>
                    <th>Flat Name</th>
                    <th>Flat Details</th>
                    <th>Rent Amount/Month</th>
                    <th>Payment</th>
                    <th>Show</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($flats as $flats)
                    <tr>
                        <td>{{ $flats->name }}</td>
                        <td>{{str_limit($flats->flat_details, 150)}}</td>
                        <td>{{ $flats->rent_amount }} Taka</td>

                        @if($flats->payment_status == true )
                            <td style="color:green">Paymet Complete</td>
                        @else
                            <td><a href="{{ route('flats.payment', $flats->id) }}"><button class="btn btn-warning btn-xs btn-archive createBtn">Payment Incomplete</button></a></td>
                        @endif

                        <td><a class="btn btn-success btn-xs btn-archive editBtn" href="{{route('flats.show',$flats->id)}}"  style="margin-right: 3px;">Show</a></td>
                        <td><a class="btn btn-info btn-xs btn-archive editBtn" href="{{route('flats.edit',$flats->id)}}"  style="margin-right: 3px;">Edit</a></td>
                        <td><a href="#" class="btn btn-danger btn-xs btn-archive deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteId="{{ $flats->id }}">Delete</a></td>
                    </tr>

                @endforeach
                </tbody>
            </table>

        @else
            No Data Found.
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                </div>
                <div class="modal-body">
                    Are you sure to delete?
                </div>
                <div class="modal-footer">
                    {{ Form::open(array('route' => array('flats.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                    {{ Form::submit('Yes, Delete', array('class' => 'btn btn-success')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>



@stop

@section('style')
    {{--{{ HTML::style('assets/data-tables/DT_bootstrap.css') }}--}}

@stop


@section('script')
    {{ HTML::script('assets/data-tables/jquery.dataTables.js') }}
    {{ HTML::script('assets/data-tables/DT_bootstrap.js') }}

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('#example').dataTable({
            });

            $(document).on("click", ".deleteBtn", function() {
                var deleteId = $(this).attr('deleteId');
                var url = "<?php echo URL::route('flats.index'); ?>";
                $(".deleteForm").attr("action", url+'/'+deleteId);
            });



        });
    </script>
@stop

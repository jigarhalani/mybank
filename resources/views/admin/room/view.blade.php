@extends('layout.app')


@section('page_heading','Rooms')
@section('content')

    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">

        @include('admin.includes.notification')
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Activated Rooms</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="leadtable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Building Name</th>
                            <th>Room Name</th>
                            <th>Maximum Allowed Person</th>
                            <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                                    <tr >
                                        <td class="name">{{ $room->building->name }}</td>
                                        <td>{{ $room->room_name }}</td>
                                        <td>{{ $room->max_person }}</td>
                                        <td>
                                            <a href="{{ url('room/edit/'.$room->id) }}" title="Edit"> <i class="fa fa-edit"></i></a>&nbsp;
                                            <a href="{{ url('room/delete/'.$room->id) }}" title="Delete" onclick="return confirm('Want to delete?');"> <i class="fa fa-trash"></i></a>&nbsp;
                                        </td>
                                    </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Building Name</th>
                            <th>Room Name</th>
                            <th>Maximum Allowed Person</th>
                            <th>Option</th>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <form action="#" method="POST" id="followup_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Set follow up</h4>
                        </div>
                        <div class="modal-body">


                            <div class="form-group">

                                <span>Follow up with : <span id="m_name"></span></span>

                            </div>

                            <div class="form-group">
                                {{ csrf_field() }}
                                <input type="hidden" name="lead_id" value="" id="m_lead_id">
                                <span>Date:</span>
                                <div class='input-group date' id='datepicker'>
                                    <input type='text' class="form-control"  name="followup_time"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <span>Notes</span>
                                <textarea class="form-control" rows="3" placeholder="Notes" name="notes"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="close_model">Close</button>
                            <button type="button" class="btn btn-primary" id="model_save_changes">Save changes</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </section>

@endsection

@section('script')
    $('#leadtable').DataTable();
@endsection
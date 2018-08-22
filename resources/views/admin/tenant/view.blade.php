@extends('layout.app')


@section('page_heading','Tenant')
@section('content')

    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">

        @include('admin.includes.notification')
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Activated Tenants</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="leadtable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Building Name</th>
                            <th>Room Name</th>
                            <th>Tenant Name</th>
                            <th>Address</th>
                            <th>Pan No</th>
                            <th>Aadhar No</th>
                            <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($tenants as $tenant)
                                    <tr >
                                        <td class="name">{{ $tenant->building->name }}</td>
                                        <td class="name">{{ $tenant->room->room_name }}</td>
                                        <td>{{ $tenant->name }}</td>
                                        <td>{{ $tenant->address }}</td>
                                        <td>{{ $tenant->pan_no }}</td>
                                        <td>{{ $tenant->aadhar_no }}</td>
                                        <td>
                                            <a href="{{ url('tenants/edit/'.$tenant->id) }}" title="Edit"> <i class="fa fa-edit"></i></a>&nbsp;
                                            <a href="{{ url('tenants/delete/'.$tenant->id) }}" title="Delete" onclick="return confirm('Want to delete?');"> <i class="fa fa-trash"></i></a>&nbsp;
                                        </td>
                                    </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Building Name</th>
                            <th>Room Name</th>
                            <th>Tenant Name</th>
                            <th>Address</th>
                            <th>Pan No</th>
                            <th>Aadhar No</th>
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
    $('#datepicker').datetimepicker();

    $(document).on('click','.setfollowup',function(){
            $("#m_name").html($(this).parents("tr").children(".name").text());
            $("#m_lead_id").val($(this).data("leadid"));
    });

    $('#model_save_changes').click(function(){
            $.ajax({
                url: base_url+"/lead/setfollowup",
                data:$('#followup_form').serialize(),
                type:"POST",
                success: function(html){
                   document.getElementById("followup_form").reset();
                   $('#modal-default').modal('hide');
                        location.reload();
                }
            });
    });

    $('#close_model').on('click',function(){
            document.getElementById("followup_form").reset();
            $('#modal-default').modal('hide');
    });


@endsection
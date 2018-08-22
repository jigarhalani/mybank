@extends('layout.app')


@section('page_heading','Tenant')
@section('content')

    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">

        @include('admin.includes.notification')

        <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add Tenant</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" action="{{ url('tenants/add') }}" method="POST" >
                {{ csrf_field() }}
            <div class="box-body">

                    <!-- text input -->
                    <div class="col-md-6 left">

                        <div class="form-group">
                            <label>Select Building </label>
                            <select name="building_id" class="form-control" id="tenants_building_id">
                                        <option value="">Please Select Building</option>
                                        @foreach($buildings as $building)
                                            <option value="{{ $building->id }}">{{ $building->name }}</option>
                                        @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Select Rooms </label>
                            <select name="room_id" class="form-control" id="room_id">
                                <option value="">Please Select Room</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tenant Name</label>
                            <input type="text" class="form-control" placeholder="Tenant Name" name="name"
                                   value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" placeholder="Address"
                                      name="address"> {{ old('address') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Pan Number</label>
                            <input type="text" class="form-control" placeholder="Pan Number" name="pan_no"
                                   value="{{ old('pan_no') }}">
                        </div>

                        <div class="form-group">
                            <label>Aadhar Number</label>
                            <input type="text" class="form-control" placeholder="Aadhar Number" name="aadhar_no"
                                   value="{{ old('aadhar_no') }}">
                        </div>

                    </div>

            </div>

            <!-- /.box-body -->

             <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
             </div>
            </form>
        </div>
        </div>

    </section>

@endsection

@section('script')
    var url="{{ url('tenants/getroom') }}";
    $(document).on('change','#tenants_building_id',function(){
            $.ajax({
                    url:url+'/'+$(this).val(),
                    type:'GET',
                    success:function(e){
                        $('#room_id').html('<option value="">Please Select Room</option>');
                        $.each(e, function(k,v) {
                                $('#room_id').append('<option value="'+v.id+'">'+v.room_name+'</option>');
                        });
                    }
            });
    });
@endsection
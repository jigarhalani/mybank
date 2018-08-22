@extends('layout.app')


@section('page_heading','Room')
@section('content')

    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">

        @include('admin.includes.notification')

        <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add Room</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" action="{{ url('room/add') }}" method="POST" >
                {{ csrf_field() }}
            <div class="box-body">

                    <!-- text input -->
                    <div class="col-md-6 left">

                        <div class="form-group">
                            <label>Select Building </label>
                            <select name="building_id" class="form-control">
                                        <option value="">Please Select Building</option>
                                        @foreach($buildings as $building)
                                            <option value="{{ $building->id }}">{{ $building->name }}</option>
                                        @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Room Name</label>
                            <input type="text" class="form-control" placeholder="Room Name" name="room_name" value="{{ old('room_name') }}" >
                        </div>


                        <div class="form-group">
                            <label>Maximum Person</label>
                            <input type="number" class="form-control" placeholder="Maximum Person" name="max_person" value="{{ old('max_person') }}" >
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

@endsection
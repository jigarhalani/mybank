@extends('layout.app')


@section('page_heading','Buildings')
@section('content')

    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">

        @include('admin.includes.notification')

        <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Building</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" action="{{ url('building/update/'.$building->id) }}" method="POST" >
                {{ csrf_field() }}
            <div class="box-body">

                    <!-- text input -->
                <div class="col-md-6 left">

                    <div class="form-group">
                        <label>Name </label>
                        <input type="text" class="form-control" placeholder="Building Name" name="name" value="{{ $building->name }}" >
                    </div>

                    <div class="form-group">
                        <label>Area</label>
                        <input type="text" class="form-control" placeholder="Area" name="area" value="{{ $building->area }}" >
                    </div>


                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="City" name="city" value="{{ $building->city }}" >
                    </div>

                    <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" placeholder="State" name="state" value="{{ $building->state }}">
                    </div>

                    <div class="form-group">
                        <label>Pincode</label>
                        <input type="text" class="form-control" placeholder="Pincode" name="pincode" value="{{ $building->pincode }}">
                    </div>


                </div>


            </div>

             <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
             </div>
            </form>
        </div>
        </div>

    </section>

@endsection
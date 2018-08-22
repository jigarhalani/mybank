@extends('layout.app')


@section('page_heading','Building')
@section('content')

    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">

        @include('admin.includes.notification')

        <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add Buildings</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" action="{{ url('building/add') }}" method="POST" >
                {{ csrf_field() }}
            <div class="box-body">

                    <!-- text input -->
                    <div class="col-md-6 left">

                        <div class="form-group">
                            <label>Name </label>
                            <input type="text" class="form-control" placeholder="Building Name" name="name" value="{{ old('name') }}" >
                        </div>

                        <div class="form-group">
                            <label>Area</label>
                            <input type="text" class="form-control" placeholder="Area" name="area" value="{{ old('area') }}" >
                        </div>


                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" placeholder="City" name="city" value="{{ old('city') }}" >
                        </div>

                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" placeholder="State" name="state" value="{{ old('state') }}">
                        </div>

                        <div class="form-group">
                            <label>Pincode</label>
                            <input type="text" class="form-control" placeholder="Pincode" name="pincode" value="{{ old('pincode') }}">
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
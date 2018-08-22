@extends('layout.app')

@section('addcss')
<link href="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('bower_components/fullcalendar/dist/fullcalendar.print.css') }}" rel="stylesheet" type="text/css" media='print' />
@endsection

@section('page_heading','Dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">

        @include('admin.includes.notification')

        <div class='row'>

            <div class='col-md-12'>
                <!-- Box -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Welcome {{ $user->name }}</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            {{--<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>--}}
                        </div>
                    </div>
                    <div class="box-body">
                                    <h4><span>Your Id:</span> <span>{{ $user->email }}</span></h4>
                                    <hr>
                                    <h4><span>Your Balance:</span> <span>{{ $user->account->balance }}</span></h4>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section>
@endsection


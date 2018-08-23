@extends('layout.app')


@section('page_heading','Deposit')
@section('content')

    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">

        @include('admin.includes.notification')

        <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Deposit Money</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" action="{{ url('account/deposit') }}" method="POST" id="deposit">
                {{ csrf_field() }}

                <div class="box-body">
                    <!-- text input -->
                    <div class="col-md-6 left">
                        <div class="form-group">
                            <label>Amount </label>
                            <input type="text" class="form-control" placeholder="Amount" name="amount" value="{{ old('amount') }}" required pattern="[0-9]+([\.,][0-9]+)?">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>

            <!-- /.box-body -->

             <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Deposit</button>
             </div>
            </form>
        </div>
        </div>

    </section>

@endsection

@section('script')
    $('#deposit').validator();
@endsection
@extends('layout.app')


@section('page_heading','Transfer')
@section('content')

    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">

        @include('admin.includes.notification')

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Transfer Money</h3>
                </div>
                <!-- /.box-header -->
                @if($user_balance>0)
                    <form role="form" action="{{ url('account/transfer') }}" method="POST" id="transfer">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <!-- text input -->
                            <div class="col-md-6 left">

                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" placeholder="Email Address" name="email"
                                           value="{{ old('email') }}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" placeholder="Amount" name="amount"
                                           value="{{ old('amount') }}" required pattern="[0-9]+([\.,][0-9]+)?">
                                    <div class="help-block with-errors"></div>
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Transfer</button>
                        </div>
                    </form>
                @else
                    <div class="box-body">
                        <h2>0 Balance In your Account.</h2>
                    </div>
                @endif
            </div>
        </div>

    </section>

@endsection

@section('script')
    $('#transfer').validator();
@endsection
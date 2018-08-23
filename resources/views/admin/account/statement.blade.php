@extends('layout.app')


@section('page_heading','Statement')
@section('content')

    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">

        @include('admin.includes.notification')
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Statement Of Account</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="statement" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Time</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Details</th>
                            <th>Balance</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($statements)>0)
                                @foreach($statements as $statement)
                                        <tr>
                                            <td class="id">{{ $statement->id }}</td>
                                            <td>{{ date('d-m-Y h:i A', strtotime($statement->created_at)) }}</td>
                                            <td>{{ $statement->amount }}</td>
                                            <td>{{ $statement->type==1?'Credit':'Debit' }}</td>
                                            <td>
                                                @if($statement->is_transfer)
                                                  <span class="show">{{ $statement->type==1?'Transfer From':'Transfer To' }}</span>
                                                  <span>{{ $statement->transfer->user->email }}</span>
                                                @else
                                                  {{ $statement->type==1?'Deposit':'Withdraw' }}
                                                @endif
                                            </td>
                                            <td>{{ $statement->closing_balance }}</td>
                                        </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" > No Statement Found.</td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Date Time</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Details</th>
                            <th>Balance</th>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

            </div>
        </div>
    </section>

@endsection

@section('script')
    $('#statement').DataTable({"order": [[ 2, "desc" ]] });
@endsection
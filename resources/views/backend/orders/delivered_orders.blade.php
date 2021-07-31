@extends('admin.admin_master')

@section('admin_index')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Delivered Order List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Invoices</th>
                                        <th>Amount</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $item->order_date }}
                                            {{-- {{ Carbon\Carbon::parse( )->format('D,d F Y') }} --}}
                                        </td>
                                        <td> {{ $item->invoice_no }} </td>
                                        <td> ${{ $item->amount }} </td>
                                        <td> {{ $item->payment_method }} </td>
                                        <td> <span class="badge badge-pill badge-primary">{{ $item->status }}</span> </td>

                                        <td class="text-center">
                                            <a title="View Data" href="{{ route('pending.order.details', $item->id) }}"
                                                class="btn btn-success"><i class="fa fa-eye"></i></a>

                                            <a target="_blank" href="{{ route('invoice.download',$item->id) }}" title="Invoices Download"
                                                class="btn btn-danger"><i class="fa fa-download"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

@endsection

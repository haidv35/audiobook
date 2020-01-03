@extends('user.layouts.app')
@section('app-main')
<div class="card card-fluid">
    <!-- .card-body -->
    <div class="card-body">
        <!-- .form-group -->
        <div class="form-group">
        <!-- .input-group -->
        <div class="input-group input-group-alt">
            <!-- .input-group-prepend -->
            <div class="input-group-prepend">
            <select class="custom-select">
                <option selected=""> Lọc theo </option>
                <option value="1"> Tags </option>
                <option value="2"> Vendor </option>
                <option value="3"> Variants </option>
                <option value="4"> Prices </option>
                <option value="5"> Sales </option>
            </select>
            </div><!-- /.input-group-prepend -->
            <!-- .input-group -->
            <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
            </div><input type="text" class="form-control" placeholder="Tìm kiếm">
            </div><!-- /.input-group -->
        </div><!-- /.input-group -->
        </div><!-- /.form-group -->
        <!-- .table-responsive -->
        <div class="text-muted"> Hiển thị 1 tới @if($orders->total() < 10) {{ $orders->total() % $orders->perPage() }} @else {{ $orders->perPage() }} @endif trong tổng số {{ $orders->total() }} </div>
        <div class="table-responsive">
        <!-- .table -->
        <table class="table">
            <!-- thead -->
            <thead>
            <tr>
                <th colspan="2" style="min-width:220px">
                    @includeIf('user.layouts.select-menu')
                    <span class="ml-2">Mã đơn hàng</span>
                </th>
                <th> Số tiền cần thanh toán </th>
                <th> Đã thanh toán </th>
                <th> Chưa thanh toán </th>
                <th> Trạng thái </th>
                <th> Phương thức thanh toán </th>
                <th> Ngày đặt hàng </th>
                <th style="width:100px; min-width:100px;"> &nbsp; </th>
            </tr>
            </thead><!-- /thead -->
            <!-- tbody -->
            <tbody>
            <!-- tr -->
            @foreach ($orders as $order)
            <tr>
                <td class="align-middle col-checker">
                    <div class="custom-control custom-control-nolabel custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="selectedRow[]" id="p{{ $order->id }}"> <label class="custom-control-label" for="p{{ $order->id }}"></label>
                    </div>
                </td>
                <td class="align-middle">
                    <span>{{ $order->order_code}}</span>
                </td>
                <td class="align-middle">
                    <span class="price" style="font-weight:bold;">{{ $order->amount}}</span>
                </td>
                <td class="align-middle">
                    <span class="@if($order->paid != 0) price @endif" style="color:green;font-weight:bold;">{{ ($order->paid != 0) ? $order->paid : 0  }}</span>
                </td>
                <td class="align-middle">
                    <span class="@if($order->amount > $order->paid) price @endif" style="color:red;font-weight:bold;">@if($order->amount > $order->paid) {{ $order->amount - $order->paid }} @else 0 @endif</span>
                </td>
                <td class="align-middle" style="max-width: 120px;">
                    @if ($order->status == 'unpaid')
                        <span class="badge badge-subtle badge-warning">Chưa thanh toán</span>
                    @elseif ($order->status == 'processing')
                        <span class="badge badge-subtle badge-primary">Đang chờ xử lý</span>
                    @elseif ($order->status == 'paid')
                        <span class="badge badge-subtle badge-success">Đã thanh toán</span>
                    @elseif ($order->status == 'canceled')
                        <span class="badge badge-subtle badge-danger">Đã huỷ</span>
                    @endif
                </td>
                <td class="align-middle">
                    <span style="text-transform:uppercase">{{ isset($order->payment_method_id) ? $order->payment_method->type : ''}}</span>
                </td>
                <td class="align-middle"> {{ \Carbon\Carbon::parse($order->ordered_at)->format('d/m/Y') }} </td>
                <td class="align-middle text-right">
                    <a href="{{ route('user.orders',$order->order_code) }}" class="btn btn-sm btn-icon btn-secondary">
                        <i class="fas fa-eye"></i> <span class="sr-only">View</span>
                    </a>
                </td>
            </tr><!-- /tr -->
            @endforeach
            </tbody><!-- /tbody -->
        </table><!-- /.table -->
        </div><!-- /.table-responsive -->
        <!-- .pagination -->
        <ul class="pagination justify-content-center mt-4">
            {{ $orders->links() }}
        </ul><!-- /.pagination -->
    </div><!-- /.card-body -->
</div>
@endsection

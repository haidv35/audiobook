@extends('admin.layouts.app')
@section('app-main')
<div class="card-columns row">
    <div class="col-lg-6">
        <div class="card card-fluid">
            <div class="card-body">
                <h4 class="card-title"> Danh sách sản phẩm </h4>
                @foreach ($order_detail as $item)
                <div class="list-group list-group-flush list-group-divider">
                    <a href="/product-details/{{ $item->product_id }}" class="list-group-item list-group-item-action" target="_blank">
                        <div class="list-group-item-figure">
                            <div class="">
                                <img src="{{ $item->product->image }}" alt="" style="width:5rem;">
                            </div>
                        </div>
                        <div class="list-group-item-body">
                            <h4 class="list-group-item-title"> {{ $item->product->title }} </h4>
                            <h5 class="list-group-item-subtitle price"> {{ $item->price }} </h5>
                            <p class="list-group-item-text text-truncate"> {{ $item->category }} </p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-fluid">
            <div class="card-body">
                <h4 class="card-title"> Thông tin đơn hàng </h4>
            </div>
            <form method="POST" id="order-form">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3  d-flex align-items-center justify-content-start">
                            <label for="order_code">Mã đơn hàng</label>
                        </div>
                        <div class="col-lg-12 col-xl-9">
                            <input type="text" class="form-control " name="order_code" id="order_code" placeholder="" disabled="" value="{{ $order->order_code }}">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3  d-flex align-items-center justify-content-start">
                            <label for="status">Trạng thái</label>
                        </div>
                        <div class="col-lg-12 col-xl-9">

                            <select id="status" class='custom-select'  name="status">
                                <option value="unpaid" @if($order->status == 'unpaid') selected @endif>Chưa thanh toán</option>
                                <option value="processing" @if($order->status == 'processing') selected @endif>Đang xử lý</option>
                                <option value="paid" @if($order->status == 'paid') selected @endif>Đã thanh toán</option>
                                <option value="canceled" @if($order->status == 'canceled') selected @endif>Đã huỷ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3  d-flex align-items-center justify-content-start">
                            <label for="status">Tên người mua</label>
                        </div>
                        <div class="col-lg-12 col-xl-9">
                            <input type="text" class="form-control" name="user_fullname" id="user_fullname" placeholder="" disabled="" value="{{ $order->fullname }}">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3  d-flex align-items-center justify-content-start">
                            <label for="status">Email người mua</label>
                        </div>
                        <div class="col-lg-12 col-xl-9">
                            <input type="text" class="form-control" name="user_email" id="user_email" placeholder="" disabled="" value="{{ $order->email }}">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3  d-flex align-items-center justify-content-start">
                            <label for="amount">Tổng số tiền</label>
                        </div>
                        <div class="col-lg-12 col-xl-9">
                            <input type="text" class="form-control price-lite" name="amount" id="amount" placeholder="" value="{{ $order->amount }}" disabled="">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3  d-flex align-items-center justify-content-start">
                            <label for="paid">Đã thanh toán</label>
                        </div>
                        <div class="col-lg-12 col-xl-9">
                            <input type="text" class="form-control price-lite" name="paid" id="paid" placeholder="" value="{{ $order->paid }}">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3  d-flex align-items-center justify-content-start">
                            <label for="balance">Còn nợ</label>
                        </div>
                        <div class="col-lg-12 col-xl-9">
                            <input type="text" class="form-control price-lite" name="balance" id="balance" placeholder="" value="{{ $order->amount - $order->paid }}" disabled="">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3  d-flex align-items-center justify-content-start">
                            <label for="payment_method_id">Phương pháp thanh toán</label>
                        </div>
                        <div class="col-lg-12 col-xl-9">
                            <select id="payment_method_id" class="custom-select" name="payment_method_id">
                                @if(empty($order->payment_method))
                                    <option>Chưa chọn phương thức thanh toán</option>
                                @endif
                                @foreach ($payment_method as $item)
                                    @if(isset($order->payment_method))
                                        <option value="{{ $item->id }}" @if(isset($order->payment_method) && $order->payment_method->type == $item->type) selected @endif>{{ $item->type }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->type }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3  d-flex align-items-center justify-content-start">
                            <label for="ordered_at">Ngày đặt hàng</label>
                        </div>
                        <div class="col-lg-12 col-xl-9">
                            <input type="text" class="form-control" name="ordered_at" id="ordered_at" placeholder="" value="{{ $order->ordered_at }}" disabled="">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 d-flex align-items-center justify-content-start">
                            <label for="paid_at">Ngày thanh toán</label>
                        </div>
                        <div class="col-lg-12 col-xl-9">
                            <input type="text" class="form-control" name="paid_at" id="paid_at" placeholder="" value="{{ $order->paid_at }}"  disabled="">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 d-flex align-items-center justify-content-start">
                                <label for="canceled_at">Ngày huỷ</label>
                            </div>
                            <div class="col-lg-12 col-xl-9">
                                <input type="text" class="form-control" name="canceled_at" id="canceled_at" placeholder="" value="{{ $order->canceled_at }}"  disabled="">
                            </div>
                        </div>
                    </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#ModalAlertWarning">Cập nhật đơn hàng</button>
                </div>
                <div class="modal modal-alert fade has-shown" id="ModalAlertWarning" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ModalAlertWarningLabel" style="display: none;" aria-hidden="true">
                    <!-- .modal-dialog -->
                    <div class="modal-dialog" role="document">
                        <!-- .modal-content -->
                        <div class="modal-content">
                        <!-- .modal-header -->
                        <div class="modal-header">
                            <h5 id="ModalAlertWarningLabel" class="modal-title">
                            <i class="fa fa-bullhorn text-warning mr-1"></i>  Xác nhận thay đổi</h5>
                        </div><!-- /.modal-header -->
                        <!-- .modal-body -->
                        <div class="modal-body">
                            <p> Bạn chắc chắn muốn cập nhật đơn hàng? </p>
                            <p class="text-muted"> Nhấn tiếp tục hoặc huỷ bỏ và xem lại các thay đổi </p>
                        </div><!-- /.modal-body -->
                        <!-- .modal-footer -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Huỷ bỏ</button>
                            <button type="button" class="btn btn-dark" id="updateBtn">Tiếp tục</button>
                        </div><!-- /.modal-footer -->
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom-footer')
    <script src="/pnotify/showStackBottomRight.js"></script>
    <script>
        let url = "{{ route('order_list.edit') }}";
        let id = "{{ $order->id }}";
    </script>
    <script src="/js/admin/product/order-details.js"></script>
@endsection

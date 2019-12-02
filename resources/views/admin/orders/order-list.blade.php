@extends('admin.layouts.app')
@section('custom-header')
<link rel="stylesheet" href="/looper/assets/vendor/datatables/extensions/buttons/buttons.bootstrap4.min.css">
@endsection
@section('app-main')
<div class="card card-fluid">
    <!-- .card-header -->
    <div class="card-header">Danh sách đơn hàng </div><!-- /.card-header -->
    <!-- .card-body -->
    <div class="card-body">
        <!-- .table -->
        <div id="myTable2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="table-responsive">
                <table id="listItemPurchased" class="table dataTable no-footer" role="grid" aria-describedby="myTable2_info">
                    <!-- thead -->
                    <thead>
                        <tr role="row">
                            <th style="min-width: 50px;" class="align-middle sorting" tabindex="0"
                                aria-controls="listItemPurchased" rowspan="1" colspan="1"
                                aria-label=" #"> # </th>
                            <th class="align-middle sorting_asc" tabindex="0" aria-controls="listItemPurchased" rowspan="1"
                                colspan="1" aria-label=" Mã đơn hàng"
                                aria-sort="ascending"> Mã đơn hàng </th>
                            <th class="align-middle sorting_asc" tabindex="0" aria-controls="listItemPurchased" rowspan="1"
                                colspan="1" aria-label=" Mã đơn hàng"
                                aria-sort="ascending"> Người mua </th>
                            <th class="align-middle sorting_asc" tabindex="0" aria-controls="listItemPurchased" rowspan="1"
                                colspan="1" aria-label=" Mã đơn hàng"
                                aria-sort="ascending"> Trạng thái </th>
                            <th class="align-middle sorting_asc" tabindex="0" aria-controls="listItemPurchased" rowspan="1"
                                colspan="1" aria-label=" Tổng tiền"
                                aria-sort="ascending"> Tổng tiền </th>
                            <th class="align-middle sorting_asc" tabindex="0" aria-controls="listItemPurchased" rowspan="1"
                                colspan="1" aria-label=" Đã thanh toán"
                                aria-sort="ascending"> Đã thanh toán </th>
                            <th class="align-middle sorting_asc" tabindex="0" aria-controls="listItemPurchased" rowspan="1"
                                colspan="1" aria-label=" Phương pháp thanh toán"
                                aria-sort="ascending"> Phương pháp thanh toán </th>
                            <th class="align-middle sorting_asc" tabindex="0" aria-controls="listItemPurchased" rowspan="1"
                                colspan="1" aria-label=" Ngày đặt hàng"
                                aria-sort="ascending"> Ngày đặt hàng </th>
                            <th class="align-middle sorting_asc" tabindex="0" aria-controls="listItemPurchased" rowspan="1"
                                colspan="1" aria-label=" Ngày thanh toán"
                                aria-sort="ascending"> Ngày thanh toán </th>
                            <th class="align-middle sorting_asc" tabindex="0" aria-controls="listItemPurchased" rowspan="1"
                                colspan="1" aria-label=" TNgày huỷ"
                                aria-sort="ascending"> Ngày huỷ </th>

                        </tr>
                    </thead><!-- /thead -->
                </table>
            </div>

        </div><!-- /.table -->
    </div><!-- /.card-body -->
</div>

@endsection

@section('custom-footer')
<script src="/looper/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/looper/assets/vendor/datatables/extensions/responsive/dataTables.responsive.min.js"></script>
<script src="/looper/assets/vendor/datatables/extensions/buttons/dataTables.buttons.min.js"></script>
<script src="/looper/assets/vendor/datatables/extensions/buttons/buttons.html5.min.js"></script>
<script src="/looper/assets/vendor/datatables/extensions/buttons/buttons.print.min.js"></script>

<script src="/looper/assets/javascript/pages/dataTables.bootstrap.js"></script>
<script src="/looper/assets/javascript/pages/dataTables-admin-orderList.js"></script>

@endsection

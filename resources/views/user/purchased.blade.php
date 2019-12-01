@extends('user.layouts.app')
@section('custom-header')
<link rel="stylesheet" href="/looper/assets/vendor/datatables/extensions/buttons/buttons.bootstrap4.min.css">
@endsection
@section('app-main')
<div class="card card-fluid">
    <!-- .card-header -->
    <div class="card-header">Danh sách sản phẩm đã mua</div><!-- /.card-header -->
    <!-- .card-body -->
    <div class="card-body">
        <!-- .table -->
        <div id="myTable2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="table-responsive">
                <table id="listItemPurchased" class="table dataTable no-footer" role="grid" aria-describedby="myTable2_info">
                    <!-- thead -->
                    <thead>
                        <tr role="row">
                            <th style="min-width: 100px;" class="align-middle sorting" tabindex="0"
                                aria-controls="listItemPurchased" rowspan="1" colspan="1"
                                aria-label=" Sản phẩm"> Sản phẩm </th>
                            <th class="align-middle sorting_asc" tabindex="0" aria-controls="listItemPurchased" rowspan="1"
                                colspan="1" aria-label=" Tên sản phẩm"
                                aria-sort="ascending"> Tên sản phẩm </th>
                        </tr>
                    </thead><!-- /thead -->
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div><!-- /.table -->
    </div><!-- /.card-body -->
</div>

@endsection

@section('custom-footer')
<script src="/looper/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/looper/assets/vendor/datatables/extensions/buttons/dataTables.buttons.min.js"></script>
<script src="/looper/assets/vendor/datatables/extensions/buttons/buttons.bootstrap4.min.js"></script>
<script src="/looper/assets/vendor/datatables/extensions/buttons/buttons.html5.min.js"></script>
<script src="/looper/assets/vendor/datatables/extensions/buttons/buttons.print.min.js"></script>
<script src="/looper/assets/javascript/pages/dataTables.bootstrap.js"></script>
<script src="/looper/assets/javascript/pages/datatables-listItemPurchased.js?v=1"></script>
@endsection

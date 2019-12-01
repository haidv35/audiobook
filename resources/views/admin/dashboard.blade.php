@extends('admin.layouts.app')
@section('title-header')

@endsection
@section('app-main')
<div class="page-section">
    <!-- .section-block -->
    <div class="section-block">
        <!-- metric row -->
        <div class="metric-row">
            <div class="col-lg-9">
                <div class="metric-row metric-flush">
                    <!-- metric column -->
                    <div class="col">
                        <!-- .metric -->
                        <a href="javascript:void(0)" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Tổng số sản phẩm </h2>
                            <p class="metric-value h3">
                                <sub><i class="fa fa-shopping-cart"></i></sub> <span class="value">{{ $product_count }}</span>
                            </p>
                        </a> <!-- /.metric -->
                    </div><!-- /metric column -->
                    <!-- metric column -->
                    <div class="col">
                        <!-- .metric -->
                        <a href="javascript:void(0)" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Số lượng đơn hàng </h2>
                            <p class="metric-value h3">
                                <sub><i class="fas fa-clipboard-list"></i></sub> <span class="value">{{ $order_count }}</span>
                            </p>
                        </a> <!-- /.metric -->
                    </div><!-- /metric column -->
                    <!-- metric column -->
                    <div class="col">
                        <!-- .metric -->
                        <a href="javascript:void(0)" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Đơn hàng thành công </h2>
                            <p class="metric-value h3">
                                <sub><i class="far fa-check-square"></i></sub> <span class="value">{{ $order_success_count }}</span>
                            </p>
                        </a> <!-- /.metric -->
                    </div><!-- /metric column -->
                </div>
            </div><!-- metric column -->
            <div class="col-lg-3">
                <!-- .metric -->
                <a href="javascript:void(0)" class="metric metric-bordered">
                    <div class="metric-badge">
                        <span class="badge badge-lg badge-success"><span class="oi oi-media-record pulse mr-1"></span>
                            Tổng lợi nhuận</span>
                    </div>
                    <p class="metric-value h3">
                        <sub><i class="fas fa-dollar-sign"></i></sub> <span class="value price">{{ $total_profit }}</span>
                    </p>
                </a> <!-- /.metric -->
            </div><!-- /metric column -->
        </div><!-- /metric row -->
    </div><!-- /.section-block -->
</div>
@endsection

@extends('user.layouts.app')
@section('app-main')
<div class="page-section">
    <!-- .section-block -->
    <div class="section-block">
        <!-- metric row -->
        <div class="metric-row">
            <div class="col-lg-12">
                <div class="metric-row metric-flush">
                    <!-- metric column -->
                    <div class="col">
                        <!-- .metric -->
                        <a href="javascript:void(0)" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Số đơn hàng </h2>
                            <p class="metric-value h3">
                                <sub><i class="fa fa-shopping-cart"></i></sub> <span class="value">{{ $paid_order_count }}</span>
                            </p>
                        </a> <!-- /.metric -->
                    </div><!-- /metric column -->
                    <!-- metric column -->
                    <div class="col">
                        <!-- .metric -->
                        <a href="javascript:void(0)" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Số sản phẩm đã mua </h2>
                            <p class="metric-value h3">
                                <sub><i class="fas fa-clipboard-list"></i></sub> <span class="value">{{ $paid_product_count }}</span>
                            </p>
                        </a> <!-- /.metric -->
                    </div><!-- /metric column -->
                    <!-- metric column -->
                    <div class="col">
                        <!-- .metric -->
                        <a href="javascript:void(0)" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Số tiền đã chi </h2>
                            <p class="metric-value h3">
                                <sub><i class="fa fa-dollar-sign"></i></sub> <span class="value price">{{ $paid }}</span>
                            </p>
                        </a> <!-- /.metric -->
                    </div><!-- /metric column -->
                    <div class="col">
                        <!-- .metric -->
                        <a href="javascript:void(0)" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Số tiền còn nợ </h2>
                            <p class="metric-value h3">
                                <sub><i class="fa fa-dollar-sign"></i></sub> <span class="value price">{{ $balance }}</span>
                            </p>
                        </a> <!-- /.metric -->
                    </div><!-- /metric column -->
                </div>
            </div><!-- metric column -->
        </div><!-- /metric row -->
    </div><!-- /.section-block -->
</div>
@endsection

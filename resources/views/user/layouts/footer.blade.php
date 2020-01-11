@php
    $timestamp = Carbon\Carbon::now()->timestamp;
@endphp
<script src="/looper/assets/vendor/jquery/jquery.min.js?v={{ $timestamp }}"></script>
<script src="/looper/assets/vendor/bootstrap/js/popper.min.js?v={{ $timestamp }}"></script>
<script src="/looper/assets/vendor/bootstrap/js/bootstrap.min.js?v={{ $timestamp }}"></script> <!-- END BASE JS -->
<!-- BEGIN PLUGINS JS -->
<script src="/looper/assets/vendor/pace/pace.min.js?v={{ $timestamp }}"></script>
{{-- <script src="/looper/assets/vendor/stacked-menu/stacked-menu.min.js"></script> --}}
<script src="/looper/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js?v={{ $timestamp }}"></script>
<script src="/looper/assets/vendor/flatpickr/flatpickr.min.js?v={{ $timestamp }}"></script>
<script src="/looper/assets/vendor/easy-pie-chart/jquery.easypiechart.min.js?v={{ $timestamp }}"></script>
<script src="/looper/assets/vendor/chart.js/Chart.min.js?v={{ $timestamp }}"></script> <!-- END PLUGINS JS -->
<!-- BEGIN THEME JS -->
<script src="/looper/assets/javascript/theme.min.js?v={{ $timestamp }}"></script> <!-- END THEME JS -->
<script src="/js/admin/product/table-dropdown-select.js?v={{ $timestamp }}"></script>
<script type="text/javascript" src="/formatCurrency/jquery.formatCurrency-1.4.0.js"></script>
<script type="text/javascript" src="/formatCurrency/i18n/jquery.formatCurrency.all.js"></script>
<script src="/formatCurrency/custom.js?v={{ $timestamp }}"></script>

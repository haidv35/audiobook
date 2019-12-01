<script src="/looper/assets/vendor/jquery/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="/looper/assets/vendor/bootstrap/js/popper.min.js"></script>
<script src="/looper/assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
<!-- BEGIN PLUGINS JS -->
<script src="/looper/assets/vendor/pace/pace.min.js"></script>
<script src="/looper/assets/vendor/stacked-menu/stacked-menu.min.js"></script>
<script src="/looper/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/looper/assets/vendor/flatpickr/flatpickr.min.js"></script>
<script src="/looper/assets/vendor/easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="/looper/assets/vendor/chart.js/Chart.min.js"></script> <!-- END PLUGINS JS -->

<script type="text/javascript" src="/formatCurrency/jquery.formatCurrency-1.4.0.js"></script>
<script type="text/javascript" src="/formatCurrency/i18n/jquery.formatCurrency.all.js"></script>
<script src="/formatCurrency/custom.js"></script>
<script type="text/javascript" src="/pnotify/dist/iife/PNotify.js"></script>
<script type="text/javascript" src="/pnotify/dist/iife/PNotifyButtons.js"></script>
<script type="text/javascript" src="/pnotify/dist/iife/PNotifyHistory.js"></script>

<!-- BEGIN THEME JS -->
<script src="/looper/assets/javascript/theme.min.js"></script> <!-- END THEME JS -->


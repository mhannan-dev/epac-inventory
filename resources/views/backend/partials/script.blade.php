<!-- jQuery -->
<script src="{{ URL::asset('backend')}}/plugins/jquery/jquery.min.js"></script>
<script src="{{ URL::asset('backend')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ URL::asset('backend')}}/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::asset('backend')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('backend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ URL::asset('backend')}}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ URL::asset('backend')}}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ URL::asset('backend')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ URL::asset('backend')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ URL::asset('backend')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ URL::asset('backend')}}/plugins/moment/moment.min.js"></script>
<script src="{{ URL::asset('backend')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ URL::asset('backend')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ URL::asset('backend')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::asset('backend')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('backend')}}/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ URL::asset('backend')}}/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('backend')}}/dist/js/demo.js"></script>
{{--handlebars--}}
<script src="{{ URL::asset('backend')}}/dist/js/handlebars.min.js"></script>
{{--notify--}}
<script src="{{ URL::asset('backend')}}/dist/js/notify.min.js"></script>
<!-- Select2 -->
<script src="{{ URL::asset('backend')}}/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    })
</script>


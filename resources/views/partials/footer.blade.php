<!-- JS Script -->

<script>
    var base_url = "{{ config('app.url') }}";
</script>
<script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('/') }}assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="{{ asset('/') }}assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="{{ asset('/') }}assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="{{ asset('/') }}assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('/') }}assets/js/bootstrap-toggle.min.js"></script>

<script src="{{ asset('/') }}assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
<script src="{{ asset('/') }}assets/vendor/select2/js/select2.js"></script>
<script src="{{ asset('/') }}assets/vendor/fuelux/js/spinner.js"></script>

<!-- Jquery Datatables JS -->
<script src="{{ asset('/') }}assets/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}assets/vendor/datatables/media/js/dataTables.bootstrap.min.js"></script>
<script src="{{ asset('/') }}assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js">
</script>
<script src="{{ asset('/') }}assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap.min.js">
</script>
<script src="{{ asset('/') }}assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js">
</script>
<script src="{{ asset('/') }}assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js">
</script>
<script src="{{ asset('/') }}assets/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.colVis.min.js">
</script>
<script src="{{ asset('/') }}assets/vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js"></script>
<script src="{{ asset('/') }}assets/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js"></script>
<script src="{{ asset('/') }}assets/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js"></script>
<script
    src="{{ asset('/') }}assets/vendor/datatables/extras/TableTools/RowGroup-1.0.2/js/dataTables.rowGroup.min.js">
</script>
<script src="{{asset('/')}}assets/js/dropify.min.js"></script>
<script src="{{asset('/')}}assets/vendor/jquery-appear/jquery-appear.js"></script>
<script src="{{asset('/')}}assets/vendor/jquery-validation/jquery.validate.js"></script>
<script src="{{asset('/')}}assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="{{asset('/')}}assets/vendor/screenfull/screenfull.min.js"></script>
<script src="{{asset('/')}}assets/vendor/sweetalert/sweetalert.min.js"></script>
<script src="{{asset('/')}}assets/js/custom.js"></script>
<script src="{{asset('/')}}assets/js/plug.init.js"></script>
<script src="{{asset('/')}}assets/js/app.js"></script>
<script src="{{asset('/')}}assets/js/app.fn.js"></script>

<script src="{{asset('/')}}assets/vendor/jquery-appear/jquery-appear.js"></script>
<script src="{{asset('/')}}assets/vendor/jquery-validation/jquery.validate.js"></script>
<script src="{{asset('/')}}assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="{{asset('/')}}assets/vendor/screenfull/screenfull.min.js"></script>
<script src="{{asset('/')}}assets/vendor/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{asset('/')}}assets/js/custom.js"></script>
<script src="{{asset('/')}}assets/js/plug.init.js"></script>
<script src="{{asset('/')}}assets/js/summernote.js"></script>
    <script src="{{ asset('/') }}assets/vendor/datetimepicker/bootstrap-timepicker.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">

    const site_url = "http://localhost/northwest_school/public";


    $('.dropify').dropify({});

    function changeURL(newURL) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "GET",
            url: newURL,
            data: {
                layout: true
            }
        })
            .done(function (response) {
                //alert(response);
                $('#replaceContent').html(response);
                $('.dropify').dropify();
            });

        updateURLWithoutPageLoad(newURL);
    }


    function updateURLWithoutPageLoad(newURL) {
        window.history.pushState({}, "", newURL);
    }

    $(function () {
        // $("#datepicker").datepicker();
    });

    //document ready
    $(document).ready(function () {
        //   $('.summernote').summernote();
    });
</script>

<script !src="">
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @elseif(count($errors) > 0)
    @foreach($errors->all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
    @endif
</script>


@stack('scripts')

<!-- <div class="whatsapp-popup">
    <div class="whatsapp-button">
        <i class="fab fa-whatsapp i-open"></i>
        <i class="far fa-times-circle fa-fw i-close"></i>
    </div>
    <div class="popup-content">
        <div class="popup-content-header">
            <i class="fab fa-whatsapp"></i>
            <h5>Start a Conversation<span>Start a Conversation</span></h5>
        </div>
        <div class="whatsapp-content">
            <ul>
            </ul>
        </div>
        <div class="content-footer">
            <p>Use this feature to chat with our agent.</p>
        </div>
    </div>
</div> -->


</body>

</html>

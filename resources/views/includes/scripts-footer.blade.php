 {{-- <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn">
            <i class="mdi mdi-account-group-outline"></i> &nbsp;Who is Here
        </a>
        <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn1">
            <i class="mdi mdi-account-convert"></i> &nbsp;Quick View
        </a> --}}
        
        <!-- Vendor js -->
        <script src="{{ asset('root/mint/assets/js/vendor.min.js') }}"></script>

        <!-- KNOB JS -->
        <script src="{{ asset('root/mint/assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

        <!-- Apex js -->
        <script src="{{ asset('root/mint/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- Plugins js -->
        <script src="{{ asset('root/mint/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>

        <!-- Datatables scripts -->
        <script src="{{ asset('root/mint/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ asset('root/mint/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>

        <script src="{{ asset('root/mint/assets/libs/select2/js/select2.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('root/mint/assets/js/app.min.js') }}"></script>



        <script>
            $(document).ready(function() {

                //INITIALIZING THE SELECT STYLE
                $('.select2').each(function() { 
                    $(this).select2({ 
                        dropdownParent: $(this).parent(),
                        width: '100%'
                    });
                    // $(this).val($(this).find('option:first').val()).trigger('change');
                });
            });
        </script>

    </body>
</html>

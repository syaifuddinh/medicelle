
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('') }}vendors/jquery/dist/jquery.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('button').on('focus', function(){
                var button_title = $(this).text().toLowerCase();
                if( $(this).attr('type') == 'submit' || button_title == 'tambah') {

                    $(this).on('keypress', function(e){
                        if (e.which == 13) {
                           $(this).trigger('click')
                        }

                    });
                }
            })
            inputs = $(':input,select').on('keypress', function(e){ 
                if (e.which == 13) {
                   e.preventDefault();
                   var nextInput = inputs.get(inputs.index(this) + 1);
                   if (nextInput) {
                      nextInput.focus();
                   }
                }
            });
    </script>
    <!-- Bootstrap -->
    <script src="{{ asset('') }}vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{ asset('') }}vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ asset('') }}vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="{{ asset('') }}vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="{{ asset('') }}vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('') }}vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="{{ asset('') }}vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="{{ asset('') }}vendors/skycons/skycons.js"></script>
    <!-- PickADate -->
    <script src="{{ asset('') }}js/picker.js"></script>
    <script src="{{ asset('') }}js/picker.date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('') }}vendors/moment/min/moment.min.js"></script>

    <script src="{{ asset('') }}vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('') }}vendors/parsleyjs/dist/parsley.min.js"></script>
    <script src="{{ asset('') }}vendors/select2/dist/js/select2.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('') }}build/js/custom.min.js"></script>

    <script src="{{ asset('') }}js/toastr.min.js"></script>
    <script src="{{ asset('') }}js/chosen.jquery.js"></script>

    <!-- Angular -->
    <script src="{{ asset('') }}bower_components/angular/angular.min.js"></script>
    <script src="{{ asset('') }}bower_components/angular-chosen/dist/angular-chosen.min.js"></script>
    <script src="{{ asset('') }}js/angular-init.js"></script>
    <script src="{{ asset('') }}js/custom_directive.js"></script>
    <script src="{{ asset('') }}js/rzslider.min.js"></script>
    <script>
        datatableError = 200
        $.extend( $.fn.dataTable.defaults, {
            ajax : {
                'statusCode' : {
                      500 : function(s, r, t, u) {
                          $.ajax(this)
                      }
                  }
            },
        } );
        $(document).ready(function(){
            $(window).bind('keydown', function(e){
                if(e.ctrlKey && e.which == 32) {
                    createButton = $('[href*="create"]')
                    if(createButton.length > 0) 
                        window.location = createButton.attr('href')
                } else if(e.ctrlKey && e.which == 191) {
                    filterButton = $('[ng-click="isFilter = !isFilter"]')
                    if(filterButton.length > 0) 
                        filterButton.trigger('click')
                } else if(e.ctrlKey && e.which == 69) {
                    exportExcelButton = $('.buttons-excel')
                    if(exportExcelButton.length > 0) 
                        exportExcelButton.trigger('click')
                } else if(e.ctrlKey && e.shiftKey) {
                    var key = parseInt( String.fromCharCode(e.which) )
                    var dt = window['oTable']
                    if(dt && (key > -1 && key < 10)) {
                        key -= 1;
                        key = key == -1 ? 9 : key
                        dt = $(dt.table().node()).find('tbody')
                        var dt_row = dt.find('tr:eq(' + key + ')')
                        var i = dt_row.find('.fa-file-text-o')
                        var a = i.parents('a')
                        window.location = a.attr('href')
                    }
                }
            })
        });
    </script>
  </body>
</html>

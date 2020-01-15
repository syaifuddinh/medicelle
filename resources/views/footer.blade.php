
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
    <script src="{{asset('js/jSignature.js')}}"></script>
    <script src="{{asset('js/jSignature.CompressorBase30.js')}}"></script>
    <script src="{{asset('js/jSignature.CompressorSVG.js')}}"></script>
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
            inputs = $(':input').on('keypress', function(e){ 
                if (e.which == 13) {
                   e.preventDefault();
                   var nextInput = inputs.get(inputs.index(this) + 1);
                   console.log(nextInput);
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
    <script src="{{ asset('') }}js/picker.time.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('') }}vendors/moment/min/moment.min.js"></script>

    <script src="{{ asset('') }}vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('') }}vendors/parsleyjs/dist/parsley.min.js"></script>
    <script src="{{ asset('') }}vendors/select2/dist/js/select2.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('') }}build/js/custom.min.js"></script>

    <script src="{{ asset('') }}js/toastr.min.js"></script>
    <script src="{{ asset('') }}js/jquery.easy-autocomplete.min.js"></script>
    <script src="{{ asset('') }}js/chosen.jquery.js"></script>
    <script src="{{ asset('') }}js/jquery.anchor-scroll.min.js"></script>
    

    
    <!-- Angular -->
    <script src="{{ asset('') }}bower_components/angular/angular.min.js"></script>
    <script src="{{ asset('') }}bower_components/angular-chosen/dist/angular-chosen.min.js"></script>
    <script src="{{ asset('') }}js/angular-init.js"></script>
    <script src="{{ asset('') }}js/custom_directive.js"></script>
    <script src="{{ asset('') }}js/rzslider.min.js"></script>
    <script>
        datatableError = 200
        // $.extend( $.fn.dataTable.defaults, {
        //     ajax : {
        //         'statusCode' : {
        //               500 : function(s, r, t, u) {
        //                   $.ajax(this)
        //               }
        //           }
        //     }
        // } );
        $(document).ready(function(){
            setTimeout(function(){
                $('#listview').css('width', '100%')
                $('[id*="_datatable"]').css('width', '100%')
            }, 500);

            $('.anchor-scroll').anchorScroll({
                scrollSpeed: 800, // scroll speed
                offsetTop: 0, // offset for fixed top bars (defaults to 0)
                onScroll: function () { 
                  // callback on scroll start
                },
                scrollEnd: function () { 
                  // callback on scroll end
                }
             });
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
    <script>
        $(document).ready(function(){
            roles = {
                'allow_update_assesment' : {!! Auth::user()->allow_update_assesment() !!},
                'allow_update_medical_record' : {!! Auth::user()->allow_update_medical_record() !!},

                'allow_edit_price' : {!! Auth::user()->allow_access('setting.price.edit') !!},
                'allow_show_price' : {!! Auth::user()->allow_access('setting.price.show') !!},
                'allow_activate_price' : {!! Auth::user()->allow_access('setting.price.activate') !!},
                'allow_destroy_price' : {!! Auth::user()->allow_access('setting.price.destroy') !!},

                'allow_edit_discount' : {!! Auth::user()->allow_access('setting.discount.edit') !!},
                'allow_show_discount' : {!! Auth::user()->allow_access('setting.discount.show') !!},
                'allow_activate_discount' : {!! Auth::user()->allow_access('setting.discount.activate') !!},
                'allow_destroy_discount' : {!! Auth::user()->allow_access('setting.discount.destroy') !!},

                'allow_edit_patient' : {!! Auth::user()->allow_access('master.patient.edit') !!},
                'allow_show_patient' : {!! Auth::user()->allow_access('master.patient.show') !!},
                'allow_activate_patient' : {!! Auth::user()->allow_access('master.patient.activate') !!},
                'allow_destroy_patient' : {!! Auth::user()->allow_access('master.patient.destroy') !!},

                'allow_edit_employee' : {!! Auth::user()->allow_access('master.employee.edit') !!},
                'allow_show_employee' : {!! Auth::user()->allow_access('master.employee.show') !!},
                'allow_activate_employee' : {!! Auth::user()->allow_access('master.employee.activate') !!},
                'allow_destroy_employee' : {!! Auth::user()->allow_access('master.employee.destroy') !!},

                'allow_edit_registration' : {!! Auth::user()->allow_access('registration.edit') !!},
                'allow_show_registration' : {!! Auth::user()->allow_access('registration.show') !!},
                'allow_attend_registration' : {!! Auth::user()->allow_access('registration.attend') !!},
                'allow_destroy_registration' : {!! Auth::user()->allow_access('registration.destroy') !!},

                'allow_edit_cashier' : {!! Auth::user()->allow_access('cashier.edit') !!},
                'allow_show_cashier' : {!! Auth::user()->allow_access('cashier.show') !!},

                'allow_edit_cuti_hamil' : {!! Auth::user()->allow_access('surat.cuti_hamil.edit') !!},
                'allow_show_cuti_hamil' : {!! Auth::user()->allow_access('surat.cuti_hamil.show') !!},
                'allow_destroy_cuti_hamil' : {!! Auth::user()->allow_access('surat.cuti_hamil.destroy') !!},

                'allow_edit_keterangan_dokter' : {!! Auth::user()->allow_access('surat.keterangan_dokter.edit') !!},
                'allow_show_keterangan_dokter' : {!! Auth::user()->allow_access('surat.keterangan_dokter.show') !!},
                'allow_destroy_keterangan_dokter' : {!! Auth::user()->allow_access('surat.keterangan_dokter.destroy') !!},

                'allow_edit_keterangan_sehat' : {!! Auth::user()->allow_access('surat.keterangan_sehat.edit') !!},
                'allow_show_keterangan_sehat' : {!! Auth::user()->allow_access('surat.keterangan_sehat.show') !!},
                'allow_destroy_keterangan_sehat' : {!! Auth::user()->allow_access('surat.keterangan_sehat.destroy') !!},

                'allow_edit_pengantar_mrs' : {!! Auth::user()->allow_access('surat.pengantar_mrs.edit') !!},
                'allow_show_pengantar_mrs' : {!! Auth::user()->allow_access('surat.pengantar_mrs.show') !!},
                'allow_destroy_pengantar_mrs' : {!! Auth::user()->allow_access('surat.pengantar_mrs.destroy') !!},

                'allow_edit_layak_terbang' : {!! Auth::user()->allow_access('surat.layak_terbang.edit') !!},
                'allow_show_layak_terbang' : {!! Auth::user()->allow_access('surat.layak_terbang.show') !!},
                'allow_destroy_layak_terbang' : {!! Auth::user()->allow_access('surat.layak_terbang.destroy') !!},

                'allow_edit_rujukan_pasien' : {!! Auth::user()->allow_access('surat.rujukan_pasien.edit') !!},
                'allow_show_rujukan_pasien' : {!! Auth::user()->allow_access('surat.rujukan_pasien.show') !!},
                'allow_destroy_rujukan_pasien' : {!! Auth::user()->allow_access('surat.rujukan_pasien.destroy') !!},
            }

            setInterval(function(){
                for(key in roles) {
                    value = roles[key]
                    var el = $('[' + key + ']')
                    if(el.length > 0) {
                        el.each(function(){
                            if(value == 0) {
                                $(el).remove()
                            }
                        })
                    }
                }
            }, 1000)
        })
    </script>
    <link rel='stylesheet' id='norebro-global-fonts-css'  href='//fonts.googleapis.com/css?family=Rubik%3A900i%2C900%2C700i%2C700%2C500i%2C500%2C400i%2C400%2C300i%2C300%7CPoppins%3A700%2C600%2C500%2C400%2C300%26subset%3Dcyrillic%2Clatin-ext%2Chebrew%2Ccyrillic%2Clatin-ext%2Chebrew%2Clatin-ext%2Cdevanagari%2Clatin-ext%2Cdevanagari%2Clatin-ext%2Cdevanagari%2Clatin-ext%2Cdevanagari%2Clatin-ext%2Cdevanagari%2Clatin-ext%2Cdevanagari%2Ccyrillic%2Clatin-ext%2Chebrew%2Ccyrillic%2Clatin-ext%2Chebrew%2Ccyrillic%2Clatin-ext%2Chebrew%2Ccyrillic%2Clatin-ext%2Chebrew%2Ccyrillic%2Clatin-ext%2Chebrew%2Ccyrillic%2Clatin-ext%2Chebrew&#038;ver=1.0.0' type='text/css' media='all' />
    
  </body>
</html>

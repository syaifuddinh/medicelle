@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="lokasi">
          <!-- top tiles -->
          

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Lokasi</h3>
                  </div>
                  <div class="col-md-6">
                      <div class="btn-group pull-right export_button">
                          <a href="{{ route('lokasi.create') }}" class='btn btn-success btn-sm'>Tambah</a>
                      </div>                    
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered" id='listview'>
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Keterangan</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>

        </div>
        <!-- /page content -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    @include('footer')
    <script src="{{ asset('') }}js/master/lokasi/lokasiCtrl.js"></script>

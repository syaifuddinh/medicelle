@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="userShow">
          <!-- top tiles -->
          

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>User </h3>
                  </div>
                  <div class="col-md-6">
                      <div class="btn-group pull-right">
                          <a href="{{ route('user.create') }}" class='btn btn-success btn-sm'>Tambah</a>
                      </div>                    
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>NIK</th>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Departemen</th>
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
    <script src="{{ asset('') }}js/user/userCtrl.js"></script>


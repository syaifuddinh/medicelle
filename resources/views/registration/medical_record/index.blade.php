@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="medicalRecord">
          <!-- top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title" ng-show='isFilter'>
                    <form action="" class='form-horizontal form-label-left'>
                        
                    </form>
                </div>
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Pasien</h3>
                  </div>
                  <div class="col-md-6">
                      <div class="btn-group pull-right export_button">
                          <button type='button' ng-click='isFilter = !isFilter' class='btn btn-primary btn-sm'>Filter</button>
                          
                      </div>                    
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered" id='listview'>
                      <thead>
                        <tr>
                          <th>No. Rekam Medis</th>
                          <th>Pasien</th>
                          <th>Tanggal</th>
                          <th>Keluhan utama</th>
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
    <script src="{{ asset('') }}js/registration/medical_record/medicalRecordCtrl.js"></script>


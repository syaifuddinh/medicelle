@include('header')
<style type="text/css">
    div table tr td.regular {
        padding:0;
    }
    div table tr td.regular table {
        margin:0;
    }
</style> 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" id='scopeContainer' ng-controller="polyclinic">
          <!-- top tiles -->
          @include('polyclinic/polyclinic/index-navigation')

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title" ng-show='!isFilter'>
                    <form action="" class='form-horizontal form-label-left'>
                        
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Periode
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="input-daterange input-group" style="width:100%;">
                                <input type="text" class="input-sm form-control" ng-model="formData.date_start" ng-change='filter()' datepick/>
                                <span class="input-group-addon">s/d</span>
                                <input type="text" class="input-sm form-control" ng-model="formData.date_end" ng-change='filter()' datepick />
                              </div>
                              <div class="form-group">
                                  <button type='button' class='btn btn-warning btn-sm' ng-click='formData={};filter()'>Reset</button>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Daftar Pasien</h3>
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
                          <th  style='width:14%'>No. Registrasi</th>
                          <th style='width:16%'>No. Rekam Medis</th>
                          <th style='width:16%'>Tanggal</th>
                          <th>Pasien</th>
                          <th>No. Telepon</th>
                          <th>Jenis kelamin</th>
                          <th>Poliklinik</th>
                          <th>Dokter</th>
                          <th>Jenis</th>
                          <th ng-show="$scope.flag != 'polyclinic'">Pemeriksaan</th>
                          <th ng-show="$scope.flag == 'laboratory' && $scope.flag == 'radiology'">Status Pemeriksaan</th>
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
    <script src="{{ asset('') }}js/polyclinic/polyclinic/polyclinicCtrl.js"></script>


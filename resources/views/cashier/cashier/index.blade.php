@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="cashier">
          <!-- top tiles -->
          

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title" ng-show='!isFilter'>
                    <form action="" class='form-horizontal form-label-left'>
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Status
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <label class="radio-inline">
                              <input type="radio" ng-model="formData.status" ng-value='null' ng-change="filter()">
                              <h5>Semua</h5>
                            </label>
                            <label class="radio-inline">
                              <input type="radio" ng-model="formData.status" ng-value='"2"' ng-change="filter()">
                              <h5>
                              Belum lunas  
                              </h5>
                            </label>
                            <label class="radio-inline">
                              <input type="radio" ng-model="formData.status" ng-value='"3"' ng-change="filter()">
                              <h5>
                              Lunas  
                              </h5>
                            </label>
                            
                            <label class="radio-inline">
                              <input type="radio" ng-model="formData.status" ng-value='"4"' ng-change="filter()">
                              <h5>
                              Lebih bayar  
                              </h5>
                            </label>
                            
                            </div>
                        </div>
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
                    <h3>Kasir</h3>
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
                          <th>No. Pembayaran</th>
                          <th>No. Registrasi</th>
                          <th>No. Rekam Medis</th>
                          <th>Tanggal bayar</th>
                          <th>Pasien</th>
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
    <script src="{{ asset('') }}js/cashier/cashier/cashierCtrl.js"></script>


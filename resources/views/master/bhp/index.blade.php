@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="bhp">
          <!-- top tiles -->
          @include('master/cure/index-navigation')
          
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
                              <input type="radio" ng-model="formData.is_active" name='is_active' ng-value='null' ng-change="filter()">
                              <h5>Semua</h5>
                            </label>
<label class="radio-inline">
                              <input type="radio" ng-model="formData.is_active" name='is_active' ng-value='"1"' ng-change="filter()">
                              <h5>Aktif</h5>
                            </label>
                            <label class="radio-inline">
                              <input type="radio" ng-model="formData.is_active" name='is_active' ng-value='"0"' ng-change="filter()">
                              <h5>
                              Tidak aktif  
                              </h5>
                            </label>

                            <div class="form-group">
                                  <button type='button' class='btn btn-warning btn-sm' ng-click='formData={};filter()'>Reset</button>
                              </div>
                            </div>
                          </div>
                        
                    </form>
                </div>
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>BHP</h3>
                  </div>
                  <div class="col-md-6">
                      <div class="btn-group pull-right export_button">
                          <button type='button' ng-click='isFilter = !isFilter' class='btn btn-primary btn-sm'>Filter</button>
                          <a href="{{ route('bhp.create') }}" class='btn btn-success btn-sm'>Tambah</a>
                      </div>                    
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered" id='listview'>
                      <thead>
                        <tr>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Kategori</th>
                          <th>Grup nota</th>
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
    <script src="{{ asset('') }}js/master/bhp/bhpCtrl.js"></script>


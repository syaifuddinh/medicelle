@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="notification">
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
                                    <input type="radio" ng-model="formData.is_read" name='is_read' ng-value='null' ng-change="filter()">
                                    <h5>Semua</h5>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" ng-model="formData.is_read" name='is_read' ng-value='0' ng-change="filter()">
                                    <h5>Belum Dibaca</h5>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" ng-model="formData.is_read" name='is_read' ng-value='1' ng-change="filter()">
                                    <h5>
                                        Sudah Dibaca 
                                    </h5>
                                </label>
                            </div>
                          </div>
                        
                    </form>
                </div>
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Pemberitahuan</h3>
                  </div>
                  <div class="col-md-6">
                      <div class="btn-group pull-right export_button">
                          <button type='button' ng-click='isFilter = !isFilter' class='btn btn-primary btn-sm'>Filter</button>
                      </div>                    
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <table class="table" id='listview'>
                      <thead>
                        <tr>
                          <th>Judul</th>
                          <th>Keterangan</th>
                          <th>Status</th>
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
    <script src="{{ asset('') }}js/user/notification/notificationCtrl.js"></script>


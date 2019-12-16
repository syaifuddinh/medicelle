@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="assesment">
          <!-- top tiles -->

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
                    <a href="#" class='btn btn-outline-dark' style='display:inline-block'>
                        </i> <b>Riwayat assesment</b>
                    </a>
                    <a href="#" class='btn btn-sm btn-outline-primary'>
                        <i class="fa fa-users"></i> <% patient.name %>
                    </a>
                    <a href="#" class='btn btn-sm btn-outline-success capitalize'>
                        <i class="fa fa-male" ng-show='patient.gender == "PRIA"'></i><i class="fa fa-female" ng-show='patient.gender == "WANITA"'></i> <% patient.gender.toLowerCase() %>
                    </a>
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
                          <th>Tanggal</th>
                          <th>Keluhan utama</th>
                          <th>Perawat</th>
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
    <script src="{{ asset('') }}js/registration/assesment/assesmentCtrl.js"></script>


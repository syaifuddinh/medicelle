@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="financeSetting">
          <!-- top tiles -->
          

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3><% title %></h3>
                  </div>
                  <div class="col-md-6">
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                      {{ csrf_field() }}
                      
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-2 col-xs-12">Kenaikan tarif asuransi(%)
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type='text' ng-model='formData.finance.asuransi_rate_percentage' class="form-control col-md-7 col-xs-12" ng-change='submitForm()' only-num>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                          <div class="btn-group compile">
                            
                            <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                          </div>
                        </div>
                      </div>

                    </form>
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
    <script src="{{ asset('') }}js/user/setting/financeSettingCtrl.js"></script>


@include('header')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="specializationCreate">
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

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="code" ng-model='formData.code' class="form-control col-md-7 col-xs-12" autofocus>
                          <br>
                          <p class="text-primary">* Jika kode dikosongi, maka kode akan dibuat secara otomatis</p>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" ng-model='formData.name' required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      @include('master/specialization/medical_record_roles')
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <div class="btn-group">
                            
                            <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                            <button class="btn btn-warning btn-sm" type="button" ng-click='formData = {}'>Reset</button>
                            <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm">Simpan</button>
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
    <script src="{{ asset('') }}js/master/specialization/specializationCreateCtrl.js"></script>


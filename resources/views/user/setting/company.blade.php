@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="companySetting">
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
                      <div class="form-group avatar-container">
                        <img class="img-responsive" id='img-preview' style='height:50mm;margin:auto' src='<% formData.company.logo %>'>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Logo 1
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id='logo' name='logo' class="form-control col-md-7 col-xs-12">
                          
                        </div>
                      </div>

                      <div class="form-group avatar-container">
                        <img class="img-responsive" id='img-preview-2' style='height:50mm;margin:auto' src='<% formData.company.logo2 %>'>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Logo 2
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id='logo2' name='logo2' class="form-control col-md-7 col-xs-12">
                          
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nama<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" ng-model='formData.company.name' required="required" class="form-control col-md-7 col-xs-12" autofocus>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Alamat
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="last-name" ng-model='formData.company.address' name="last-name"  class="form-control col-md-7 col-xs-12">
                          </textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Kota
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type='text' ng-model='formData.company.city' class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Email
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type='text' ng-model='formData.company.email' class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Website
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type='text' ng-model='formData.company.website' class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">No Telepon
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type='text' ng-model='formData.company.phone_number' class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">No Whatsapp
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type='text' ng-model='formData.company.whatsapp_number' class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Fax
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type='text' ng-model='formData.company.fax' class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                          <div class="btn-group compile">
                            
                            <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
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
    <script src="{{ asset('') }}js/user/setting/companySettingCtrl.js"></script>


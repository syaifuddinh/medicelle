@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="priceCreate">
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
                      <div class="row">
                        
                          <div class="col-md-6 col-sm-12">
                            
                              <div class="form-group">
                                  <label class="control-label col-md-5 col-sm-3 col-xs-12" for="first-name">Grup nota<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" data-placeholder-text-single="'Pilih Grup Nota'" required='required' chosen allow-single-deselect="false" ng-model="formData.grup_nota_id" ng-options="c.id as c.slug + ' - ' + c.name for c in data.grup_nota">
                                      <option value=""></option>
                                    </select>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-5 col-sm-3 col-xs-12" for="first-name">Nama tarif<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" ng-model='formData.name' required="required" class="form-control col-md-7 col-xs-12" autofocus>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-5 col-sm-3 col-xs-12" for="last-name">Apakah tarif registrasi
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label class="radio-inline">
                                        <input type="radio" ng-model='formData.is_registration' ng-value='"1"'> Ya
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" ng-model='formData.is_registration' ng-value='"0"'> Tidak
                                    </label>
                                  </div>
                              </div>
                          </div>
                                              

                          <div class="col-md-6 col-sm-6">
                              <div class="form-group" ng-hide='!formData.is_registration || formData.is_registration == "1"'>
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tujuan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" data-placeholder-text-single="'Pilih Tujuan'"  chosen allow-single-deselect="false" ng-model="formData.destination">
                                        <option value=""></option>
                                        <option value="POLIKLINIK">Poliklinik</option>
                                        <option value="MEDICAL CHECK-UP">Medical Check-up</option>
                                        <option value="LABORATORIUM">Laboratorium Check-up</option>
                                        <option value="RADIOLOGI">Radiologi</option>
                                        <option value="KEMOTERAPI">Kemoterapi</option>
                                        <option value="RUANG TINDAKAN">Ruang tindakan</option>
                                    </select>
                                  </div>
                              </div>
                            
                              <div class="form-group" ng-show='formData.destination == "POLIKLINIK" && (formData.is_registration && formData.is_registration == "0")'>
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Poliklinik
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" data-placeholder-text-single="'Pilih Poliklinik'"  chosen allow-single-deselect="false" ng-model="formData.polyclinic_id" ng-options="c.id as c.name for c in data.polyclinic" ng-change="changeDoctor()">
                                        <option value=""></option>
                                    </select>
                                  </div>
                              </div>
                            
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Harga
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" ng-model='formData.price' class="form-control" jnumber2 only-num>
                                  </div>
                              </div>
                            
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Qty default
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" ng-model='formData.qty' class="form-control" ng-value='1' jnumber2 only-num>
                                  </div>
                              </div>
                            
                          </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
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
    <script src="{{ asset('') }}js/user/price/priceCreateCtrl.js"></script>

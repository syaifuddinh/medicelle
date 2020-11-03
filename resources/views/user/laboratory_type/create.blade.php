@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" id='scopeContainer' ng-controller="laboratoryTypeCreate">
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
                          <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Grup Nota<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select class="form-control" data-placeholder-text-single="'Pilih Grup Nota'" required='required' chosen allow-single-deselect="false" ng-model="formData.price.grup_nota_id" ng-options="c.id as c.slug + ' - ' + c.name for c in data.grup_nota">
                                      <option value=""></option>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nama<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="first-name" ng-model='formData.name' class="form-control col-md-7 col-xs-12" autofocus>
                                </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Satuan<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select class="form-control" data-placeholder-text-single="'Pilih Satuan'"  chosen allow-single-deselect="false" ng-model="formData.price.piece_id" ng-options="c.id as c.name for c in data.piece">
                                  </select>
                                </div>
                              </div>
                          </div>
                      </div>

                      <div class="ln_solid"></div>

                      <div class="row">
                         <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary pull-right" ng-click='addDetail()'>Tambah</button>
                         </div>
                         <div class="col-md-12">
                              <table class="table" id='detail_datatable'>
                                  <thead>
                                      <th>Nama</th>
                                      <th>Harga</th>
                                      <th>Service Dokter</th>
                                      <th>Persentase Dokter (%)</th>
                                      <th></th>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                              </table>
                         </div>
                       </div> 

                      <div class="ln_solid"></div>
                      <div class="row">
                        <div class="col-md-12">
                          
                              <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="btn-group">
                                    
                                    <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm">Simpan</button>
                                  </div>
                                </div>
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
    <script src="{{ asset('') }}js/user/laboratory_type/laboratoryTypeCreateCtrl.js"></script>


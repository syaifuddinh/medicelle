@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="treatmentGroupCreate">
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
                                  <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Grup nota<span class="required">*</span>
                                  </label>
                                  <div class="col-md-7 col-sm-6 col-xs-12">
                                    <select class="form-control" data-placeholder-text-single="'Pilih Grup Nota'" required='required' chosen allow-single-deselect="false" ng-model="formData.grup_nota_id" ng-options="c.id as c.slug + ' - ' + c.name for c in data.grup_nota">
                                      <option value=""></option>
                                    </select>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Nama tarif<span class="required">*</span>
                                  </label>
                                  <div class="col-md-7 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" ng-model='formData.name' required="required" class="form-control col-md-7 col-xs-12" autofocus>
                                  </div>
                              </div>
                              
                          </div>
                                              
                            <div class="col-md-6 col-sm-12">
                            
                              <div class="form-group">
                                  <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Harga
                                  </label>
                                  <div class="col-md-7 col-sm-6 col-xs-12">
                                      <input type="text" ng-model='formData.price' class="form-control" jnumber2 only-num>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Persentase dokter(%)
                                  </label>
                                  <div class="col-md-7 col-sm-6 col-xs-12">
                                      <input type="text" ng-model='formData.percentage' class="form-control" maxlength='3' ng-value='0' jnumber2 only-num>
                                  </div>
                              </div>
                            
                          </div>
                      </div>

                      <span>
                          
                            <div class="ln_solid"></div>
                            <h2>Detail Tindakan</h2>

                            <div class="row">
                              <div class="col-md-12">
                                  <button type="button" class="btn btn-sm btn-primary" ng-click='insertItem({qty:1})'>
                                      <i class="fa fa-plus"></i>
                                  </button>
                                  <table class="table" id='treatment_group_detail_datatable'>
                                      <thead>
                                          <tr>
                                              <th>Item</th>
                                              <th>Qty</th>
                                              <th></th>
                                          </tr>
                                      </thead>
                                      <tbody></tbody>
                                  </table>
                              </div>
                            </div>
                      </span>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="btn-group">
                            
                            <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                            <button class="btn btn-warning btn-sm" type="button" ng-click='formData = {}'>Reset</button>
                            <button type="button" ng-disabled='disBtn' class="btn btn-success btn-sm" ng-click='submitForm()'>Simpan</button>
                          </div>
                        </div>
                      </div>

                    </form>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>

          <!-- Modal Item -->
          
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:80%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Daftar Tindakan / BHP</h4>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#bhp">BHP</a></li>
                  <li><a data-toggle="tab" href="#price">Tindakan</a></li>
                </ul>

                <div class="tab-content">
                  <div id="bhp" class="tab-pane fade in active" style='padding-top:6mm'>
                    
                    <table class="table table-bordered" id='item_datatable' style='width:100%'>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Kode</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                  </div>
                  <div id="price" class="tab-pane fade" style='padding-top:6mm'>
                    <table class="table table-bordered" id='price_datatable' style='width:100%'>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Grup Nota</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>
          <!-- ---------- -->

        </div>
        <!-- /page content -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    @include('footer')
    <script src="{{ asset('') }}js/user/treatment_group/treatmentGroupCreateCtrl.js"></script>


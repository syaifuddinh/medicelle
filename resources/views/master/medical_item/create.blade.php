@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" id='scopeContainer' ng-controller="cureCreate" ng-cloak>
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
            <div class="col-md-6">
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kelompok<span class="required">*</span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <div class="input-group">
                    <select class="form-control" data-placeholder-text-single="'Pilih Kelompok'"  chosen allow-single-deselect="false" ng-model="formData.category_id" ng-options="c.id as c.code + ' - ' + c.name for c in data.category" ng-change='changeSampleCode();changeClassification()'>
                      <option value=""></option>
                    </select>
                    <div class="input-group-addon" ng-click='insert("category")'>
                        <i class='fa fa-pencil'></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis<span class="required">*</span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="input-group">
                    <select class="form-control" data-placeholder-text-single="'Pilih Jenis'" chosen allow-single-deselect="false" ng-model="formData.classification_id" ng-options="c.id as c.code + ' - ' + c.name for c in classification" ng-change='changeSampleCode()'>
                      <option value=""></option>
                    </select>
                    <div class="input-group-addon" ng-click='insert("classification")'>
                        <i class='fa fa-pencil'></i>
                    </div>
                </div>
                </div>
              </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode<span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="input-group">
                    <input type="text"  ng-model='formData.code' required="required" class="form-control col-md-7 col-xs-12" only-num maxlength="3" ng-change='changeSampleCode()'>
                    <div class="input-group-addon">
                        <% sample_code %>
                    </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama<span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" id="first-name" ng-model='formData.name' required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group"> 
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Satuan jual<span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select class="form-control" data-placeholder-text-single="'Pilih Satuan'"  chosen allow-single-deselect="false" ng-model="formData.piece_id" ng-options="c.id as c.name for c in data.piece">
                  <option value=""></option>
                </select>
              </div>
            </div>

            <div class="form-group"> 
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Satuan beli<span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select class="form-control" data-placeholder-text-single="'Pilih Satuan'"  chosen allow-single-deselect="false" ng-model="formData.purchase_piece_id" ng-options="c.id as c.name for c in data.piece">
                  <option value=""></option>
                </select>
              </div>
            </div>

            <div class="form-group" >
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Grup nota<span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select   class="form-control" data-placeholder-text-single="'Pilih Grup Nota'" required='required' chosen allow-single-deselect="false" ng-model="formData.grup_nota_id" ng-options="c.id as c.name for c in data.grup_nota">
                  <option value=""></option>
                </select>
              </div>
            </div>



            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keterangan
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <textarea ng-model='formData.description' class="form-control col-md-7 col-xs-12"></textarea>
                </div>
            </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga beli
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" class="form-control"   ng-model="formData.purchase_price"  ng-change='countPrice()' jnumber2 only-num>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Margin(%)
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" class="form-control"   ng-model="formData.additional.margin" ng-change='countPrice()' maxlength='3' only-num>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga Jual
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                      <input type="text" class="form-control"   ng-model="formData.price" ng-change='countMargin()' jnumber2 only-num>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga Eceran Tertinggi
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" ng-model='formData.additional.harga_eceran_tertinggi' jnumber2 only-num class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Principal
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="input-group">
                        <select class="form-control" data-placeholder-text-single="'Pilih Principal'" chosen allow-single-deselect="true" ng-model="formData.additional.principal" ng-options="c.id as c.name for c in data.supplier">
                          <option value=""></option>
                        </select>
                        @if(Auth::user()->allow_access('master.supplier.create'))
                            <div class="input-group-btn">
                                <button type='button' class="btn btn-primary btn-sm" ng-click='insertSupplier()' ng-disabled='disBtn'>
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                  </div>
              </div>

            </div>
            

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

    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:50%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">
                  <% insert_title %>
                </h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group" style='padding-bottom:8mm'>
                        <label class='col-md-4'>Kode</label>
                        <div class="col-md-8">
                            <input type="text" ng-model='insertData.code' class="form-control">
                        </div>
                    </div>
                    <div class="form-group"  style='padding-bottom:8mm'>
                        <label class='col-md-4'>Nama</label>
                        <div class="col-md-8">
                            <input type="text" ng-model='insertData.name' class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button class='btn btn-sm btn-success pull-right' ng-disabled='disBtn' ng-click="submitComponent()">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
  </div>
  <!-- /page content -->

  <!-- ============================================================== -->
  <!-- All Jquery -->
  <!-- ============================================================== -->

  @include('footer')
  <script src="{{ asset('') }}js/master/cure/cureCreateCtrl.js"></script>


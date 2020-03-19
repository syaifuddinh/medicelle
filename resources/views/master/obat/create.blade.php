@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="obatCreate" ng-cloak>
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis administrasi<span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="input-group">
                    <select class="form-control" data-placeholder-text-single="'Pilih Jenis Administrasi'" ng-required='formData.is_category != 1' chosen allow-single-deselect="false" ng-model="formData.category_id" ng-options="c.id as c.code + ' - ' + c.name for c in data.category" ng-change='changeSampleCode();changeClassification()'>
                      <option value=""></option>
                    </select>
                    <div class="input-group-addon" ng-click='insert("category")'>
                        <i class='fa fa-pencil'></i>
                    </div>
                </div>
              </div>
            </div>

            <div class="form-group" ng-show='is_allow_classification == 1'>
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelas<span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="input-group">
                    <select class="form-control" data-placeholder-text-single="'Pilih Kelas'" chosen allow-single-deselect="false" ng-model="formData.classification_id" ng-options="c.id as c.code + ' - ' + c.name for c in classification" ng-change='changeSampleCode();changeSubclassification()'>
                      <option value=""></option>
                    </select>
                    <div class="input-group-addon" ng-click='insert("classification")'>
                        <i class='fa fa-pencil'></i>
                    </div>
                </div>
              </div>
            </div>

            <div class="form-group" ng-show='is_allow_subclassification == 1'>
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub-Kelas<span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="input-group">
                    <select class="form-control" data-placeholder-text-single="'Pilih Sub-Kelas'" chosen allow-single-deselect="false" ng-model="formData.subclassification_id" ng-options="c.id as c.code + ' - ' + c.name for c in subclassification" ng-change='changeSampleCode();changeGeneric()'>
                      <option value=""></option>
                    </select>
                    <div class="input-group-addon" ng-click='insert("subclassification")'>
                        <i class='fa fa-pencil'></i>
                    </div>
                </div>
              </div>
            </div>

            <div class="form-group" ng-show='is_allow_generic == 1'>
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Generik<span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="input-group">
                    <select class="form-control" data-placeholder-text-single="'Pilih Generik'" chosen allow-single-deselect="false" ng-model="formData.generic_id" ng-options="c.id as c.code + ' - ' + c.name for c in generic" ng-change='changeSampleCode()'>
                      <option value=""></option>
                    </select>
                    <div class="input-group-addon" ng-click='insert("generic")'>
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
                    <input type="text"  ng-model='formData.code' required="required" class="form-control col-md-7 col-xs-12" maxlength="3" ng-change='changeSampleCode()'>
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

            <div class="form-group" ng-show='formData.is_category != 1'> 
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Satuan jual<span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select class="form-control" data-placeholder-text-single="'Pilih Satuan'" ng-required='formData.is_category != 1' chosen allow-single-deselect="false" ng-model="formData.piece_id" ng-options="c.id as c.name for c in data.piece">
                  <option value=""></option>
                </select>
              </div>
            </div>

            <div class="form-group" ng-show='formData.is_category != 1'> 
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Satuan beli<span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select class="form-control" data-placeholder-text-single="'Pilih Satuan'" ng-required='formData.is_category != 1' chosen allow-single-deselect="false" ng-model="formData.purchase_piece_id" ng-options="c.id as c.name for c in data.piece">
                  <option value=""></option>
                </select>
              </div>
            </div>

            <div class="form-group"  ng-show='formData.is_category != 1'>
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Grup nota<span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select  ng-required='formData.is_category != 1' class="form-control" data-placeholder-text-single="'Pilih Grup Nota'" required='required' chosen allow-single-deselect="false" ng-model="formData.grup_nota_id" ng-options="c.id as c.name for c in data.grup_nota">
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
                
               
                
                <div class="form-group" ng-show='formData.is_category != 1'> 
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga beli
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="pd-l2">
                        <input type="text" class="form-control" ng-required='formData.is_category != 1'  ng-model="formData.purchase_price" jnumber2 only-num ng-change='countPrice()'>
                    </div>
                      
                  </div>
                </div>
                
                <div class="form-group" ng-show='formData.is_category != 1'> 
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga jual
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="pd-l2" style='padding-top:2mm'>
                        <% formData.price | number  %>
                    </div>
                      
                  </div>
                </div>
                
                <div class="form-group" ng-show='formData.is_category != 1'> 
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Margin(%)
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="pd-l2">
                        <input type="text" class="form-control" ng-required='formData.is_category != 1'  ng-model="formData.additional.margin" maxlength='3' only-num  ng-change='countPrice()'>
                    </div>
                      
                  </div>
                </div>
                
                <div class="form-group"  ng-show='formData.is_category != 1'>
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Komposisi
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <div class="pd-l2">
                        
                          <textarea ng-model='formData.additional.ingredient' class="form-control col-md-7 col-xs-12"></textarea>
                      </div>
                    </div>
                </div>
                

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal kadaluarsa<span class="required">*</span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <input type="text" id="first-name" ng-model='formData.additional.expired_date' required="required" class="form-control col-md-7 col-xs-12" datepick>
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
  <script src="{{ asset('') }}js/master/obat/obatCreateCtrl.js"></script>


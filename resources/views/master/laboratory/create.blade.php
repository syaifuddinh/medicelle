@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="laboratoryCreate" ng-cloak>
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Apakah kategori ?
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <label class="radio-inline">
                      <input type="radio" ng-model='formData.is_category' ng-value="1" ng-change='emptyCategory()'> Ya
                  </label>
                  <label class="radio-inline">
                      <input type="radio" ng-model='formData.is_category' ng-value="0" ng-change='emptyCategory()'> Tidak
                  </label>
              </div>
            </div>

            <div class="form-group" ng-show='formData.is_category != 1'>
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" data-placeholder-text-single="'Pilih Kategori'" ng-required='formData.is_category != 1' chosen allow-single-deselect="false" ng-model="formData.category_id" ng-options="c.id as c.code + ' - ' + c.name for c in data.category" ng-change='changeSampleCode()'>
                  <option value=""></option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
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
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" ng-model='formData.name' required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>


            <div class="form-group" ng-show='formData.is_category != 1'> 
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarif<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" ng-required='formData.is_category != 1'  ng-model="formData.price" jnumber2 only-num>
                  
              </div>
            </div>


            <div class="form-group" ng-show='formData.is_category != 1'> 
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Satuan<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" data-placeholder-text-single="'Pilih Satuan'" ng-required='formData.is_category != 1' chosen allow-single-deselect="false" ng-model="formData.piece_id" ng-options="c.id as c.name for c in data.piece">
                  <option value=""></option>
                </select>
              </div>
            </div>

            <div class="form-group"  ng-show='formData.is_category != 1'>
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Grup nota<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select  ng-required='formData.is_category != 1' class="form-control" data-placeholder-text-single="'Pilih Grup Nota'" required='required' chosen allow-single-deselect="false" ng-model="formData.grup_nota_id" ng-options="c.id as c.name for c in data.grup_nota">
                  <option value=""></option>
                </select>
              </div>
            </div>



            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keterangan
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea ng-model='formData.description' class="form-control col-md-7 col-xs-12"></textarea>
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

  </div>
  <!-- /page content -->

  <!-- ============================================================== -->
  <!-- All Jquery -->
  <!-- ============================================================== -->

  @include('footer')
  <script src="{{ asset('') }}js/master/laboratory/laboratoryCreateCtrl.js"></script>


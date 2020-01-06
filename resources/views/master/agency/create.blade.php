@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="agencyCreate" ng-cloak>
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kode<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text"  ng-model='formData.code' required="required" class="form-control col-md-7 col-xs-12" autofocus>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" ng-model='formData.name' required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label class="radio-inline">
                  <input type="radio" ng-model="formData.agency_type" name='type' ng-value='"INSTANSI"'>
                  <h5>Instansi</h5>
                </label>
                <label class="radio-inline">
                  <input type="radio" ng-model="formData.agency_type" name='type' ng-value='"ASURANSI"' required='required'>
                  <h5>Asuransi</h5>
                </label>
                </div>
              </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class='form-control' ng-model="formData.address" id="" cols="20" rows="10"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kota
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" data-placeholder-text-single="'Pilih Kota'" required='required' chosen allow-single-deselect="false" ng-model="formData.city_id" ng-options="c.id as c.name group by c.province.name for c in data.city">
                </select>
              </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode pos
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text"  ng-model='formData.postal_code' class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="email"  ng-model='formData.email' class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Telepon
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text"  ng-model='formData.phone' class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fax
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text"  ng-model='formData.fax' class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama kontak
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text"  ng-model='formData.contact_name' class="form-control col-md-7 col-xs-12">
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Diskon(%)
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text"  ng-model='formData.agency_disc_percent' class="form-control col-md-7 col-xs-12" only-num maxlength='3'>
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
  <script src="{{ asset('') }}js/master/agency/agencyCreateCtrl.js"></script>


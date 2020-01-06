@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="doctorCreate" ng-cloak>
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input autofocus type="text" id="first-name" ng-model='formData.name' required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea class='form-control' ng-model="formData.address" id="" cols="20" rows="10"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telepon
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" ng-model='formData.phone' required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kota
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control" data-placeholder-text-single="'Pilih Kota'" required='required' chosen allow-single-deselect="false" ng-model="formData.city_id" ng-options="c.id as c.name group by c.province.name for c in data.city">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Spesialisasi
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control" data-placeholder-text-single="'Pilih Spesialisasi'" required='required' chosen allow-single-deselect="false" ng-model="formData.specialization_id" ng-options="c.id as c.name for c in data.specialization">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Poliklinik
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control" data-placeholder-text-single="'Pilih Poliklinik'" required='required' chosen allow-single-deselect="false" ng-model="formData.polyclinic_id" ng-options="c.id as c.name for c in data.polyclinic">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Diskon farmasi(%)
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  ng-model='formData.pharmacy_disc_percent' class="form-control col-md-7 col-xs-12" only-num maxlength='3'>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fee pengirim LAB(%)
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  ng-model='formData.lab_sender_fee_value' class="form-control col-md-7 col-xs-12" only-num maxlength='3'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fee pengirim LAB rujukan(%)
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  ng-model='formData.lab_refer_sender_fee_value' class="form-control col-md-7 col-xs-12" only-num maxlength='3'>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fee pengirim X-Ray(%)
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  ng-model='formData.xray_sender_fee_value' class="form-control col-md-7 col-xs-12" only-num maxlength='3'>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fee baca X-Ray(%)
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  ng-model='formData.xray_read_fee_value' class="form-control col-md-7 col-xs-12" only-num maxlength='3'>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fee pengirim ECG(%)
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  ng-model='formData.ecg_sender_fee_value' class="form-control col-md-7 col-xs-12" only-num maxlength='3'>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fee baca ECG(%)
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  ng-model='formData.ecg_read_fee_value' class="form-control col-md-7 col-xs-12" only-num maxlength='3'>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fee tindakan medis(%)
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  ng-model='formData.medical_action_fee_value' class="form-control col-md-7 col-xs-12" only-num maxlength='3'>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fee visite/konsul(%)
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  ng-model='formData.consultation_fee_value' class="form-control col-md-7 col-xs-12" only-num maxlength='3'>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1">
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
<script src="{{ asset('') }}js/master/doctor/doctorCreateCtrl.js"></script>


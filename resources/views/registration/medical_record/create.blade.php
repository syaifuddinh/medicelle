@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="medicalRecordCreate" ng-cloak>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                            
                                    <label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Keluhan utama<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea class="form-control" ng-model='formData.main_complaint'></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="ln_solid"></div>
                        <h2>Riwayat penyakit dahulu</h2>
                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                <div class="form-group col-md-3">
                                    
                                    <label>Penyakit</label>
                                    <select class="form-control col-md-12" data-placeholder-text-single="'Pilih Penyakit'"  chosen allow-single-deselect="false" ng-options="c.id as c.name group by c.category.name for c in data.disease" ng-model="disease_history.disease_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mg-r2">
                                    
                                    <label>Obat yang pernah diminum</label>
                                    <input type="text" class='form-control' ng-model='disease_history.cure'>
                                </div>
                                <div class="form-group col-md-4 mg-r2">

                                    <label>Kontrol terakhir</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model='disease_history.last_checkup_date' datepick>
                                        <div class="input-group-btn">
                                            <button type='button' class='btn btn-success' ng-click='submitDiseaseHistory()' ng-disabled='!disease_history.disease_id'>Tambah</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='disease_history_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Penyakit</td>
                                            <td>Obat yang pernah diminum</td>
                                            <td>Terakhir control</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <h2>Riwayat penyakit keluarga</h2>
                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                <div class="form-group col-md-3">
                                    
                                    <label>Penyakit</label>
                                    <select class="form-control col-md-12" data-placeholder-text-single="'Pilih Penyakit'"  chosen allow-single-deselect="false" ng-options="c.id as c.name group by c.category.name for c in data.disease" ng-model="family_disease_history.disease_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mg-r2">
                                    
                                    <label>Obat yang pernah diminum</label>
                                    <input type="text" class='form-control' ng-model='family_disease_history.cure'>
                                </div>
                                <div class="form-group col-md-4 mg-r2">

                                    <label>Kontrol terakhir</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model='family_disease_history.last_checkup_date' datepick>
                                        <div class="input-group-btn">
                                            <button type='button' class='btn btn-success' ng-click='submitFamilyDiseaseHistory()' ng-disabled='!family_disease_history.disease_id'>Tambah</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='family_disease_history_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Penyakit</td>
                                            <td>Obat yang pernah diminum</td>
                                            <td>Terakhir control</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-right">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm">Selanjutnya</button>
                                </div>
                                <div class="btn-group pull-left">

                                    <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='formData = {}'>Reset</button>
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
<script src="{{ asset('') }}js/registration/medical_record/medicalRecordCreateCtrl.js"></script>


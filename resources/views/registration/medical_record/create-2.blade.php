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
                        <a href='#' class="btn btn-primary pull-right btn-xs">
                            <i class="fa fa-user"></i> <% patient.name %>
                        </a>
                        <a href='#' class="btn btn-dark pull-right btn-xs mg-r2">
                            <i class="fa fa-list-alt"></i> <% code %>
                        </a>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                        <nav style='margin-bottom:2mm'>
            
                         <ul class="nav nav-pills">
                            <li><a href="{{ route('medical_record.edit', ['id' => $id]) }}">Langkah 1</a></li>
                            <li class="active"><a href="#">Langkah 2</a></li>
                            <li><a href="{{ route('medical_record.edit.3', ['id' => $id]) }}">Langkah 3</a></li>
                          </ul> 
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Alergi obat & reaksi efek samping</h2>
                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                
                                <div class="form-group col-md-5 mg-r2">
                                    
                                    <label>Obat / makanan / lainnya</label>
                                    <div class="input-group">
                                        <input type="text" class='form-control' ng-model='allergy_history.cure' ng-show='!allergy_history.is_unknown'>
                                        <input readonly type="text" class='form-control' value='Tidak diketahui'  ng-show='allergy_history.is_unknown'>
                                        <div class="input-group-addon" ng-click='allergy_history.is_unknown = !allergy_history.is_unknown'>
                                            <i class="fa fa-close" ng-show='!allergy_history.is_unknown'></i>
                                            <i class="fa fa-pencil" ng-show='allergy_history.is_unknown'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-7 mg-r2">

                                    <label>Reaksi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model='allergy_history.side_effect'>
                                        <div class="input-group-btn">
                                            <button type='button' class='btn btn-success' ng-click='submitAllergyHistory()' ng-disabled='!allergy_history.side_effect'>Tambah</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='allergy_history_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Obat</td>
                                            <td>Reaksi</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="row">
                            
                            <div class="col-md-12" style='display:flex;align-items:center;justify-content:space-between;'>
                                <h2>Skrining resiko jatuh</h2>
                                <div>
                                    
                                    <a class='btn btn-dark pull-right btn-xs'>Tidak Beresiko</a>
                                    <a class='btn btn-primary pull-right btn-xs'>Diperlukan operasi</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='fallen'>
                                    <thead>
                                        <tr>
                                            <td style='width:30mm'>Kondisi pasien</td>
                                            <td style='width:70mm'>Skala</td>
                                            <td>Nilai</td>
                                            <td>Keterangan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Riwayat jatuh</td>
                                            <td>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.fallen" ng-value='25'>
                                                  <h5>Ya</h5>
                                                </label>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.fallen" ng-value='0'>
                                                      <h5>Tidak</h5>
                                                </label>
                                            </td>
                                            <td class="text-right"><% formData.fallen %></td>
                                            <td><input type="text" class="form-control" ng-model='formData.fallen_description'></td>
                                        </tr>
                                        <tr>
                                            <td>Diagnosa sekunder</td>
                                            <td>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.secondary_diagnose" ng-value='15'>
                                                  <h5>Ya</h5>
                                                </label>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.secondary_diagnose" ng-value='0'>
                                                      <h5>Tidak</h5>
                                                </label>
                                            </td>
                                            <td class="text-right"><% formData.secondary_diagnose %></td>
                                            <td><input type="text" class="form-control" ng-model='formData.secondary_diagnose_description'></td>
                                        </tr>
                                        <tr>
                                            <td>Alat bantu</td>
                                            <td>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.helper" ng-value='30'>
                                                  <h5>Peralatan khusus</h5>
                                                </label>
                                                <br>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.helper" ng-value='15'>
                                                      <h5>Tongkat / walker</h5>
                                                </label>
                                                <br>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.helper" ng-value='0'>
                                                      <h5>Kursi roda/tanpa alat bantu</h5>
                                                </label>
                                            </td>
                                            <td class="text-right"><% formData.helper %></td>
                                            <td>
                                                <textarea class="form-control" ng-model='formData.helper_description'>
                                                </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pasien diinfus</td>
                                            <td>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.infus" ng-value='20'>
                                                  <h5>Ya</h5>
                                                </label>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.infus" ng-value='0'>
                                                      <h5>Tidak</h5>
                                                </label>
                                            </td>
                                            <td class="text-right"><% formData.infus %></td>
                                            <td><input type="text" class="form-control" ng-model='formData.infus_description'></td>
                                        </tr>
                                        <tr>
                                            <td>Cara berjalan</td>
                                            <td>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.walking" ng-value='20'>
                                                  <h5>Terganggu</h5>
                                                </label>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.walking" ng-value='10'>
                                                      <h5>Lemah</h5>
                                                </label>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.walking" ng-value='0'>
                                                      <h5>Normal</h5>
                                                </label>
                                            </td>
                                            <td class="text-right"><% formData.walking %></td>
                                            <td><input type="text" class="form-control" ng-model='formData.walking_description'></td>
                                        </tr>
                                        <tr>
                                            <td>Kondisi mental</td>
                                            <td>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.mental" ng-value='15'>
                                                  <h5>Keterbatasan daya ingat</h5>
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.mental" ng-value='0'>
                                                  <h5>Normal</h5>
                                                </label>
                                            </td>
                                            <td class="text-right"><% formData.mental %></td>
                                            <td><input type="text" class="form-control" ng-model='formData.mental_description'></td>
                                        </tr>
                                    </tbody>
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
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
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


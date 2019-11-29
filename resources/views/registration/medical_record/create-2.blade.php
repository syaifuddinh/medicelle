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
                          </ul> 
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Alergi obat & reaksi efek samping</h2>
                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                
                                <div class="form-group col-md-5 mg-r2">
                                    
                                    <label>Obat</label>
                                    <input type="text" class='form-control' ng-model='allergy_history.cure'>
                                </div>
                                <div class="form-group col-md-7 mg-r2">

                                    <label>Efek samping</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model='allergy_history.side_effect' datepick>
                                        <div class="input-group-btn">
                                            <button type='button' class='btn btn-success' ng-click='submitAllergyHistory()' ng-disabled='!disease_history.disease_id'>Tambah</button>
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
                                            <td>Efek samping</td>
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
                        <h2>Skrining nyeri</h2>
                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                <div class="form-group col-md-3">
                                    
                                    <label>Lokasi nyeri</label>
                                    
                                    <input type="text" class='form-control' ng-model='pain_history.pain_location'>
                                </div>
                                <div class="form-group col-md-4 mg-r2">
                                    
                                    <label>Kualitas nyeri</label>
                                    <div class="input-group">
                                        <span ng-show='!is_other_pain_type'>
                                            
                                            <select class="form-control col-md-12" data-placeholder-text-single="'Pilih Penyakit'"  chosen allow-single-deselect="false" ng-model="pain_history.pain_type">
                                                <option value=""></option>
                                                <option value="MENGIRIS">Mengiris</option>
                                                <option value="MENUSUK">Menusuk</option>
                                                <option value="MENEKAN">Menekan</option>
                                                <option value="MENYEBAR">Menyebar</option>
                                            </select>
                                        </span>
                                        <input type="text" class='form-control' ng-model='pain_history.pain_type' ng-show='is_other_pain_type'>
                                        <div class="input-group-addon" ng-click="is_other_pain_type = !is_other_pain_type">
                                            <i class="fa fa-pencil" ng-show='!is_other_pain_type'></i>
                                            <i class="fa fa-close" ng-show='is_other_pain_type'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    
                                    <label>Lamanya nyeri</label>
                                    <div class="input-group">
                                        <input type="text" class='form-control' ng-model='pain_history.pain_duration'>
                                        <div class="input-group-btn">
                                            <button type='button' class='btn btn-success' ng-click='submitPainHistory()' ng-disabled='!pain_history.pain_location'>Tambah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='pain_history_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Lokasi nyeri</td>
                                            <td>Kualitas nyeri</td>
                                            <td>Lamanya nyeri</td>
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


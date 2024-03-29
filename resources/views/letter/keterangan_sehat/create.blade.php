@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" id='scopeContainer' ng-controller="keteranganSehatCreate">
          <!-- top tiles -->
          

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3><% title %></h3>
                  </div>
                  <div class="col-md-6">
                      <a href='#' class="btn btn-default pull-right btn-xs" ng-show='medical_record.id'>
                          <i class="fa fa-file-archive-o"></i> <% medical_record.code %>
                      </a>
                      <a href='#' class="btn btn-primary pull-right btn-xs" ng-show='medical_record.id'>
                          <i class="fa fa-user-md"></i> <% medical_record.registration_detail.doctor.name %>, Spesialis <% medical_record.registration_detail.doctor.specialization.name %> 
                      </a>
                      <a href='#' class="btn btn-dark pull-right btn-xs" ng-show='formData.id'>
                          <i class="fa fa-barcode"></i> <% formData.code %>
                      </a>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class='form-control' ng-model='formData.date' datepick>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Pasien<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group" ng-click='showMedicalRecord()'>
                                            <input type="text" id="first-name" ng-model='medical_record.patient.name' required="required" class="form-control col-md-7 col-xs-12" ng-readonly='!is_new_patient'>
                                            <div class="input-group-addon">
                                                <i class="fa fa-search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" ng-show='medical_record.id'>
                                    <label class="col-md-3 col-sm-3 col-xs-12">Tanggal lahir
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% medical_record.patient.birth_date | fullDate %>
                                    </div>
                                </div>

                                <div class="form-group" ng-show='medical_record.id'>
                                    <label class="col-md-3 col-sm-3 col-xs-12">Umur
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% medical_record.age %> Tahun
                                    </div>
                                </div>

                                <div class="form-group" ng-show='medical_record.id'>
                                    <label class="col-md-3 col-sm-3 col-xs-12">Jenis kelamin
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% medical_record.patient.gender %>
                                    </div>
                                </div>

                                <div class="form-group" ng-show='medical_record.id'>
                                    <label class="col-md-3 col-sm-3 col-xs-12">Alamat
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% medical_record.patient.address %>
                                    </div>
                                </div>

                                <div class="form-group" ng-show='medical_record.id'>
                                    <label class="col-md-3 col-sm-3 col-xs-12">Kota
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% medical_record.patient.city.name %>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12">Hasil pemeriksaan<span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="input-group-addon">TD</div>
                                                <input type="text" class="form-control" jnumber2 only-num ng-model='formData.additional.td'>
                                            </div>
                                        </div>          
                                        <div class="col-md-4">
                                            
                                            <div class="input-group">
                                                <div class="input-group-addon">N</div>
                                                <input type="text" class="form-control" jnumber2 only-num ng-model='formData.additional.n'>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            
                                            <div class="input-group">
                                                <div class="input-group-addon">RR</div>
                                                <input type="text" class="form-control" jnumber2 only-num ng-model='formData.additional.rr'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="input-group-addon">Sh</div>
                                                <input type="text" class="form-control" jnumber2 only-num ng-model='formData.additional.sh'>
                                            </div>
                                        </div>          
                                        <div class="col-md-4">
                                            
                                            <div class="input-group">
                                                <div class="input-group-addon">BB</div>
                                                <input type="text" class="form-control" jnumber2 only-num ng-model='formData.additional.bb'>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            
                                            <div class="input-group">
                                                <div class="input-group-addon">TB</div>
                                                <input type="text" class="form-control" jnumber2 only-num ng-model='formData.additional.tb'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class='col-md-12'>Buta warna</label>
                                            <div class="col-md-5">
                                                <label class="radio-inline">
                                                    <input type="radio" ng-model='formData.additional.buta_warna' ng-value='"YA"'> Ya
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" ng-model='formData.additional.buta_warna' ng-value='"TIDAK"'> Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12">Pemeriksaan mata
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea ng-model='formData.additional.eye_diagnose' class='form-control'></textarea>  

                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12">Pemeriksaan telinga
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea ng-model='formData.additional.ear_diagnose' class='form-control'></textarea>  

                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12">Keadaan pasien
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label class="radio-inline">
                                            <input type="radio" ng-model='formData.option' ng-value='"SEHAT"'> Sehat
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" ng-model='formData.option' ng-value='"TIDAK SEHAT"'> Tidak sehat
                                        </label>
                                    </div>
                                </div>
                                

                                
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12">Keterangan
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea ng-model='formData.description' class='form-control'></textarea>
                                    </div>
                                </div>
                                
                            </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1">
                            <div class="btn-group">

                                <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button> <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                <button type="button" ng-click='repeat = 1;submitForm()' ng-disabled='disBtn' class="btn btn-primary btn-sm">Simpan dan lanjutkan</button>
                                <button type="button" ng-click='repeat = 0;submitForm()' ng-disabled='disBtn' class="btn btn-success btn-sm">Simpan dan keluar</button>
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

<div class="modal fade" id="medicalRecordModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:80%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Daftar Pasien</h4>
            </div>
            <div class="modal-body">

                <table class="table table-bordered" id='browse_medical_record_datatable' style='width:100%'>
                    <thead>
                        <tr>
                            <th></th>
                            <th>No Rekam Medis</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Spesialis</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    @include('footer')
    <script src="{{ asset('') }}js/letter/keterangan_sehat/keteranganSehatCreateCtrl.js"></script>


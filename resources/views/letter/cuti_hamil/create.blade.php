@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="cutiHamilCreate">
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
                                    <label class="col-md-12 col-sm-12 col-xs-12">Tanggal taksiran persalinan
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class='form-control' ng-model='formData.review_date' datepick>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12">Usia kehamilan<span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-7">
                                            <input type="text" class='form-control' ng-model='formData.age' maxlength='3' only-num>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="form-control"  chosen allow-single-deselect="false" ng-model="formData.age_type" >
                                                <option value=""></option>
                                                <option value="MINGGU">Minggu</option>
                                                <option value="BULAN">Bulan</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12">Perkiraan cuti hamil<span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-7">
                                            <input type="text" class='form-control' ng-model='formData.duration'  ng-change='adjustEndDate()' maxlength='3' only-num>
                                        </div>
                                        <div class="col-md-5">
                                            <select class="form-control"  chosen allow-single-deselect="false" ng-model="formData.duration_type"  ng-change='adjustEndDate()' >
                                                <option value=""></option>
                                                <option value="MINGGU">Minggu</option>
                                                <option value="BULAN">Bulan</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12">Tanggal mulai cuti<span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" class='form-control' ng-model='formData.start_date'  ng-change='adjustEndDate()'  datepick>
                                            <div class="input-group-addon">
                                              s/d
                                            </div>
                                            <input type="text" class='form-control' ng-model='formData.end_date' disabled datepick>
                                        </div>
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
    <script src="{{ asset('') }}js/letter/cuti_hamil/cutiHamilCreateCtrl.js"></script>


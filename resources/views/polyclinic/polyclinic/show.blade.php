@include('header')
<?php 
    $path = Route::getCurrentRoute()->getName();
    if( strpos($path, 'polyclinic') > -1) {
      $flag = 'polyclinic';
    } else if( strpos($path, 'radiology') > -1) {
      $flag = 'radiology';
    } else if( strpos($path, 'chemoterapy') > -1) {
      $flag = 'chemoterapy';
    }  else if( strpos($path, 'laboratory') > -1) {
      $flag = 'laboratory';
    } else if( strpos($path, 'ruang_tindakan') > -1) {
      $flag = 'ruang_tindakan';
    } else if( strpos($path, 'medical_checkup') > -1) {
      $flag = 'medical_checkup';
    } else {
        $flag = '';
    }
    $edit_role = $flag . '.edit'
?>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="polyclinicShow">
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-6 hidden">
                        <div class="btn-group pull-right">
                            <a href='{{ route("assesment.index", ["id" => $patient_id]) }}' target='_blank' class="btn btn-info btn-sm" >Riwayat assesment</a>
                            <?php 
                                $path = preg_replace('/([a-z]+)\..*/', '$1', $flag);
                             ?>
                            <a href='{{ route("medical_record.index.$path", ["id" => $patient_id]) }}' target='_blank' class="btn btn-success btn-sm" >Riwayat rekam medis</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                       <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.date | fullDate %>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Pasien
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.patient.name %>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Status pembayaran
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.invoice.status_name %>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal registrasi
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.date | fullDate %>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12">Jenis pasien
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 capitalize">

                                    <% formData.patient_type.toLowerCase() %>


                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12">Jenis kelamin
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12 capitalize">

                                    <% formData.patient.gender.toLowerCase() %>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <% formData.patient.address %>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Kota
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <% formData.patient.city.name %>, <% formData.patient.city.province.name %>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12">Umur
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <% formData.patient.age %>
                                </div>
                            </div>


                            <div class="form-group" ng-show='pivot.is_ruang_tindakan == 1'>
                                <label class="col-md-3 col-sm-3 col-xs-12">Keterangan
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea class="form-control" ng-model='pivotData.ruang_tindakan_description' ng-change='updateRuangTindakanDescription()'></textarea>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12">No. telepon yang bisa dihubungi 
                                </label>
                                <div class="col-md-10 col-xs-12">
                                    <% formData.patient.phone %>

                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <h2>Penanggung jawab</h2>
                            <span ng-show='formData.patient_type == "ASURANSI SWASTA"'>

                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Nama instansi / asuransi
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.pic.name %>



                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">ID Kartu / No. Polis
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.insurance_code %>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Atas nama
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.insurance_owner_name %>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Plafon hutang
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.plafon %>

                                    </div>
                                </div>
                            </span>
                            <span ng-show='formData.patient_type == "UMUM"'>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Jenis
                                    </label>
                                    <div class="col-md-10 col-xs-12 capitalize">
                                        <% formData.family_type.toLowerCase() %>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Nama orang tua/suami/istri
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.patient.family.name %>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Alamat
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.patient.family.address %>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Pekerjaan
                                    </label>
                                    <div class="col-md-10 col-xs-12 capitalize">
                                        <% formData.patient.family.job.toLowerCase() %>
                                    </div>
                                </div>
                            </span>
                        </div>
                        <div class="col-md-12"  ng-show='pivot.is_radiology == 1 && pivot.is_referenced == 1'>
                            <hr>
                            <div class="form-group">
                                <label class="col-xs-12">Keterangan
                                </label>
                                <div class="col-xs-12">
                                    <textarea class="form-control" ng-model='pivotData.radiology_description' ng-change='updatePivot()' rows='7'></textarea>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @include('polyclinic/polyclinic/laboratory/laboratory_treatment_description')
                    
                    <div class="ln_solid"></div>
                    <div class="form-group" >
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <div class="btn-group pull-left">

                                <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Kembali</button>
                            </div>

                            <div class="btn-group pull-right" ng-show='pivot.is_referenced == 1'>

                                <button class="btn btn-primary btn-sm" ng-click="openPDF()" type="button" title='Buka dokumen PDF'>
                                    <i class="fa fa-file-pdf-o"></i>
                                </button>
                            </div>
                            <div class="btn-group pull-right" ng-hide='pivot.is_referenced == 1'>
                             @if(Auth::user()->allow_update_assesment())
                                <a id='assesmentButton' ng-show='formData.invoice.status > 2' href='{{ route("assesment.edit", ["id" => ""]) }}' class="btn btn-info btn-sm" >Isi assesment</a>                                
                                <a ng-show='formData.invoice.status < 3' disabled href='#' class="btn btn-info btn-sm" >Isi assesment</a>                                
                            @endif

                             @if(Auth::user()->allow_update_medical_record() && Auth::user()->allow_access($edit_role))
                            <a target='_blank' id='medicalRecordButton' ng-show='formData.invoice.status > 2 && edit_role' href='{{ route("medical_record.edit", ["id" => $medical_record_id]) }}' class="btn btn-success btn-sm" >Isi rekam medis</a>     
                            <a id='medicalRecordButton' ng-show='formData.invoice.status < 3' disabled href='#' class="btn btn-success btn-sm" >Isi rekam medis</a>     
                            @endif
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
<script src="{{ asset('') }}js/polyclinic/polyclinic/polyclinicShowCtrl.js"></script>


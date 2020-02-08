@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="medicalRecordCreate" ng-cloak>
    <!-- top tiles -->
    <div class="row">
        <div class="col-md-12">
            
                <ul class="nav nav-pills" style='margin-bottom:1mm'>
                    @if( Specialization::allow_access('anamnesa') == 1 || Specialization::allow_access('anamnesa_obgyn') == 1 )
                        <li class='{{ strpos(url()->current(), "step") != null ? "active" : "" }}'><a href="{{ route('medical_record.edit', ['id' => $id]) }}">Anamnesa</a></li>
                    @endif
    
                    @if( Specialization::allow_access('umum') == 1 || Specialization::allow_access('kepala') == 1 || Specialization::allow_access('breast') == 1 || Specialization::allow_access('rectum') == 1)
                        <li class='{{ strpos(url()->current(), "physique") != null ? "active" : "" }}'>
                            <a href="{{ route('medical_record.edit.physique.general', ['id' => $id]) }}">Pemeriksaan Fisik</a>
                        </li>
                    @endif

                    @if( Specialization::allow_access('medical_checkup') == 1)
                        <li class='{{ strpos(url()->current(), "medical_checkup") != null ? "active" : "" }}'>
                            <a href="{{ route('medical_record.edit.medical_checkup', ['id' => $id]) }}">Medical Checkup</a>
                        </li>
                    @endif

                    @if( Specialization::allow_access('tindakan') == 1 || Specialization::allow_access('diagnostik') == 1 || Specialization::allow_access('obat') == 1)
                        <li class='{{ strpos(url()->current(), "therapy") != null ? "active" : "" }}'>
                            <a href="{{ route('medical_record.edit.therapy.treatment', ['id' => $id]) }}">Terapi</a>
                        </li>
                    @endif
                    
                    @if( Specialization::allow_access('bhp') == 1 || Specialization::allow_access('sewa_alkes') == 1 || Specialization::allow_access('sewa_ruangan') == 1)
                        <li class='{{ strpos(url()->current(), "utilization") != null ? "active" : "" }}'>
                            <a href="{{ route('medical_record.edit.utilization.bhp', ['id' => $id]) }}">BHP, sewa ruang & sewa alkes</a>
                        </li>
                    @endif
                    
                    @if( Specialization::allow_access('radiologi') == 1)
                        <li class='{{ strpos(url()->current(), "radiology") != null ? "active" : "" }}'>
                            <a href="{{ route('medical_record.edit.radiology', ['id' => $id]) }}">Radiologi</a>
                        </li>
                    @endif
                    
                    @if( Specialization::allow_access('laboratorium')  == 1)
                        <li class='{{ strpos(url()->current(), "laboratory") != null ? "active" : "" }}'>
                            <a href="{{ route('medical_record.edit.laboratory', ['id' => $id]) }}">Laboratorium</a>
                        </li>
                    @endif

                    @if( Specialization::allow_access('patologi')  == 1)
                        <li class='{{ strpos(url()->current(), "pathology") != null ? "active" : "" }}'>
                            <a href="{{ route('medical_record.edit.pathology', ['id' => $id]) }}">Patologi & anatomi</a>
                        </li>
                    @endif

                    <li class='{{ strpos(url()->current(), "permintaan") != null ? "active" : "" }}'>
                        <a href="{{ route('medical_record.edit.permintaan.fnab', ['id' => $id]) }}">Permintaan</a>
                    </li>

                    @if( Specialization::allow_access('jadwal_kontrol') == 1 )
                        <li class='{{ strpos(url()->current(), "schedule") != null ? "active" : "" }}'>
                            <a href="{{ route('medical_record.edit.schedule', ['id' => $id]) }}">Jadwal kontrol</a>
                        </li>
                    @endif
                    @if( Specialization::allow_access('resume_medis') == 1 )
                        <li class='{{ strpos(url()->current(), "resume") != null ? "active" : "" }}'>
                            <a href="{{ route('medical_record.edit.resume', ['id' => $id]) }}">Resume medis</a>
                        </li>
                    @endif
                    @if( Specialization::allow_access('assesment') == 1 )
                        <li class='{{ strpos(url()->current(), "assesment") != null ? "active" : "" }}'>
                            <a href="{{ route('medical_record.edit.assesment', ['id' => $id]) }}">Riwayat Assesment</a>
                        </li>
                    @endif
                </ul> 
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-3">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-9">
                        <div class="btn-group pull-right">
                          <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class='fa fa-angle-down'> </i>
                          </button>
                           <ul class="list-group dropdown-menu">
                                <li class='list-group-item'>
                                    <a href='#' class="text-primary" ng-click='referMedicalRecord()'>
                                        Rujuk ke dokter lain ?
                                    </a>      
                                    <a href='#' class="text-primary" ng-click='showMedicalRecord()'>
                                        Apakah anda ingin menyalin dari rekam medis sebelumnya ?
                                    </a>      
                                </li>
                            </ul>
                         <!--  <div class="dropdown-menu" style='width:100mm'>
                                       
                          </div> -->
                        </div>
                        <a href='#' class="btn btn-primary pull-right btn-xs">
                            <i class="fa fa-user"></i> <% patient.name %>
                        </a>
                        <a href='#' class="btn btn-dark pull-right btn-xs mg-r2">
                            <i class="fa fa-list-alt"></i> <% code %>
                        </a>
                        <a href='#' class="btn btn-default pull-right btn-xs">
                            <i class="fa fa-user-md"></i> 
                            <% doctor.name %>, Spesialis <% doctor.specialization.name %>
                        </a>
                        <a href='#' class="btn btn-default pull-right btn-xs" ng-show='refer_doctor.name'>
                            <i class="fa fa-user-md"></i> 
                            Dirujuk ke <% refer_doctor.name %>
                        </a>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                        <nav style='margin-bottom:2mm'>
                            <div class="pull-right">
                                <div class="form-group" id='reduksi_form_group'>
                                    <label class='col-md-3' style="margin-top:1.5mm">Reduksi(%)</label>

                                    <div class="col-md-8">
                                        
                                        <input type="text" class="form-control" ng-model='formData.reduksi' ng-change='submitOne("reduksi")' maxlength="3"  jnumber2 only-num>
                                    </div>
                                </div>
                            </div>
            
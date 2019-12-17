@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="medicalRecordCreate" ng-cloak>
    <!-- top tiles -->
    <div class="row">
        <div class="col-md-12">
            
                <ul class="nav nav-pills" style='margin-bottom:1mm'>
                    <li class='{{ strpos(url()->current(), "step") != null ? "active" : "" }}'><a href="{{ route('medical_record.edit', ['id' => $id]) }}">Anamnesa</a></li>
                    <li class='{{ strpos(url()->current(), "physique") != null ? "active" : "" }}'>
                        <a href="{{ route('medical_record.edit.physique.general', ['id' => $id]) }}">Pemeriksaan Fisik</a>
                    </li>

                    <li class='{{ strpos(url()->current(), "therapy") != null ? "active" : "" }}'>
                        <a href="{{ route('medical_record.edit.therapy.treatment', ['id' => $id]) }}">Terapi</a>
                    </li>
                    
                    <li class='{{ strpos(url()->current(), "radiology") != null ? "active" : "" }}'>
                        <a href="{{ route('medical_record.edit.radiology', ['id' => $id]) }}">Radiologi</a>
                    </li>

                    <span class="hidden">
                        
                        <li class='{{ strpos(url()->current(), "bhp") != null ? "active" : "" }}'><a href="#">BHP - Sewa Alkes & Ruang</a></li>
                        <li class='{{ strpos(url()->current(), "laboratory") != null ? "active" : "" }}'><a href="#">Laboratorium</a></li>
                        <li class='{{ strpos(url()->current(), "patologi") != null ? "active" : "" }}'><a href="#">Patologi anatomi</a></li>
                        <li class='{{ strpos(url()->current(), "schedule") != null ? "active" : "" }}'><a href="#">Jadwal kontrol</a></li>
                    </span>
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
                    <div class="col-md-9.1">
                        <a href='#' class="text-primary pull-right" ng-click='showMedicalRecord()'>
                            Apakah anda ingin menyalin dari rekam medis sebelumnya ?
                        </a>
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
                            <div class="pull-right">
                                <div class="form-group">
                                    <label class='col-md-3' style="margin-top:1.5mm">Reduksi(%)</label>

                                    <div class="col-md-8">
                                        
                                        <input type="text" class="form-control" ng-model='formData.reduksi' maxlength="3"  jnumber2 only-num>
                                    </div>
                                </div>
                            </div>
            
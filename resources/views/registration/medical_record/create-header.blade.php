@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="medicalRecordCreate" ng-cloak>
    <!-- top tiles -->
    <div class="row">
        <div class="col-md-12">
            
                <ul class="nav nav-pills" style='margin-bottom:1mm'>
                    <li class="active"><a href="#">Anamnesa</a></li>
                    <li><a href="#">Pemeriksaan Fisik</a></li>
                    <li><a href="#">Terapi</a></li>
                    <li><a href="#">BHP - Sewa Alkes & Ruang</a></li>
                    <li><a href="#">Radiologi</a></li>
                    <li><a href="#">Laboratorium</a></li>
                    <li><a href="#">Patologi anatomi</a></li>
                    <li><a href="#">Jadwal kontrol</a></li>
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
            
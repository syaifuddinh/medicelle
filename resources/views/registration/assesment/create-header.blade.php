@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" id='scopeContainer' ng-controller="assesmentCreate" ng-cloak>
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-3">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-9.1">
                        <a href='#' class="text-primary pull-right" ng-click='showAssesment()'>
                            Apakah anda ingin menyalin dari assesment sebelumnya ?
                        </a>
                        <a href='#' class="btn btn-primary pull-right btn-xs">
                            <i class="fa fa-user"></i> <% patient.name %>
                        </a>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                        <nav style='margin-bottom:2mm'>
                            <ul class="nav nav-pills">
                                <li  class='{{ strpos(url()->current(), "/step/1") != null ? "active" : "" }}'><a href="{{ route('assesment.edit', ['id' => $id]) }}">Langkah 1</a></li>
                                <li  class='{{ strpos(url()->current(), "/step/2") != null ? "active" : "" }}'><a href="{{ route('assesment.edit.2', ['id' => $id]) }}">Langkah 2</a></li>
                                <li  class='{{ strpos(url()->current(), "/step/3") != null ? "active" : "" }}'><a href="{{ route('assesment.edit.3', ['id' => $id]) }}">Langkah 3</a></li>
                                <li  class='{{ strpos(url()->current(), "/step/4") != null ? "active" : "" }}'><a href="{{ route('assesment.edit.4', ['id' => $id]) }}">Langkah 4</a></li>
                                <li  class='{{ strpos(url()->current(), "/history") != null ? "active" : "" }}'><a href="{{ route('assesment.edit.history', ['id' => $id]) }}">Riwayat</a></li>
                            </ul> 
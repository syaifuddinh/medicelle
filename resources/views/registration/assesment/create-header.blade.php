@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="assesmentCreate" ng-cloak>
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
            
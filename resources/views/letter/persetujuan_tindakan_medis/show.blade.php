@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" id='scopeContainer' ng-controller="persetujuanTindakanMedisShow">
    <!-- top tiles -->
    <div class="container-fluid">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Detail</a></li>
            <li><a data-toggle="tab" href="#detail">Cetakan</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-4">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-8">
                        <a href='#' class="btn btn-default pull-right btn-xs">
                            <i class="fa fa-file-archive-o"></i> <% medical_record.code %>
                        </a>
                        <a href='#' class="btn btn-primary pull-right btn-xs">
                            <i class="fa fa-user-md"></i> <% formData.doctor.name %>, Spesialis <% formData.doctor.specialization.name %> 
                        </a>
                        <a href='#' class="btn btn-dark pull-right btn-xs">
                            <i class="fa fa-barcode"></i> <% formData.code %>
                        </a>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate | fullDate class="form-horizontal form-label-left" ng-submit='submitForm()'>
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
                                        <% medical_record.patient.name %>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12">Tanggal lahir
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% medical_record.patient.birth_date | fullDate %>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12">Umur
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% medical_record.age %> Tahun
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12">Jenis kelamin
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% medical_record.patient.gender %>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12">Alamat
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% medical_record.patient.address %>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12">Kota
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% medical_record.patient.city.name %>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        <b>Penanggung Jawab</b>
                                    </label>
                                </div>
                                <div class="form-group" style='padding-top:3mm'>
                                    <label class="col-md-12 col-sm-12 col-xs-12">Nama
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <% formData.additional.name %>
                                    </div>
                                </div>

                                <div class="form-group" style='padding-top:3mm'>
                                    <label class="col-md-12 col-sm-12 col-xs-12">Alamat
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <% formData.additional.address %>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12">Identitas Diri
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <% formData.additional.identitas_diri %>
                                    </div>
                                </div>
                
                                <hr>
                
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12">Tindakan medis
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                            <% formData.description %>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="btn-group">

                                    <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button> 
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
            <div id="detail" class="tab-pane fade">
                <div class="row x_title dashboard_graph">
                    <div class="col-md-12">
                        <p>
                            Jika pdf tidak tampil, silahkan klik
                            <a href="{{ route('controller.letter.persetujuan_tindakan_medis.pdf', ['id' => $id]) }}" target="_blank">disini</a>
                        </p>
                        <embed id='pdfDocument' style='width:100%;height:28cm'>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- /page content -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

@include('footer')
<script src="{{ asset('') }}js/letter/persetujuan_tindakan_medis/persetujuanTindakanMedisShowCtrl.js"></script>


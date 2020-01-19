@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="doctorShow">
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group pull-right">
                            @if(Auth::user()->allow_access('master.medical_worker.edit'))
                                <a href='{{ route("doctor.edit", ["id" => $id]) }}' class="btn btn-warning btn-sm" >Edit</a>
                            @endif

                            @if(Auth::user()->allow_access('master.medical_worker.destroy'))
                                <button type="button" ng-if='formData.is_active == 1' class="btn btn-danger btn-sm" ng-click='delete({{ $id }})'>Non-aktifkan</button>
                            @endif

                            @if(Auth::user()->allow_access('master.medical_worker.activate'))
                                <button type="button" ng-if='formData.is_active == 0' class="btn btn-default btn-sm" ng-click='activate({{ $id }})'>Aktifkan</button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Nama<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.name %>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.address %>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Telepon
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.phone %>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Kota
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.city_id %>

                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Spesialisasi
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.specialization_id %>

                                            
                                        
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Poliklinik
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.polyclinic_id %>

                                            
                                        
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-5 col-sm-5 col-xs-12">Diskon farmasi(%)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.pharmacy_disc_percent %>%

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-5 col-sm-5 col-xs-12">Fee pengirim LAB(%)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.lab_sender_fee_value %>%

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 col-sm-5 col-xs-12">Fee pengirim LAB rujukan(%)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.lab_refer_sender_fee_value %>%

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-5 col-sm-5 col-xs-12">Fee pengirim X-Ray(%)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.xray_sender_fee_value %>%

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-5 col-sm-5 col-xs-12">Fee baca X-Ray(%)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.xray_read_fee_value %>%

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-5 col-sm-5 col-xs-12">Fee pengirim ECG(%)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.ecg_sender_fee_value %>%

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-5 col-sm-5 col-xs-12">Fee baca ECG(%)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.ecg_read_fee_value %>%

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-5 col-sm-5 col-xs-12">Fee tindakan medis(%)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.medical_action_fee_value %>%

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-5 col-sm-5 col-xs-12">Fee visite/konsul(%)
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.consultation_fee_value %>%

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                <div class="btn-group pull-left">

                                    <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Kembali</button>
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
<script src="{{ asset('') }}js/master/doctor/doctorShowCtrl.js"></script>


@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="registrationCreate" ng-cloak>
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-6">
                        <span class='pull-right' ng-show='formData.id'>
                            
                            <a class='btn btn-xs btn-outline-dark'><i class='fa fa-barcode'></i> <% formData.code %></a>
                            <a class='btn btn-xs btn-outline-primary'><i class='fa fa-thumb-tack'></i> <% formData.status_name %></a>
                            <a class='btn btn-xs btn-outline-success'><i class='fa fa-calendar'></i> <% formData.date | fullDate %></a>
                        </span>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tanggal<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class='form-control' ng-model='formData.date' datepick>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Pasien<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12" {!! Auth::user()->contact_id != null ? (Auth::user()->contact->is_doctor == 1 ? 'ng-init="is_new_patient = 1"' : '') : '' !!}>
                                        <div class="input-group">
                                            <input type="text" id="first-name" ng-model='formData.patient.name' required="required" class="form-control col-md-7 col-xs-12" ng-click='showPatients()' ng-readonly='!is_new_patient' ng-change="changeFamilyName()">
                                            <div class="input-group-addon" ng-click='fillPatient()'>
                                                <i class="fa fa-pencil" ng-show='!is_new_patient'></i>
                                                <i class="fa fa-close" ng-show='is_new_patient'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Jenis pasien<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label class="radio-inline">
                                            <input type="radio" ng-model="formData.patient_type" ng-value='"UMUM"'>
                                            <h5>Umum</h5>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" ng-model="formData.patient_type" ng-value='"ASURANSI SWASTA"'>
                                            <h5>Asuransi swasta</h5>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Jenis kelamin<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <label class="radio-inline">
                                            <input type="radio" ng-model="formData.patient.gender" name='type' ng-value='"PRIA"' ng-disabled='!is_new_patient'>
                                            <h5>Pria</h5>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" ng-model="formData.patient.gender" name='type' ng-value='"WANITA"' ng-disabled='!is_new_patient'>
                                            <h5>Wanita</h5>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Alamat
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea class='form-control' ng-model="formData.patient.address" id="" cols="20" rows="10" ng-disabled='!is_new_patient'  ng-change="changeFamilyName()"></textarea>
                                    </div>
                                </div>

                                <div class="form-group" ng-if='formData.is_new_city'>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Provinsi
                                    </label> 
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control" data-placeholder-text-single="'Pilih Provinsi'" required='required' chosen allow-single-deselect="false" ng-model="formData.patient.province_id" ng-options="c.id as c.name for c in data.province">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Kota
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group">   
                                            <span ng-if='!formData.is_new_city'>  
                                                <select class="form-control" data-placeholder-text-single="'Pilih Kota'" required='required' chosen allow-single-deselect="false" ng-model="formData.patient.city_id" ng-options="c.id as c.name group by c.province.name for c in data.city" ng-disabled='!is_new_patient'>
                                                    <option value=""></option>
                                                </select>
                                            </span>
                                            <input type="text" class="form-control" ng-model='formData.patient.city_id' required ng-if='formData.is_new_city'>
                                            <div class="input-group-addon" ng-show='is_new_patient' ng-click='formData.is_new_city = !formData.is_new_city'>
                                                <i class="fa fa-pencil" ng-show='!formData.is_new_city'></i>
                                                <i class="fa fa-close" ng-show='formData.is_new_city'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Tanggal lahir
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  ng-model='formData.patient.birth_date' ng-disabled='!is_new_patient' class="form-control col-md-7 col-xs-12" ng-change='countAge()' datepick>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Umur
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  ng-model='formData.patient.age' class="form-control col-md-7 col-xs-12" readonly only-num>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 col-sm-12 col-xs-12">No. telepon yang bisa dihubungi 
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <input type="text"  ng-model='formData.patient.phone' class="form-control col-md-7 col-xs-12" ng-disabled='!is_new_patient'>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <h2>Penanggung jawab</h2>
                                <span ng-show='formData.patient_type == "ASURANSI SWASTA"'>

                                    <div class="form-group">
                                        <label class="col-md-12 col-xs-12" for="first-name">Nama instansi / asuransi
                                        </label>
                                        <div class="col-md-10 col-xs-12">
                                            <select class="form-control" data-placeholder-text-single="'Pilih instansi / asuransi'" chosen allow-single-deselect="false" ng-model="formData.agency_id" ng-options="c.id as c.name for c in data.agency">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-xs-12" for="first-name">ID Kartu / No. Polis
                                        </label>
                                        <div class="col-md-10 col-xs-12">
                                            <input type="text" ng-model="formData.insurance_code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-xs-12" for="first-name">Atas nama
                                        </label>
                                        <div class="col-md-10 col-xs-12">
                                            <input type="text" ng-model="formData.insurance_owner_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-xs-12" for="first-name">Plafon hutang
                                        </label>
                                        <div class="col-md-10 col-xs-12">
                                            <input type="text" ng-model="formData.plafon" class="form-control" jnumber2 only-num>
                                        </div>
                                    </div>
                                </span>
                                <span >
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-xs-12" for="first-name">Jenis
                                        </label>
                                        <div class="col-md-10 col-xs-12">
                                            <select class="form-control" data-placeholder-text-single="'Pilih jenis'" chosen allow-single-deselect="false" ng-model="formData.family_type"  ng-change="changeFamilyName()">
                                                <option value=""></option>
                                                <option value="ORANG TUA">Orang tua</option>
                                                <option value="DIRI SENDIRI">Diri sendiri</option>
                                                <option value="SUAMI/ISTRI">Suami/istri</option>
                                                <option value="KELUARGA">Keluarga</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 col-xs-12">Nama orang tua/suami/istri
                                        </label>
                                        <div class="col-md-10 col-xs-12">
                                            <input type="text" class="form-control" ng-model="formData.patient.family.name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-xs-12" for="first-name">Alamat
                                        </label>
                                        <div class="col-md-10 col-xs-12">
                                            <textarea class="form-control" ng-model="formData.patient.family.address"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 col-xs-12" for="first-name">Pekerjaan
                                        </label>
                                        <div class="col-md-10 col-xs-12">
                                            <select class="form-control" data-placeholder-text-single="'Pilih Pekerjaan'" required='required' chosen allow-single-deselect="false" ng-model="formData.patient.family.job" 
                                            >
                                            <option value=""></option>
                                            <option value="PNS">PNS</option>
                                            <option value="SWASTA">Swasta</option>
                                            <option value="WIRASWASTA">Wiraswasta</option>
                                            <option value="TNI/POLRI">TNI/Polri</option>
                                            <option value="PETANI">Petani</option>
                                            <option value="NELAYAN">Nelayan</option>
                                            <option value="PTT">PTT</option>
                                            <option value="IBU RTGA">Ibu RTGA</option>
                                        </select>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <h2>Jadwal</h2>
                    <div class="row" style='margin-left:3mm'>
                        <div class="col-md-3">
                            <label>Tujuan</label>
                            <select class="form-control" data-placeholder-text-single="'Pilih Tujuan'"  chosen allow-single-deselect="false" ng-model="detail.destination" ng-change='adjustDestination()'>
                                <option value=""></option>
                                <option value="POLIKLINIK">Poliklinik</option>
                                <option value="MEDICAL CHECK-UP">Medical Check-up</option>
                                <option value="LABORATORIUM">Laboratorium</option>
                                <option value="RADIOLOGI">Radiologi</option>
                                <option value="KEMOTERAPI">Kemoterapi</option>
                                <option value="RUANG TINDAKAN">Ruang tindakan</option>
                            </select>
                        </div>
                        <div class="col-md-3" ng-show='detail.destination == "POLIKLINIK"'>
                            <div class="form-group">
                                <label>Poliklinik</label>
                                <select class="form-control" data-placeholder-text-single="'Pilih Poliklinik'"  chosen allow-single-deselect="false" ng-model="detail.polyclinic_id" ng-options="c.id as c.name for c in data.polyclinic" ng-change="changeDoctor()">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class='col-md-12'>Waktu</label>
                                <div class="col-md-12" style='display:flex'>
                                    <input type="text" class="form-control" ng-model='detail.time' clockpick>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">

                                <label>Dokter</label>
                                <div class="input-group">
                                    <select class="form-control" data-placeholder-text-single="'Pilih Dokter'"  chosen allow-single-deselect="false" ng-model="detail.doctor_id" ng-options="c.id as c.name for c in doctor">
                                        <option value=""></option>
                                    </select>
                                    <div class="input-group-btn">
                                        <button type='button' class='btn btn-success' ng-click='submitDetail()' ng-disabled='!detail.destination || !detail.doctor_id || !detail.time || (detail.destination == "POLIKLINIK" && !detail.polyclinic_id)'><i class="fa fa-check"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id='registration_detail_datatable'>
                                <thead>
                                    <tr>
                                        <td>Tujuan</td>
                                        <td>Waktu</td>
                                        <td>Dokter</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
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

<div class="modal fade" id="patientModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:80%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Daftar Pasien</h4>
            </div>
            <div class="modal-body">

                <table class="table table-bordered" id='patient_datatable' style='width:100%'>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Pasien</th>
                            <th>Umur</th>
                            <th>Kota</th>
                            <th>Jenis kelamin</th>
                            <th>Golongan darah</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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
<script src="{{ asset('') }}js/registration/registration/registrationCreateCtrl.js"></script>


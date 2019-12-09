@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="patientCreate" ng-cloak>
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                            
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <select ng-model='formData.patient_type' class='form-control input-sm col-md-3'>
                                                <option value=""></option>
                                                <option value="ANAK">Anak</option>
                                                <option value="NYONYA">Nyonya</option>
                                                <option value="NONA">Nona</option>
                                                <option value="TUAN">Tuan</option>
                                            </select>
                                        </div>    
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            
                                            <input type="text" class="input-sm form-control col-md-9" ng-model="formData.name" required autofocus/>
                                        </div>    
                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis kelamin<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <label class="radio-inline">
                                      <input type="radio" ng-model="formData.gender" name='gender' ng-value='"PRIA"'>
                                      <h5>Pria</h5>
                                    </label>
                                     <label class="radio-inline">
                                          <input type="radio" ng-model="formData.gender" name='gender' ng-value='"WANITA"'>
                                          <h5>Wanita</h5>
                                     </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telepon
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" ng-model='formData.phone' required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No KTP/SIM
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" ng-model='formData.civil_code' class="form-control col-md-7 col-xs-10">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea class='form-control' ng-model="formData.address" id="" cols="20" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kota
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control" data-placeholder-text-single="'Pilih Kota'" required chosen allow-single-deselect="false" ng-model="formData.city_id" ng-change="changeDistrict()" ng-options="c.id as c.name group by c.province.name for c in data.city">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kecamatan
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group">
                                            <span ng-show='!is_create_district'>
                                                
                                                <select class="form-control" data-placeholder-text-single="'Pilih Kecamatan'" required='required' chosen allow-single-deselect="false" ng-model="formData.district_id" ng-change="changeVillage()" ng-options="c.id as c.name for c in district">
                                                    <option value=""></option>
                                                </select>
                                            </span>
                                            <input type="text" ng-model='formData.district_id' class='form-control' ng-show='is_create_district'>
                                            <div class="input-group-addon" ng-click='is_create_district = !is_create_district;formData.district_id=null'>
                                                <i class="fa fa-pencil"  ng-show='!is_create_district'></i>
                                                <i class="fa fa-close" ng-show='is_create_district'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Desa
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group">
                                            <span ng-show='!is_create_village'>
                                                
                                                <select class="form-control" data-placeholder-text-single="'Pilih Desa'" required='required' chosen allow-single-deselect="false" ng-model="formData.village_id" ng-options="c.id as c.name for c in village">
                                                    <option value=""></option>
                                                </select>
                                            </span>
                                            <input type="text" ng-model='formData.village_id' class='form-control' ng-show='is_create_village'>
                                            <div class="input-group-addon" ng-click='is_create_village = !is_create_village;formData.village_id=null'>
                                                <i class="fa fa-pencil"  ng-show='!is_create_village'></i>
                                                <i class="fa fa-close" ng-show='is_create_village'></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal lahir
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" required='required'  ng-model='formData.birth_date' class="form-control col-md-7 col-xs-12" ng-change='countAge()' datepick>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Umur
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  required='required' ng-model='formData.age' class="form-control col-md-7 col-xs-12" only-num>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Golongan darah<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <label class="radio-inline">
                                      <input type="radio" ng-model="formData.blood_type" ng-value='"A"'>
                                      <h5>A</h5>
                                    </label>
                                     <label class="radio-inline">
                                          <input type="radio" ng-model="formData.blood_type" ng-value='"AB"'>
                                          <h5>AB</h5>
                                     </label>
                                     <label class="radio-inline">
                                          <input type="radio" ng-model="formData.blood_type" ng-value='"B"'>
                                          <h5>B</h5>
                                     </label>
                                     <label class="radio-inline">
                                          <input type="radio" ng-model="formData.blood_type" ng-value='"O"'>
                                          <h5>O</h5>
                                     </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Agama
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control" data-placeholder-text-single="'Pilih Agama'" required='required' chosen allow-single-deselect="false" ng-model="formData.religion" 
                                        >
                                            <option value=""></option>
                                            <option value="ISLAM">Islam</option>
                                            <option value="KRISTEN">Kristen</option>
                                            <option value="KATOLIK">Katolik</option>
                                            <option value="HINDU">Hindu</option>
                                            <option value="BUDHA">Budha</option>
                                            <option value="KONGHUCU">Konghucu</option>
                                            <option value="LAINNYA">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status perkawinan
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control" data-placeholder-text-single="'Pilih Status Perkawinan'" chosen allow-single-deselect="false" ng-model="formData.marriage_status" 
                                        >
                                            <option value=""></option>
                                            <option value="MENIKAH">Menikah</option>
                                            <option value="BELUM MENIKAH">Belum menikah</option>
                                            <option value="DUDA">Duda</option>
                                            <option value="JANDA">Janda</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Pekerjaan
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control" data-placeholder-text-single="'Pilih Pekerjaan'" chosen allow-single-deselect="false" ng-model="formData.job" 
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

                                <div class="ln_solid"></div>
                                <h2>Data Keluarga</h2>
                                <div class="form-group">
                                            
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Ayah/Ibu/Suami/Istri<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                            
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            
                                            <input type="text" class="input-sm form-control col-md-9" ng-model="formData.family.name"/>
                                        </div>    
                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea class='form-control' ng-model="formData.family.address" id="" cols="20" rows="5"></textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kota
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control" data-placeholder-text-single="'Pilih Kota'" required='required' chosen allow-single-deselect="false" ng-model="formData.family.city_id" ng-options="c.id as c.name group by c.province.name for c in data.city">
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telepon
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" ng-model='formData.family.phone' class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Pekerjaan
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control" data-placeholder-text-single="'Pilih Pekerjaan'" chosen allow-single-deselect="false" ng-model="formData.family.job" 
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
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1">
                                <div class="btn-group">

                                    <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='formData = {}'>Reset</button>
                                    <button type="button" ng-click='submitForm()' ng-disabled='disBtn' class="btn btn-success btn-sm">Simpan</button>
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
<script src="{{ asset('') }}js/master/patient/patientCreateCtrl.js"></script>


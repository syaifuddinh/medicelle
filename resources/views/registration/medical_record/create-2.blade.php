@include('registration/medical_record/create-header')
                         <ul class="nav nav-pills">
                            @if(Specialization::allow_access('anamnesa') == 1)
                                <li><a href="{{ route('medical_record.edit', ['id' => $id]) }}">Anamnesa</a></li>
                            @endif

                            @if(Specialization::allow_access('anamnesa_obgyn') == 1)
                                <li class="active"><a href="#">Anamnesa(Obgyn)</a></li>
                            @endif
                          </ul>  
                      </nav>
                        <div id="role_layer" style="position:relative">
                            @if(Specialization::readonly('anamnesa_obgyn') == 1)
                                <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                            @endif

                            <div class="ln_solid"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                                
                                        <label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Keluhan utama<span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <textarea class="form-control" ng-model='formData.obgyn_main_complaint'  ng-change="submitOne('obgyn_main_complaint')"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <h2>Maternitas</h2>

                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Menarche usia
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <div class="input-group">
                                                <input type="text"  ng-model='formData.menarche_age' class="form-control col-md-7 col-xs-12" ng-change='submitOne("menarche_age")' only-num>
                                                <div class="input-group-addon">
                                                    Tahun
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Siklus haid
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text"  ng-model='formData.siklus_haid' ng-change='submitOne("siklus_haid")' class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Jumlah pemakaian pembalut/hr
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text"  only-num ng-model='formData.jumlah_pemakaian_pembalut' ng-change='submitOne("jumlah_pemakaian_pembalut")' class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Lamanya
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <div class="input-group">
                                                <input type="text" ng-model='formData.lama_pemakaian_pembalut' ng-change='submitOne("lama_pemakaian_pembalut")' class="form-control col-md-7 col-xs-12" only-num maxlength='3'>
                                                <div class="input-group-addon">
                                                    Hari
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Riwayat vaksinasi
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea ng-model='formData.additional.riwayat_vaksinasi' ng-change='submitOne("additional.riwayat_vaksinasi")' class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Apakah teratur ?
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <label class="radio-inline">
                                          <input type="radio" ng-model="formData.is_tidy" ng-value='1' ng-change='submitOne("is_tidy")'>
                                          <h5>Ya</h5>
                                        </label>
                                         <label class="radio-inline">
                                              <input type="radio" ng-model="formData.is_tidy" ng-value='0' ng-change='submitOne("is_tidy")'>
                                              <h5>Tidak</h5>
                                         </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">HPHT
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text"  ng-model='formData.hpht' class="form-control col-md-7 col-xs-12" ng-change='submitOne("hpht")' datepick>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Keluhan haid
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <textarea ng-model='formData.haid_complaint' ng-change='submitOne("haid_complaint")' class="form-control"></textarea>   
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Papsmear
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <textarea ng-model='formData.additional.obgyn_papsmear' class="form-control" ng-change='submitOne("additional.obgyn_papsmear")'></textarea>   
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <h2>Riwayat perkawinan</h2>

                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label class="col-md-4 col-sm-4 col-xs-12">Status
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label class="radio-inline">
                                                <input type="radio" ng-model='formData.marriage_status' ng-value='"KAWIN"' ng-change='submitOne("marriage_status")'> Kawin
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" ng-model='formData.marriage_status' ng-value='"BELUM KAWIN"' ng-change='submitOne("marriage_status")'> Belum Kawin
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" ng-model='formData.marriage_status' ng-value='"JANDA"' ng-change='submitOne("marriage_status")'> Janda
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Lama menikah
                                        </label>
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <div class="input-group">
                                                <input type="text" ng-model='formData.marriage_duration' class="form-control col-md-7 col-xs-12" ng-change='submitOne("marriage_duration")' max-length="2" only-num>
                                                <div class="input-group-addon">
                                                    Tahun
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                             <h2>Riwayat kehamilan, persalinan, dan nifas</h2>
                            <div class="row">
                                <div class="col-md-12" style='display:flex'>

                                    <div class="form-group col-md-3 mg-r2">                                    
                                        <label class='col-md-12'>Anak ke</label>
                                        <input type="text" class='form-control' ng-model='kid_history.kid_order' only-num>
                                    </div>
                                    
                                    <div class="form-group col-md-3 mg-r2">                                    
                                        <label class='col-md-12'>Thn partus</label>
                                        <input type="text" class='form-control' ng-model='kid_history.partus_year' only-num>
                                    </div>
                                    <div class="form-group col-md-3 mg-r2">                                    
                                        <label class='col-md-12'>Tempat partus</label>
                                        <input type="text" class='form-control' ng-model='kid_history.partus_location'>
                                    </div>
                                    
                                    <div class="form-group col-md-3 mg-r2">                                    
                                        <label class='col-md-12'>Umur hamil <i class="fa fa-moon-o" ng-show='!kid_history.is_pregnant_week_age' ng-click='kid_history.is_pregnant_week_age = !kid_history.is_pregnant_week_age'></i><i class="fa fa-mail-reply" ng-show='kid_history.is_pregnant_week_age' ng-click='kid_history.is_pregnant_week_age = !kid_history.is_pregnant_week_age'></i></label>
                                        <div class="input-group">
                                            
                                            <input type="text" class='form-control' ng-model='kid_history.pregnant_month_age' only-num>
                                            <span class="input-group-addon">
                                                Bulan
                                            </span>
                                            <input type="text" class='form-control' ng-model='kid_history.pregnant_week_age' ng-show='kid_history.is_pregnant_week_age' only-num>
                                            <span class="input-group-addon" ng-show='kid_history.is_pregnant_week_age'>
                                                Minggu
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-md-12" style='display:flex'>
                                    
                                    <div class="form-group col-md-3 mg-r2">                                    
                                        <label class='col-md-12'>Jenis persalinan</label>
                                        <input type="text" class='form-control' ng-model='kid_history.birth_type'>
                                    </div>
                                    <div class="form-group col-md-3 mg-r2">                                    
                                        <label class='col-md-12'>Penolong persalinan</label>
                                        <input type="text" class='form-control' ng-model='kid_history.birth_helper'>
                                    </div>
                                    <div class="form-group col-md-3 mg-r2">                                    
                                        <label class='col-md-12'>Penyulit</label>
                                        <input type="text" class='form-control' ng-model='kid_history.birth_obstacle'>
                                    </div>

                                    <div class="form-group col-md-3">                                    
                                        <label class='col-md-12'>Jenis kelamin</label>
                                        <label class="radio-inline">
                                            <input type="radio" ng-model='kid_history.baby_gender' ng-value='"PRIA"'>Pria
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" ng-model='kid_history.baby_gender' ng-value='"WANITA"'>Wanita
                                        </label>
                                    </div>

                                </div>
                                
                                <div class="col-md-12" style='display:flex'>
                                    
                                    <div class="form-group col-md-3 mg-r2">                                    
                                        <label class='col-md-12'>BB</label>
                                        <div class="input-group">
                                            <input type="text" class='form-control' ng-model='kid_history.weight' only-num>
                                            <div class="input-group-addon">
                                                Kg
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">                                    
                                        <label class='col-md-12'>PB</label>
                                        <div class="input-group">
                                            <input type="text" class='form-control' ng-model='kid_history.long' only-num>
                                            <div class="input-group-addon">
                                                cm
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">                                    
                                        <label class='col-md-12'>Komplikasi nifas</label>
                                        <div class="input-group">
                                            <input type="text" class='form-control' ng-model='kid_history.komplikasi_nifas'>
                                            <div class="input-group-btn">
                                                <button type='button' class='btn btn-success' ng-click='submitKidHistory()' ng-disabled='!kid_history.kid_order'><i class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered" id='kid_history_datatable'>
                                        <thead>
                                            <tr>
                                                <td>Anak ke</td>
                                                <td>Thn partus</td>
                                                <td>Tempat partus</td>
                                                <td>Umur hamil</td>
                                                <td>Jenis persalinan</td>
                                                <td>Penolong persalinan</td>
                                                <td>Penyulit</td>
                                                <td>Jenis kelamin</td>
                                                <td>BB(cm)</td>
                                                <td>PB(cm)</td>
                                                <td>Komplikasi nifas</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                                
                                        <label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Riwayat penyakit<span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <textarea class="form-control" ng-model='formData.obgyn_current_disease'  ng-change="submitOne('obgyn_current_disease')"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <h2>Riwayat penyakit dahulu</h2>
                            <div class="row disease" allow_update_medical_record>
                                <div class="col-md-12" style='display:flex'>
                                    <div class="form-group col-md-3">
                                        
                                        <label>Penyakit</label>
                                        <input type="text" class='form-control' ng-model="obgyn_disease_history.disease_name">
                                    </div>
                                    <div class="form-group col-md-4 mg-r2">
                                        
                                        <label>Obat yang pernah diminum</label>
                                        <input type="text" class='form-control' ng-model='obgyn_disease_history.cure'>
                                    </div>
                                    <div class="form-group col-md-4 mg-r2">

                                        <label>Kontrol terakhir</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" ng-model='obgyn_disease_history.last_checkup_date' datepick>
                                            <div class="input-group-btn">
                                                <button type='button' class='btn btn-success' ng-click='submitObgynDiseaseHistory()' ng-disabled='!obgyn_disease_history.disease_name'><i class="fa fa-check"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered" id='obgyn_disease_history_datatable'>
                                        <thead>
                                            <tr>
                                                <td>Penyakit</td>
                                                <td>Obat yang pernah diminum</td>
                                                <td>Terakhir control</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                                    
                                            <label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Riwayat operasi
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea class="form-control" ng-model='formData.additional.obgyn_operasi'  ng-change="submitOne('additional.obgyn_operasi')"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <div class="ln_solid"></div>
                            <h2>Riwayat penyakit keluarga</h2>
                            <div class="row disease" allow_update_medical_record>
                                <div class="col-md-12" style='display:flex'>
                                    <div class="form-group col-md-3">
                                        
                                        <label>Penyakit</label>
                                        <input type="text" class='form-control' ng-model="obgyn_family_disease_history.disease_name">
                                            
                                    </div>
                                    <div class="form-group col-md-4 mg-r2">
                                        
                                        <label>Obat yang pernah diminum</label>
                                        <input type="text" class='form-control' ng-model='obgyn_family_disease_history.cure'>
                                    </div>
                                    <div class="form-group col-md-4 mg-r2">

                                        <label>Kontrol terakhir</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" ng-model='obgyn_family_disease_history.last_checkup_date' datepick>
                                            <div class="input-group-btn">
                                                <button type='button' class='btn btn-success' ng-click='submitObgynFamilyDiseaseHistory()' ng-disabled='!obgyn_family_disease_history.disease_name'><i class="fa fa-check"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered" id='obgyn_family_disease_history_datatable'>
                                        <thead>
                                            <tr>
                                                <td>Penyakit</td>
                                                <td>Obat yang pernah diminum</td>
                                                <td>Terakhir control</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <h2>Riwayat ginekologi</h2>
                            <div class="row ginekologi" allow_update_medical_record>
                                <div class="col-md-12" style='display:flex'>
                                    <div class="form-group col-md-6">
                                        
                                        <label>Nama</label>
                                        <div class="input-group">
                                            <div class="input-group">
                                                <input type="text" class='form-control' ng-model="ginekologi_history.name">
                                                <div class="input-group-btn">
                                                    <button type='button' class='btn btn-success' ng-click='submitGinekologiHistory()' ng-disabled='!ginekologi_history.name'><i class="fa fa-check"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                            
                                    </div>
                                    
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered" id='ginekologi_history_datatable'>
                                        <thead>
                                            <tr>
                                                <td>Nama</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>

                            
                            <div class="ln_solid"></div>
                            <h2>Riwayat KB</h2>
                            <div class="row" allow_update_medical_record>
                                <div class="col-md-12" style='display:flex'>
                                    <div class="form-group col-md-3">
                                        
                                        <label>KB yang pernah digunakan</label>
                                        <input type="text" class='form-control' ng-model="kb_history.name">
                                            
                                    </div>
                                    <div class="form-group col-md-4 mg-r2">

                                        <label>Lama</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" ng-model='kb_history.duration' maxlength="2" only-num >
                                            <div class="input-group-addon"> 
                                                Tahun
                                            </div>  
                                            <div class="input-group-btn">
                                                <button type='button' class='btn btn-success' ng-click='submitKbHistory()' ng-disabled='!kb_history.name || !kb_history.duration'><i class="fa fa-check"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                            </div>
                            <div class="row disease">
                                <div class="col-md-12">
                                    <table class="table table-bordered" id='kb_history_datatable'>
                                        <thead>
                                            <tr>
                                                <td>Jenis KB</td>
                                                <td>Lama( Tahun )</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="ln_solid"></div>
                            <h2>Riwayat Komplikasi KB</h2>
                            <div class="row disease" allow_update_medical_record >
                                <div class="col-md-12" style='display:flex'>
                                    <div class="form-group col-md-6">
                                        
                                        <label>Jenis komplikasi</label>

                                        <div class="input-group">
                                            <input type="text" class='form-control' ng-model="komplikasi_kb_history.name">
                                            <div class="input-group-btn">
                                                <button type='button' class='btn btn-success' ng-click='submitKomplikasiKbHistory()' ng-disabled='!komplikasi_kb_history.name'><i class="fa fa-check"></i></button>
                                            </div>        
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>

                            <div class="row disease">
                                <div class="col-md-12">
                                    <table class="table table-bordered" id='komplikasi_kb_history_datatable'>
                                        <thead>
                                            <tr>
                                                <td>Jenis komplikasi</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-right" allow_update_medical_record >
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm">Simpan</button>
                                </div>
                                <div class="btn-group pull-left">
                                    <button class="btn btn-default btn-sm" ng-click="backtohome()" type="button">Batal</button>
                                    <button  allow_update_medical_record class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/medical_record/create-footer')
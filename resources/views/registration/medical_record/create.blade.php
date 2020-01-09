@include('registration/medical_record/create-header')
                         <ul class="nav nav-pills">
                            @if(Specialization::allow_access('anamnesa') == 1)
                                <li class="active"><a href="#">Anamnesa</a></li>
                            @endif
                            @if(Specialization::allow_access('anamnesa_obgyn') == 1)
                                <li><a href="{{ route('medical_record.edit.2', ['id' => $id]) }}">Anamnesa(Obgyn)</a></li>
                            @endif
                          </ul> 
                      </nav>
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('anamnesa') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="ln_solid"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                                    
                                            <label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Keluhan utama<span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea class="form-control" ng-model='formData.main_complaint' ng-change="submitOne('main_complaint')"></textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                                    
                                            <label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Riwayat penyakit sekarang<span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea class="form-control" ng-model='formData.current_disease'  ng-change="submitOne('current_disease')"></textarea>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="ln_solid"></div>
                                <h2>Riwayat penyakit dahulu</h2>
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-3">
                                            
                                            <label>Penyakit</label>
                                            <input type="text" class='form-control' ng-model="disease_history.disease_name">
                                        </div>
                                        <div class="form-group col-md-4 mg-r2">
                                            
                                            <label>Obat yang pernah diminum</label>
                                            <input type="text" class='form-control' ng-model='disease_history.cure'>
                                        </div>
                                        <div class="form-group col-md-4 mg-r2">

                                            <label>Kontrol terakhir</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" ng-model='disease_history.last_checkup_date' datepick>
                                                <div class="input-group-btn">
                                                    <button type='button' class='btn btn-success' ng-click='submitDiseaseHistory()' ng-disabled='!disease_history.disease_name'><i class='fa fa-check'></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='disease_history_datatable'>
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
                                                    <textarea class="form-control" ng-model='formData.operasi'  ng-change="submitOne('operasi')"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                <div class="ln_solid"></div>
                                <h2>Riwayat penyakit keluarga</h2>
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-3">
                                            
                                            <label>Penyakit</label>
                                            <input type="text" class='form-control' ng-model="family_disease_history.disease_name">
                                                
                                        </div>
                                        <div class="form-group col-md-4 mg-r2">
                                            
                                            <label>Keterangan</label>
                                            <div class="input-group">
                                                <input type="text" class='form-control' ng-model='family_disease_history.description'>
                                                <div class="input-group-btn">
                                                    <button type='button' class='btn btn-success' ng-click='submitFamilyDiseaseHistory()' ng-disabled='!family_disease_history.disease_name'><i class='fa fa-check'></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='family_disease_history_datatable'>
                                            <thead>
                                                <tr>
                                                    <td>Penyakit</td>
                                                    <td>Keterangan</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="ln_solid hidden"></div>
                                <h2 class='hidden'>Skrining nyeri</h2>
                                <div class="row hidden">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-6">
                                            
                                            <label>Lokasi nyeri</label>
                                            
                                            <input type="text" class='form-control' ng-model='pain_history.pain_location'>
                                        </div>
                                        <div class="form-group col-md-6">
                                            
                                            <label>Kualitas nyeri</label>
                                            <div class="input-group">
                                                <span ng-show='!is_other_pain_type'>
                                                    
                                                    <select class="form-control col-md-12" data-placeholder-text-single="'Pilih Kualitas Nyeri'"  chosen allow-single-deselect="false" ng-model="pain_history.pain_type">
                                                        <option value=""></option>
                                                        <option value="MENGIRIS">Mengiris</option>
                                                        <option value="MENUSUK">Menusuk</option>
                                                        <option value="MENEKAN">Menekan</option>
                                                        <option value="MENYEBAR">Menyebar</option>
                                                    </select>
                                                </span>
                                                <input type="text" class='form-control' ng-model='pain_history.pain_type' ng-show='is_other_pain_type'>
                                                <div class="input-group-addon" ng-click="is_other_pain_type = !is_other_pain_type">
                                                    <i class="fa fa-pencil" ng-show='!is_other_pain_type'></i>
                                                    <i class="fa fa-close" ng-show='is_other_pain_type'></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-md-12" style='display:flex'>
                                        
                                        <div class="form-group col-md-6">
                                            
                                            <label>Lamanya nyeri</label>
                                            <input type="text" class='form-control' ng-model='pain_history.pain_duration'>
                                        </div>
                                        <div class="form-group col-md-6">
                                            
                                            <label>Kapan nyeri timbul ?</label>
                                            <div class="input-group">
                                                <input type="text" class='form-control' ng-model='pain_history.emergence_time'>
                                                <div class="input-group-btn">
                                                    <button type='button' class='btn btn-success' ng-click='submitPainHistory()' ng-disabled='!pain_history.pain_location'><i class="fa fa-check"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row hidden">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='pain_history_datatable'>
                                            <thead>
                                                <tr>
                                                    <td>Lokasi nyeri</td>
                                                    <td>Kualitas nyeri</td>
                                                    <td>Lamanya nyeri</td>
                                                    <td>Kapan nyeri timbul ?</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>



                                <div class="ln_solid"></div>
                                <h2>Riwayat pengobatan</h2>
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-3 mg-r2">
                                            
                                            <label>Nama obat</label>
                                            
                                            <input type="text" class='form-control' ng-model='pain_cure_history.cure'>
                                        </div>
                                        
                                        <div class="form-group col-md-5">
                                            
                                            <label>Mulai kapan ?</label>
                                            <div class="input-group">
                                                <input type="text" class='form-control' ng-model='pain_cure_history.emergence_time'>
                                                <div class="input-group-btn">
                                                    <button type='button' class='btn btn-success' ng-click='submitPainCureHistory()' ng-disabled='!pain_cure_history.cure'><i class="fa fa-check"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='pain_cure_history_datatable'>
                                            <thead>
                                                <tr>
                                                    <td>Nama obat</td>
                                                    <td>Mulai kapan ?</td>
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
                                                    
                                            <label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Riwayat psiko sosial
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea class="form-control" ng-model='formData.psiko_sosial'  ng-change="submitOne('psiko_sosial')"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="form-group hidden">
                                    <label class="col-md-3 col-sm-3 col-xs-12">Apakah nyeri menganggu aktivitas<span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                      <label class="radio-inline">
                                      <input type="radio" ng-model="formData.is_disturb" ng-value='1'>
                                      <h5>Ya</h5>
                                    </label>
                                     <label class="radio-inline">
                                          <input type="radio" ng-model="formData.is_disturb" ng-value='0'>
                                          <h5>Tidak</h5>
                                     </label>
                                    </div>
                                </div>

                                <div class="form-group hidden">
                                    <label>Skala nyeri</label>
                                    <a href="#" class='btn btn-xs btn-primary pull-right' id='pain_status'>
                                        <%
                                            formData.pain_score == 0 ? 'Tidak ada rasa nyeri' : (formData.pain_score == 1 ? 'Nyeri seperti gatal gigitan nyamuk' : (formData.pain_score == 2 ? 'Terasa nyeri seperti dicubit/melilit' : (formData.pain_score == 3 ? 'Nyeri sangat terasa seperti ditonjok bagian wajah atau disuntik' : (formData.pain_score == 4 ? 'Nyeri yang kuat seperti sakit gigi dan nyeri disengat tawon' : (formData.pain_score == 5 ? 'Nyeri yang tertekan seperti terkilir, keseleo' : (formData.pain_score == 6 ? 'Nyeri yang seperti tertusuk-tusuk menyebabkan tidak fokus dan komunikasi terganggu' : (formData.pain_score == 7 ? 'Nyeri yang menusuk begitu kuat menyebabkan tidak bisa berkomunikasi dengan baik dan tidak mampu melakukan perawatan sendiri' : (formData.pain_score == 8 ? 'Nyeri yang begitu kuat sehingga menyebabkan tidak dapat berfikir jernih' : (formData.pain_score == 9 ? 'Nyeri yang menyiksa tak tertahankan sehingga ingin segera menghilangkan nyerinya' : 'Nyeri yang tidak terbayangkan dan tidak dapat diungkapkan sampai tidak sadarkan diri')))))))))
                                        %>
                                    </a>
                                    <rzslider rz-slider-model="formData.pain_score" rz-slider-options="{floor:0, ceil:10}" ></rzslider>
                                </div>
                                <div class="ln_solid"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-right">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm">Simpan</button>
                                </div>
                                <div class="btn-group pull-left">

                                    <button class="btn btn-default btn-sm" ng-click="backtohome()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/medical_record/create-footer')
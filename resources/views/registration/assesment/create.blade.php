@include('registration/assesment/create-header')
                         <ul class="nav nav-pills">
                            <li class="active"><a href="#">Langkah 1</a></li>
                            <li><a href="{{ route('assesment.edit.2', ['id' => $id]) }}">Langkah 2</a></li>
                            <li><a href="{{ route('assesment.edit.3', ['id' => $id]) }}">Langkah 3</a></li>
                            <li><a href="{{ route('assesment.edit.4', ['id' => $id]) }}">Langkah 4</a></li>
                            <li><a href="{{ route('assesment.edit.history', ['id' => $id]) }}">Riwayat</a></li>
                          </ul> 
                      </nav>
                        <div class="ln_solid"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                            
                                    <label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Keluhan utama<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea class="form-control" ng-model='formData.main_complaint' ng-change='submitOne("main_complaint")'></textarea>
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
                                    <select class="form-control col-md-12" data-placeholder-text-single="'Pilih Penyakit'"  chosen allow-single-deselect="false" ng-options="c.id as c.name group by c.category.name for c in data.disease" ng-model="disease_history.disease_id">
                                        <option value=""></option>
                                    </select>
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
                                            <button type='button' class='btn btn-success' ng-click='submitDiseaseHistory()' ng-disabled='!disease_history.disease_id'><i class="fa fa-check"></i></button>
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
                        <h2>Riwayat penyakit keluarga</h2>
                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                <div class="form-group col-md-3">
                                    
                                    <label>Penyakit</label>
                                    <select class="form-control col-md-12" data-placeholder-text-single="'Pilih Penyakit'"  chosen allow-single-deselect="false" ng-options="c.id as c.name group by c.category.name for c in data.disease" ng-model="family_disease_history.disease_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mg-r2">
                                    
                                    <label>Obat yang pernah diminum</label>
                                    <input type="text" class='form-control' ng-model='family_disease_history.cure'>
                                </div>
                                <div class="form-group col-md-4 mg-r2">

                                    <label>Kontrol terakhir</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model='family_disease_history.last_checkup_date' datepick>
                                        <div class="input-group-btn">
                                            <button type='button' class='btn btn-success' ng-click='submitFamilyDiseaseHistory()' ng-disabled='!family_disease_history.disease_id'><i class="fa fa-check"></i></button>
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
                        <h2>Skrining nyeri</h2>
                        <div class="row">
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

                        <div class="row">
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
                        <h2>Obat nyeri yang pernah diminum</h2>
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
                            
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12">Apakah nyeri menganggu aktivitas<span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <label class="radio-inline">
                                  <input type="radio" ng-model="formData.is_disturb" ng-value='1' ng-change='submitOne("is_disturb")'>
                                  <h5>Ya</h5>
                                </label>
                                 <label class="radio-inline">
                                      <input type="radio" ng-model="formData.is_disturb" ng-value='0' ng-change='submitOne("is_disturb")'>
                                      <h5>Tidak</h5>
                                 </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Skala nyeri</label>
                                <a href="#" class='btn btn-xs btn-primary pull-right' id='pain_status'>
                                    <%
                                        formData.pain_score == 0 ? 'Tidak ada rasa nyeri' : (formData.pain_score == 1 ? 'Nyeri seperti gatal gigitan nyamuk' : (formData.pain_score == 2 ? 'Terasa nyeri seperti dicubit/melilit' : (formData.pain_score == 3 ? 'Nyeri sangat terasa seperti ditonjok bagian wajah atau disuntik' : (formData.pain_score == 4 ? 'Nyeri yang kuat seperti sakit gigi dan nyeri disengat tawon' : (formData.pain_score == 5 ? 'Nyeri yang tertekan seperti terkilir, keseleo' : (formData.pain_score == 6 ? 'Nyeri yang seperti tertusuk-tusuk menyebabkan tidak fokus dan komunikasi terganggu' : (formData.pain_score == 7 ? 'Nyeri yang menusuk begitu kuat menyebabkan tidak bisa berkomunikasi dengan baik dan tidak mampu melakukan perawatan sendiri' : (formData.pain_score == 8 ? 'Nyeri yang begitu kuat sehingga menyebabkan tidak dapat berfikir jernih' : (formData.pain_score == 9 ? 'Nyeri yang menyiksa tak tertahankan sehingga ingin segera menghilangkan nyerinya' : 'Nyeri yang tidak terbayangkan dan tidak dapat diungkapkan sampai tidak sadarkan diri')))))))))
                                    %>
                                </a>
                                <rzslider rz-slider-model="formData.pain_score" rz-slider-options="{floor:0, ceil:10}" ></rzslider>
                            </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-right">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm">Selanjutnya</button>
                                </div>
                                <div class="btn-group pull-left">

                                    <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/assesment/create-footer')
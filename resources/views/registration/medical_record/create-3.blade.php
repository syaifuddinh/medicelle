@include('registration/medical_record/create-header')
                         <ul class="nav nav-pills">
                            <li><a href="{{ route('medical_record.edit', ['id' => $id]) }}">Langkah 1</a></li>
                            <li ><a href="{{ route('medical_record.edit.2', ['id' => $id]) }}">Langkah 2</a></li>
                            <li class="active"><a href="#">Langkah 3</a></li>
                            <li ><a href="{{ route('medical_record.edit.4', ['id' => $id]) }}">Langkah 4</a></li>
                          </ul> 
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Maternitas</h2>

                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Menarche usia
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text"  ng-model='formData.menarche_age' class="form-control col-md-7 col-xs-12" only-num>
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
                                        <input type="text"  ng-model='formData.siklus_haid' class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Jumlah pemakaian pembalut/hr
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  only-num ng-model='formData.jumlah_pemakaian_pembalut' class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Lamanya
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" ng-model='formData.lama_pemakaian_pembalut' class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Apakah teratur ?
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <label class="radio-inline">
                                      <input type="radio" ng-model="formData.is_tidy" ng-value='1'>
                                      <h5>Ya</h5>
                                    </label>
                                     <label class="radio-inline">
                                          <input type="radio" ng-model="formData.is_tidy" ng-value='0'>
                                          <h5>Tidak</h5>
                                     </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">HPHT
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text"  ng-model='formData.hpht' class="form-control col-md-7 col-xs-12" datepick>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Keluhan haid
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea ng-model='formData.haid_complaint' class="form-control"></textarea>   
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        

                        <div class="ln_solid"></div>
                        <h2>Riwayat KB</h2>

                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Pernah KB ?
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <label class="radio-inline">
                                            <input type="radio" ng-model='formData.is_pernah_kb' ng-value='1'>
                                            Ya
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" ng-model='formData.is_pernah_kb' ng-value='0'>
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-6"  ng-show='formData.is_pernah_kb == 1'>
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">KB yang digunakan
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text"  ng-model='formData.kb_item' class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"  ng-show='formData.is_pernah_kb == 1'>
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Sejak kapan menggunakan KB ?
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text"  ng-model='formData.kb_start_time' class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"  ng-show='formData.is_pernah_kb == 1'>
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Keluhan selama menggunakan KB
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea  ng-model='formData.kb_complaint' class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <h2>Riwayat kehamilan, persalinan, dan nifas</h2>

                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-xs-12">G
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" class='form-control' ng-model='formData.gravida' only-num>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">P
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text" class='form-control' ng-model='formData.partus' only-num>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">A
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <input type="text"  class='form-control' ng-model='formData.abortus' only-num>
                                    </div>
                                </div>
                            </div>

                           
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Riwayat imunisasi TT
                                    </label>
                                    <div class="col-md-12 col-xs-12">
                                        <input type="text"  ng-model='formData.imunisasi_tt' class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Pada usia kehamilan
                                    </label>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="input-group">
                                            <input type="text"  ng-model='formData.pada_usia_kehamilan' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                Bulan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Riwayat pemakaian obat saat kehamilan
                                    </label>
                                    <div class="col-md-12 col-xs-12">
                                        <textarea  ng-model='formData.pemakaian_obat_saat_kehamilan' class="form-control col-md-7 col-xs-12">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Keluhan saat kehamilan
                                    </label>
                                    <div class="col-md-12 col-xs-12">
                                        <textarea  ng-model='formData.keluhan_saat_kehamilan' class="form-control col-md-7 col-xs-12">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
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
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-right">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm">Selanjutnya</button>
                                </div>
                                <div class="btn-group pull-left">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm" ng-click='back = 1'>Sebelumnya</button>
                                    <button class="btn btn-default btn-sm" ng-click="backtohome()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/medical_record/create-footer')
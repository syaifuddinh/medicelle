@include('registration/medical_record/create-header')
                         <ul class="nav nav-pills">
                            <li><a href="{{ route('medical_record.edit', ['id' => $id]) }}">Langkah 1</a></li>
                            <li ><a href="{{ route('medical_record.edit.2', ['id' => $id]) }}">Langkah 2</a></li>
                            <li><a href="{{ route('medical_record.edit.3', ['id' => $id]) }}">Langkah 3</a></li>
                            <li class="active"><a href="#">Langkah 4</a></li>
                          </ul> 
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Pemeriksaan fisik</h2>

                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Keadaan umum
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea  ng-model='formData.general_condition' class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">TB
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group">
                                            
                                            <input type="text" ng-model='formData.long' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                CM
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">BB
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group">
                                            
                                            <input type="text" ng-model='formData.weight' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                KG
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="control-label col-md-4 col-xs-12">Tensi
                                    </label>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" ng-model='formData.blood_pressure' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                MMHG
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-xs-12">Nadi
                                    </label>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" ng-model='formData.pulse' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                X/Mnt
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="control-label col-md-4 col-xs-12">Suhu
                                    </label>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" ng-model='formData.temperature' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                C
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="control-label col-md-4 col-xs-12">Frek. nafas
                                    </label>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" ng-model='formData.breath_frequency' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                X/Mnt
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-xs-12">BB sebelum lahir
                                    </label>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" ng-model='formData.prebirth_weight' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                KG
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-xs-12">BB setelah lahir
                                    </label>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" ng-model='formData.postbirth_weight' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                KG
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <h2>Anak</h2>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">PB
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group">
                                            
                                            <input type="text" ng-model='formData.birth_long' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                CM
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">BB
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group">
                                            
                                            <input type="text" ng-model='formData.birth_weight' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                KG
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Lingkar kepala
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group">
                                            
                                            <input type="text" ng-model='formData.head_size' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                CM
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Lingkar lengan
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group">
                                            
                                            <input type="text" ng-model='formData.arm_size' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                CM
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Gigi tumbuh pertama
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type='text' ng-model='formData.gigi_tumbuh_pertama' class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                

                            </div>
                           
                           <div class="col-md-6">
                               
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-xs-12">Berguling usia
                                    </label>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" ng-model='formData.berguling_usia' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                Bulan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-xs-12">Duduk usia
                                    </label>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" ng-model='formData.duduk_usia' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                Bulan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-xs-12">Merangkak usia
                                    </label>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" ng-model='formData.merangkak_usia' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                Bulan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-xs-12">Berdiri usia
                                    </label>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" ng-model='formData.berdiri_usia' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                Bulan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-xs-12">Berjalan usia
                                    </label>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" ng-model='formData.berjalan_usia' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                Bulan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-xs-12">Bicara usia
                                    </label>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" ng-model='formData.bicara_usia' class="form-control col-md-7 col-xs-12" only-num>
                                            <div class="input-group-addon">
                                                Bulan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           </div>
                        </div>

                        <div class="ln_solid"></div>
                        <h2>Riwayat imunisasi</h2>
                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                <div class="form-group col-md-3">
                                    
                                    <label>Imunisasi</label>
                                    <div class="input-group">
                                        <span ng-show='!imunisasi_history.is_other_imunisasi'>
                                            <select class="form-control col-md-12" data-placeholder-text-single="'Pilih imunisasi'"  chosen allow-single-deselect="false" ng-model="imunisasi_history.imunisasi">
                                                <option value=""></option>
                                                <option value="BCG">BCG</option>
                                                <option value="DPT I,II,III">DPT I,II,III</option>
                                                <option value="POLIO I,II,III,IV">POLIO I,II,III,IV</option>
                                                <option value="CAMPAK">CAMPAK</option>
                                                <option value="HEPATITIS">HEPATITIS</option>
                                            </select>
                                        </span>
                                        <input type="text" ng-model='imunisasi_history.imunisasi' class="form-control" ng-show='imunisasi_history.is_other_imunisasi'>
                                        <div class="input-group-addon" ng-click='imunisasi_history.is_other_imunisasi = !imunisasi_history.is_other_imunisasi;imunisasi_history.imunisasi = null'>
                                            <i class="fa fa-pencil" ng-show='!imunisasi_history.is_other_imunisasi'></i>
                                            <i class="fa fa-close" ng-show='imunisasi_history.is_other_imunisasi'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 mg-r2">                                    
                                    <label class='col-md-12'>Usia <i class="fa fa-moon-o" ng-show='!imunisasi_history.is_imunisasi_month_age' ng-click='imunisasi_history.is_imunisasi_month_age = !imunisasi_history.is_imunisasi_month_age'></i><i class="fa fa-mail-reply" ng-show='imunisasi_history.is_imunisasi_month_age' ng-click='imunisasi_history.is_imunisasi_month_age = !imunisasi_history.is_imunisasi_month_age'></i></label>
                                    <div class="input-group">
                                        
                                        <input type="text" class='form-control' ng-model='imunisasi_history.imunisasi_year_age' only-num>
                                        <span class="input-group-addon">
                                            Tahun
                                        </span>
                                        <input type="text" class='form-control' ng-model='imunisasi_history.imunisasi_month_age' ng-show='imunisasi_history.is_imunisasi_month_age' only-num>
                                        <span class="input-group-addon" ng-show='imunisasi_history.is_imunisasi_month_age'>
                                            Bulan
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 mg-r2">

                                    <label>Reaksi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model='imunisasi_history.reaksi_imunisasi'>
                                        <div class="input-group-btn">
                                            <button type='button' class='btn btn-success' ng-click='submitImunisasiHistory()' ng-disabled='!imunisasi_history.imunisasi'><i class="fa fa-check"></i></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='imunisasi_history_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Imunisasi</td>
                                            <td>Usia</td>
                                            <td>Reaksi</td>
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
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm" ng-click='finished = 1'>Simpan</button>
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
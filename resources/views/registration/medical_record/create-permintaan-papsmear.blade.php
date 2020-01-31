@include('registration/medical_record/create-header')
@include('registration/medical_record/create-permintaan-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Pemeriksaan Papsmear</h2>
    
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('umum') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Hari pertama haid terakhir / menopause
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_hari_menopause' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_hari_menopause")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Riwayat vaksinasi
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_vaksinasi' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_vaksinasi")'></textarea>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Riwayat kontrasepsi
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_kontrasepsi' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_kontrasepsi")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Riwayat papsmear
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_papsmear' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_papsmear")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Keluhan saat ini
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_keluhan' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_keluhan")'></textarea>
                                            </div>
                                        </div>
                                        

                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Tanggal pengambilan papsmear
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input  ng-model='formData.additional.papsmear_hari_menopause' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_hari_menopause")'>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Riwayat vaksinasi
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_vaksinasi' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_vaksinasi")'></textarea>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Riwayat kontrasepsi
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_kontrasepsi' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_kontrasepsi")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Riwayat papsmear
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_papsmear' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_papsmear")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Keluhan saat ini
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_keluhan' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_keluhan")'></textarea>
                                            </div>
                                        </div>
                                        

                                    </div>
                                    
                                </div>

                                
                                <div class="ln_solid"></div>

                                <h2>Keterangan Klinik</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Anamnesa
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.histopatologi_anamnesa' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.histopatologi_anamnesa")'></textarea>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Status Lokasi
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.histopatologi_status_lokasi' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.histopatologi_status_lokasi")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Keadaan kelenjar regional
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.histopatologi_keadaan_kelenjar_regional' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.histopatologi_keadaan_kelenjar_regional")'></textarea>
                                            </div>
                                        </div>
                                                                                
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Metastasis
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.histopatologi_metastasis' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.histopatologi_metastasis")'></textarea>
                                            </div>
                                        </div>
                                                                                

                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Rontgen foto
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.histopatologi_rontgen_foto' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.histopatologi_rontgen_foto")'></textarea>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Radiasi
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.histopatologi_radiasi' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.histopatologi_radiasi")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Terapi
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.histopatologi_terapi' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.histopatologi_terapi")'></textarea>
                                            </div>
                                        </div>
                                                                                

                                    </div>
                                    
                                </div>

                                <div class="ln_solid"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-left">
                                    <button class="btn btn-default btn-sm" ng-click="backtohome()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/medical_record/create-footer')
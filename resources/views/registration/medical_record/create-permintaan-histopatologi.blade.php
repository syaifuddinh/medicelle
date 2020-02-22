@include('registration/medical_record/create-header')
@include('registration/medical_record/create-permintaan-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Pemeriksaan FNAB</h2>
    
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('umum') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Bahan sediaan
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.histopatologi_bahan_sediaan' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.histopatologi_bahan_sediaan")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Diagnosa
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.histopatologi_diagnose' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.histopatologi_diagnose")'></textarea>
                                            </div>
                                        </div>
                                        

                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Lokasi Pengambilan
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.histopatologi_lokasi_pengambilan' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.histopatologi_lokasi_pengambilan")'></textarea>
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
                                                <textarea  ng-model='formData.current_disease' class="form-control col-md-7 col-xs-12" ng-change='submitOne("current_disease")'></textarea>
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
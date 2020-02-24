@include('registration/medical_record/create-header')
@include('registration/medical_record/create-permintaan-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Pemeriksaan Sitologi</h2>
    
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('umum') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Diagnosa klinik
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.sitologi_diagnose' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.sitologi_diagnose")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Lokasi pengambilan
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.sitologi_lokasi' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.sitologi_lokasi")'></textarea>
                                            </div>
                                        </div>
                                        
                                        

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Jumlah volume (CC)
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.sitologi_volume' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.sitologi_volume")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Informasi klinis
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.sitologi_description' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.sitologi_description")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Tanggal & waktu pengambilan bahan
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input  ng-model='formData.additional.sitologi_date' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.sitologi_date")' datepick>
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
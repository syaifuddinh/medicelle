@include('registration/medical_record/create-header')
@include('registration/medical_record/create-physique-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Pemeriksaan Anak</h2>
                        
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('children') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-7">
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-xs-12">BB lahir
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.prebirth_weight' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("prebirth_weight")' only-num>
                                                    <div class="input-group-addon">
                                                        KG
                                                    </div>
                                                </div>
                                            </div>
                                        </div>     
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-xs-12">BB sekarang
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.postbirth_weight'  ng-change='submitOne("postbirth_weight")' class="form-control col-md-7 col-xs-12" only-num>
                                                    <div class="input-group-addon">
                                                        KG
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-xs-12">PB lahir
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.additional.pb_lahir' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("additional.pb_lahir")' only-num>
                                                    <div class="input-group-addon">
                                                        CM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>     
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-xs-12">PB sekarang
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.additional.pb_sekarang' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("additional.pb_sekarang")' only-num>
                                                    <div class="input-group-addon">
                                                        CM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                        </div>
                        
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <!-- <div class="btn-group pull-right">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm" ng-click='finished = 1'>Simpan</button>
                                </div> -->
                                <div class="btn-group pull-left">
                                    <button class="btn btn-default btn-sm" ng-click="backtohome()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/medical_record/create-footer')
@include('registration/medical_record/create-header')
@include('registration/medical_record/create-physique-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Pemeriksaan kepala & leher</h2>
                        
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('head') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">

                                         <div class="form-group">
                                            <label class="col-md-4 col-xs-12">Keterangan
                                            </label>
                                            <div class="col-md-12 col-xs-12">
                                                <textarea class="form-control" ng-model='formData.head_description'></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-right">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm" ng-click='finished = 1'>Simpan</button>
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
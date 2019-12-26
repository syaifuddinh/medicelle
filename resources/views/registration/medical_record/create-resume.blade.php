@include('registration/medical_record/create-header')
                          
                      </nav>
                        <h2>Resume medis</h2>
                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                <div class="form-group col-md-6">
                                    
                                    <label>Tanggal</label>
                                    <div class="input-group">
                                        
                                        <input type="text" class='form-control' ng-model="resume_date"  datepick>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-md btn-primary" ng-click="changeResumeDate()">Ubah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                         <embed id='pdfDocument' style='width:100%;height:28cm'> 
                        
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
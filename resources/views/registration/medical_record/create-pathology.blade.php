@include('registration/medical_record/create-header')
                          
                      </nav>
                        <h2>Daftar Pemeriksaan Patologi & Anatomi</h2>
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('patologi') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-6">
                                            
                                            <label>Tanggal pemeriksaaan</label>
                                            <input type="text" class='form-control' ng-model="research.date"  datepick>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Jenis pemeriksaan</label>
                                            <input type="text" ng-model='research.name' class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-6">
                                            <label>Tanggal hasil</label>
                                            <input type="text" class='form-control' ng-model="research.result_date"  datepick>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>File</label>
                                            <input type="file" name='file' id='file'>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-6">
                                            <button type='button' class='btn btn-sm btn-success submitButton' ng-click='submitResearch("pathology")' ng-disabled='!research.name || disBtn'><i class="fa fa-check"></i></button> </div>
                                    </div>
                                </div>

                                <div class="row" style='margin-top:4mm'>
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='pathology_datatable'>
                                            <thead>
                                                <tr>
                                                    <td>Tanggal pemeriksaan</td>
                                                    <td>Jenis pemeriksaan</td>
                                                    <td>Tanggal hasil</td>
                                                    <td>File</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
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
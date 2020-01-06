@include('registration/assesment/show-header')
                         <ul class="nav nav-pills">
                            <li><a href="{{ route('assesment.show', ['id' => $id]) }}">Langkah 1</a></li>
                            <li ><a href="{{ route('assesment.show.2', ['id' => $id]) }}">Langkah 2</a></li>
                            <li><a href="{{ route('assesment.show.3', ['id' => $id]) }}">Langkah 3</a></li>
                            <li class="active"><a href="#">Langkah 4</a></li>
                          </ul> 
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Pemeriksaan fisik</h2>

                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">Keadaan umum
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.general_condition %>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">TB
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                            
<% formData.long %> CM
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">BB
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                            
<% formData.weight %> KG
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12">Tensi
                                    </label>
                                    <div class="col-md-8 col-xs-12">
<% formData.blood_pressure %> MMHG
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12">Nadi
                                    </label>
                                    <div class="col-md-8 col-xs-12">
<% formData.pulse %>  X/Mnt
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12">Suhu
                                    </label>
                                    <div class="col-md-8 col-xs-12">
<% formData.temperature %> C
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12">Frek. nafas
                                    </label>
                                    <div class="col-md-8 col-xs-12">
<% formData.breath_frequency %> X/Mnt
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12">BB sebelum lahir
                                    </label>
                                    <div class="col-md-8 col-xs-12">
<% formData.prebirth_weight %> KG
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12">BB setelah lahir
                                    </label>
                                    <div class="col-md-8 col-xs-12">
<% formData.postbirth_weight %> KG
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <h2>Anak</h2>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">PB
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                            
<% formData.birth_long %> CM
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">BB
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                            
<% formData.birth_weight %> KG
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">Lingkar kepala
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                            
<% formData.head_size %> CM
                                    </div>
                                </div>
                                                                
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">Lingkar lengan
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                            
<% formData.arm_size %> CM
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">Gigi tumbuh pertama
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.gigi_tumbuh_pertama %>
                                    </div>
                                </div>
                                

                            </div>
                           
                           <div class="col-md-6">
                               
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12">Berguling usia
                                    </label>
                                    <div class="col-md-8 col-xs-12">
<% formData.berguling_usia %> Bulan
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12">Duduk usia
                                    </label>
                                    <div class="col-md-8 col-xs-12">
<% formData.duduk_usia %> Bulan
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12">Merangkak usia
                                    </label>
                                    <div class="col-md-8 col-xs-12">
<% formData.merangkak_usia %> Bulan
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12">Berdiri usia
                                    </label>
                                    <div class="col-md-8 col-xs-12">
<% formData.berdiri_usia %> Bulan
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12">Berjalan usia
                                    </label>
                                    <div class="col-md-8 col-xs-12">
<% formData.berjalan_usia %> Bulan
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12">Bicara usia
                                    </label>
                                    <div class="col-md-8 col-xs-12">
<% formData.bicara_usia %> Bulan
                                    </div>
                                </div>
                           </div>
                        </div>

                        <div class="ln_solid"></div>
                        <h2>Riwayat imunisasi</h2>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='imunisasi_history_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Imunisasi</td>
                                            <td>Usia</td>
                                            <td>Reaksi</td>
                                            
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
                                    <a class="btn btn-primary btn-sm" href="{{ route('assesment.edit.4', ['id' => $id]) }}">Edit</a>
                                </div>
                                <div class="btn-group pull-left">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm" ng-click='back = 1'>Sebelumnya</button>
                                    <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/assesment/show-footer')
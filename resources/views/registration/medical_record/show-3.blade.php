@include('registration/medical_record/show-header')
                         <ul class="nav nav-pills">
                            <li><a href="{{ route('medical_record.show', ['id' => $id]) }}">Langkah 1</a></li>
                            <li ><a href="{{ route('medical_record.show.2', ['id' => $id]) }}">Langkah 2</a></li>
                            <li class="active"><a href="#">Langkah 3</a></li>
                            <li ><a href="{{ route('medical_record.show.4', ['id' => $id]) }}">Langkah 4</a></li>
                          </ul> 
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Maternitas</h2>

                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">Menarche usia
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.menarche_age %> tahun
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">Siklus haid
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.siklus_haid %>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">Jumlah pemakaian pembalut/hr
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.jumlah_pemakaian_pembalut %>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">Lamanya
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.lama_pemakaian_pembalut %>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12">Apakah teratur ?
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.is_tidy == 0 ? 'Tidak' : 'Ya' %>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12">HPHT
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.hpht %>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12">Keluhan haid
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.haid_complaint %>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <h2>Riwayat perkawinan</h2>

                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-4 col-sm-4 col-xs-12">Status
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.marriage_status %>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12">Lama menikah
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.marriage_duration %>
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
<% formData.is_pernah_kb == 1 ? 'Ya' : 'Tidak' %>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-6"  ng-show='formData.is_pernah_kb == 1'>
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">KB yang digunakan
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
<% formData.kb_item %>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"  ng-show='formData.is_pernah_kb == 1'>
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Sejak kapan menggunakan KB ?
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
<% formData.kb_start_time %>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"  ng-show='formData.is_pernah_kb == 1'>
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Keluhan selama menggunakan KB
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
<% formData.kb_complaint %>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <h2>Riwayat kehamilan, persalinan, dan nifas</h2>

                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                <div class="form-group">
                                    <label class="col-md-2 col-xs-12">G
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
<% formData.gravida %>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 col-sm-2 col-xs-12">P
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
<% formData.partus %>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 col-sm-2 col-xs-12">A
                                    </label>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
<% formData.abortus %>
                                    </div>
                                </div>
                            </div>

                           
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Riwayat imunisasi TT
                                    </label>
                                    <div class="col-md-12 col-xs-12">
<% formData.imunisasi_tt %>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Pada usia kehamilan
                                    </label>
                                    <div class="col-md-12 col-xs-12">
                                        <% formData.pada_usia_kehamilan %> bulan
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Riwayat pemakaian obat saat kehamilan
                                    </label>
                                    <div class="col-md-12 col-xs-12">
<% formData.pemakaian_obat_saat_kehamilan %>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12">Keluhan saat kehamilan
                                    </label>
                                    <div class="col-md-12 col-xs-12">
<% formData.keluhan_saat_kehamilan %>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>

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
                                    <a class="btn btn-primary btn-sm" href="{{ route('medical_record.edit.3', ['id' => $id]) }}">Edit</a>
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm">Selanjutnya</button>
                                </div>
                                <div class="btn-group pull-left">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm" ng-click='back = 1'>Sebelumnya</button>
                                    <button class="btn btn-default btn-sm" ng-click="backtohome()" type="button">Batal</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/medical_record/show-footer')
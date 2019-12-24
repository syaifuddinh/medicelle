@include('registration/medical_record/create-header')
                          
                      </nav>
                        <h2>Resume medis</h2>
                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                <div class="form-group col-md-6">
                                    
                                    <label>Tanggal</label>
                                    <div class="input-group">
                                        
                                        <input type="text" class='form-control' ng-model="research.date"  datepick>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-md btn-primary" ng-click="changeResume()">Ubah</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row" style='margin-top:4mm'>
                            <div class="col-md-12" style='padding-left:5.5mm'>
                                
                                <p>Datang dengan keluhan utama <% formData.main_complaint || dot %>, riwayat penyakit sekarang <% formData.current_disease || dot %>.</p>
                                <p>Penyakit dahulu :</p>
                                <ol>
                                    <li ng-repeat='unit in formData.disease_history'>
                                        <% unit.disease_name %>
                                    </li>
                                </ol>
                                <br>
                                <p>Pemeriksaan fisik didapatkan :</p>
                                <p>Tensi : <% formData.blood_pressure || shortDot %> mmHg, Nadi : <% formData.pulse || shortDot %> x/menit, Suhu badan : <% formData.temperature || shortDot %> <sup>o</sup>C, Nafas : <% formData.breath_frequency || shortDot %> x/menit</p>
                                <br>
                                <p>Diagnosis :</p>
                                <ol>
                                    <li ng-repeat='unit in formData.diagnose_history'>
                                        <% unit.disease_name %>
                                    </li>
                                </ol>
                                <br>
                                <p>Terapi :</p>
                                <ol>
                                    <li ng-repeat='unit in formData.drug'>
                                        <% (unit.item.name || shortDot) %> sebanyak <% unit.qty %> <% unit.item.piece.name %>
                                    </li>
                                </ol>
                                <p>Jadwal kontrol selanjutnya pada hari <% next_schedule.date ? (next_schedule.date | day) : shortDot %>, tanggal <% next_schedule.date ? (next_schedule.date | fullDate) : shortDot %></p>
                            </div>
                        </div>

                         <embed src="http://supplychainindonesia.com/new/wp-content/files/1._Pengantar_Manajemen_Logistik_2015.pdf" style='width:100%;height:28cm'> 
                        
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
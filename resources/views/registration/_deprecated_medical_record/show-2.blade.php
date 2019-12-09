@include('registration/medical_record/show-header')
                         <ul class="nav nav-pills">
                            <li><a href="{{ route('medical_record.show', ['id' => $id]) }}">Langkah 1</a></li>
                            <li class="active"><a href="#">Langkah 2</a></li>
                            <li><a href="{{ route('medical_record.show.3', ['id' => $id]) }}">Langkah 3</a></li>                            
                            <li><a href="{{ route('medical_record.show.4', ['id' => $id]) }}">Langkah 4</a></li>
                            
                          </ul> 
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Alergi obat & reaksi efek samping</h2>
                        

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='allergy_history_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Obat</td>
                                            <td>Reaksi</td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="row">
                            
                            <div class="col-md-12" style='display:flex;align-items:center;justify-content:space-between;'>
                                <h2>Skrining resiko jatuh</h2>
                                <div>
                                    
                                    <a class='btn btn-primary pull-right btn-xs'><% risk_level_action %></a>
                                    <a class='btn btn-dark pull-right btn-xs'><% risk_level_status %></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='fallen'>
                                    <thead>
                                        <tr>
                                            <td style='width:30mm'>Kondisi pasien</td>
                                            <td style='width:70mm'>Skala</td>
                                            <td>Nilai</td>
                                            <td>Keterangan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Riwayat jatuh</td>
                                            <td>
                                                <% formData.fallen == 0 ? 'Tidak' : 'Ya' %>
                                            </td>
                                            <td class="text-right"><% formData.fallen %></td>
                                            <td><% formData.fallen_description %></td>
                                        </tr>
                                        <tr>
                                            <td>Diagnosa sekunder</td>
                                            <td>
                                                <% formData.secondary_diagnose == 0 ? 'Tidak' : 'Ya' %>
                                            </td>
                                            <td class="text-right"><% formData.secondary_diagnose %></td>
                                            <td><% formData.secondary_diagnose_description %></td>
                                        </tr>
                                        <tr>
                                            <td>Alat bantu</td>
                                            <td>
                                                <% formData.helper == 0 ? 'Kursi roda/tanpa alat bantu' : (formData.helper == 15 ? 'Tongkat / walker' : 'Peralatan khusus') %>
                                                
                                            </td>
                                            <td class="text-right"><% formData.helper %></td>
                                            <td>
                                                <% formData.helper_description %>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pasien diinfus</td>
                                            <td>
                                                <% formData.infus == 0 ? 'Tidak' : 'Ya' %>
                                            </td>
                                            <td class="text-right"><% formData.infus %></td>
                                            <td><% formData.infus_description %></td>
                                        </tr>
                                        <tr>
                                            <td>Cara berjalan</td>
                                            <td>
                                                <% formData.walking == 0 ? 'Normal' : (formData.walking == 10 ? 'Lemah' : 'Terganggu') %>
                                            </td>
                                            <td class="text-right"><% formData.walking %></td>
                                            <td><% formData.walking_description %></td>
                                        </tr>
                                        <tr>
                                            <td>Kondisi mental</td>
                                            <td>
                                                <% formData.mental == 0 ? 'Normal' : 'Keterbatasan daya ingat' %>
                                            </td>
                                            <td class="text-right"><% formData.mental %></td>
                                            <td><% formData.mental_description %></td>
                                        </tr>
                                        <tfoot>
                                            <tr>
                                                <th colspan='2'>Total</th>
                                                <th class='text-right'><% formData.fallen + formData.secondary_diagnose + formData.helper + formData.infus + formData.walking + formData.mental %></th>
                                            </tr>
                                        </tfoot>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-right">
                                    <a class="btn btn-primary btn-sm" href="{{ route('medical_record.edit.2', ['id' => $id]) }}">Edit</a>
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
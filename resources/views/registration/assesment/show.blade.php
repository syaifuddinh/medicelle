@include('registration/assesment/show-header')
                         <ul class="nav nav-pills">
                            <li class="active"><a href="#">Langkah 1</a></li>
                            <li><a href="{{ route('assesment.show.2', ['id' => $id]) }}">Langkah 2</a></li>
                            <li><a href="{{ route('assesment.show.3', ['id' => $id]) }}">Langkah 3</a></li>
                            <li><a href="{{ route('assesment.show.4', ['id' => $id]) }}">Langkah 4</a></li>
                          </ul> 
                      </nav>
                        <div class="ln_solid"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                            
                                    <label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Keluhan utama
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.main_complaint %>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="ln_solid"></div>
                        <h2>Riwayat penyakit dahulu</h2>
                        

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='disease_history_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Penyakit</td>
                                            <td>Obat yang pernah diminum</td>
                                            <td>Terakhir control</td>
                                            
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <h2>Riwayat penyakit keluarga</h2>
                        

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='family_disease_history_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Penyakit</td>
                                            <td>Obat yang pernah diminum</td>
                                            <td>Terakhir control</td>
                                            
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <h2>Skrining nyeri</h2>
                        

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='pain_history_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Lokasi nyeri</td>
                                            <td>Kualitas nyeri</td>
                                            <td>Lamanya nyeri</td>
                                            <td>Kapan nyeri timbul ?</td>
                                            
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>



                        <div class="ln_solid"></div>
                        <h2>Obat nyeri yang pernah diminum</h2>
                        

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='pain_cure_history_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Nama obat</td>
                                            <td>Mulai kapan ?</td>
                                            
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                            
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12">Apakah nyeri menganggu aktivitas<span class="required">*</span>
                                </label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <% formData.is_disturb == 1 ? 'Ya' : 'Tidak' %>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Skala nyeri</label>
                                <a href="#" class='btn btn-xs btn-primary pull-right' id='pain_status'>
                                    <%
                                        formData.pain_score == 0 ? 'Tidak ada rasa nyeri' : (formData.pain_score == 1 ? 'Nyeri seperti gatal gigitan nyamuk' : (formData.pain_score == 2 ? 'Terasa nyeri seperti dicubit/melilit' : (formData.pain_score == 3 ? 'Nyeri sangat terasa seperti ditonjok bagian wajah atau disuntik' : (formData.pain_score == 4 ? 'Nyeri yang kuat seperti sakit gigi dan nyeri disengat tawon' : (formData.pain_score == 5 ? 'Nyeri yang tertekan seperti terkilir, keseleo' : (formData.pain_score == 6 ? 'Nyeri yang seperti tertusuk-tusuk menyebabkan tidak fokus dan komunikasi terganggu' : (formData.pain_score == 7 ? 'Nyeri yang menusuk begitu kuat menyebabkan tidak bisa berkomunikasi dengan baik dan tidak mampu melakukan perawatan sendiri' : (formData.pain_score == 8 ? 'Nyeri yang begitu kuat sehingga menyebabkan tidak dapat berfikir jernih' : (formData.pain_score == 9 ? 'Nyeri yang menyiksa tak tertahankan sehingga ingin segera menghilangkan nyerinya' : 'Nyeri yang tidak terbayangkan dan tidak dapat diungkapkan sampai tidak sadarkan diri')))))))))
                                    %>
                                </a>
                                <rzslider rz-slider-model="formData.pain_score" rz-slider-options="{floor:0, ceil:10, readOnly:true}" ></rzslider>
                            </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-right">
                                    <a class="btn btn-primary btn-sm" href="{{ route('assesment.edit', ['id' => $id]) }}">Edit</a>
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm">Selanjutnya</button>
                                </div>
                                <div class="btn-group pull-left">

                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/assesment/show-footer')
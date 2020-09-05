@include('registration/medical_record/create-header')
@include('registration/medical_record/create-physique-header')
<link href="{{ asset('') }}css/Chart.css" rel="stylesheet">   
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Grafik pertumbuhan anak</h2>
                        
                        <div id='role_layer' style="position:relative">
                                <div class="row">
                                    <div class="col-md-12">
                                        <canvas id='grafikBerat'></canvas>
                                    </div>
                                    <div class="col-md-12">
                                        <canvas id='grafikPanjang'></canvas>
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
<script src="{{asset('js/Chart.js')}}"></script>
@include('registration/medical_record/create-footer')
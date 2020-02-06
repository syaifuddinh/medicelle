@include('registration/assesment/create-header')
                         <ul class="nav nav-pills">
                            <li><a href="{{ route('assesment.edit', ['id' => $id]) }}">Langkah 1</a></li>
                            <li ><a href="{{ route('assesment.edit.2', ['id' => $id]) }}">Langkah 2</a></li>
                            <li><a href="#">Langkah 3</a></li>
                            <li ><a href="{{ route('assesment.edit.4', ['id' => $id]) }}">Langkah 4</a></li>
                            <li class="active"><a href="{{ route('assesment.edit.history', ['id' => $id]) }}">Riwayat</a></li>
                          </ul> 
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Riwayat assesment</h2>

                        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title" ng-show='!isFilter'>
                    <form action="" class='form-horizontal form-label-left'>
                        
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Periode
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div class="input-daterange input-group" style="width:100%;">
                                <input type="text" class="input-sm form-control" ng-model="filterData.date_start" ng-change='filter()' datepick/>
                                <span class="input-group-addon">s/d</span>
                                <input type="text" class="input-sm form-control" ng-model="filterData.date_end" ng-change='filter()' datepick />
                              </div>
                              <div class="form-group">
                                  <button type='button' class='btn btn-warning btn-sm' ng-click='filterData={};filter()'>Reset</button>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row x_title">
                  <div class="col-md-12">
                      <div class="btn-group pull-right export_button">
                          <button type='button' ng-click='isFilter = !isFilter' class='btn btn-primary btn-sm'>Filter</button>
                          
                      </div>                    
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered" id='listview'>
                      <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>Keluhan utama</th>
                          <th>Perawat</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
                        
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-left">
                                    <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/assesment/create-footer')
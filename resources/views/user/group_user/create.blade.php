@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="groupUserCreate">
          <!-- top tiles -->
          

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3><% title %></h3>
                  </div>
                  <div class="col-md-6">
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>

                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nama<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" ng-model='formData.name' required="required" class="form-control col-md-7 col-xs-12" autofocus>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="last-name">Keterangan
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="last-name" ng-model='formData.description' name="last-name"  class="form-control col-md-7 col-xs-12">
                          </textarea>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      @include('user/group_user/roles')
                      <div class="ln_solid"></div>
                      <div class="form-group" style='position:fixed;bottom:3mm;right:2.7mm'>
                        <div class="col-md-12">
                          <div class="compile">
                            <div class="btn-group">
                              
                              
                                <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                                <button class="btn btn-warning btn-sm" type="button" ng-click='formData = { roles : {}}'>Reset</button>
                                <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm">Simpan</button>
                                <input type="text" class='form-control pull-right input-xs' placeholder="Cari hak akses...." style='width:53.55%;height:29.5px' ng-model='keyword' ng-change='searchRoles()'>
                            </div>
                              
                            </div>
                        </div>
                      </div>

                    </form>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>

        </div>
        <!-- /page content -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    @include('footer')
    <script src="{{ asset('') }}js/user/group_user/groupUserCreateCtrl.js"></script>


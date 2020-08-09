@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" id='scopeContainer' ng-controller="userCreate">
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
                  <form id="form" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" ng-submit='submitForm()'>
                      {{ csrf_field() }}
                      <div class="form-group avatar-container">
                        <img class="img-responsive hidden" id='img-preview' style='height:50mm;margin:auto'>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Foto Profil
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id='avatar' ng-model='formData.avatar' name='avatar' class="form-control col-md-7 col-xs-12" ng-required='!formData.id'>
                          
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">NIK<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" ng-model='formData.code' required="required" class="form-control col-md-7 col-xs-12" autofocus>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" ng-model='formData.name' required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Lengkap<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" ng-model='formData.fullname' required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="first-name" ng-model='formData.email' required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" ng-model='formData.username' required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password<span ng-hide='formData.id' class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" ng-model='formData.password' ng-required='!formData.id' class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Konfirmasi Password<span ng-hide='formData.id' class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="first-name" ng-model='formData.password_confirm' ng-required='!formData.id' required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                        
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Departemen<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" data-placeholder-text-single="'Pilih Departemen'" required='required' chosen allow-single-deselect="false" ng-model="formData.group_user_id" ng-options="c.id as c.name for c in data.group_user" ng-change='emptyFavoritePage()'>
                            <option value=""></option>
                          </select>
                        </div>
                      </div>
                      
                        
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Halaman Favorit
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-group" ng-click='showRolesModal()'>
                                <input type="text" ng-model='formData.favorite_page_name' class='form-control' readonly>
                                <div class="input-group-btn">
                                    <button type="button" class='btn btn-md btn-primary'>
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                      </div>
                      

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <div class="btn-group">
                            
                            <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                            <button class="btn btn-warning btn-sm" type="button" ng-click='formData = {}'>Reset</button>
                            <button type="submit" class="btn btn-success btn-sm submitButton" ng-disabled="disBtn">Simpan</button>
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
        <div class="modal fade" id="rolesModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:80%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Daftar Fitur</h4>
            </div>
            <div class="modal-body" id='roles_container'>

                <table class="table table-hover" id='roles_datatable'  style='width:100%'>
                    <thead>
                        <tr>
                            <th>Fitur</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    @include('footer')
    <script>
        authUser = {!! Auth::user() !!};
    </script>
    <script src="{{ asset('') }}js/user/user/userCreateCtrl.js"></script>


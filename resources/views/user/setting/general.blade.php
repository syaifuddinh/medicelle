@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" id='scopeContainer' ng-controller="companySetting">
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
                <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#general">General</a></li>
    <li><a data-toggle="tab" href="#pic">Penanggung Jawab</a></li>
    <li><a data-toggle="tab" href="#children_growth">Grafik Pertumbuhan Anak</a></li>
  </ul>

  <div class="tab-content">
    <div id="general" class="tab-pane fade in active" style='padding-top:15mm'>
        <div class="col-md-12 col-sm-12 col-xs-12">
              <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                  {{ csrf_field() }}
                  <div class="form-group avatar-container">
                    <img class="img-responsive" id='img-preview' style='height:50mm;margin:auto' src='<% formData.company.logo %>'>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Logo 1
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="file" id='logo' name='logo' class="form-control col-md-7 col-xs-12">
                      
                    </div>
                  </div>

                  <div class="form-group avatar-container">
                    <img class="img-responsive" id='img-preview-2' style='height:50mm;margin:auto' src='<% formData.company.logo2 %>'>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Logo 2
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="file" id='logo2' name='logo2' class="form-control col-md-7 col-xs-12">
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nama<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" ng-model='formData.company.name' required="required" class="form-control col-md-7 col-xs-12" autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Alamat
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea id="last-name" ng-model='formData.company.address' name="last-name"  class="form-control col-md-7 col-xs-12">
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Kota
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type='text' ng-model='formData.company.city' class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Email
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type='text' ng-model='formData.company.email' class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Website
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type='text' ng-model='formData.company.website' class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">No Telepon
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type='text' ng-model='formData.company.phone_number' class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">No Whatsapp
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type='text' ng-model='formData.company.whatsapp_number' class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Fax
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type='text' ng-model='formData.company.fax' class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                      <div class="btn-group compile">
                        
                        <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                        <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm">Simpan</button>
                      </div>
                    </div>
                  </div>

             </form>
        </div>
    </div>
    <div id="pic" class="tab-pane fade">
          <table class='table table-striped'>
              <tbody>
                  <tr ng-repeat='p in pic'>
                      <td>
                        <b>
                        <% p.name %>      
                        </b>
                        <ol style='margin-top:1.5mm'>
                            <li ng-repeat='i in incharge[p.slug]'>
                                <% i.name %>
                            </li>
                        </ol>
                      </td>
                      <td>
                          <button class='btn btn-sm btn-primary pull-right' ng-disabled='disBtn' ng-click="showRelated(p.slug, p.name)">
                              <i class="fa fa-plus"></i>
                          </button>
                      </td>
                  </tr>
              </tbody>
          </table>
    </div>

    <div id="children_growth" class="tab-pane fade">
        <table class='table'>
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Batas Bawah (kg)</th>
                    <th>Batas Normal (kg)</th>
                    <th style='border-right:1mm solid #2f3640;'>Batas Atas (kg)</th>
                    <th>Batas Bawah (cm)</th>
                    <th>Batas Normal (cm)</th>
                    <th>Batas Atas (cm)</th>
                </tr>
            </thead>
            <tbody>
               <tr ng-repeat='(childrenIndex, unit) in children_growth'>
                   <td><% childrenIndex + 1 %></td>
                   <td>
                        <input type="text" class='form-control' ng-model='children_growth[childrenIndex].berat.batas_bawah' ng-change='storeChildrenGrowth(childrenIndex)' only-num>
                    </td>
                   <td>
                        <input type="text" class='form-control' ng-model='children_growth[childrenIndex].berat.batas_normal' ng-change='storeChildrenGrowth(childrenIndex)' only-num>
                    </td>
                   <td style='border-right:1mm solid #2f3640;'>
                        <input type="text" class='form-control' ng-model='children_growth[childrenIndex].berat.batas_atas' ng-change='storeChildrenGrowth(childrenIndex)' only-num>
                    </td>
                   <td>
                        <input type="text" class='form-control' ng-model='children_growth[childrenIndex].panjang.batas_bawah' ng-change='storeChildrenGrowth(childrenIndex)' only-num>
                    </td>
                   <td>
                        <input type="text" class='form-control' ng-model='children_growth[childrenIndex].panjang.batas_normal' ng-change='storeChildrenGrowth(childrenIndex)' only-num>
                    </td>
                   <td>
                        <input type="text" class='form-control' ng-model='children_growth[childrenIndex].panjang.batas_atas' ng-change='storeChildrenGrowth(childrenIndex)' only-num>
                    </td>
               </tr> 
            </tbody>
        </table>
    </div>
</div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>

        </div>
        <!-- /page content -->
    <div class="modal fade" id="medicalModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
        <div class="modal-dialog" style='width:80%'>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">Penanggung Jawab <% picTitle %></h4>
                </div>
                <div class="modal-body">

                    <table class="table table-striped" id='medical_datatable' style='width:100%'>
                        <thead>
                            <tr>
                                <th>Nama</th>
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
    <script src="{{ asset('') }}js/user/setting/companySettingCtrl.js"></script>


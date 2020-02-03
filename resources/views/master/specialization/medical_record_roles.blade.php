<div class="container-fluid">
  
    <ul class="nav nav-pills">
        <li class="active"><a data-toggle="pill" href="#roles">Hak akses rekam medis</a></li>
        <li><a data-toggle="pill" href="#tindakan">Hak akses tindakan rekam medis</a></li>
    </ul>
    <br>

    <div class="tab-content">
        <div id="roles" class="tab-pane fade in active">
            
    <div class="pull-right btn-group" ng-hide='is_hidden' style='margin-top:4mm'>
        <button class='btn btn-xs btn-dark' type='button' ng-click='uncheckAll()' title='Unchecklist semua'>
            <i class="fa fa-close"></i>
        </button>
        <button class='btn btn-xs btn-success' type='button' ng-click='checkAll()' title='Checklist semua'>
            <i class="fa fa-check"></i>
        </button>
    </div>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#doctor">Dokter</a></li>
        <li><a data-toggle="tab" href="#nurse">Perawat</a></li>
    </ul>
    <div class="tab-content">
        <div id="doctor" class='tab-pane fade in active roles_container'>
            <table class="table" id='medical_record_doctor_roles_table'>
                <thead>
                    <tr>
                        <th style='width:90%'>Hak akses</th> 
                        <th  class='text-right' title='Hanya diizinkan untuk melihat data'>
                            <i class="fa fa-file-text-o"></i>
                        </th>
                        <th class='text-right' title='Diizinkan untuk melihat dan mengubah data'>
                            <i class="fa fa-pencil"></i>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
        <div id="nurse" class='tab-pane fade roles_container'>
            <table class="table" id='medical_record_nurse_roles_table'>
                <tr>
                        <th  style='width:90%'>Hak akses</th> 
                        <th  class='text-right' title='Hanya diizinkan untuk melihat data'>
                            <i class="fa fa-file-text-o"></i>
                        </th>
                        <th  class='text-right' title='Diizinkan untuk melihat dan mengubah data'>
                            <i class="fa fa-pencil"></i>
                        </th>
                    </tr>
            </table>
        </div>
    </div>
        </div>
        <div id="tindakan" class="tab-pane fade roles_container">
            <table class="table" id='grup_nota_roles_table'>
                <thead>
                    <tr>
                        <th  style='width:90%'>Tindakan</th> 
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Poliklinik</td>
                        <td class='text-right'>
                            <label class="radio-inline">
                                <input type='checkbox' ng-model='formData.grup_nota_roles[0]' ng-true-value="'POLIKLINIK'" ng-false-value='0'>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Medical Check-up</td>
                        <td class="text-right">
                            <label for="" class="radio-inline">
                                <input type='checkbox' ng-model='formData.grup_nota_roles[1]' ng-true-value="'MEDICAL CHECK-UP'">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Laboratorium</td>
                        <td class="text-right">
                            <label for="" class="radio-inline">
                                <input type='checkbox' ng-model='formData.grup_nota_roles[2]' ng-true-value="'LABORATORIUM'">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Radiologi</td>
                        <td class="text-right">
                            <label for="" class="radio-inline">
                                <input type='checkbox' ng-model='formData.grup_nota_roles[3]' ng-true-value="'RADIOLOGI'">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Kemoterapi</td>
                        <td class="text-right">
                            <label for="" class="radio-inline">                    
                                <input type='checkbox' ng-model='formData.grup_nota_roles[4]' ng-true-value="'KEMOTERAPI'">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Ruang tindakan</td>
                        <td class="text-right">
                            <label for="" class="radio-inline">
                                <input type='checkbox' ng-model='formData.grup_nota_roles[5]' ng-true-value="'RUANG TINDAKAN'">
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
</div>
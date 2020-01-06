<div class="container-fluid">
  
    <h2>Hak akses rekam medis</h2>
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
            <table class="table" id='medical_record_doctor_roles_table'></table>
        </div>
        <div id="nurse" class='tab-pane fade roles_container'>
            <table class="table" id='medical_record_nurse_roles_table'></table>
        </div>
    </div>
</div>
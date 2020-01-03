app.controller('polyclinicHistory', ['$scope', '$compile', '$http', '$filter', function($scope, $compile, $http, $filter) {
  var path = window.location.pathname
  var patient_head =  baseUrl + '/datatable/registration/'
  var patient_url;
  var flag
  if( path.indexOf('polyclinic') > -1) {
      patient_url = patient_head + 'polyclinic_registered'
      flag = 'polyclinic'
  } else if( path.indexOf('radiology') > -1) {
      patient_url = patient_head + 'radiology_registered'
      flag = 'radiology'
  } else if( path.indexOf('chemoterapy') > -1) {
      patient_url = patient_head + 'chemoterapy_registered'
      flag = 'chemoterapy'
  }  else if( path.indexOf('laboratory') > -1) {
      patient_url = patient_head + 'laboratory_registered'
      flag = 'chemoterapy'
  } else if( path.indexOf('ruang_tindakan') > -1) {
      patient_url = patient_head + 'ruang_tindakan_registered'
      flag = 'ruang_tindakan'
  } else if( path.indexOf('medical_checkup') > -1) {
      patient_url = patient_head + 'medical_checkup_registered'
      flag = 'medical_checkup'
  } 

  patient_url += '/finish'

  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : patient_url,
      data : x => Object.assign(x, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Registrasi - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Registrasi'
      },
    ],

    columns:[
      {data:"registration_detail.registration.code", name:"registration_detail.registration.code", width:'13%',},
      {data:"medical_record.code", name:"medical_record.code", width:'16%',},
      {
        data:null, 
        searchable:false,
        orderable:false,
        render:resp => $filter('fullDate')(resp.registration_detail.registration.date),
      },
      {data:"registration_detail.registration.patient.name", name:"registration_detail.registration.patient.name"},
      {data:"registration_detail.registration.patient.phone", name:"registration_detail.registration.patient.phone"},
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'capitalize',
        render : resp => resp.registration_detail.registration.patient.gender.toLowerCase()
      },
      {
        data:"registration_detail.polyclinic.name", 
        name:"registration_detail.polyclinic.name",
        className : path.indexOf('polyclinic') > -1 ? '' : 'hidden',
      },
      {data:"registration_detail.doctor.name", name:"registration_detail.doctor.name"},
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => 
        "<div class='btn-group'>" + 
        "<a class='btn btn-xs btn-default' href='" + baseUrl +  '/' + flag + "/patient/" + resp.registration_detail.registration_id +  "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.filter = function() {
    oTable.ajax.reload()
  }

  $scope.delete = function(id) {
    is_delete = confirm('Apakah registrasi pasien ini dibatalkan ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/polyclinic/polyclinic/' + id).then(function(data) {
            oTable.ajax.reload();
            toastr.success("Pasien dibatalkan !");
        }, function(error) {
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
  }

  $scope.finish = function(id) {
    is_activate = confirm('Pemeriksaan sudah selesai ?');
      if(is_activate)
          $http.put(baseUrl + '/controller/registration/registration/finish/' + id).then(function(data) {
              toastr.success("Pemeriksaan pasien telah selesai");
              oTable.ajax.reload();
          }, function(error) {
            if (error.status==422) {
              var det="";
              angular.forEach(error.data.errors,function(val,i) {
                det+="- "+val+"<br>";
              });
              toastr.warning(det,error.data.message);
            } else {
              toastr.error(error.data.message,"Error Has Found !");
            }
          });
    }
}]);
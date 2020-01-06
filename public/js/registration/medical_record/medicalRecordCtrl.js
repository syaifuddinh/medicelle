app.controller('medicalRecord', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
  $scope.formData = {}
  var path = window.location.pathname;
  patient_id = path.replace(/.+\/(\d+)\/patient.*/, '$1');
  var medical_record_head=  baseUrl + '/datatable/registration/'
  var medical_record_url
  if( path.indexOf('polyclinic') > -1) {
      medical_record_url = medical_record_head + 'polyclinic_medical_record/'
  } else if( path.indexOf('radiology') > -1) {
      medical_record_url = medical_record_head + 'radiology_medical_record/'
  } else if( path.indexOf('laboratory') > -1) {
      medical_record_url = medical_record_head + 'laboratory_medical_record/'
  } else if( path.indexOf('chemoterapy') > -1) {
      medical_record_url = medical_record_head + 'chemoterapy_medical_record/'
  } else if( path.indexOf('ruang_tindakan') > -1) {
      medical_record_url = medical_record_head + 'ruang_tindakan_medical_record/'
  } else if( path.indexOf('medical_checkup') > -1) {
      medical_record_url = medical_record_head + 'medical_checkup_medical_record/'
  }

  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : medical_record_url  + patient_id,
      data : d => Object.assign(d, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Rekam Medis - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Rekam Medis'
      },
    ],

    columns:[

      {
        data:'medical_record.code', 
        name:'medical_record.code',
        width : '35mm',
      },
      {
        data:null, 
        orderable:false,
        searchable:false,
        width : '45mm',
        render:resp => $filter('fullDate')(resp.medical_record.date)
      },
      {
        data:'medical_record.main_complaint', 
        name:'medical_record.main_complaint' 
      },
      {data:"registration_detail.doctor.name", name:"registration_detail.doctor.name"},
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => 
        "<div class='btn-group'>" + 
        "<a allow_update_medical_record class='btn btn-xs btn-success' " + (resp.registration_detail.registration.invoice.status > 2 ? " href='" + baseUrl + "/medical_record/step/1/edit/" + resp.medical_record.id +  "' " : ' disabled href="#" ') + " title='Edit'><i class='fa fa-pencil'></i></a>" 
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.filter = function() {
    oTable.ajax.reload();
  }

  $scope.patient = function() {
        $http.get(baseUrl + '/controller/master/patient/' + patient_id).then(function(data) {
                $scope.patient = data.data
                
            }, function(error) {
              $rootScope.disBtn=false;
              if (error.status==422) {
                var det="";
                angular.forEach(error.data.errors,function(val,i) {
                  det+="- "+val+"<br>";
                });
                toastr.warning(det,error.data.message);
              } else {
                $scope.patient()
                toastr.error(error.data.message,"Error Has Found !");
              }
        });
    }
    $scope.patient()

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/registration/medical_record/' + id).then(function(data) {
            oTable.ajax.reload();
            toastr.success("Data Berhasil dinon-aktifkan !");
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

  $scope.activate = function(id) {
    is_activate = confirm('Apakah anda ingin mengaktifkan data ini ?');
      if(is_activate)
          $http.put(baseUrl + '/controller/registration/medical_record/activate/' + id).then(function(data) {
              toastr.success("Data Berhasil diaktifkan !");
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
app.controller('polyclinic', ['$scope', '$compile', '$http', '$filter', function($scope, $compile, $http, $filter) {
  var path = window.location.pathname

  var patient_head =  baseUrl + '/datatable/registration/'
  var patient_url;
  var flag
  var currentDate = new Date()
  var date = currentDate.getFullYear() + '-' + ( currentDate.getMonth() + 1 ).toString().padStart(2, 0) + '-' + currentDate.getDate().toString().padStart(2, 0)
  $scope.formData = {
      'date_start' : date, 
      'date_end' : date 
  }
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
      {
        data:null, 
        name:"medical_record.code", 
        width:'16%',
        render : resp => "<a class='btn' href='" + baseUrl + "/medical_record/" + flag + "/" + resp.registration_detail.registration.patient.id + "/patient'>" + resp.medical_record.code + "</a>"
      },
      {
        data:null, 
        searchable:false,
        orderable:false,
        render:resp => $filter('fullDate')(resp.registration_detail.registration.date),
      },
      {
        data:null, 
        name:"registration_detail.registration.patient.name",
        render : resp => "<a class='btn' href='" + baseUrl + "/" + flag + "/patient/" + resp.registration_detail.registration_id +  "'>" + resp.registration_detail.registration.patient.name + "</a>"
      },
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
        className : path.indexOf('polyclinic') > -1 ? '' : 'hidden'
      },
      {data:"registration_detail.doctor.name", name:"registration_detail.doctor.name"},
      {
        data: null,
        width:'10%', 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => "<div class='btn-group'>" + 
        (resp.is_referenced != 1 ? "<a class='btn btn-xs btn-primary' ng-click='finish(" + resp.registration_detail.id + ")' type='button' title='Pemeriksaan selesai'><i class='fa fa-check'></i></a>" : '') +
        "<a class='btn btn-xs btn-default' href='" + baseUrl + "/" + flag + "/patient/" + resp.registration_detail.registration_id +  "/" + resp.id + "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    },
    initComplete : function() {
        var patientTable = this.api()
        setInterval(function(){
            patientTable.ajax.reload()
        }, 20000)
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.filter = function() {
    is_date = /\d+-\d+-\d+/
    if((is_date.test($scope.formData.date_start) && is_date.test($scope.formData.date_end)) || !$scope.formData.date_end || !$scope.formData.date_start) {
        oTable.ajax.reload()
    }
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
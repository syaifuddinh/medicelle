app.controller('polyclinicCreate', ['$scope', '$http', '$rootScope', '$compile', '$filter', function($scope, $http, $rootScope, $compile, $filter) {
  $scope.title = 'Tambah Registrasi';
  $scope.data = {}
  $scope.doctor = []
  
  var hours = [];
  for(i = 1;i <= 24;i++) {
    hours.push(
      String(i).padStart(2, '0')
      )
  }
  $scope.data.hours = hours
  var path = window.location.pathname;
  if(/edit/.test(path)) {
    $scope.title = 'Edit Registrasi';
  } 


  $http.get(baseUrl + '/controller/master/city').then(function(data) {
    $scope.data.city = data.data
  }, function(error) {
    $rootScope.disBtn=false;
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

  patient_datatable = $('#patient_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url : baseUrl+'/datatable/master/patient',
      data : function(d) {
        d.is_display_all = 1
        d.length = 6

        return d
      }
    },
    columns:[
    {
      data:null, 
      name:null,
      searchable:false,
      orderable:false,
      className : 'text-center',
      render : resp => "<button type='button' class='btn btn-xs btn-primary' ng-click='selectPatient($event.currentTarget)'>Pilih</button>"
    },
    {data:"name", name:"name"},
    {data:"age", name:"age"},
    {data:"city.name", name:"city.name"},
    {data:"gender", name:"gender"},
    {data:"blood_type", name:"blood_type"}
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  polyclinic_detail_datatable = $('#polyclinic_detail_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    {
      data : null,
      className : 'capitalize',
      render : function(resp) {
        console.log(resp)
        if(resp.destination == 'POLIKLINIK') {
          var poly = $scope.data.polyclinic.find(x => x.id == resp.polyclinic_id);
          return 'Poliklinik ' + poly.name
        } else {
          return resp.destination.toLowerCase()
        }
      }
    },
    {
      data : 'time',
    },
    {
      data : null,
      render : function(resp) {
        var doctor = $scope.data.doctor.find(x => x.id == resp.doctor_id)
        return doctor.name;
      }
    },

    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteDetail($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  $scope.reset = function() {
    $scope.formData = {
      'patient' : {
        'family' : {}
      },
      'detail' : {}
    }
    $scope.detail = {}
    $scope.formData.patient_type = 'UMUM'
    var currentDate = new Date()
    var date = currentDate.getFullYear() + '-' + ( currentDate.getMonth() + 1 ) + '-' + currentDate.getDate()
    $scope.formData.date = date
    setTimeout(function () {    
          $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
    }, 300)
    polyclinic_detail_datatable.clear().draw()
    window.scrollTo(0, 0)
  }

  $scope.reset()

  $scope.fillPatient = function() {
    $scope.is_new_patient = !$scope.is_new_patient
    $scope.formData.patient = {}
    $scope.formData.patient.family = {}
  }

  $scope.deleteDetail = function(e) {
    var tr = $(e).parents('tr');
    polyclinic_detail_datatable.row(tr).remove().draw()
  }


  $http.get(baseUrl + '/controller/master/polyclinic').then(function(data) {
    $scope.data.polyclinic = data.data

    $http.get(baseUrl + '/controller/master/doctor').then(function(data) {
      $scope.data.doctor = data.data
      if(/edit/.test(path)) {
        id = path.replace(/.+\/(\d+)/, '$1');
        $http.get(baseUrl + '/controller/polyclinic/polyclinic/' + id).then(function(data) {
          $scope.formData = data.data
          setTimeout(function () {
              
                $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
            }, 300)
          if(data.data.patient_type == 'ASURANSI SWASTA') {
              $scope.formData.agency_id = data.data.pic_id
          }
          polyclinic_detail_datatable.rows.add(data.data.detail).draw()
        }, function(error) {
          $rootScope.disBtn=false;
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
    }, function(error) {
      $rootScope.disBtn=false;
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
  }, function(error) {
    $rootScope.disBtn=false;
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

  $http.get(baseUrl + '/controller/master/agency').then(function(data) {
    $scope.data.agency = data.data

  }, function(error) {
    $rootScope.disBtn=false;
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



  $scope.adjustTime = function() {
    $scope.detail.time = ($scope.detail.hour || '00') + ':' + ($scope.detail.minute || '00')
  } 

  $scope.adjustDestination = function() {
    $scope.detail.doctor_id = null
    $scope.detail.polyclinic_id = null
    $scope.doctor = $scope.data.doctor
  }

  $scope.changeDoctor = function() {
    $scope.detail.doctor_id = null
    var doctor = $scope.data.doctor.filter(x => x.polyclinic_id == $scope.detail.polyclinic_id)         
    $scope.doctor = doctor
  }

  $scope.showPatients = function() {
    if(!$scope.is_new_patient) {
      $('#patientModal').modal()
    }
  }

  $scope.selectPatient = function(e) {
    var tr = $(e).parents('tr');
    var data = patient_datatable.row(tr).data();
    $scope.formData.patient = data;
    $scope.formData.patient.city_id = parseInt(data.city_id)
    $('#patientModal').modal('hide');
  }

  $scope.submitDetail = function() {
    polyclinic_detail_datatable.row.add($scope.detail).draw()
    $scope.detail = {}
  }

  $scope.submitForm=function() {
    $rootScope.disBtn=true;
    var url = baseUrl + '/controller/polyclinic/polyclinic';
    var method = 'post';
    $scope.formData.detail = polyclinic_detail_datatable.data().toArray()
    if($scope.formData.id) {
      var url = baseUrl + '/controller/polyclinic/polyclinic/' + id;
      var method = 'put';
    } 
    $http[method](url, $scope.formData).then(function(data) {
      $rootScope.disBtn = false
      toastr.success("Data Berhasil Disimpan !");
      if($scope.repeat == 0) {

          setTimeout(function () {
            window.location = baseUrl + '/polyclinic'          
          }, 1000)
        } else {
            if($scope.formData.id) {
                window.location = baseUrl + '/polyclinic/create'          
            } else {
                $scope.reset()
                patient_datatable.ajax.reload()
            }
        }
    }, function(error) {
      $rootScope.disBtn=false;
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
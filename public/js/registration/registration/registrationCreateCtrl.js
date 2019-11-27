app.controller('registrationCreate', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope, $compile) {
    $scope.title = 'Tambah Registrasi';
    $scope.formData = {
        'patient' : {
            'family' : {}
        },
        'detail' : {}
    }
    $scope.data = {}
    $scope.doctor = []
    var path = window.location.pathname;
    if(/edit/.test(path)) {
        $scope.title = 'Edit Registrasi';
        id = path.replace(/.+\/(\d+)/, '$1');
        $http.get(baseUrl + '/controller/master/registration/' + id).then(function(data) {
            $scope.formData = data.data
            $scope.formData.contact_name = data.data.contact.name
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

    registration_detail_datatable = $('#registration_detail_datatable').DataTable({
        'columns' : [
            {
                data : null,
                className : 'capitalize',
                render : function(resp) {
                    if(resp.destination == 'POLIKLINIK') {
                        var poly = $scope.data.polyclinic.find(x => x.id == resp.polyclinic_id);
                        return 'Poliklinik ' + poly.name
                    } else {
                          return resp.destination.toLower()
                    }
                }
            },
            {
                data : null,
                className : 'capitalize',
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

    $scope.fillPatient = function() {
        $scope.is_new_patient = !$scope.is_new_patient
        $scope.formData.patient = {}
        $scope.formData.patient.family = {}
    }

    $scope.deleteDetail = function(e) {
        var tr = $(e).parents('tr');
        registration_detail_datatable.row(tr).remove().draw()
    }


    $http.get(baseUrl + '/controller/master/polyclinic').then(function(data) {
        $scope.data.polyclinic = data.data

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

    
    $http.get(baseUrl + '/controller/master/doctor').then(function(data) {
        $scope.data.doctor = data.data

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
        registration_detail_datatable.row.add($scope.detail).draw()
        $scope.detail = {}
    }

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/registration/registration';
      var method = 'post';
      $scope.formData.detail = registration_detail_datatable.data()
      if($scope.formData.id) {
          var url = baseUrl + '/controller/registration/registration/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/registration'          
        }, 1000)
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
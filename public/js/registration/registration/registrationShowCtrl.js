app.controller('registrationShow', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope,  $compile) {
  $scope.title = 'Detail Registrasi';
  $scope.formData = {}
  $scope.data = {}
  var path = window.location.pathname
  id = path.replace(/.+\/(\d+)/, '$1');
  $http.get(baseUrl + '/controller/registration/registration/' + id).then(function(data) {
    $scope.formData = data.data
    $http.get(baseUrl + '/controller/master/polyclinic').then(function(data) {
      $scope.data.polyclinic = data.data

      $http.get(baseUrl + '/controller/master/doctor').then(function(data) {
        $scope.data.doctor = data.data
          registration_detail_datatable.rows.add($scope.formData.detail).draw()

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


  registration_detail_datatable = $('#registration_detail_datatable').DataTable({
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
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
    if(is_delete)
      $http.delete(baseUrl + '/controller/master/registration/' + id).then(function(data) {
        toastr.success("Data Berhasil dinon-aktifkan !");
        setTimeout(function () {
          location.reload();
        }, 1500)
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
      $http.put(baseUrl + '/controller/master/registration/activate/' + id).then(function(data) {
        toastr.success("Data Berhasil diaktifkan !");
        setTimeout(function () {
          location.reload();
        }, 1500)
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
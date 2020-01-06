app.controller('patientShow', ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope) {
    $scope.title = 'Detail Pasien';
    $scope.formData = {}
    var path = window.location.pathname
    id = path.replace(/.+\/(\d+)/, '$1');
    $scope.patient = function() {
        $http.get(baseUrl + '/controller/master/patient/' + id).then(function(data) {
                $scope.formData = data.data
                if(data.data.medical_record_id) {
                    var medical_record_button = $('#medicalRecordButton')
                    var medical_record_link = medical_record_button.attr('href')
                    medical_record_button.attr('href', medical_record_link + '/' + data.data.medical_record_id);
                }
                if(data.data.assesment_id) {
                    var assesment_button = $('#assesmentButton')
                    var assesment_link = assesment_button.attr('href')
                    assesment_button.attr('href', assesment_link + '/' + data.data.assesment_id);
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
                $scope.patient()
                toastr.error(error.data.message,"Error Has Found !");
              }
        });
    }
    $scope.patient()

    $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
      if(is_delete)
          $http.delete(baseUrl + '/controller/master/patient/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/master/patient/activate/' + id).then(function(data) {
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
app.controller('patientCreate', ['$scope', '$http', '$rootScope', '$filter', function($scope, $http, $rootScope, $filter) {
    $scope.title = 'Tambah Pasien';
    $scope.detail = []
    $scope.village = []
    $scope.district = []
    $scope.formData = {
        'patient_type' : 'ANAK',
        'family' : {}
    }
    $scope.data = {}
    var path = window.location.pathname;
    if(/edit/.test(path)) {
        $scope.title = 'Edit Pasien';
        
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

    $http.get(baseUrl + '/controller/master/district').then(function(data) {
        $scope.data.district = data.data
        
    $http.get(baseUrl + '/controller/master/village').then(function(data) {
        $scope.data.village = data.data
        if(/edit/.test(path)) {
          id = path.replace(/.+\/(\d+)/, '$1');
          $http.get(baseUrl + '/controller/master/patient/' + id).then(function(data) {
              $scope.formData = data.data
              $scope.changeDistrict()
              $scope.changeVillage()
              setTimeout(function () {                
                  $('[ng-model="formData.birth_date"]').val( $scope.formData.birth_date != null ? $filter('fullDate')($scope.formData.birth_date) : '')
              }, 300)
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



    $scope.countAge = function() {
      var birth_year = $scope.formData.birth_date.replace(/(\d+)-.+/, '$1');
      var current_date = new Date();
      var current_year = current_date.getFullYear();
      var age = (parseInt(current_year) || 0) - (parseInt(birth_year) || 0)
      $scope.formData.age = age;
    }

    $scope.changeDistrict = function() {
      $scope.village = []
      var district = $scope.data.district.filter(x => x.city_id == $scope.formData.city_id)
      $scope.district = district
    }

    $scope.changeVillage = function() {
      var village = $scope.data.village.filter(x => x.district_id == $scope.formData.district_id)
      $scope.village = village
    }

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/master/patient';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/master/patient/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/patient'          
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
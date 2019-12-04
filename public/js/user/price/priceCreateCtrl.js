app.controller('priceCreate', ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope) {
    $scope.title = 'Tambah Tarif';
    $scope.formData = {}
    $scope.data = {}
    var path = window.location.pathname;
    if(/edit/.test(path)) {
        $scope.title = 'Edit Departemen';
        id = path.replace(/.+\/(\d+)/, '$1');
        $http.get(baseUrl + '/controller/user/price/' + id).then(function(data) {
            $scope.formData = data.data
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

    $scope.grup_nota = function() {
        $http.get(baseUrl + '/controller/user/grup_nota').then(function(data) {
            $scope.data.grup_nota = data.data
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.grup_nota()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.grup_nota()


    $scope.polyclinic = function() {
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
            
            $scope.polyclinic()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.polyclinic()

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/user/price';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/user/price/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/price'          
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
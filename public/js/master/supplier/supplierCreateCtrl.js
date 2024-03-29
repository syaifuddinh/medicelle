app.controller('supplierCreate', ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope) {
    $scope.title = 'Tambah Distributor Farmasi';
    $scope.formData = {
        'supplier_category' : 'principal'
    }
    $scope.data = {}
    var path = window.location.pathname;
    if(/edit/.test(path)) {
        $scope.title = 'Edit Distributor Farmasi';
        id = path.replace(/.+\/(\d+)/, '$1');
        $http.get(baseUrl + '/controller/master/supplier/' + id).then(function(data) {
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

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/master/supplier';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/master/supplier/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          if($rootScope.hasBuffer()) {
              $rootScope.accessBuffer()
          } else {
              window.location = baseUrl + '/supplier'          
          }
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
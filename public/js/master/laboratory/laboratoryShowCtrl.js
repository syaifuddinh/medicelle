app.controller('laboratoryShow', ['$scope', '$http', '$rootScope', '$filter', function($scope, $http, $rootScope) {
    $scope.title = 'Detail Item Pemeriksaan Laboratorium';
    $scope.formData = {}
    $scope.data = {}
    var path = window.location.pathname
    id = path.replace(/.+\/(\d+)/, '$1');
    
    $scope.show = function() {
      $http.get(baseUrl + '/controller/master/laboratory/' + id).then(function(data) {
            $scope.formData = data.data
            $scope.formData = data.data
            $scope.changeSampleCode()
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
          $scope.show()
    });
    }

    $scope.category = function() {
        $http.get(baseUrl + '/controller/master/laboratory/category').then(function(data) {
            $scope.data.category = data.data
            $scope.show()
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.category()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.category()

    $scope.changeSampleCode = function() {
        var prefix = '';
        var code = '';
        if($scope.formData.code) {
          
            if($scope.formData.is_category == 0 && $scope.formData.category_id) {
                console.log($scope.data.category)
                prefix = $scope.data.category.find(x => parseInt(x.id) == parseInt($scope.formData.category_id)).code
                prefix = prefix.padStart(3, 0) + '.'
            }

            var code = $scope.formData.code.padStart(3, 0)
        }
        $scope.sample_code = prefix +  code
    }

    $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
      if(is_delete)
          $http.delete(baseUrl + '/controller/master/laboratory/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/master/laboratory/activate/' + id).then(function(data) {
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
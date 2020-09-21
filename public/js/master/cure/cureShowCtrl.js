app.controller('cureShow', ['$scope', '$http', '$rootScope', '$filter', function($scope, $http, $rootScope) {
    $scope.title = 'Detail BMHP';
    $scope.formData = {}
    $scope.data = {}
    var path = window.location.pathname
    id = path.replace(/.+\/(\d+)/, '$1');
    
    $scope.show = function() {
      $http.get(baseUrl + '/controller/master/medical_item/' + id).then(function(data) {
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
        $http.get(baseUrl + '/controller/master/medical_item/category').then(function(data) {
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
          
            if($scope.formData.category_id && $scope.formData.classification_id) {
                category_code = $scope.data.category.find(x => x.id == $scope.formData.category_id).code
                category_code = category_code.padStart(2, 0)
                classification_code = $scope.data.classification.find(x => x.id == $scope.formData.classification_id).code
                classification_code = classification_code.padStart(3, 0)
                prefix = '400.02.00.00.' + category_code + '.' + classification_code + '.'
            }

            var code = $scope.formData.code.padStart(3, 0)
        }
        $scope.sample_code = prefix +  code
    }

    $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
      if(is_delete)
          $http.delete(baseUrl + '/controller/master/cure/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/master/cure/activate/' + id).then(function(data) {
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
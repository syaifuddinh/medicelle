app.controller('obatShow', ['$scope', '$http', '$rootScope', '$filter', function($scope, $http, $rootScope) {
    $scope.title = 'Detail Obat';
    $scope.formData = {}
    $scope.data = {}
    var path = window.location.pathname
    id = path.replace(/.+\/(\d+)/, '$1');

     $scope.showClassification = function() {
        $http.get(baseUrl + '/controller/master/obat/classification/actived').then(function(data) {
            $scope.data.classification = data.data
            $scope.changeClassification()
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.showClassification()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }

    $scope.showSubclassification = function() {
        $http.get(baseUrl + '/controller/master/obat/subclassification/actived').then(function(data) {
            $scope.data.subclassification = data.data
            $scope.changeSubclassification()
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.showSubclassification()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }

    $scope.showGeneric = function() {
        $http.get(baseUrl + '/controller/master/obat/generic/actived').then(function(data) {
            $scope.data.generic = data.data
            $scope.changeGeneric()
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.showGeneric()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }

    $scope.changeSampleCode = function() {
        var prefix = '';
        var code = '';
        if($scope.formData.code) {
          
            if($scope.formData.category_id && $scope.formData.classification_id && $scope.formData.subclassification_id && $scope.formData.generic_id) {
                category_code = $scope.data.category.find(x => x.id == $scope.formData.category_id).code
                category_code = category_code.padStart(2, 0)
                classification_code = $scope.data.classification.find(x => x.id == $scope.formData.classification_id).code
                classification_code = classification_code.padStart(2, 0)
                subclassification_code = $scope.data.subclassification.find(x => x.id == $scope.formData.subclassification_id).code
                subclassification_code = subclassification_code.padStart(2, 0)
                generic_code = $scope.data.generic.find(x => x.id == $scope.formData.generic_id).code
                generic_code = generic_code.padStart(3, 0)

                prefix = '400.01.' + category_code + '.' + classification_code + '.' + subclassification_code + '.' + generic_code + '.'
            }

            var code = $scope.formData.code.padStart(3, 0)
        }
        $scope.sample_code = prefix +  code
    }
    
    $scope.show = function() {
      $http.get(baseUrl + '/controller/master/obat/' + id).then(function(data) {
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
          $scope.show()
    });
    }

    $scope.show()


    $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
      if(is_delete)
          $http.delete(baseUrl + '/controller/master/obat/' + id).then(function(data) {
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
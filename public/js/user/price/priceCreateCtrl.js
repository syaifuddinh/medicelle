app.controller('priceCreate', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope, $compile) {
    $scope.title = 'Tambah Tarif';
    $scope.formData = {}
    $scope.formData.laboratory_types = []
    $scope.data = {}
    var path = window.location.pathname;
    $scope.show = function() {

        if(/edit/.test(path)) {
            $scope.title = 'Edit Tarif';
            id = path.replace(/.+\/(\d+)/, '$1');
            $http.get(baseUrl + '/controller/user/price/' + id).then(function(data) {
                $scope.formData = data.data
                $scope.formData.name = data.data.service.name
                $scope.formData.price = data.data.service.rate
                $scope.formData.piece_id = data.data.service.piece_id
                $scope.formData.laboratory_types = []
                $scope.showLaboratoryType()
            }, function(error) {
              $scope.show()
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
    }
    $scope.show()

    $scope.showLaboratoryType = function() {
        $http.get(baseUrl + '/controller/user/laboratory_type').then(function(data) {
            var units = data.data
            var laboratory_type_datatable = $('#laboratory_type_datatable tbody')
            var unit, tr, td, laboratory_treatment
            for(x in units) {
                tr = $("<tr></tr>")
                for(y in units[x]) {
                    unit = units[x][y]
                    if(/edit/.test(path)) {
                        laboratory_treatment = $scope.formData.laboratory_treatment.find(i => i.laboratory_type_id == unit.id)
                        if(laboratory_treatment != undefined) {
                            unit.is_active = 1
                        }
                    }
                    $scope.formData.laboratory_types.push(unit)
                    var length = $scope.formData.laboratory_types.length - 1
                    td = $("<td>" + unit.name + "<input type='checkbox' ng-model='formData.laboratory_types[" + length + "].is_active' ng-true-value='1' ng-false-value='0' class='pull-right'></td>")
                    tr.append(td)
                }
                laboratory_type_datatable.append(tr)
            }
            $compile(laboratory_type_datatable)($scope);
        }, function(error) {
          $scope.show()
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
    if(!/edit/.test(path)) {
        $scope.showLaboratoryType()
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


    $scope.radiology_type = function() {
        $http.get(baseUrl + '/controller/user/radiology_type').then(function(data) {
            $scope.data.radiology_type = data.data
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.radiology_type()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.radiology_type()

    $scope.piece = function() {
        $http.get(baseUrl + '/controller/master/piece/actived').then(function(data) {
            $scope.data.piece = data.data
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.piece()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.piece()


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
      console.log($scope.formData.laboratory_types)
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
app.controller('cureCreate', ['$scope', '$http', '$rootScope','$filter', function($scope, $http, $rootScope, $filter) {
    $scope.title = 'Tambah BMHP';
    $scope.insertData = {}
    $scope.formData = {
        is_category : 0,
        additional : {}
    }
    $scope.data = {}
    var path = window.location.pathname;


    $scope.countPrice = function() {
        $scope.formData.price = parseInt($scope.formData.purchase_price) * ( 100 + parseInt($scope.formData.additional.margin)) / 100
    }

    $scope.supplier = function() {
        $http.get(baseUrl + '/controller/master/supplier/principal').then(function(data) {
            $scope.data.supplier = data.data
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
            
            $scope.supplier()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.supplier()

    $scope.insert = function(flag) {
      var label
      switch (flag) {
        case 'category' :
          label = 'Kelompok'
          break
        case 'classification' :
          label = 'Jenis'
          $scope.insertData.category_id = $scope.formData.category_id
          break
        case 'subclassification' :
          label = 'Sub-Kelas'
          $scope.insertData.classification_id = $scope.formData.classification_id
          break
        case 'generic' :
          label = 'Generic'
          $scope.insertData.subclassification_id = $scope.formData.subclassification_id
          break
      }
      $scope.insert_title = 'Tambah ' + label
      $scope.componentState = flag
      if(flag != 'category') {
          if(flag == 'classification' && !$scope.formData.category_id) {
              toastr.warning("Kelompok tidak boleh kosong")
          } else {
            $('#insertModal').modal()
          }
      } else {
            $('#insertModal').modal()        
      }
    }

    $scope.changeClassification = function() {
        if($scope.formData.category_id) {
            classification = $scope.data.classification.filter(x => x.category_id == $scope.formData.category_id)
            $scope.classification = classification
        }
    }

    $scope.showClassification = function() {
        $http.get(baseUrl + '/controller/master/medical_item/classification/actived').then(function(data) {
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
    $scope.showClassification()

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

    $scope.show = function() {
        if(/edit/.test(path)) {
            $scope.title = 'Edit Item Medis';
            id = path.replace(/.+\/(\d+)/, '$1');
            $http.get(baseUrl + '/controller/master/medical_item/' + id).then(function(data) {
                $scope.formData = data.data
                $scope.formData.grup_nota_id = data.data.price.grup_nota_id
                $scope.formData.price = data.data.rate
                $scope.changeSampleCode()
                $scope.countPrice()
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
                $scope.show()
                toastr.error(error.data.message,"Error Has Found !");
              }
            });
        }
    }
    $scope.show()

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

    $scope.submitComponent=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/master/medical_item/' + $scope.componentState;
      var method = 'post';
      $http[method](url, $scope.insertData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        $scope.category()
        if($scope.componentState == 'classification') {
            $scope.showClassification()
        } else if($scope.componentState == 'subclassification') {
            $scope.showSubclassification()
        } else if($scope.componentState == 'generic') {
            $scope.showGeneric()
        } else if($scope.componentState == 'category') {
            $scope.category()
        }

        $scope.insertData = {}
        $('#insertModal').modal('hide')
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

    $scope.emptyCategory = function() {
        $scope.formData.category_id = null
        $scope.changeSampleCode()
    }

    $scope.category = function() {
        $http.get(baseUrl + '/controller/master/medical_item/category/actived').then(function(data) {
            $scope.data.category = data.data
            if(/edit/.test(path)) {
                $scope.show()
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
            
            $scope.category()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.category()

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

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/master/medical_item';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/master/medical_item/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/medical_item'          
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
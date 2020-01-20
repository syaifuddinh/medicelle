app.controller('groupUserCreate', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope, $compile) {
    $scope.title = 'Tambah Departemen';
    $scope.formData = {
      roles : {}
    }

    $compile(angular.element($('.compile')).contents())($scope);
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');
    
    $scope.uncheckAll = function() {
      $scope.formData.roles = {}
    }

    $scope.checkAll = function() {
      var roles = $('[ng-model*="formData.roles"]');
      var role, unit;
      for(model = 0;model < roles.length;model++) {
          console.log(roles[model])
          unit = $(roles[model])
          if(unit.length > 0) {
            role = unit.attr('ng-model').replace(/formData\.roles(.+)/, '$1')
            role = role.replace(/\.(\[.*\])/, '$1')
            console.log(role)
            role = role.replace(/\[["'](.+)["']\]/, '$1')
            $scope.formData.roles[role] = '1'
          }

      }
    }

    $scope.show = function() {
      $scope.title = 'Edit Departemen';
        $http.get(baseUrl + '/controller/user/group_user/' + id).then(function(data) {
            $scope.formData = data.data
            var length = data.data.roles.length
            if(typeof length == 'number') {
              $scope.formData.roles = {}
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
          $scope.show()
        });
    }

    if(/edit/.test(path)) {
        $scope.show()
    }

    $scope.searchRoles = function() {
        var keyword = $scope.keyword.toLowerCase().trim()
        var roles = $('tbody td:first-child, tbody th:first-child')
        var role, x, currentRow, row, hasParent = 1
        var roleName
        for(x = 0;x < roles.length;x++ ) {
            role = $(roles[x])
            currentRow = role.parents('tr')
            roleName = role.text().toLowerCase().trim()
            if(roleName.indexOf(keyword) > -1) {
                currentRow.show()
            } else {
              currentRow.hide()
              
            }


        }
    }

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/user/group_user';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/user/group_user/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/group_user'          
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
app.controller('userCreate', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope, $compile) {
    $scope.title = 'Tambah User';
    $scope.formData = {}
    $scope.data = {}

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $scope.formData.avatar = e.target.result;
          $('#img-preview').removeClass('hidden')
          $('#img-preview').attr('src', e.target.result)

        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }

    $('#avatar').change(function(){
        readURL(this)
    })

    $http.get(baseUrl + '/controller/user/group_user/').then(function(data) {
        $scope.data.group_user = data.data
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

    var path = window.location.pathname;
    if(/edit/.test(path)) {
        $scope.title = 'Edit User';
        id = path.replace(/.+\/(\d+)/, '$1');
        $http.get(baseUrl + '/controller/user/user/' + id).then(function(data) {
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

    $scope.submitForm=function() {
      if($scope.formData.password != $scope.formData.password_confirm) {
          toastr.warning('Password konfirmasi tidak cocok');
      } else {
          var formData = new FormData( $('#form')[0] )
          for(x in $scope.formData) {
              formData.append(x, $scope.formData[x]);
          }
          $rootScope.disBtn=true;
          if($scope.formData.id) {

              $http.put(baseUrl + '/controller/user/user/' + id, $scope.formData).then(function(data) {
                toastr.success("Data Berhasil Disimpan !");
                setTimeout(function () {
                  window.location = baseUrl + '/user'          
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
          } else {
              $.ajax({
        url:baseUrl+'/operational_warehouse/receipt?_token='+csrfToken,
        contentType : false,
        processData : false,
        type : 'POST',
        data : fd,
        beforeSend : function(request) {
          request.setRequestHeader('Authorization', 'Bearer ' + authUser.api_token);
        },
        success:function(data) {
          toastr.success("Data Berhasil Disimpan!");
           $scope.disBtn=false;
           $('.submitButton').removeAttr('disabled');
        },
        error : function(xhr) {
          var resp = JSON.parse(xhr.responseText);
           toastr.error(resp.message,"Error Has Found !");
           $('.submitButton').removeAttr('disabled');
        }
      });
          }
      }
    }
}]);
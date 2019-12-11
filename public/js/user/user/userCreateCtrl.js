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

    $scope.group_user = function() {
        $http.get(baseUrl + '/controller/user/group_user').then(function(data) {
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
            
            $scope.group_user()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.group_user()

    var path = window.location.pathname;
    if(/edit/.test(path)) {
        $scope.title = 'Edit User';
        $scope.user = authUser;
        id = path.replace(/.+\/(\d+)/, '$1');
        $http.get(baseUrl + '/controller/user/user/' + id).then(function(data) {
            $scope.formData = data.data
            $scope.formData.avatar = null
            $('#img-preview').removeClass('hidden')
            $('#img-preview').attr('src', data.data.avatar_url)
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
          $rootScope.disBtn = true
          $('.submitButton').attr('disabled', 'disabled')
          var url = baseUrl + '/controller/user/user';
          var method = 'post';
          var formData = new FormData( $('#form')[0] )
          for(x in $scope.formData) {
              formData.append(x, $scope.formData[x]);
          }
          $rootScope.disBtn=true;
          if($scope.formData.id) {
            var url = baseUrl + '/controller/user/user/' + $scope.formData.id;
          } 

          $.ajax({
            'url':url,
            contentType : false,
            processData : false,
            'type' : method,
            data : formData,
            success:function(data) {
              toastr.success("Data Berhasil Disimpan!");
               $('.submitButton').removeAttr('disabled');
               window.location = baseUrl + '/user'
            },
            error : function(xhr) {
              var resp = JSON.parse(xhr.responseText);
                if (xhr.status==422) {
                  var det="";
                  angular.forEach(resp.errors,function(val,i) {
                    det+="- "+val+"<br>";
                  });
                  toastr.warning(det,resp.message);
                } else {

                   toastr.error(resp.message,"Error Has Found !");
                }
               $('.submitButton').removeAttr('disabled');
            }
          });
          
      }
    }
}]);
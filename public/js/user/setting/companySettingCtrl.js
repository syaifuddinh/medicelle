app.controller('companySetting', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope, $compile) {
    $scope.title = 'Setting Perusahaan';
    $scope.formData = {
      company : {}
    }


    function readURL(input, flag = 1) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          if(flag == 1) {
              $('#img-preview').removeClass('hidden')
              $('#img-preview').attr('src', e.target.result)
          } else {
            
              $('#img-preview-2').removeClass('hidden')
              $('#img-preview-2').attr('src', e.target.result)
          }

        }
        
        reader.readAsDataURL(input.files[0]);
        fd = new FormData();
        var logo_url = baseUrl + '/controller/user/setting/store_logo'
        if(flag == 1) {
            fd.append('logo', input.files[0])
        } else if(flag == 2) {
            fd.append('logo2', input.files[0])
            logo_url = baseUrl + '/controller/user/setting/store_logo/2'
        }
        $.ajax({
            'url' : logo_url,
            contentType : false,
            processData : false,
            'type' : 'post',
            data : fd,
            success:function(data) {
              toastr.success("Data Berhasil Disimpan!");
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
            }
          });
      }
    }

    $('#logo').change(function(){
        readURL(this, 1)
    })
    $('#logo2').change(function(){
        readURL(this, 2)
    })

    $scope.show = function() {
        $http.get(baseUrl + '/controller/user/setting/company').then(function(data) {
            $scope.formData.company = data.data
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
    
    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/user/setting/store_company';
      var method = 'put';
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
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
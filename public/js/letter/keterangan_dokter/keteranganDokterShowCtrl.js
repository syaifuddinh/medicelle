app.controller('keteranganDokterShow', ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope) {
    $scope.title = 'Detail Surat Keterangan Dokter';
    $scope.formData = {}
    var path = window.location.pathname
    id = path.replace(/.+\/(\d+)/, '$1');
    $scope.show = function() {

        if(true) {
            $scope.title = 'Detail Surat Keterangan Dokter';
            id = path.replace(/.+\/(\d+)/, '$1');
            $http.get(baseUrl + '/controller/letter/keterangan_dokter/' + id).then(function(data) {
                $scope.formData = data.data
                $scope.medical_record = data.data.medical_record
                $('#pdfDocument').attr('src', baseUrl + '/controller/letter/keterangan_dokter/' + data.data.id + '/pdf')
                setTimeout(function () {    
                      $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
                      $('[ng-model="formData.review_date"]').val( $filter('fullDate')($scope.formData.review_date))
                      $('[ng-model="formData.start_date"]').val( $filter('fullDate')($scope.formData.start_date))
                      $('[ng-model="formData.end_date"]').val( $filter('fullDate')($scope.formData.end_date))
                }, 300)
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
            }, function(){
                $scope.show()
            });
        } else {
            var currentDate = new Date()
            var date = currentDate.getFullYear() + '-' + ( currentDate.getMonth() + 1 ) + '-' + currentDate.getDate()
            $scope.formData.date = date
            setTimeout(function () {    
                  $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
            }, 300)
        }
    }
    $scope.show()
    $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
      if(is_delete)
          $http.delete(baseUrl + '/controller/user/keteranganDokter/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/user/keteranganDokter/activate/' + id).then(function(data) {
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
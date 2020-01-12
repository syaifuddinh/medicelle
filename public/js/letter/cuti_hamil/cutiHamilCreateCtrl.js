app.controller('cutiHamilCreate', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Tambah Surat Cuti Hamil';
    $scope.formData = {
      age_type : 'MINGGU',
      duration_type : 'BULAN'
    }
    $scope.medical_record = {}
    id = null
    var path = window.location.pathname;
    $scope.show = function() {

        if(/edit/.test(path)) {
            $scope.title = 'Edit Surat Cuti Hamil';
            id = path.replace(/.+\/(\d+)/, '$1');
            $http.get(baseUrl + '/controller/letter/cuti_hamil/' + id).then(function(data) {
                $scope.formData = data.data
                $scope.medical_record = data.data.medical_record
                $scope.medical_record.registration_detail = {
                  'doctor' : $scope.formData.doctor
                }
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

    $scope.showMedicalRecord = function() {
        $('#medicalRecordModal').modal()
    }

    $scope.adjustEndDate = function() {
        var start_date, month, duration, date, end_date = ''
        if($scope.formData.start_date) {
            start_date = new Date($scope.formData.start_date)
            if($scope.formData.duration_type == 'MINGGU') {
              duration = parseInt($scope.formData.duration) || 0
              duration *= 7
              start_date.setDate( parseInt(start_date.getDate()) + duration )
            } else {
              duration = parseInt($scope.formData.duration) || 0
              start_date.setMonth( parseInt(start_date.getMonth()) + duration )

            }
          end_date = start_date.getFullYear() + '-' + ( start_date.getMonth() + 1 ).toString().padStart(2, 0) + '-' + start_date.getDate().toString().padStart(2, 0)
        }
        $scope.formData.end_date = end_date
        setTimeout(function () {    
              $('[ng-model="formData.end_date"]').val( $filter('fullDate')($scope.formData.end_date))
        }, 300)
    }

    $scope.selectMedicalRecord = function(e) {
        var tr = $(e).parents('tr')
        var data = browse_medical_record_datatable.row(tr).data()
        $scope.medical_record = data
        $scope.formData.medical_record_id = data.id
        $('#medicalRecordModal').modal('hide') 
    }

    $scope.browse_medical_record = function() {
        browse_medical_record_datatable = $('#browse_medical_record_datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url : baseUrl+'/datatable/registration/medical_record',
            data : function(d) {
              d.length = 6

              return d
            }
          },
          columns:[
          {
            data:null, 
            name:null,
            searchable:false,
            orderable:false,
            className : 'text-center',
            render : resp => "<button type='button' class='btn btn-xs btn-primary' ng-click='selectMedicalRecord($event.currentTarget)'>Pilih</button>"
          },
          {data:"code", name:"code"},
          {data:"patient.name", name:"patient.name"},
          {data:"registration_detail.doctor.name", name:"registration_detail.doctor.name"},
          {data:"registration_detail.doctor.specialization.name", name:"registration_detail.doctor.specialization.name"},
          ],
          createdRow: function(row, data, dataIndex) {
            $compile(angular.element(row).contents())($scope);
          }
        });
    }
    $scope.browse_medical_record()

    $scope.reset = function() {
        $scope.formData = {
          age_type : 'MINGGU',
          duration_type : 'BULAN'
        }
        $scope.medical_record = {}
        var currentDate = new Date()
        var date = currentDate.getFullYear() + '-' + ( currentDate.getMonth() + 1 ) + '-' + currentDate.getDate()
        $scope.formData.date = date
        setTimeout(function () {    
              $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
        }, 300)
        window.scrollTo(0, 0)
    }

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/letter/cuti_hamil';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/letter/cuti_hamil/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        if($scope.repeat == 1) {
            if(!id) {
                $scope.reset()
            } else {
                window.location = baseUrl + '/surat/cuti_hamil/create'          
            }
        } else {
            setTimeout(function () {

              window.location = baseUrl + '/surat/cuti_hamil'          
            }, 1000)
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
      });
      
    }
}]);
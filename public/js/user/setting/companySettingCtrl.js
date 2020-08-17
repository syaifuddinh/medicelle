app.controller('companySetting', ['$scope', '$http', '$rootScope', '$compile', '$timeout', '$timeout', function($scope, $http, $rootScope, $compile, $timeout) {
    $scope.title = 'General';
    $scope.formData = {
      company : {}
    }
    $scope.p = {}
    $scope.person = []
    
    $scope.personPromise = 0
    medical_datatable = null

    $scope.changePic = function(contact_id) {
        var params = {
            'contact_id' : contact_id
        }
        $http.put(baseUrl + '/controller/user/setting/pic/' + $scope.picOn, params).then(function(data) {
            $scope.formData.company = data.data
            $scope.picSetting = null
            $scope.showPicSetting()
            $scope.splitByType()
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

    $scope.splitByType = function() {
        if($scope.personPromise < 3 || !$scope.picSetting || !$scope.incharge) {
            $timeout(function(){
                $scope.splitByType()
            }, 1000)
        } else {
            for(i in $scope.pic) {
                $scope.incharge[$scope.pic[i].slug] = $scope.person.filter(p => $scope.picSetting[$scope.pic[i].slug].includes(p.id))
            }
        }
    }
    $scope.splitByType()

    $scope.showDoctor = function() {
        $http.get(baseUrl + '/controller/master/doctor').then(function(data) {
            $scope.person = $scope.person.concat(data.data) 
            $scope.personPromise += 1
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
          $scope.showDoctor()
        });
    }
    $scope.showDoctor()

    $scope.showNurse = function() {
        $http.get(baseUrl + '/controller/master/nurse').then(function(data) {
            $scope.person = $scope.person.concat(data.data) 
            $scope.personPromise += 1
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
          $scope.showNurse()
        });
    }
    $scope.showNurse()

    $scope.showNurseHelper = function() {
        $http.get(baseUrl + '/controller/master/nurse_helper').then(function(data) {
            $scope.person = $scope.person.concat(data.data) 
            $scope.personPromise += 1
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
          $scope.showNurseHelper()
        });
    }
    $scope.showNurseHelper()

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

    $scope.showMedicalDatatable = function() {
        medical_datatable = $('#medical_datatable').DataTable({
            processing: true,
            serverSide: true,
            dom: 'frtip',
            ajax: {
              url : baseUrl+'/datatable/master/medical',
              data : function(d) {
                d.is_display_all = 1
                d.is_active = 1

                return d
              }
            },
            columns:[
                {data:"name", name:"name"},
                {
                    data:null, 
                    searchable:false,
                    orderable:false,
                    render:function(r){
                        var input, checked = ''
                        $scope.p[r.id] = false
                        if($scope.picOn) {
                            if($scope.picSetting[$scope.picOn].filter(x => x == r.id).length > 0) {
                                checked = 'checked'
                                $scope.p[r.id] = true
                            }
                            console.log($scope.picSetting[$scope.picOn])
                        }
                        input = "<input type='checkbox' ng-model='p[" + r.id + "]' ng-change='changePic(" + r.id + ")' class='pull-right' " + checked + ">"
                        return input
                    } 
                },
            ],
            createdRow: function(row, data, dataIndex) {
              $compile(angular.element(row).contents())($scope);
            }
        });
    }

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

    $scope.showPicSetting = function() {
        $http.get(baseUrl + '/controller/user/setting/pic').then(function(data) {
            $scope.picSetting = data.data
            if(!medical_datatable) {
                $scope.showMedicalDatatable()
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
          $scope.showPicSetting()
        });
    }
    $scope.showPicSetting()
    $scope.showRelated = function(slug, name) {
        $scope.picOn = slug
        $('#medicalModal .modal-title').html('Penanggung Jawab ' + name)
        $rootScope.disBtn=false;
        medical_datatable.ajax.reload()
        $('#medicalModal').modal()
        $compile($('.modal-title'))($scope);
    }

    $scope.showPic = function() {
        $http.get(baseUrl + '/controller/user/setting/pic/show').then(function(data) {
            $scope.pic = data.data
            $scope.incharge = {}
            for(p in $scope.pic) {
                $scope.incharge[$scope.pic[p].slug] = []
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
          $scope.showPic()
        });
    }
    $scope.showPic()
    
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
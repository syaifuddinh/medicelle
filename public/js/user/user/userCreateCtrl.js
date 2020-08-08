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

    $scope.showRolesModal = function() {
        $scope.showRoles()
        $('#rolesModal').modal()
    }

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

    $scope.renderRoles = function(roles) {
        var tr, level = {}, level2, level3
        var roles_container = $('#roles_container tbody')
        roles_container.html('')
        var renderRow = function(padLeft = 0, name, slug, id, parent_id = '') {
            var tr, col 
            tr = $('<tr></tr>')
            if(padLeft == 0) {
                col = $('<th>')
            } else {
                col = $('<td>')              
            }
            col.html(name)
            if(padLeft > 0) {
                col.css('paddingLeft', padLeft + 'mm')
            }
            tr.attr('data-id', id)
            tr.attr('data-parent-id', parent_id)
            tr.append(
                col
            )

            col = col.clone().html('')
            col.append(
                $('<button type="button" class="btn btn-sm btn-primary pull-right" ng-click="selectRoles(' + id + ', \'' + name + '\')">Pilih</button>')
            )
            tr.append(
                col
            )
            return tr
        }
        if(roles.length > 0) {
            for(r in roles) {
                level['1'] = roles[r]
                tr = renderRow(0, level['1']['name'], level['1']['slug'], level['1']['id'])
                roles_container.append(tr)
                roles[r]['tr'] = tr
                level2 = level['1']['level2']
                if( level2 !== null ) {
                    if(level2[0] !== null) {
                        for(s in level2) {
                            level['2'] = level2[s] 
                            tr = renderRow(10, level['2']['name'], level['2']['slug'], level['2']['id'], level['2']['parent_id'])
                            roles_container.append(tr)
                            roles[r]['level2'][s]['tr'] = tr
                            if(!('level3' in level['2'])) {
                                level['2']['level3'] = null
                            }
                            level3 = level['2']['level3']
                            if( level3 !== null ) {
                                if(level3[0] !== null) {
                                    for(t in level3) {
                                        level['3'] = level3[t]
                                        tr = renderRow(20, level['3']['name'], level['3']['slug'], level['3']['id'], level['3']['parent_id'])
                                        roles_container.append(tr)
                                        roles[r]['level2'][s]['level3'][t]['tr'] = tr
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
          roles_container.append(
              $('<tr><td colspan="2" class="text-center">Tidak ada data</td></tr>')
          )
        }
        $compile( $('#roles_container tbody') )($scope)
    }

    $scope.selectRoles = function(id, name) {
        $scope.formData.favorite_page_id = id
        $scope.formData.favorite_page_name = name
        $('#rolesModal').modal('hide')
    }

    $scope.emptyFavoritePage = function() {
        $scope.formData.favorite_page_id = null
        $scope.formData.favorite_page_name = null
    }

    $scope.showRoles = function() {
        var params = { 'hide_level' : '[3]'}
        $http.get(baseUrl + '/controller/user/group_user/' + $scope.formData.group_user_id + '/roles', {'params' : params}).then(function(data) {
          roles = data.data || []
          $scope.renderRoles(roles)
        }, function(error) {
          $scope.showRoles()
        });
    }
    $scope.showRoles()

    $scope.show = function() {
        var path = window.location.pathname;
        if(/edit/.test(path)) {
            $scope.title = 'Edit User';
            $scope.user = authUser;
            id = path.replace(/.+\/(\d+)/, '$1');
            $http.get(baseUrl + '/controller/user/user/' + id).then(function(data) {
                $scope.formData = data.data
                $scope.formData.favorite_page_name = data.data.role.name
                $scope.formData.avatar = null
                $('#img-preview').removeClass('hidden')
                $('#img-preview').attr('src', data.data.avatar_url)
                $scope.showRoles()
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
    }
    $scope.show()

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
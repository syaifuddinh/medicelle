app.controller('groupUserShow', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope, $compile) {
    $scope.title = 'Detail Group User';
    $scope.formData = {}
    $scope.is_hidden = 1
    var path = window.location.pathname
    id = path.replace(/.+\/(\d+)/, '$1');

    $scope.show = function() {
        $http.get(baseUrl + '/controller/user/group_user/' + id).then(function(data) {
                $scope.formData = data.data
                var lock = $('<div style="position:absolute;top:0;left:0;width:100%;height:100%;"></div>')
                $('#roles_container').append(lock)
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


    $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
      if(is_delete)
          $http.delete(baseUrl + '/controller/user/group_user/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/user/group_user/activate/' + id).then(function(data) {
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
            col.attr('colspan', 2)
            return tr
        }
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
        $compile( $('#roles_container tbody') )($scope)
    }

    $scope.showRoles = function() {
        $http.get(baseUrl + '/controller/user/group_user/' + id + '/roles').then(function(data) {
          roles = data.data || []
          $scope.renderRoles(roles)
        }, function(error) {
          $scope.showRoles()
        });
    }
    $scope.showRoles()
}]);
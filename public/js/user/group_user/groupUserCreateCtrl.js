app.controller('groupUserCreate', ['$scope', '$http', '$rootScope', '$compile', '$timeout', function($scope, $http, $rootScope, $compile, $timeout) {
    $scope.title = 'Tambah Departemen';
    $scope.formData = {
      roles : {}
    }
    $scope.roleData = []
    $scope.data = {}

    $compile(angular.element($('.compile')).contents())($scope);
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');
    
    $scope.uncheckAll = function() {
      $scope.formData.roles = {}
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

            col = col.clone()
            col.html('')
            col.addClass('text-right')
            col.append(
                $('<label class="radio-inline"><input type="checkbox" ng-click=\'adjustParent($event.currentTarget, "' + slug + '")\' ng-model=\'formData.roles["' + slug + '"]\' ng-true-value=\'"1"\' ng-false-value=\'"0"\' ></label>')
            )
            tr.append(
                col
            )

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

    $scope.adjustParent = function(e, s) {
        $timeout(function() {
            v = $scope.formData.roles[s]
            if(v == 1) {
                var tr = $(e).parents('tr')
                var parent_id = tr.attr('data-parent-id')
                var related = $('[data-id="' + parent_id + '"]')
                if(related.length > 0) {
                    var parent = related.find('input[type="checkbox"]')
                    var model = parent.attr('ng-model')
                    var slug = model.replace(/.*\["(.+)"\].*/, '$1')
                    $scope.formData.roles[slug] = '1'
                    $scope.adjustParent(parent, slug)
                }
            }
        }, 200)
    } 

    $scope.showRoles = function() {
        $http.get(baseUrl + '/controller/user/roles').then(function(data) {
          roles = data.data
          $scope.renderRoles(roles)
        }, function(error) {
          $scope.showRoles()
        });
    }
    $scope.showRoles()

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

    var searchTimeout = null
    $scope.searchRoles = function() {
        $timeout.cancel(searchTimeout)
        $timeout(function() {
            var y, z
            var keyword = $scope.keyword.toLowerCase().trim()
            var level = {}
            for(r in roles) {
                y = 0
                z = 0
                level['1'] = roles[r]
                level2 = level['1']['level2']
                if( level2 !== null ) {
                    if(level2[0] !== null) {
                        for(s in level2) {
                            level['2'] = level2[s] 
                            level3 = level['2']['level3']
                            if( level3 !== null ) {
                                if(level3[0] !== null) {
                                    for(t in level3) {
                                        level['3'] = level3[t]
                                        if(level['3']['name'].toLowerCase().indexOf(keyword) > -1) {
                                            z += 1
                                            level['3']['tr'].show()
                                        } else {
                                            level['3']['tr'].hide()
                                        }
                                    }
                                }
                            }

                            if(level['2']['name'].toLowerCase().indexOf(keyword) > -1) {
                                y += 1
                                level['2']['tr'].show()
                                $('[data-parent-id="' + level['2']['id'] + '"]').show()
                            } else {
                                level['2']['tr'].hide()
                                if(z > 0) {                                
                                    level['2']['tr'].show()
                                }
                            }
                        }
                    }
                }
                if(level['1']['name'].toLowerCase().indexOf(keyword) > -1) {
                    level['1']['tr'].show()
                    $('[data-parent-id="' + level['1']['id'] + '"]').show()
                } else {
                    level['1']['tr'].hide()
                    if(y > 0) {                                
                        level['1']['tr'].show()
                    }
                }
            }
        }, 600)
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
          if($rootScope.hasBuffer()) {
              $rootScope.accessBuffer()
          } else {
              window.location = baseUrl + '/group_user'          
          }
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
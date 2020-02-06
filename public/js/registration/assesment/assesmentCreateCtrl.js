app.controller('assesmentCreate', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Form Assesment';
    $scope.data = {}
    $scope.filterData = {}
    $scope.priceSlider = 209
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');
    step = path.replace(/.*step\/(\d+)\/.*/, '$1')
    step = parseInt(step)


  $scope.assesmentHistory = function() {
      if(path.indexOf('history') > -1) {
          oTable = $('#listview').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                url : baseUrl+'/datatable/registration/assesment/' + $scope.formData.patient_id,
                data : d => Object.assign(d, $scope.filterData)
              },

              columns:[
                {
                  data:null, 
                  orderable:false,
                  searchable:false,
                  width : '45mm',
                  render:resp => $filter('fullDate')(resp.date)
                },
                {data:"main_complaint", name:"main_complaint", orderable:false},
                {data:"nurse.name", name:"nurse.name", orderable:false, searchable:false},
                {
                  data: null, 
                  orderable : false,
                  searchable : false,
                  className : 'text-center',
                  render : resp => 
                  "<div class='btn-group'>" + 
                  "<a allow_update_assesment class='btn btn-xs btn-success' href='" + baseUrl + "/assesment/step/1/edit/" + resp.id +  "' title='Edit'><i class='fa fa-pencil'></i></a></div>"
                },
              ],
              createdRow: function(row, data, dataIndex) {
                $compile(angular.element(row).contents())($scope);
              }
            });
      }
  }

  $scope.filter = function() {
    oTable.ajax.reload();
  }

  $scope.browse_assesment = function() {
      assesment_datatable = $('#assesment_datatable').DataTable({
          processing: true,
          serverSide: true,
          dom: 'frtip',
          ajax: {
            url : baseUrl+'/datatable/registration/assesment/' + $scope.patient.id,
            data : d => Object.assign(d, {'current_id' : id})
          },

          columns:[
            {
              data: null, 
              orderable : false,
              searchable : false,
              className : 'text-center',
              render : resp => '<button class="btn btn-sm btn-primary" ng-disabled="disBtn" ng-click="cloneAssesment($event.currentTarget)">Pilih</button>'
            },
            {
              data:null, 
              orderable:false,
              searchable:false,
              width : '45mm',
              render:resp => $filter('fullDate')(resp.date)
            },
            {data:"main_complaint", name:"main_complaint", orderable:false, searchable:false},
            {data:"doctor.name", name:"doctor.name", orderable:false, searchable:false},
          ],
          createdRow: function(row, data, dataIndex) {
            $compile(angular.element(row).contents())($scope);
          }
        });
  }

  $scope.submitOne = function(key) {
        $scope.silent = 1
        $scope.submitForm(0, key)
    }

  $scope.showAssesment = function() {
      $('#assesmentModal').modal()
  }
    
  $scope.cloneAssesment = function(e) {
      $rootScope.disBtn = true
      var tr = $(e).parents('tr')
      var origin = assesment_datatable.row(tr).data()
      $http.put(baseUrl + '/controller/registration/assesment/' + id + '/origin/' + origin.id).then(function(data) {
          $scope.reset();
          $scope.show();
          toastr.success('Assesment berhasil disalin');
          $rootScope.disBtn = false
          setTimeout(function () {
              $('#assesmentModal').modal('hide')
          }, 500)
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
        $rootScope.disBtn = false
    });
  }
    
  $scope.show = function() {
      $http.get(baseUrl + '/controller/registration/assesment/' + id).then(function(data) {
        $scope.formData = data.data
        $scope.patient = data.data.patient
        $scope.code = data.data.code

        $scope.assesmentHistory()
        $scope.browse_assesment()
        if(step == 1){

          disease_history_datatable.rows.add(data.data.disease_history).draw()
          family_disease_history_datatable.rows.add(data.data.family_disease_history).draw()
          pain_history_datatable.rows.add(data.data.pain_history).draw()
          pain_cure_history_datatable.rows.add(data.data.pain_cure_history).draw()
        } else if(step == 2) {
          allergy_history_datatable.rows.add(data.data.allergy_history).draw()
          $scope.changeRiskLevel()
        } else if(step == 3) {
          kid_history_datatable.rows.add(data.data.kid_history).draw()
          setTimeout(function () {                
              $('[ng-model="formData.hpht"]').val( $scope.formData.hpht != null ? $filter('fullDate')($scope.formData.hpht) : '')
          }, 300)
        } else if(step == 4) {
          imunisasi_history_datatable.rows.add(data.data.imunisasi_history).draw()
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
        $scope.show()
        toastr.error(error.data.message,"Error Has Found !");
      }
    });
  }

  $scope.submitDiseaseHistory = function() {
      disease_history_datatable.row.add($scope.disease_history).draw()
      $scope.disease_history = {}
  }

  $scope.changePainStatus = function() {
    $scope.formData.pain_score = parseInt($scope.formData.pain_score)
    if($scope.formData.pain_score  == 0) {
          $scope.pain_status = 'Tidak ada rasa nyeri'
      } else if($scope.formData.pain_score  == 1) {
          $scope.pain_status = 'Nyeri seperti gatal gigitan nyamuk'
      } else if($scope.formData.pain_score == 2) {
          $scope.pain_status = 'Terasa nyeri seperti dicubit'
      } else if($scope.formData.pain_score == 3) {
          $scope.pain_status = 'Nyeri sangat terasa seperti ditonjok di bagian wajah atau disuntik'
      } else if($scope.formData.pain_score == 4) {
          $scope.pain_status = 'Nyeri yang kuat seperti sakit gigi dan disengat tawon'
      } else if($scope.formData.pain_score == 5) {
          $scope.pain_status = 'Nyeri yang tertekan seperti terkilir, keseleo'
      } else if($scope.formData.pain_score == 6) {
          $scope.pain_status = 'Nyeri yang seperti tertusuk-tusuk menyebabkan tidak fokus dan komunikasi terganggu'
      } else if($scope.formData.pain_score == 7) {
          $scope.pain_status = 'Nyeri yang menusuk begitu kuat menyebabkan tidak bisa berkomunikasi dengan baik dan tidak mampu melakukan perawatan sendiri'
      } else if($scope.formData.pain_score == 8) {
          $scope.pain_status = 'Nyeri yang begitu kuat sehingga menyebabkan tidak bisa berfikir jernih'
      } else if($scope.formData.pain_score == 9) {
          $scope.pain_status = 'Nyeri yang menyiksa tak tertahankan sehingga ingin sehingga menghilangkan nyerinya'
      } else if($scope.formData.pain_score == 10) {
          $scope.pain_status = 'nyeri yang tidak terbayangkan dan tidak dapat diungkapkan sampai tidak sadarkan diri'
      }
      $compile(angular.element($('#pain_status')[0]).contents())($scope);
      $scope.submitOne('pain_score')
  }

  $scope.changeRiskLevel = function() {
    var f = $scope.formData
     var risk_level_status, risk_level_action 
     var risk_level = f.fallen + f.secondary_diagnose + f.helper + f.infus + f.walking + f.mental
     if(risk_level >=0 && risk_level <= 24) {
          risk_level_status = 'Tidak beresiko'
          risk_level_action = 'Perawatan dasar'
     } else if(risk_level >=25 && risk_level <= 50) {
          risk_level_status = 'Resiko rendah'
          risk_level_action = 'Pelaksanaan intervensi pencegahan jatuh standard'
     } else if(risk_level > 50) {
          risk_level_status = 'Resiko tinggi'
          risk_level_action = 'Pelaksanaan intervensi pencegahan jatuh standard'
     }
    $scope.risk_level_status = risk_level_status
    $scope.risk_level_action = risk_level_action

  }

  $scope.$on('slideEnded', function() {
      // user finished sliding a handle
      $scope.changePainStatus()
  })

  $scope.submitFamilyDiseaseHistory = function() {
      family_disease_history_datatable.row.add($scope.family_disease_history).draw()
      $scope.family_disease_history = {}
  }


  $scope.submitAllergyHistory = function() {
      $scope.allergy_history.is_unknown = $scope.allergy_history.is_unknown ? '1' : '0';
      allergy_history_datatable.row.add($scope.allergy_history).draw()
      $scope.allergy_history = {}
  }

  $scope.submitPainHistory = function() {
      $scope.pain_history.is_other_pain_type = $scope.pain_history.is_other_pain_type ? '1' : '0';
      pain_history_datatable.row.add($scope.pain_history).draw()
      $scope.pain_history = {}
  }

  $scope.submitImunisasiHistory = function() {
      $scope.imunisasi_history.is_other_imunisasi = $scope.imunisasi_history.is_other_imunisasi ? '1' : '0';
      $scope.imunisasi_history.is_imunisasi_month_age = $scope.imunisasi_history.is_imunisasi_month_age ? '1' : '0';
      imunisasi_history_datatable.row.add($scope.imunisasi_history).draw()
      $scope.imunisasi_history = {}
  }


  $scope.submitKidHistory = function() {
      $scope.kid_history.is_pregnant_week_age = $scope.kid_history.is_pregnant_week_age ? '1' : '0';
      kid_history_datatable.row.add($scope.kid_history).draw()
      $scope.kid_history = {}
  }

  $scope.submitPainCureHistory = function() {
      $scope.pain_cure_history.is_other_pain_cure_type = $scope.pain_cure_history.is_other_pain_cure_type ? '1' : '0';
      pain_cure_history_datatable.row.add($scope.pain_cure_history).draw()
      $scope.pain_cure_history = {}
  }

  $scope.disease = function() {

      $http.get(baseUrl + '/controller/master/disease').then(function(data) {
        $scope.data.disease = data.data
        $scope.show()
      }, function(error) {
        $rootScope.disBtn=false;
        if (error.status==422) {
          var det="";
          angular.forEach(error.data.errors,function(val,i) {
            det+="- "+val+"<br>";
          });
          toastr.warning(det,error.data.message);
        } else {
          $scope.disease()
          toastr.error(error.data.message,"Error Has Found !");
        }
      });
  }
  $scope.disease()

  allergy_history_datatable = $('#allergy_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    {
      data : null,
      render : resp => resp.is_unknown == 1 ? 'Tidak diketahui' : resp.cure
    },
    {data : 'side_effect'},
    {
      data : null,
      className : 'text-center',
      render : resp => '<button type="button" class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteAllergyHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    

  kid_history_datatable = $('#kid_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
        { data : 'kid_order', className : 'text-right'},
        { data : 'partus_year', className : 'text-right'},
        { data : 'partus_location'},
        { 
          data : null,
          render : function(resp) {
              var outp = resp.pregnant_month_age + ' bulan ';
              outp += resp.is_pregnant_week_age == 1 ? resp.pregnant_week_age + ' minggu' : ''
              return outp
          }
        },
        {data : 'birth_type'},
        {data : 'birth_helper'},
        {data : 'birth_obstacle'},
        {data : 'baby_gender'},
        {data : 'weight', className : 'text-right'},
        {data : 'long', className : 'text-right'},
        {data : 'komplikasi_nifas'},
        {
            data : null,
            className : 'text-center',
            render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteKidHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
        },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    

  pain_history_datatable = $('#pain_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    {data : 'pain_location'},
    {data : 'pain_type'},
    {data : 'pain_duration'},
    {data : 'emergence_time'},
    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deletePainHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    

  imunisasi_history_datatable = $('#imunisasi_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    {data : 'imunisasi'},
    {
      data : null,
      render : function(resp) {
          var outp= resp.imunisasi_year_age + ' Tahun '
          var imunisasi_month_age = resp.imunisasi_month_age || 0
          if(resp.is_imunisasi_month_age == 1 && imunisasi_month_age != 0) {
                outp += imunisasi_month_age + ' Bulan'
          }

          return outp
      }
    },
    {data : 'reaksi_imunisasi'},
    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteImunisasiHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  pain_cure_history_datatable = $('#pain_cure_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    {data : 'cure'},
    {data : 'emergence_time'},
    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deletePainCureHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  disease_history_datatable = $('#disease_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    {
      data : null,
      render : function(resp) {
        var disease = $scope.data.disease.find(x => x.id == resp.disease_id);
        return disease ? disease.name : '-'
      }
    },
    {data : 'cure'},
    {
      data : null,
      render : function(resp) {
        return $filter('fullDate')(resp.last_checkup_date);
      }
    },

    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteDiseaseHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  family_disease_history_datatable = $('#family_disease_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    {
      data : null,
      render : function(resp) {
        var disease = $scope.data.disease.find(x => x.id == resp.disease_id);
        return disease ? disease.name : '-'
      }
    },
    {data : 'cure'},
    {
      data : null,
      render : function(resp) {
        return $filter('fullDate')(resp.last_checkup_date);
      }
    },

    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteFamilyDiseaseHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  $scope.reset = function() {
      $scope.formData = {
        code : $scope.code,
        patient : $scope.patient,
        pain_score : 0
      }
      $scope.disease_history = {}
      $scope.family_disease_history = {}
      $scope.pain_history = {}
      $scope.pain_cure_history = {}
      $scope.allergy_history = {}
      $scope.kid_history = {}
      $scope.imunisasi_history = {}
      $scope.pain_status = 'Tidak ada rasa nyeri'

      if(step == 1) {
          disease_history_datatable.clear().draw();
          family_disease_history_datatable.clear().draw();
          pain_history_datatable.clear().draw();
      } else if(step == 2) {
          allergy_history_datatable.clear().draw();
      } else if(step == 3) {
          kid_history_datatable.clear().draw();
      }

      window.scrollTo(0, 0)
  }
  $scope.reset()
    
  $scope.deleteAllergyHistory = function(e) {
    var tr = $(e).parents('tr');
    allergy_history_datatable.row(tr).remove().draw()
  }
    
  $scope.deleteImunisasiHistory = function(e) {
    var tr = $(e).parents('tr');
    imunisasi_history_datatable.row(tr).remove().draw()
  }

  $scope.deletePainHistory = function(e) {
    var tr = $(e).parents('tr');
    pain_history_datatable.row(tr).remove().draw()
  }
    
  $scope.deleteKidHistory = function(e) {
    var tr = $(e).parents('tr');
    kid_history_datatable.row(tr).remove().draw()
  }
    
  $scope.deletePainCureHistory = function(e) {
    var tr = $(e).parents('tr');
    pain_cure_history_datatable.row(tr).remove().draw()
  }
    
  $scope.deleteDiseaseHistory = function(e) {
    var tr = $(e).parents('tr');
    disease_history_datatable.row(tr).remove().draw()
  }

  $scope.deleteFamilyDiseaseHistory = function(e) {
    var tr = $(e).parents('tr');
    family_disease_history_datatable.row(tr).remove().draw()
  }

    $scope.submitForm=function(is_massive = 1, key) {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/registration/assesment/' + id;
      var method = 'put';
      
      if(step == 1) {
          $scope.formData.pain_history = pain_history_datatable.data().toArray()
          $scope.formData.pain_cure_history = pain_cure_history_datatable.data().toArray()
          $scope.formData.disease_history = disease_history_datatable.data().toArray()
          $scope.formData.family_disease_history = family_disease_history_datatable.data().toArray()
      } else if(step == 2) {
          $scope.formData.allergy_history = allergy_history_datatable.data().toArray()
      } else if(step == 3) {
          $scope.formData.kid_history = kid_history_datatable.data().toArray()
      } else if(step == 4) {
          $scope.formData.imunisasi_history = imunisasi_history_datatable.data().toArray()
      }

      if(is_massive == 1) {
          submitData = $scope.formData
      } else {
          submitData = {}
          is_additional = /([a-z_]+)\.([a-z_]+)/
          if(is_additional.test(key)) {
              primary = key.replace(is_additional, '$1')
              second = key.replace(is_additional, '$2')
              submitData[primary] = {}
              submitData[primary][second] = $scope.formData[primary][second]

          } else {

            submitData[key] = $scope.formData[key]
          }
      }

      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        if(is_massive == 1) {
            toastr.success("Data Berhasil Disimpan !");
            if($scope.back == 1) {

                setTimeout(function () {
                  window.location = baseUrl + '/assesment/step/' + (step - 1) + '/edit/' + id          
                }, 1000)
            } else {
                if($scope.finished != 1) {
                  
                  setTimeout(function () {
                    window.location = baseUrl + '/assesment/step/' + (step + 1) + '/edit/' + id          
                  }, 1000)
                } else {
                  setTimeout(function () {
                    window.location = baseUrl + '/assesment/' + $scope.patient.id + '/patient/'          
                  }, 1000)

                }

            }
        }
        $scope.silent = 0
        
      }, function(error) {
        $scope.silent = 0
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
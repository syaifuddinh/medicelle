app.controller('medicalRecordShow', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Detail Rekam Medis';
    $scope.data = {}
    $scope.priceSlider = 209
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');
    step = path.replace(/.*step\/(\d+)\/.*/, '$1')
    step = parseInt(step)

  $scope.backtohome = function() {
      var home_url = baseUrl + '/medical_record/' + $scope.patient.id + '/patient';  
      window.location = home_url
  }
    
  $scope.show = function() {
      $http.get(baseUrl + '/controller/registration/medical_record/' + id).then(function(data) {
        $scope.formData = data.data
        $scope.patient = data.data.patient
        $scope.code = data.data.code

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
  

    $scope.submitForm=function() {
      if($scope.back == 1) {

            setTimeout(function () {
              window.location = baseUrl + '/medical_record/step/' + (step - 1) + '/show/' + id          
            }, 1000)
        } else {
            setTimeout(function () {
              window.location = baseUrl + '/medical_record/step/' + (step + 1) + '/show/' + id          
            }, 1000)
        }
    }
}]);
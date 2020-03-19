app.controller('medicalRecordCreate', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Form Rekam Medis';
    $scope.data = {}
    $scope.dot = '.............................................................................................................'
    $scope.shortDot = '..........'
    $scope.priceSlider = 209
    path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');
    step = path.replace(/.*step\/(\d+)\/.*/, '$1')
    step = parseInt(step)
    var today = new Date()
    $scope.resume_date = today.getFullYear() + '-' + (parseInt(today.getMonth()) + 1).toString().padStart(2, 0) + '-' + today.getDate().toString().padStart(2, 0)
    setTimeout(function () {    
          $('[ng-model="resume_date"]').val( $filter('fullDate')($scope.resume_date))
    }, 300)

    $('#printButton').hide()
    if(path.indexOf('permintaan') > -1) {
        $('#printButton').show()
    } 

    $('#printButton').click(function(){
       if(path.indexOf('fnab') > -1) {
          window.open( baseUrl + '/controller/registration/medical_record/' + id + '/fnab/pdf'  )
       } else if(path.indexOf('histopatologi') > -1) {
          window.open( baseUrl + '/controller/registration/medical_record/' + id + '/histopatologi/pdf'  )
       } else if(path.indexOf('papsmear') > -1) {
          window.open( baseUrl + '/controller/registration/medical_record/' + id + '/papsmear/pdf'  )
       } else if(path.indexOf('sitologi') > -1) {
          window.open( baseUrl + '/controller/registration/medical_record/' + id + '/sitologi/pdf'  )
       }
    })

    $scope.finishedMedicalRecord = function(is_finish) {
        if(is_finish == 1) {
          var role_layer = $('#role_layer')
          var lock = $('<div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>')
          role_layer.append(lock)
        }
    }

    $scope.checkStock = function(item_id) {
      var param = {
          'item_id' : item_id,
        }

      $http.get(baseUrl + '/controller/pharmacy/stock_transaction/item/check?' + $.param(param)).then(function(data) {
            $rootScope.disBtn=false;
            $scope.stock = data.data.qty
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

    $scope.checkStockByLokasi = function(item_id, lokasi_id) {
      if(item_id && lokasi_id) {
          var param = {
              'item_id' : item_id,
              'lokasi_id' : lokasi_id,
            }

          $http.get(baseUrl + '/controller/pharmacy/stock_transaction/lokasi/check?' + $.param(param)).then(function(data) {
                $rootScope.disBtn=false;
                $scope.stock = data.data.qty
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

    $scope.medicalRecordHistory = function() {

        if(path.indexOf('resume') > -1) {
            var medical_record_url = baseUrl + '/datatable/registration/medical_records/'
            $scope.filterData = {}            

            medical_record_history = $('#medical_record_history').DataTable({
              processing: true,
              serverSide: true,
              ajax: {
                url : medical_record_url  + $scope.formData.patient_id,
                data : d => Object.assign(d, $scope.filterData)
              },
              columns:[

                {
                  data:'registration_detail.registration.code', 
                  name:'registration_detail.registration.code',
                  width : '18mm',
                },
                {
                  data:null, 
                  orderable:false,
                  searchable:false,
                  width : '30mm',
                  render:resp => $filter('fullDate')(resp.medical_record.date)
                },
                {
                  data:null, 
                  className : 'capitalize',
                  render:function(resp) {
                      var destination = resp.registration_detail.destination.toLowerCase()
                      return destination
                  }
                },
                {
                  data:null, 
                  render:function(resp) {
                      var summary = "Tensi : " + resp.medical_record.blood_pressure + " mmHg, Nadi : " + resp.medical_record.pulse + " x/menit, Suhu badan : " + resp.medical_record.temperature + " <sup>o</sup>C, Nafas : " + resp.medical_record.breath_frequency + " x/menit"
                      return summary
                  }
                },
                {data:"registration_detail.doctor.name", name:"registration_detail.doctor.name"},
                {
                  data: null, 
                  orderable : false,
                  searchable : false,
                  width : '15mm',
                  className : 'text-center',
                  render : resp => "<div class='btn-group'><a class='btn btn-xs btn-default' href='#' ng-click='previewResume()' title='Preview'><i class='fa fa-file-text-o'></i></a><a class='btn btn-xs btn-success' href='#' ng-click='downloadResume()' title='Download'><i class='fa fa-download'></i></a><a class='btn btn-xs btn-primary' href='#' ng-click='downloadResumeDOCX()' title='Download dengan format ms. word'><i class='fa fa-file-word-o'></i></a></div>"
                },
              ],
              createdRow: function(row, data, dataIndex) {
                $compile(angular.element(row).contents())($scope);
              }
            });
            medical_record_history.buttons().container().appendTo( '.export_button' );

            $scope.filter = function() {
              medical_record_history.ajax.reload();
            }

        }
    }
 
    $("[ng-model='obgyn_disease_history.disease_name'], [ng-model='obgyn_family_disease_history.disease_name']").easyAutocomplete({
        data : ['Asma', 'Hipertensi', 'DM', 'Tiroid', 'Epilepsi'],
        list : { match: {
            enabled: true
          }
        }
    });

    $("[ng-model='ginekologi_history.name']").easyAutocomplete({
        data : ['Interfilitas', 'Infeksi', 'PMS', 'Cervisitis Cronis', 'Endrometeriosis', 'Myoma', 'Polip Servix', 'Kanker Kandungan', 'Operasi Kandungan', 'Perkosaan', 'Flour albus', 'Post Coital Bleeding'],
        list : { match: {
            enabled: true
          }
        }
    });


    $("[ng-model='komplikasi_kb_history.name']").easyAutocomplete({
        data : ['PID / Radang panggul', 'Pendarahan'],
        list : { match: {
            enabled: true
          }
        }
    });

    $compile(angular.element($(".ginekologi, .disease")).contents())($scope)

    // Pengaturan hak akses
    var role_layer = $('#role_layer')
    var role_cover
    var role_message
    if(role_layer.length > 0) {
        role_cover = role_layer.find('[style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"]')
        if(role_cover.length > 0) {
            $("[ng-click='reset()']").hide()
            $("button[type='submit']").hide()
            $("#reduksi_form_group").hide()
            role_message = $('<p class="text-primary" style="margin-bottom:6mm"><b><i class="fa fa-info-circle"></i> Anda hanya diizinkan untuk melihat data</b></p>')
            role_layer.before(role_message)
        }
    }

    const b64toBlob = (b64Data, contentType='', sliceSize=512) => {
     contentType = contentType || '';
        sliceSize = sliceSize || 512;

        var byteCharacters = atob(b64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            byteArrays.push(byteArray);
        }

      var blob = new Blob(byteArrays, {type: contentType});
      return blob;
  }

    if(path.indexOf('permintaan/fnab') > -1) {
        var signature_driver = $(".signature").jSignature({height:640, width:760, color:'blue'});
    } else {
        var signature_driver = $(".signature").jSignature({height:450, width:500, color:'blue'});
    }
    bodyImage = new Image()
    bodyImage.onload = function() {
        ctx.drawImage(bodyImage, 0, 0)
    }
    setTimeout(function () {

        var canvas =  $('canvas')[0]
        if( $('canvas').length > 0 ) {
            ctx = canvas.getContext('2d')
            $scope.resetSignature()
        }
    }, 300)

    $scope.resetSignature = function() {
        $(".signature").jSignature('reset') 
        if(path.indexOf('physique/head') > -1) {
              bodySrc = baseUrl + '/images/kepala.bmp'
        } else if(path.indexOf('physique/surgical') > -1) {
              bodySrc = baseUrl + '/images/general.bmp'
        } else if(path.indexOf('physique/breast') > -1) {
              bodySrc = baseUrl + '/images/breast.bmp'
        } else if(path.indexOf('physique/rectum') > -1) {
              bodySrc = baseUrl + '/images/rectum.bmp'
        } else if(path.indexOf('permintaan/fnab') > -1) {
              bodySrc = baseUrl + '/images/fnab.png'
        }

        bodyImage.src = bodySrc     
    }

    $scope.storeSignature = function() {
        if(path.indexOf('physique/head') > -1) {
              key = 'head'
        } else if(path.indexOf('physique/surgical') > -1) {
              key = 'surgical'
        } else if(path.indexOf('physique/breast') > -1) {
              key = 'breast'
        } else if(path.indexOf('physique/rectum') > -1) {
              key = 'rectum'
        } else if(path.indexOf('permintaan/fnab') > -1) {
              key = 'fnab'
        }
        var fd = new FormData();
        var signature = $('.signature').jSignature("getData", "image");
        const contentType = signature[0];
        const b64Data = signature[1];
        const blob = b64toBlob(b64Data, contentType);
        console.log({contentType, b64Data, blob} );
        const body_visual = blob;
        fd.append(key + '_visual', body_visual);
        $('.submitButton').attr('disabled', 'disabled');
        $.ajax({
            'url':baseUrl + '/controller/registration/medical_record/' + id + '/store_signature/' + key,
            contentType : false,
            processData : false,
            'type' : 'post',
            data : fd,
            success:function(data) {
              toastr.success("Foto Berhasil Disimpan!");
               $('.submitButton').removeAttr('disabled');
               window.location.reload()
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

    $scope.backtohome = function() {
        var home_url = baseUrl + '/medical_record/polyclinic/' + $scope.patient.id + '/patient';  
        window.location = home_url
    }

    $scope.showNewResearch = function(medical_record_detail_id) {
        $scope.medical_record_detail_id = medical_record_detail_id
        var research = $scope.formData.radiology.concat($scope.formData.laboratory)
        var sample = research.find(x => x.id == medical_record_detail_id)
        $scope.new_research = {
            'additional' : sample.additional
        }        
        $('#newResearchModal').modal()
    }

    $scope.submitNewResearch = function() {
        $scope.updateResearch($scope.medical_record_detail_id, function(){
            $('#newResearchModal').modal('hide')
            window.location.reload()
        })
    }

    $scope.changeResumeDate = function() {
        $scope.showResume($scope.resume_date)
    }

    $scope.previewResume = function(date) {
        var source = baseUrl + '/controller/registration/medical_record/' + id + '/pdf'
        window.open(source)
    }

    $scope.downloadResume = function(date) {
        var source = baseUrl + '/controller/registration/medical_record/' + id + '/pdf/download'
        window.open(source)
    }

    $scope.downloadResumeDOCX = function(date) {
        var source = baseUrl + '/controller/registration/medical_record/' + id + '/docx'
        window.open(source)
    }

    $scope.browse_medical_record = function() {
      medical_record_datatable = $('#medical_record_datatable').DataTable({
          processing: true,
          serverSide: true,
          dom: 'frtip',
          ajax: {
            url : baseUrl+'/datatable/registration/polyclinic_medical_record/' + $scope.patient.id,
            data : d => Object.assign(d, {'current_id' : id})
          },

          columns:[
            {
              data: null, 
              orderable : false,
              searchable : false,
              className : 'text-center',
              render : resp => '<button class="btn btn-sm btn-primary" ng-disabled="disBtn" ng-click="cloneMedicalRecord($event.currentTarget)">Pilih</button>'
            },
            {data:"code", name:"code", width : '35mm' },
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

  $scope.browse_doctor = function() {
      doctor_datatable = $('#doctor_datatable').DataTable({
          processing: true,
          serverSide: true,
          dom: 'frtip',
          ajax: {
            url : baseUrl+'/datatable/master/doctor',
            data : d => Object.assign(d, {'current_id' : $scope.doctor.id})
          },

          columns:[
            {
              data: null, 
              orderable : false,
              searchable : false,
              className : 'text-center',
              render : resp => '<button class="btn btn-sm btn-primary" ng-disabled="disBtn" ng-click="selectDoctor($event.currentTarget)">Pilih</button>'
            },
            {data:"name", name:"name" },
            {data:"specialization.name", name:"specialization.name" },
           ],
          createdRow: function(row, data, dataIndex) {
            $compile(angular.element(row).contents())($scope);
          }
        });
  }

  $scope.showMedicalRecord = function() {
      $('#medicalRecordModal').modal()
  }
    
  $scope.cloneMedicalRecord = function(e) {
      $rootScope.disBtn = true
      var tr = $(e).parents('tr')
      var origin = medical_record_datatable.row(tr).data()
      $http.put(baseUrl + '/controller/registration/medical_record/' + id + '/origin/' + origin.id).then(function(data) {
          $scope.reset();
          $scope.show();
          toastr.success('Rekam medis berhasil disalin');
          $rootScope.disBtn = false
          setTimeout(function () {
              $('#medicalRecordModal').modal('hide')
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
  
  $scope.assesmentHistory = function() {
          assesment_history = $('#assesment_history').DataTable({
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
                  "<a is_nurse class='btn btn-xs btn-success' href='" + baseUrl + "/assesment/step/1/edit/" + resp.id +  "' title='Edit'><i class='fa fa-pencil'></i></a></div>"
                },
              ],
              createdRow: function(row, data, dataIndex) {
                $compile(angular.element(row).contents())($scope);
              }
            });

          $scope.filter = function() {
            assesment_history.ajax.reload();
          }
      
  }
    
  $scope.show = function() {
      $scope.reset()
      $http.get(baseUrl + '/controller/registration/medical_record/' + id).then(function(data) {
        $scope.formData = data.data
        $scope.patient = data.data.patient
        $scope.code = data.data.code
        $scope.finishedMedicalRecord($scope.formData.registration_detail.status)
        setTimeout(function () {    
              $('[ng-model="formData.hpht"]').val( $filter('fullDate')($scope.formData.hpht))
              $('[ng-model="formData.additional.papsmear_date"]').val( $filter('fullDate')($scope.formData.additional.papsmear_date))
              $('[ng-model="formData.additional.sitologi_date"]').val( $filter('fullDate')($scope.formData.additional.sitologi_date))
        }, 300)
        $scope.medicalRecordHistory()
        $scope.browse_medical_record()
        if(step) {
            if(step == 1){

              disease_history_datatable.rows.add(data.data.disease_history).draw()
              family_disease_history_datatable.rows.add(data.data.family_disease_history).draw()
              pain_history_datatable.rows.add(data.data.pain_history).draw()
              pain_cure_history_datatable.rows.add(data.data.pain_cure_history).draw()
            } else if(step == 2) {
              obgyn_disease_history_datatable.rows.add(data.data.obgyn_disease_history).draw()
              obgyn_family_disease_history_datatable.rows.add(data.data.obgyn_family_disease_history).draw()
              ginekologi_history_datatable.rows.add(data.data.ginekologi_history).draw()
              kb_history_datatable.rows.add(data.data.kb_history).draw()
              komplikasi_kb_history_datatable.rows.add(data.data.komplikasi_kb_history).draw()
              kid_history_datatable.rows.add(data.data.kid_history).draw()
            } 
        }

        if(path.indexOf('physique/general') > -1) {
              diagnose_history_datatable.rows.add(data.data.diagnose_history).draw()
        }

        if(path.indexOf('therapy/treatment') > -1) {
              treatment_datatable.rows.add(data.data.treatment).draw()
        }


        if(path.indexOf('therapy/diagnostic') > -1) {
              diagnostic_datatable.rows.add(data.data.diagnostic).draw()
        }

        if(path.indexOf('therapy/drug') > -1) {
              drug_datatable.rows.add(data.data.drug).draw()
        }

        if(path.indexOf('therapy/treatment_group') > -1) {
              treatment_group_datatable.rows.add(data.data.treatment_group).draw()
        }

        if(path.indexOf('radiology') > -1) {
              radiology_datatable.rows.add(data.data.radiology).draw()
        }

        if(path.indexOf('laboratory') > -1) {
              laboratory_datatable.rows.add(data.data.laboratory).draw()
        }

        if(path.indexOf('pathology') > -1) {
              pathology_datatable.rows.add(data.data.pathology).draw()
        }

        if(path.indexOf('bhp') > -1) {
              bhp_datatable.rows.add(data.data.bhp).draw()
        }

        if(path.indexOf('sewa_alkes') > -1) {
              sewa_alkes_datatable.rows.add(data.data.sewa_alkes).draw()
        }

        if(path.indexOf('sewa_ruangan') > -1) {
              sewa_ruangan_datatable.rows.add(data.data.sewa_ruangan).draw()
        }
        if(path.indexOf('assesment') > -1) {
              $scope.assesmentHistory()
        }
        if(path.indexOf('resume') > -1) {
              var unit, disease_name, disease;
              for(i in data.data.diagnose_history) {
                  unit = data.data.diagnose_history[i]
                  disease = $scope.data.disease.find(x => x.id == unit.disease_id)
                  disease_name = disease != null ? disease.name : '' 
                  $scope.formData.diagnose_history[i].disease_name = disease_name
              }
              $scope.next_schedule()
        }
    }, function(error) {
      $scope.show()
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
      
  $scope.next_schedule = function() {
      $http.get(baseUrl + '/controller/registration/medical_record/' + id + '/next_schedule').then(function(data) {
          $scope.next_schedule = data.data
      }, function(error) {
        $scope.next_schedule()
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

  $scope.doctor = function() {
      $http.get(baseUrl + '/controller/registration/medical_record/' + id + '/doctor').then(function(data) {
        $scope.doctor = data.data.doctor
        $scope.refer_doctor = data.data.refer_doctor
        $scope.browse_doctor()
    }, function(error) {
      $scope.doctor()
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
  $scope.doctor()
   
  $scope.schedule_item = function() {
    if(path.indexOf('schedule') > -1) {

          $http.get(baseUrl + '/controller/registration/medical_record/' + id + '/schedule').then(function(data) {
                schedule_datatable.rows.add(data.data).draw()
          }, function(error) {
            $scope.schedule_item()
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
  $scope.schedule_item()

  $scope.submitDiseaseHistory = function() {
      disease_history_datatable.row.add($scope.disease_history).draw()
      $scope.disease_history = {}
  }

  $scope.submitBHP = function() {
      $scope.bhp.item = {
          'name' : $scope.bhp.name,
          'piece' : $scope.bhp.piece
      }
      var lokasi = $scope.data.lokasi.find(x => x.id == $scope.bhp.lokasi_id)
      $scope.bhp.lokasi = lokasi
      bhp_datatable.row.add($scope.bhp).draw()
      $scope.bhp = {
          date : $scope.resume_date
      }
      setTimeout(function () {    
            $('[ng-model="bhp.date"]').val( $filter('fullDate')($scope.bhp.date))
      }, 300)
  }


  $scope.submitSewaAlkes = function() {
      $scope.sewa_alkes.item = {
          'name' : $scope.sewa_alkes.name,
          'piece' : $scope.sewa_alkes.piece
      }
      var lokasi = $scope.data.lokasi.find(x => x.id == $scope.sewa_alkes.lokasi_id)
      $scope.sewa_alkes.lokasi = lokasi
      sewa_alkes_datatable.row.add($scope.sewa_alkes).draw()
      $scope.sewa_alkes = {
          date : $scope.resume_date
      }
      setTimeout(function () {    
            $('[ng-model="sewa_alkes.date"]').val( $filter('fullDate')($scope.sewa_alkes.date))
      }, 300)
  }


  $scope.submitSewaRuangan = function() {
      $scope.sewa_ruangan.item = {
          'name' : $scope.sewa_ruangan.name,
          'piece' : $scope.sewa_ruangan.piece
      }
      var lokasi = $scope.data.lokasi.find(x => x.id == $scope.sewa_ruangan.lokasi_id)
      $scope.sewa_ruangan.lokasi = lokasi
      sewa_ruangan_datatable.row.add($scope.sewa_ruangan).draw()
      $scope.sewa_ruangan = {
          date : $scope.resume_date
      }
      setTimeout(function () {    
            $('[ng-model="sewa_ruangan.date"]').val( $filter('fullDate')($scope.sewa_ruangan.date))
      }, 300)
  }

  $scope.submitTreatment = function() {
      treatment_datatable.row.add($scope.treatment).draw()
      $scope.treatment = {
          date : $scope.resume_date,
          qty : 1
      }
      setTimeout(function () {    
            $('[ng-model="treatment.date"]').val( $filter('fullDate')($scope.treatment.date))
      }, 300)
  }

  $scope.submitDiagnostic = function() {
      diagnostic_datatable.row.add($scope.diagnostic).draw()
      $scope.diagnostic = {
          date : $scope.resume_date,
          qty : 1
      }
      setTimeout(function () {    
            $('[ng-model="diagnostic.date"]').val( $filter('fullDate')($scope.diagnostic.date))
      }, 300)
  }

  $scope.submitTreatmentGroup = function() {
      treatment_group_datatable.row.add($scope.treatment_group).draw()
      $scope.treatment_group = {
          date : $scope.resume_date,
          qty : 1
      }
      setTimeout(function () {    
            $('[ng-model="treatment_group.date"]').val( $filter('fullDate')($scope.treatment_group.date))
      }, 300)
  }

  $scope.submitDrug = function() {
      var is_id = /^(\d+)$/
      if($scope.drug.is_new_signa1 && is_id.test($scope.drug.signa1)) {
          toastr.warning('Signa 1 harus berisi huruf')
      } else if($scope.drug.is_new_signa2 && is_id.test($scope.drug.signa2)) {
          toastr.warning('Signa 2 harus berisi huruf')
      } else {
        
          drug_datatable.row.add($scope.drug).draw()
          $scope.drug = {
              date : $scope.resume_date,
              is_new_signa1 : 1,
              is_new_signa2 : 1
          }
          setTimeout(function () {    
                $('[ng-model="drug.date"]').val( $filter('fullDate')($scope.drug.date))
          }, 300)
      } 

  }

  $scope.submitDiagnoseHistory = function() {
      $scope.diagnose_history.is_other = !$scope.diagnose_history.is_other ? 0 : 1 
      if($scope.diagnose_history.disease_id && $scope.diagnose_history.item_id) {

          diagnose_history_datatable.row.add($scope.diagnose_history).draw()
          $scope.diagnose_history = {is_other : 1}
      }
  }

  $scope.submitKbHistory = function() {
      if($scope.kb_history.name) {

          kb_history_datatable.row.add($scope.kb_history).draw()
          $scope.kb_history = {}
      }
  }


  $scope.submitKomplikasiKbHistory = function() {
      if($scope.komplikasi_kb_history.name) {

          komplikasi_kb_history_datatable.row.add($scope.komplikasi_kb_history).draw()
          $scope.komplikasi_kb_history = {}
      }
  }


  $scope.submitGinekologiHistory = function() {
      if($scope.ginekologi_history.name) {
          ginekologi_history_datatable.row.add($scope.ginekologi_history).draw()
          $scope.ginekologi_history = {}
      }
  }

  $scope.submitObgynDiseaseHistory = function() {
      obgyn_disease_history_datatable.row.add($scope.obgyn_disease_history).draw()
      $scope.obgyn_disease_history = {}
  }

  $scope.changeDrugPiece = function() {
     $scope.piece_name = $scope.data.drug.find(x => x.id == $scope.drug.item_id).piece.name
     $scope.checkStock($scope.drug.item_id)
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

  $scope.submitFamilyDiseaseHistory = function() {
      family_disease_history_datatable.row.add($scope.family_disease_history).draw()
      $scope.family_disease_history = {}
  }


  $scope.submitObgynFamilyDiseaseHistory = function() {
      obgyn_family_disease_history_datatable.row.add($scope.obgyn_family_disease_history).draw()
      $scope.obgyn_family_disease_history = {}
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
      if(path.indexOf('therapy') < 0 && path.indexOf('utilization') < 0) {

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
  }

  $scope.signa = function() {
      if(path.indexOf('drug') > -1) {

          $http.get(baseUrl + '/controller/user/signa').then(function(data) {
            var signa = data.data
            $scope.data.signa1 = signa.filter(x => x.description == 'signa1')
            $scope.data.signa2 = signa.filter(x => x.description == 'signa2')
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
  }
  $scope.disease()

  $scope.treatment_item = function() {
      if(path.indexOf('treatment') > - 1) {

          $http.get(baseUrl + '/controller/user/price/treatment').then(function(data) {
            $scope.data.treatment = data.data
            $scope.show()
          }, function(error) {
            $rootScope.disBtn=false;
            $scope.treatment_item()
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
  $scope.treatment_item()

  $scope.diagnostic_item = function() {
      if(path.indexOf('diagnostic') > - 1) {

          $http.get(baseUrl + '/controller/user/price/diagnostic').then(function(data) {
            $scope.data.diagnostic = data.data
            $scope.show()
          }, function(error) {
            $rootScope.disBtn=false;
            $scope.diagnostic_item()
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
  $scope.diagnostic_item()

  $scope.drug_item = function() {
      if( path.indexOf('drug') > -1 ) {

          $http.get(baseUrl + '/controller/user/price/drug').then(function(data) {
            $scope.data.drug = data.data
            $scope.signa()
          }, function(error) {
            $rootScope.disBtn=false;
            $scope.drug_item()
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
  $scope.drug_item()


  $scope.treatment_group_item = function() {
      if( path.indexOf('treatment_group') > -1 ) {

          $http.get(baseUrl + '/controller/user/treatment_group').then(function(data) {
            $scope.data.treatment_group = data.data
          }, function(error) {
            $rootScope.disBtn=false;
            $scope.treatment_group_item()
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
  $scope.treatment_group_item()


  $scope.lokasi = function() {
      if( path.indexOf('utilization') > -1 ) {

          $http.get(baseUrl + '/controller/master/lokasi').then(function(data) {
            $scope.data.lokasi = data.data
            $scope.show()
          }, function(error) {
            $rootScope.disBtn=false;
            $scope.lokasi()
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
  $scope.lokasi()

  $scope.showBHP = function() {
    browse_bhp_datatable.ajax.reload()
    $('#BHPModal').modal()
  }

  $scope.showSewaAlkes = function() {
    browse_sewa_alkes_datatable.ajax.reload()
    $('#sewaAlkesModal').modal()
  }

  $scope.showSewaRuangan = function() {
    browse_sewa_ruangan_datatable.ajax.reload()
    $('#sewaRuanganModal').modal()
  }

  $scope.bhp_datatable = function() {
      if( path.indexOf('bhp') > -1 ) {
          bhp_datatable = $('#bhp_datatable').DataTable({
            dom: 'rt',
            'columns' : [
            {
              data : null,
              render : resp => $filter('fullDate')(resp.date)
            },
            {data : 'lokasi.name'},
            {data : 'item.name'},
            {data : 'qty'},
            {data : 'item.piece.name'},
            {
              data : null,
              className : 'text-center',
              render : resp => '<button type="button" class="btn btn-sm btn-danger" title="Hapus" ng-disabled="disBtn" ng-click="deleteBHP($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
            },
            ],
            createdRow: function(row, data, dataIndex) {
              $compile(angular.element(row).contents())($scope);
            }
          });
      }    
  }
  $scope.bhp_datatable()

  $scope.sewa_alkes_datatable = function() {
      if( path.indexOf('sewa_alkes') > -1 ) {
          sewa_alkes_datatable = $('#sewa_alkes_datatable').DataTable({
            dom: 'rt',
            'columns' : [
            {
              data : null,
              render : resp => $filter('fullDate')(resp.date)
            },
            {data : 'lokasi.name'},
            {data : 'item.name'},
            {data : 'qty'},
            {data : 'item.piece.name'},
            {
              data : null,
              className : 'text-center',
              render : resp => '<button type="button" class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteSewaAlkes($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
            },
            ],
            createdRow: function(row, data, dataIndex) {
              $compile(angular.element(row).contents())($scope);
            }
          });
      }    
  }
  $scope.sewa_alkes_datatable()

  $scope.sewa_ruangan_datatable = function() {
      if( path.indexOf('sewa_ruangan') > -1 ) {
          sewa_ruangan_datatable = $('#sewa_ruangan_datatable').DataTable({
            dom: 'rt',
            'columns' : [
            {
              data : null,
              render : resp => $filter('fullDate')(resp.date)
            },
            {data : 'lokasi.name'},
            {data : 'item.name'},
            {data : 'qty'},
            {data : 'item.piece.name'},
            {
              data : null,
              className : 'text-center',
              render : resp => '<button type="button" class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteSewaRuangan($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
            },
            ],
            createdRow: function(row, data, dataIndex) {
              $compile(angular.element(row).contents())($scope);
            }
          });
      }    
  }
  $scope.sewa_ruangan_datatable()

  $scope.browse_bhp = function() {
      if( path.indexOf('bhp') > -1 ) {
          browse_bhp_datatable = $('#browse_bhp_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
              url : baseUrl+'/datatable/master/bhp/actived',
            },
            'columns' : [
            {
              data:null, 
              name:null,
              searchable:false,
              orderable:false,
              className : 'text-center',
              render : resp => "<button type='button' class='btn btn-xs btn-primary' ng-click='selectBHP($event.currentTarget)'>Pilih</button>"
            },
            {data : 'name'},
            {
              data:null, 
              name:null,
              searchable:false,
              orderable:false,
              render : resp => "<input type='text' class='form-control' ng-model='qty' id='qty' maxlength='3' jnumber2 only-num>"
            },
            {data : 'piece.name'},
            ],
            createdRow: function(row, data, dataIndex) {
              $compile(angular.element(row).contents())($scope);
            }
          });
      }    
  }
  $scope.browse_bhp()
    
  $scope.browse_sewa_alkes = function() {
      if( path.indexOf('sewa_alkes') > -1 ) {
          browse_sewa_alkes_datatable = $('#browse_sewa_alkes_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
              url : baseUrl+'/datatable/master/sewa_alkes/actived',
            },
            'columns' : [
            {
              data:null, 
              name:null,
              searchable:false,
              orderable:false,
              className : 'text-center',
              render : resp => "<button type='button' class='btn btn-xs btn-primary' ng-click='selectSewaAlkes($event.currentTarget)'>Pilih</button>"
            },
            {data : 'name'},
            {
              data:null, 
              name:null,
              searchable:false,
              orderable:false,
              render : resp => "<input type='number' class='form-control text-right' id='qty' maxlength='3'>"
            },
            {data : 'piece.name'},
            ],
            createdRow: function(row, data, dataIndex) {
              $compile(angular.element(row).contents())($scope);
            }
          });
      }    
  }
  $scope.browse_sewa_alkes()
    
  
  $scope.browse_sewa_ruangan = function() {
      if( path.indexOf('sewa_ruangan') > -1 ) {
          browse_sewa_ruangan_datatable = $('#browse_sewa_ruangan_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
              url : baseUrl+'/datatable/master/sewa_ruangan/actived',
            },
            'columns' : [
            {
              data:null, 
              name:null,
              searchable:false,
              orderable:false,
              className : 'text-center',
              render : resp => "<button type='button' class='btn btn-xs btn-primary' ng-click='selectSewaRuangan($event.currentTarget)'>Pilih</button>"
            },
            {data : 'name'},
            {
              data:null, 
              name:null,
              searchable:false,
              orderable:false,
              render : resp => "<input type='number' class='form-control text-right' id='qty' maxlength='3'>"
            },
            {data : 'piece.name'},
            ],
            createdRow: function(row, data, dataIndex) {
              $compile(angular.element(row).contents())($scope);
            }
          });
      }    
  }
  $scope.browse_sewa_ruangan()
    

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
    
  treatment_datatable = $('#treatment_datatable').DataTable({
    dom: 'rt',
    'columns' : [
      {
          data : null,
          render : resp => $filter('fullDate')(resp.date)
      },
      { 
        data : null,
        render : function(resp) {

          return $scope.data.treatment.find(x => x.id == resp.item_id).name
          // return $scope.data.treatment.find(x => x.id == resp.item_id).name
        }
      },
      {data : 'qty', className : 'text-right', width:'10%', orderable:false},
      {data : 'reduksi', className : 'text-right', width:'10%', orderable:false},

      {
        data : null,
        className : 'text-center',
        render : resp => '<button type="button" class="btn btn-sm btn-danger" title="Hapus" ng-disabled="disBtn" ng-click="deleteTreatment($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
      }
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
        
  schedule_datatable = $('#schedule_datatable').DataTable({
    dom: 'rt',
    'columns' : [
      {
          data : null,
          render : resp => $filter('fullDate')(resp.date)
      },
      {data : 'medical_record.registration.code'},
      {data : 'medical_record.registration_detail.visiting_room'},
      {data : 'medical_record.registration.patient_type'},
      {data : 'medical_record.registration_detail.doctor.name'},
      {data : 'medical_record.registration_detail.doctor.specialization.name'},

      {
        data : null,
        className : 'text-center',
        render : resp => '<button type="button" ng-disabled="disBtn" class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteSchedule($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
      }
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
      
  radiology_datatable = $('#radiology_datatable').DataTable({
    dom: 'rt',
    'columns' : [
      {
          data : null,
          width : '18%',
          render : resp => $filter('fullDate')(resp.date)
      },
      {data : 'name'},
      {
          data : null,
          width : '15%',
          render : resp => $filter('fullDate')(resp.result_date)
      },
      {
          data : null,
          render : resp => '<a href="' + resp.filename + '" target="_blank"><i class="fa fa-file-archive-o"></i> Lampiran</a>'
      },

      {
        data : null,
        className : 'text-center',
          width : '12%',
        render : resp => '<div class="btn-group"><button type="button" class="btn btn-sm btn-default" ng-click="showNewResearch(' + resp.id + ')" title="Isi form radiologi"><i class="fa fa-newspaper-o"></i></button><button type="button" class="btn btn-sm btn-danger" ng-disabled="disBtn" title="Hapus" ng-click="deleteRadiology($event.currentTarget)"><i class="fa fa-trash-o"></i></button></div>'
      }
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
      
  laboratory_datatable = $('#laboratory_datatable').DataTable({
    dom: 'rt',
    'columns' : [
      {
          data : null,
          width : '18%',
          render : resp => $filter('fullDate')(resp.date)
      },
      {data : 'name'},
      {
          data : null,
          width : '15%',
          render : resp => $filter('fullDate')(resp.result_date)
      },
      {
          data : null,
          render : resp => '<a href="' + resp.filename + '" target="_blank"><i class="fa fa-file-archive-o"></i> Lampiran</a>'
      },

      {
        data : null,
        className : 'text-center',
        render : resp => '<div class="btn-group"><button type="button" class="btn btn-sm btn-default" ng-click="showNewResearch(' + resp.id + ')" title="Isi form radiologi"><i class="fa fa-newspaper-o"></i></button><button type="button" class="btn btn-sm btn-danger" ng-disabled="disBtn" title="Hapus" ng-click="deleteLaboratory($event.currentTarget)"><i class="fa fa-trash-o"></i></button></div>'
      }
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
        
  pathology_datatable = $('#pathology_datatable').DataTable({
    dom: 'rt',
    'columns' : [
      {
          data : null,
          render : resp => $filter('fullDate')(resp.date)
      },
      {data : 'name'},
      {
          data : null,
          render : resp => $filter('fullDate')(resp.result_date)
      },
      {
          data : null,
          render : resp => '<a href="' + resp.filename + '" target="_blank"><i class="fa fa-file-archive-o"></i> Lampiran</a>'
      },

      {
        data : null,
        className : 'text-center',
        render : resp => '<button type="button" class="btn btn-sm btn-danger" ng-disabled="disBtn" title="Hapus" ng-click="deletePathology($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
      }
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  diagnostic_datatable = $('#diagnostic_datatable').DataTable({
    dom: 'rt',
    'columns' : [
      {
          data : null,
          render : resp => $filter('fullDate')(resp.date)
      },
      { 
        data : null,
        render : resp => $scope.data.diagnostic.find(x => x.id == resp.item_id) ? $scope.data.diagnostic.find(x => x.id == resp.item_id).name : ''
      },
      {data : 'qty', className : 'text-right', width:'10%', orderable:false},
      {data : 'reduksi', className : 'text-right', width:'10%', orderable:false},

      {
        data : null,
        className : 'text-center',
        render : resp => '<div class="btn-group"><button type="button" class="btn btn-sm btn-danger" title="Hapus" ng-disabled="disBtn" ng-click="deleteDiagnostic($event.currentTarget)"><i class="fa fa-trash-o"></i></button><button type="button" class="btn btn-sm btn-primary" title="Checklist Laboratorium" ng-click="showLaboratoryChecklistModal($event.currentTarget)"><i class="fa fa-code-fork"></i></button></div>'
      }
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  drug_datatable = $('#drug_datatable').DataTable({
    dom: 'rt',
    'columns' : [
      {
          data : null,
          render : resp => $filter('fullDate')(resp.date)
      },
      { 
        data : null,
        render : resp => $scope.data.drug.find(x => x.id == resp.item_id).name
      },
      {data : 'qty', className : 'text-right', width:'10%', orderable:false},
      { 
        data : null,
        render : resp => $scope.data.drug.find(x => x.id == resp.item_id).piece.name
      },
      { 
        data : null,
        render : function(resp) {
            var is_id = /^(\d+)$/
            return is_id.test(resp.signa1) ? ($scope.data.signa1.find(x => x.id == resp.signa1) ? $scope.data.signa1.find(x => x.id == resp.signa1).name : '') : resp.signa1
        } 
      },
      { 
        data : null,
        render : function(resp) {
            var is_id = /^(\d+)$/
            return is_id.test(resp.signa2) ? ($scope.data.signa2.find(x => x.id == resp.signa2) ? $scope.data.signa2.find(x => x.id == resp.signa2).name : '') : resp.signa2
        }
      },

      {
        data : null,
        className : 'text-center',
        render : resp => '<button  type="button" class="btn btn-sm btn-danger" title="Hapus" ng-disabled="disBtn" ng-click="deleteDrug($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
      }
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
   
  treatment_group_datatable = $('#treatment_group_datatable').DataTable({
    dom: 'rt',
    'columns' : [
      {
          data : null,
          render : resp => $filter('fullDate')(resp.date)
      },
      { 
        data : null,
        render : resp => $scope.data.treatment_group.find(x => x.id == resp.item_id).name
      },
      {data : 'qty', className : 'text-right', width:'10%', orderable:false},
      
      {
        data : null,
        className : 'text-center',
        render : resp => '<button  type="button" class="btn btn-sm btn-danger" title="Hapus" ng-disabled="disBtn" ng-click="deleteTreatmentGroup($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
      }
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  disease_history_datatable = $('#disease_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    { data : 'disease_name'},
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
    
    
  diagnose_history_datatable = $('#diagnose_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    { 
        data : null,
        render : resp => resp.is_other != 1 ? $scope.data.disease.find(x => x.id == resp.disease_id).name : resp.disease_id
    },
    { 
        data : null,
        render : resp => "<b>" + $scope.data.disease.find(x => x.id == resp.item_id).unique_code + " / </b>" + $scope.data.disease.find(x => x.id == resp.item_id).name
    },
    {data : 'description'},
    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteDiagnoseHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  kb_history_datatable = $('#kb_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    { data : 'name'},
    {data : 'duration', className : 'text-right'},
    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteKbHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  komplikasi_kb_history_datatable = $('#komplikasi_kb_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    { data : 'name'},
    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteKomplikasiKbHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  ginekologi_history_datatable = $('#ginekologi_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    { data : 'name'},
    {
      data : null,
      className : 'text-center',
      render : resp => '<button class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteGinekologiHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  family_disease_history_datatable = $('#family_disease_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    { data : 'disease_name' },
    {data : 'description'},
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

  obgyn_family_disease_history_datatable = $('#obgyn_family_disease_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    { data : 'disease_name' },
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
      render : resp => '<button type="button" class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteObgynFamilyDiseaseHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
    
  obgyn_disease_history_datatable = $('#obgyn_disease_history_datatable').DataTable({
    dom: 'rt',
    'columns' : [
    { data : 'disease_name'},
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
      render : resp => '<button type="button" class="btn btn-sm btn-danger" title="Hapus" ng-click="deleteObgynDiseaseHistory($event.currentTarget)"><i class="fa fa-trash-o"></i></button>'
    },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  $scope.showLaboratoryChecklistModal = function(obj) {
      var tr = $(obj).parents('tr')
      var data = diagnostic_datatable.row(tr).data()
      $scope.showLaboratoryChecklist(data.laboratory_pivot.id)
      $('#laboratoryChecklistModal').modal()
  }

  $scope.openLaboratoryChecklistPDF =  function() {
      window.open( baseUrl + '/controller/registration/medical_record/pivot/' + $scope.pivot_medical_record_id + '/laboratory/pdf')
  }

  $scope.showLaboratoryChecklist = function(pivot_medical_record_id) {
      $http.get(baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id).then(function(data) {
          var laboratory_treatment_datatable = $('#laboratory_treatment_datatable')
          var unit, subunit, tr, content
          $scope.pivotData = data.data.additional
          $scope.pivot_medical_record_id = data.data.id
          for(x in $scope.pivotData.treatment) {
              unit = $scope.pivotData.treatment[x]
              tr = $("<div class='col-md-4'><b>" + unit.name + "</b><div class='ln_solid'></div></div>")
              for(y in unit.detail) {
                  subunit = unit.detail[y]
                  content = $("<div><input type='checkbox' style='margin-right:4mm' ng-change='changeLaboratoryTreatment(" + x + ", " + y + ", " + data.data.id + ")' ng-model='pivotData.treatment[" + x +"].detail[" + y +"].is_active' ng-true-value='1' ng-false-value='0'>" + subunit.name + "</div><div class='ln_solid'></div>")
                  tr.append(content)
              }
              laboratory_treatment_datatable.append(tr)
          }

          $compile(laboratory_treatment_datatable)($scope);
      }, function(error) {
          console.log(error)
      });
  }

  $scope.changeLaboratoryTreatment = function(x, y, pivot_medical_record_id) {
      var data = {
          "row" : x,
          "column" : y,
          "is_active" : $scope.pivotData.treatment[x].detail[y].is_active
      }

      $http.put(baseUrl + '/controller/registration/medical_record/pivot/' + pivot_medical_record_id + '/laboratory', data).then(function(data) {
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

  $scope.reset = function() {
      $scope.patient = {}
      $scope.formData = {
        code : $scope.code,
        patient : $scope.patient,
        pain_score : 0,
        additional : {}
      }
      $scope.sewa_alkes = {        
        date : $scope.resume_date
      }
      setTimeout(function () {    
            $('[ng-model="sewa_alkes.date"]').val( $filter('fullDate')($scope.sewa_alkes.date))
      }, 300)
      $scope.sewa_ruangan = {        
        date : $scope.resume_date
      }
      setTimeout(function () {    
            $('[ng-model="sewa_ruangan.date"]').val( $filter('fullDate')($scope.sewa_ruangan.date))
      }, 300)
      $scope.bhp = {
        is_bhp : 1,
        date : $scope.resume_date
      }
      setTimeout(function () {    
            $('[ng-model="bhp.date"]').val( $filter('fullDate')($scope.bhp.date))
      }, 300)
      $scope.schedule = {}
      $scope.research = {}
      $scope.diagnostic = {
          is_diagnostic : 1,
          date : $scope.resume_date,
          qty : 1
      }
      setTimeout(function () {    
            $('[ng-model="diagnostic.date"]').val( $filter('fullDate')($scope.diagnostic.date))
            $('[ng-model="treatment_group.date"]').val( $filter('fullDate')($scope.treatment_group.date))
      }, 300)
      $scope.treatment = {
          is_treatment : 1,
          date : $scope.resume_date,
          qty : 1
      }
      setTimeout(function () {    
            $('[ng-model="treatment.date"]').val( $filter('fullDate')($scope.treatment.date))
      }, 300)
      $scope.drug = {
        is_drug : 1,
        date : $scope.resume_date,
        is_new_signa1 : 1,
        is_new_signa2 : 1
      }
      $scope.treatment_group = {
        is_treatment_group : 1,
        date : $scope.resume_date
      }
      setTimeout(function () {    
            $('[ng-model="drug.date"]').val( $filter('fullDate')($scope.drug.date))
      }, 300)
      $scope.diagnose_history = { is_other : 1 }
      $scope.disease_history = {}
      $scope.family_disease_history = {}
      $scope.obgyn_disease_history = {}
      $scope.obgyn_family_disease_history = {}
      $scope.pain_history = {}
      $scope.kb_history = {}
      $scope.komplikasi_kb_history = {}
      $scope.ginekologi_history = {}
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
          kid_history_datatable.clear().draw();
          kb_history_datatable.clear().draw();
          komplikasi_kb_history_datatable.clear().draw();
          ginekologi_history_datatable.clear().draw();
          obgyn_disease_history_datatable.clear().draw();
          obgyn_family_disease_history_datatable.clear().draw();
      } else if(step == 3) {
          kid_history_datatable.clear().draw();
      }

      if(path.indexOf('therapy/treatment') > -1) {
          treatment_datatable.clear().draw();
      }

      if(path.indexOf('therapy/treatment_group') > -1) {
          treatment_group_datatable.clear().draw();
      }

      if(path.indexOf('therapy/drug') > -1) {
          drug_datatable.clear().draw();
      }

      if(path.indexOf('pathology') > -1) {
          pathology_datatable.clear().draw();
      }

      if(path.indexOf('laboratory') > -1) {
          laboratory_datatable.clear().draw();
      }


      if(path.indexOf('radiology') > -1) {
          radiology_datatable.clear().draw();
      }

      window.scrollTo(0, 0)
  }
    
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

  $scope.deleteBHP = function(e) {
    var tr = $(e).parents('tr');
    var data = bhp_datatable.row(tr).data()
    $scope.destroyDetail(data.id)
  }


  $scope.deleteSewaAlkes = function(e) {
    var tr = $(e).parents('tr');
    sewa_alkes_datatable.row(tr).remove().draw()
  }


  $scope.deleteSewaRuangan = function(e) {
    var tr = $(e).parents('tr');
    sewa_ruangan_datatable.row(tr).remove().draw()
  }

    
  $scope.deleteTreatment = function(e) {
    var tr = $(e).parents('tr');
    var data = treatment_datatable.row(tr).data()
    $scope.destroyDetail(data.id)  }
    
  $scope.deleteRadiology = function(e) {
    var tr = $(e).parents('tr');
    var data = radiology_datatable.row(tr).data()
    var url = baseUrl + '/controller/registration/medical_record/detail/' + data.id;
    $scope.deleteResearch(url)
  }

  $scope.deleteLaboratory = function(e) {
    var tr = $(e).parents('tr');
    var data = laboratory_datatable.row(tr).data()
    var url = baseUrl + '/controller/registration/medical_record/detail/' + data.id;
    $scope.deleteResearch(url)
  }


  $scope.deletePathology = function(e) {
    var tr = $(e).parents('tr');
    var data = pathology_datatable.row(tr).data()
    var url = baseUrl + '/controller/registration/medical_record/detail/' + data.id;
    $scope.deleteResearch(url)
  }

  $scope.deleteResearch = function(url) {

    $rootScope.disBtn = true;
    $http.delete(url).then(function(data) {
      $rootScope.disBtn = false
      toastr.success("Data Berhasil dihapus !");
      if(path.indexOf('radiology') > -1) {
          radiology_datatable.clear().draw()
      } else if(path.indexOf('laboratory') > -1) {
          laboratory_datatable.clear().draw()
      } else if(path.indexOf('pathology') > -1) {
          pathology_datatable.clear().draw()
      } else if(path.indexOf('schedule') > -1) {
          schedule_datatable.clear().draw()
          $scope.schedule_item()
      }
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
        toastr.error(error.data.message,"Error Has Found !");
      }
    });
  }

  $scope.deleteSchedule = function(e) {
    var tr = $(e).parents('tr');
    var data = schedule_datatable.row(tr).data()
    var url = baseUrl + '/controller/registration/medical_record/detail/' + data.id;
    $scope.deleteResearch(url)
  }
    
  $scope.deleteDiagnostic = function(e) {
    var tr = $(e).parents('tr');
    var data = diagnostic_datatable.row(tr).data()
    var data = diagnostic_datatable.row(tr).data()
    $scope.destroyDetail(data.id)
  }

    
  $scope.deleteDrug = function(e) {
    var tr = $(e).parents('tr');
    var data = drug_datatable.row(tr).data()
    $scope.destroyDetail(data.id)
  }

    
  $scope.deleteTreatmentGroup = function(e) {
    var tr = $(e).parents('tr');
    var data = treatment_group_datatable.row(tr).data()
    $scope.destroyDetail(data.id)
  }

    
  $scope.deleteDiagnoseHistory = function(e) {
    var tr = $(e).parents('tr');
    diagnose_history_datatable.row(tr).remove().draw()
  }

    
  $scope.deleteKbHistory = function(e) {
    var tr = $(e).parents('tr');
    kb_history_datatable.row(tr).remove().draw()
  }

    
  $scope.deleteKomplikasiKbHistory = function(e) {
    var tr = $(e).parents('tr');
    komplikasi_kb_history_datatable.row(tr).remove().draw()
  }

  $scope.deleteGinekologiHistory = function(e) {
    var tr = $(e).parents('tr');
    ginekologi_history_datatable.row(tr).remove().draw()
  }

  $scope.deleteFamilyDiseaseHistory = function(e) {
    var tr = $(e).parents('tr');
    family_disease_history_datatable.row(tr).remove().draw()
  }

    
  $scope.deleteObgynDiseaseHistory = function(e) {
    var tr = $(e).parents('tr');
    obgyn_disease_history_datatable.row(tr).remove().draw()
  }

  $scope.deleteObgynFamilyDiseaseHistory = function(e) {
    var tr = $(e).parents('tr');
    obgyn_family_disease_history_datatable.row(tr).remove().draw()
  }

    $scope.submitSchedule=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/registration/medical_record/submit_schedule/' + id;
      var method = 'post'

      $http[method](url, $scope.schedule).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function(){
          window.location.reload()
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

    $scope.selectBHP = function(e) {
        var tr = $(e).parents('tr')
        var bhp = browse_bhp_datatable.row(tr).data()
        $scope.bhp.item_id = bhp.id
        $scope.bhp.name = bhp.name
        $scope.bhp.qty = tr.find('#qty').val()
        $scope.bhp.piece = bhp.piece
        $scope.checkStockByLokasi(bhp.id, $scope.bhp.lokasi_id) 
        $('#BHPModal').modal('hide')
    }

    $scope.referMedicalRecord = function() {
      doctor_datatable.ajax.reload()
      $('#doctorModal').modal()
    }

    $scope.selectDoctor = function(e) {
        var tr = $(e).parents('tr')
        var doctor = doctor_datatable.row(tr).data()
        $http.get(baseUrl + '/controller/registration/medical_record/' + id + '/refer_doctor/' + doctor.id).then(function(data) {
            toastr.success("Dokter rujukan telah dipilih");
            $('#doctorModal').modal('hide')
            setTimeout(function(){
                window.location.reload()
            }, 1200)
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

    $scope.selectSewaAlkes = function(e) {
        var tr = $(e).parents('tr')
        var sewa_alkes = browse_sewa_alkes_datatable.row(tr).data()
        $scope.sewa_alkes.item_id = sewa_alkes.id
        $scope.sewa_alkes.name = sewa_alkes.name
        $scope.sewa_alkes.qty = tr.find('#qty').val()
        $scope.sewa_alkes.piece = sewa_alkes.piece
        $('#sewaAlkesModal').modal('hide')
    }

    $scope.selectSewaRuangan = function(e) {
        var tr = $(e).parents('tr')
        var sewa_ruangan = browse_sewa_ruangan_datatable.row(tr).data()
        $scope.sewa_ruangan.item_id = sewa_ruangan.id
        $scope.sewa_ruangan.name = sewa_ruangan.name
        $scope.sewa_ruangan.qty = tr.find('#qty').val()
        $scope.sewa_ruangan.piece = sewa_ruangan.piece
        $('#sewaRuanganModal').modal('hide')
    }

    $scope.submitOne = function(key) {
        $scope.silent = 1
        $scope.submitForm(0, key)
    }

    $scope.submitForm=function(is_massive = 1, key) {
      $rootScope.disBtn=true;
      var submitData
      var url = baseUrl + '/controller/registration/medical_record/' + id;
      var method = 'put';
      
      if(step) {
          if(step == 1) {
              $scope.formData.pain_history = pain_history_datatable.data().toArray()
              $scope.formData.pain_cure_history = pain_cure_history_datatable.data().toArray()
              $scope.formData.disease_history = disease_history_datatable.data().toArray()
              $scope.formData.family_disease_history = family_disease_history_datatable.data().toArray()
          } else if(step == 2) {
              $scope.formData.kid_history = kid_history_datatable.data().toArray()
              $scope.formData.kb_history = kb_history_datatable.data().toArray()
              $scope.formData.komplikasi_kb_history = komplikasi_kb_history_datatable.data().toArray()
              $scope.formData.ginekologi_history = ginekologi_history_datatable.data().toArray()
              $scope.formData.obgyn_disease_history = obgyn_disease_history_datatable.data().toArray()
              $scope.formData.obgyn_family_disease_history = obgyn_family_disease_history_datatable.data().toArray()
          } 
      }

      if(path.indexOf('physique/general') > -1) {
          $scope.formData.diagnose_history = diagnose_history_datatable.data().toArray()
      }

      if(path.indexOf('therapy/treatment') > -1) {
          $scope.formData.treatment = treatment_datatable.data().toArray()
      }

      if(path.indexOf('therapy/diagnostic') > -1) {
          $scope.formData.diagnostic = diagnostic_datatable.data().toArray()
      }

      if(path.indexOf('therapy/drug') > -1) {
          $scope.formData.drug = drug_datatable.data().toArray()
      }

      if(path.indexOf('utilization/bhp') > -1) {
          $scope.formData.bhp = bhp_datatable.data().toArray()
      }

      if(path.indexOf('utilization/sewa_alkes') > -1) {
          $scope.formData.sewa_alkes = sewa_alkes_datatable.data().toArray()
      }

      if(path.indexOf('utilization/sewa_ruangan') > -1) {
          $scope.formData.sewa_ruangan = sewa_ruangan_datatable.data().toArray()
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

      $http[method](url, submitData).then(function(data) {
        $rootScope.disBtn = false
        if(is_massive == 1) {
            toastr.success("Data Berhasil Disimpan !");
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

    $scope.submitResearch=function(flag) {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/registration/medical_record/submit_research/' + id + '/' + flag;
      var method = 'post';
      
      var fd = new FormData();
      var attachment = $('#file')[0]
      if(attachment.files.length > 0)  
          fd.append('file', attachment.files[0])
      fd.append('date', $scope.research.date);
      fd.append('result_date', $scope.research.result_date);
      fd.append('name', $scope.research.name);


          $.ajax({
            'url':url,
            contentType : false,
            processData : false,
            'type' : method,
            data : fd,
            success:function(data) {
              toastr.success("Data Berhasil Disimpan!");
               $('.submitButton').removeAttr('disabled');
               window.location.reload()
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
               $compile(angular.element($('.submitButton')[0]).contents())($scope)
            },
          }).done(function() {
               $('.submitButton').removeAttr('disabled');
               $compile(angular.element($('.submitButton')[0]).contents())($scope)
          });
          
    }

    $scope.updateResearch=function(medical_record_detail_id, action) {
      $rootScope.disBtn= true
      var url = baseUrl + '/controller/registration/medical_record/update_research/' + medical_record_detail_id;
      var method = 'post';


      $http[method](url, $scope.new_research).then(function(data) {
        $rootScope.disBtn = false
        $scope.new_research = {
            'additional' : {}
        }
        toastr.success("Data Berhasil Disimpan !");
        action()
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

    $scope.storeDetail=function(data) {
      $rootScope.disBtn= true
      var url = baseUrl + '/controller/registration/medical_record/' + id + '/detail';
      var method = 'post';


      $http[method](url, data).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function() {
            location.reload()
        }, 800)
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

    $scope.destroyDetail=function(detail_id) {
      $rootScope.disBtn= true
      var url = baseUrl + '/controller/registration/medical_record/' + id + '/detail/' + detail_id;
      var method = 'delete';


      $http[method](url).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Dihapuss !");
        setTimeout(function() {
            location.reload()
        }, 800)
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
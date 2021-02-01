var app = angular.module('klinikApp', ['localytics.directives', 'rzSlider', 'angularTrix'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

app.run(function($rootScope) {

  $.fn.dataTable.ext.errMode = 'none';
  $rootScope.disBtn = false;
  $rootScope.backward = function(){
      if($rootScope.hasBuffer()) {
          $rootScope.accessBuffer()
      } else {
          history.back();
      }
  }
  $('[data-toggle="tooltip"]').tooltip();

  $rootScope.getScope = function() {
      var scopeContainer = $('#scopeContainer')
      var scope = angular.element(scopeContainer).scope()

      return scope
  }

  $rootScope.getFormData = function() {
      return $rootScope.getScope().formData
  }

  $rootScope.getBuffer = function() {
      var buffer = localStorage.getItem('buffer')
      if(buffer) {
          return JSON.parse(buffer)
      } else {
          return []
      }
  }

  $rootScope.setBuffer = function(buffer) {
      var bufferUpdated = JSON.stringify(buffer)
      localStorage.setItem('buffer', bufferUpdated)
  }

  $rootScope.insertBuffer = function() {
      var buffer = $rootScope.getBuffer()
      var formData = $rootScope.getFormData()
      buffer.push({
          'url' : window.location.pathname,
          'formData' : formData
      })
      $rootScope.setBuffer(buffer)
  }
  $rootScope.accessBuffer = function() {
      var buffer = $rootScope.getBuffer()
      var index = buffer.length - 1
      if(index > -1) {
          var target = buffer[index]
          window.location.href = window.location.protocol + '//' + window.location.hostname + target.url
      }
  }

  $rootScope.emptyBuffer = function() {
      $rootScope.setBuffer([])
  }
  $rootScope.hasBuffer = function() {
      var resp = false
      var buffer = $rootScope.getBuffer()
      if(buffer.length > 0) {
          resp = true
      }

      return resp
  }

  $rootScope.validateBuffer = function() {
      var pathname = window.location.pathname
      if(pathname.search('create') < 0) {
          $rootScope.emptyBuffer()
      }

      var buffer = $rootScope.getBuffer()
      var index = buffer.length - 1
      var target, scope
      if(index > -1) {
          target = buffer[index]
          if(target.url == pathname) {
              setTimeout(function () {
                  scope = $rootScope.getScope()
                  scope.formData = target.formData
                  scope.$apply()
                  buffer.splice(index, 1)
                  $rootScope.setBuffer(buffer)
              }, 1000)
          }
      }
  }
  $rootScope.validateBuffer()

  $rootScope.insertSpecialization = function() {
      $rootScope.disBtn = true
      $rootScope.insertBuffer()
      location.href = baseUrl + '/specialization/create'
  }

  $rootScope.insertPolyclinic = function() {
      $rootScope.disBtn = true
      $rootScope.insertBuffer()
      location.href = baseUrl + '/polyclinic/create'
  }

  $rootScope.insertGroupUser = function() {
      $rootScope.disBtn = true
      $rootScope.insertBuffer()
      location.href = baseUrl + '/group_user/create'
  }

  $rootScope.insertPiece = function() {
      $rootScope.disBtn = true
      $rootScope.insertBuffer()
      location.href = baseUrl + '/piece/create'
  }

  $rootScope.insertSupplier = function() {
      $rootScope.disBtn = true
      $rootScope.insertBuffer()
      location.href = baseUrl + '/supplier/create'
  }
});

app.filter('fullDate', function() {
  return function(val) {
    if(!val) {
        return '';
    }
    var days = new Date(val);
    // var months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nop','Des'];
    var months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    return ('0'+days.getDate()).slice(-2)+' '+months[days.getMonth()]+' '+days.getFullYear();
  }
});
app.filter('day', function() {
  return function(val) {
    var date = new Date(val);
    var day = date.getDay()
    var readableDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];

    return readableDays[day]
  }
});
app.filter('aTime', function() {
  return function(val) {
    var days = new Date(val);
    return ('0'+days.getHours()).slice(-2)+':'+('0'+days.getMinutes()).slice(-2);
  }
});

app.filter('minDate', function() {
  return function(val) {
    var days = new Date(val);
    return days.getDate()+'-'+(days.getMonth()+1)+'-'+days.getFullYear();
  }
});

app.filter('fullDateTime', function() {
  return function(val) {
    var days = new Date(val);
    var months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    return ('0'+days.getDate()).slice(-2)+' '+months[days.getMonth()]+' '+days.getFullYear()+' '+('0'+days.getHours()).slice(-2)+':'+('0'+days.getMinutes()).slice(-2);
  }
});

app.directive('onlyNum', function($browser) {
      return {
        restrict: 'A',
        require: 'ngModel',
        link: function(scope, element, attrs, modelCtrl) {
            var keyCode = [173,8,9,37,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,110,190];
            $(element).addClass('text-right')
            element.bind("keydown", function(event) {
                if (modelCtrl.$modelValue) {
                  // var hitungTitik=(modelCtrl.$modelValue.match(/./g)||[]).length;
                  var modelVal=modelCtrl.$modelValue;
                  var hitungTitik=modelVal.split('.').length-1;
                  var slength=modelVal.length;
                  // console.log(slength);
                  // alert(modelVal)
                  if (slength>1 && modelVal.charAt(0)=="0" && (modelVal.charAt(1)!=".")) {
                    var newVal=modelVal.indexOf('0') == 0 ? modelVal.substring(1) : modelVal;
                    modelCtrl.$setViewValue(newVal);
                    modelCtrl.$render();
                  }
                  if (hitungTitik>0) {
                    keyCode=[173, 8,9,37,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,110];
                  } else {
                    keyCode=[173, 8,9,37,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,110,190];
                  }
                }
                if($.inArray(event.which,keyCode) == -1) {
                    scope.$apply(function(){
                        scope.$eval(attrs.onlyNum);
                        event.preventDefault();
                    });
                    event.preventDefault();
                }
            });
            element.bind("click", function(event) {
                if (modelCtrl.$modelValue == 0) {
                  modelCtrl.$setViewValue('');
                  modelCtrl.$render();
                }
            });
        }
      }
  });
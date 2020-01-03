var app = angular.module('klinikApp', ['localytics.directives', 'rzSlider'], function($interpolateProvider) {
  $interpolateProvider.startSymbol('<%');
  $interpolateProvider.endSymbol('%>');
});

app.run(function($rootScope) {

  $.fn.dataTable.ext.errMode = 'none';
  $rootScope.disBtn = false;
  $rootScope.backward = function(){
    history.back();
  }
  $('[data-toggle="tooltip"]').tooltip();
});

app.filter('rupiah', function () {
  return function (val) {
    if (val!=null || !isNaN(val)) {
      while (/(\d+)(\d{3})/.test(val.toString())){
        val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
      }
      var val = 'Rp ' + val;
      return val;
    } else {
      return 'Rp. 0';
    }
  };
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
    // var months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nop','Des'];
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
    // var months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nop','Des'];
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
        }
      }
  });
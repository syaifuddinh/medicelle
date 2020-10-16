app.directive("ngFileSelect", function(fileReader, $timeout) {
    return {
      scope: {
        ngModel: '='
      },
      link: function($scope, el) {
        function getFile(file) {
          fileReader.readAsDataUrl(file, $scope)
            .then(function(result) {
              $timeout(function() {
                $scope.ngModel = result;
              });
            });
        }

        el.bind("change", function(e) {
          var file = (e.srcElement || e.target).files[0];
          getFile(file);
        });
      }
    };
  });

app.factory("fileReader", function($q, $log) {
  var onLoad = function(reader, deferred, scope) {
    return function() {
      scope.$apply(function() {
        deferred.resolve(reader.result);
      });
    };
  };

  var onError = function(reader, deferred, scope) {
    return function() {
      scope.$apply(function() {
        deferred.reject(reader.result);
      });
    };
  };

  var onProgress = function(reader, scope) {
    return function(event) {
      scope.$broadcast("fileProgress", {
        total: event.total,
        loaded: event.loaded
      });
    };
  };

  var getReader = function(deferred, scope) {
    var reader = new FileReader();
    reader.onload = onLoad(reader, deferred, scope);
    reader.onerror = onError(reader, deferred, scope);
    reader.onprogress = onProgress(reader, scope);
    return reader;
  };

  var readAsDataURL = function(file, scope) {
    var deferred = $q.defer();

    var reader = getReader(deferred, scope);
    reader.readAsDataURL(file);

    return deferred.promise;
  };

  return {
    readAsDataUrl: readAsDataURL
  };
});
app.directive('datepick', function() {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, el, attr, ngModel) {

      var pick = $(el).pickadate({
        'selectYears' : 90,
        'selectMonths' : true
      });
      var p = pick.pickadate('picker')
      var model = attr.ngModel
      var second = model.replace(/.+\.([a-z_]+)$/, '$1')
      var first = model.replace(/(.+)\.([a-z_]+)$/, '$1') || null
     
      if(second == first) {
        var datepick = scope[second]
      } else {
        if(scope[first]) {
            var datepick = scope[first][second]
        }
      }
      if(datepick) {
        
          if(/(\d{4})-(\d{2})-(\d{2})/.test(datepick)) {
              var d = datepick.split('-')
              p.set('select', new Date(d[0], parseInt(d[1]) - 1, d[2]))
              var actualValue = $(el).val()
              if(second == first) {
                scope[second] = datepick
              } else {
                scope[first][second] = datepick
              }

              setTimeout(function(){
                  $(el).val(actualValue)
              }, 200)
          }
      }
      
       ngModel.$parsers.push(function(value) {
        return p.get('select', 'yyyy-mm-dd');
      });
      // console.log(ngModel);
      // $(el).datepicker('update', ngModel.$modelValue);
      // ngModel.$formatters.push(function(modelValue) {
      //   console.log(modelValue);
      //   $(el).datepicker('update', modelValue);
      // });
    }
  };
});

app.directive('clockpick', function() {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, el, attr, ngModel) {
      // console.log(ngModel);
      var time = $(el).pickatime({
          'interval' : 20,
          'format' : 'H:i'
          //'format' : 'H:i',
	  //'editable' : true
      });
      var p = time.pickatime('picker')
    }
  };
});
app.directive('jnumber2', function($filter,$browser) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, element, attr, ngModel) {
      var viewValue, noCommasVal;
      var wholeNosReg = /^(?=.{1,9}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})?$/;
      function testValue(value) {
        ngModel.$setValidity('pattern',wholeNosReg.test(value));
      }
      function setThousandSeperator(value) {
        if (value) {
          noCommasVal = value.toString().replace(/,/g, '');
          viewValue = noCommasVal.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          ngModel.$setViewValue(viewValue);
          ngModel.$render();
        }
      }

      ngModel.$parsers.push(function(value) {
        if (!value) {
          ngModel.$setValidity('pattern',true);
        } else {
          testValue(value);
          setThousandSeperator(value);
          return noCommasVal;
        }
      });
      ngModel.$formatters.push(function(value) {
        if (!value) {
          ngModel.$setValidity('pattern',true);
          return value;
        } else {
          testValue(value);
          setThousandSeperator(value);
          return viewValue;
        }
      });

    }
  }
})
app.directive('inputThousandSeparator', [
      function() {
        return {
          restrict: 'A',
          require: 'ngModel',
          link: function(scope, element, attr, ngModel) {

            var viewValue, noCommasVal;
            var numberMode = attr['inputThousandSeparator'];

            var currencyReg = /^(?!0+\.00)(?=.{1,9}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})*(\.[0-9]{2})?$/;
            var percentageReg = /(^100([.]0{1,2})?)$|(^\d{1,2}([.]\d{1,2})?)$/;
            var wholeNosReg = /^(?=.{1,9}(\.|$))(?!0(?!\.))\d{1,3}(,\d{3})?$/;

            function testValue(value) {
              switch(numberMode) {
                case 'currency':
                  ngModel.$setValidity('pattern',currencyReg.test(value));
                  break;

                case 'percentage':
                  ngModel.$setValidity('pattern',percentageReg.test(value));
                  break;

                case 'whole':
                  ngModel.$setValidity('pattern',wholeNosReg.test(value));
                  break;
              }
            }

            function setThousandSeperator(value) {
              if (value) {
                noCommasVal = value.toString().replace(/,/g, '');
                viewValue = noCommasVal.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                ngModel.$setViewValue(viewValue);
                ngModel.$render();
              }
            }

            ngModel.$parsers.push(function(value) {
              if (!value) {
                ngModel.$setValidity('pattern',true);
              } else {
                testValue(value);
                setThousandSeperator(value);
                return noCommasVal;
              }
            });
            ngModel.$formatters.push(function(value) {
              if (!value) {
                ngModel.$setValidity('pattern',true);
                return value;
              } else {
                testValue(value);
                setThousandSeperator(value);
                return viewValue;
              }
            });
          }
        };
      }
    ]);
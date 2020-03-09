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
          'interval' : 15,
          'format' : 'H:i'
      });
      var p = time.pickatime('picker')
    }
  };
});
app.directive('jnumber', function($filter, $browser) {
    return {
        require: 'ngModel',
        restrict: 'A',
        scope: {
          ngModel: '='
        },
        link: function(scope, $element, $attrs, ngModelCtrl) {
            var listener = function() {
                var value = $element.val().replace(/,/g, '')
                $element.val($filter('number')(value, false))
            }

            // This runs when we update the text field
            ngModelCtrl.$parsers.push(function(viewValue) {
                return viewValue.replace(/,/g, '');
            })

            // This runs when the model gets updated on the scope directly and keeps our view in sync
            ngModelCtrl.$render = function() {
                if (isNaN(ngModelCtrl.$viewValue)) {
                  $element.val(0)
                } else {
                  $element.val($filter('number')(ngModelCtrl.$viewValue, false))
                }
            }

            $element.bind('change', listener)
            $element.bind('keydown', function(event) {
                var key = event.keyCode
                // If the keys include the CTRL, SHIFT, ALT, or META keys, or the arrow keys, do nothing.
                // This lets us support copy and paste too
                if (key == 91 || (15 < key && key < 19) || (37 <= key && key <= 40))
                    return
                $browser.defer(listener) // Have to do this or changes don't get picked up properly
            })

            $element.bind('paste cut', function() {
                $browser.defer(listener)
            })
        }

    }
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
// app.directive('onlyNum', function($browser) {
//       return {
//         restrict: 'A',
//         require: 'ngModel',
//         link: function(scope, element, attrs, modelCtrl) {
//             $(element).addClass('text-right')
//             // keyCode = [173, 8,9,37,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,110,190];
//             // element.bind("keyup", function(event) {
//             //     if (event.which == 13) {
//             //        var nextInput = inputs.get(inputs.index(this) + 1);
//             //        if (nextInput) {
//             //           nextInput.focus();
//             //        }
//             //     }
//             //     if (modelCtrl.$modelValue) {
//             //       // var hitungTitik=(modelCtrl.$modelValue.match(/./g)||[]).length;
//             //       var modelVal=modelCtrl.$modelValue;
//             //       var hitungTitik=modelVal.split('.').length-1;
//             //       var slength=modelVal.length;
//             //       // console.log(slength);
//             //       alert(modelVal)
//             //       modelCtrl.$render();
//             //       // if (slength>0 && modelVal.charAt(0)=="0") {
//             //       //   // var newVal=modelVal.indexOf('0') == 0 ? modelVal.substring(1) : modelVal;
//             //       //   // modelCtrl.$setViewValue(newVal);
//             //       //   modelCtrl.$render();
//             //       // }
//             //       // if (hitungTitik>0) {
//             //       //   keyCode=[173,8,9,37,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,110];
//             //       // } else {
//             //       //   keyCode=[173,8,9,37,39,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,110,190];
//             //       // }
//             //     }
//             //     if($.inArray(event.which,keyCode) == -1) {
//             //         console.log(event.which)
//             //         scope.$apply(function(){
//             //             scope.$eval(attrs.onlyNum);
//             //             event.preventDefault();
//             //         });
//             //         event.preventDefault();
//             //     }
//             // });

//         }
//       }
//   });
app.directive('ngConfirmClick', [
    function(){
        return {
            link: function (scope, element, attr) {
                var msg = attr.ngConfirmClick || "Are you sure?";
                var clickAction = attr.confirmedClick;
                element.on('click',function (event) {
                    if ( window.confirm(msg) ) {
                        scope.$eval(clickAction)
                    }
                });
            }
        };
}])

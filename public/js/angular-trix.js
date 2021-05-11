/*! angular-trix - v1.0.0 - 2015-12-09
* https://github.com/sachinchoolur/angular-trix
* Copyright (c) 2015 Sachin; Licensed MIT */
(function() {
    'use strict';
    angular.module('angularTrix', []).directive('angularTrix', function() {
        return {
            restrict: 'A',
            require: 'ngModel',
            scope: {
                ngChange: '&',
                trixInitialize: '&',
                trixChange: '&',
                trixSelectionChange: '&',
                trixFocus: '&',
                trixBlur: '&',
                trixFileAccept: '&',
                trixAttachmentAdd: '&',
                trixAttachmentRemove: '&'
            },
            link: function(scope, element, attrs, ngModel) {


                element.on('trix-initialize', function() {
                    if (ngModel.$modelValue) {
                        element[0].editor.loadHTML(ngModel.$modelValue);
                    }
                });

                setTimeout(function() {
                    $('[data-trix-button-group="history-tools"]').remove()
                    $('[data-trix-button-group="file-tools"]').remove()
                    $('[data-trix-attribute="bullet"]').remove()
                    $('[data-trix-attribute="code"]').remove()
                    $('[data-trix-attribute="quote"]').remove()
                    $('[data-trix-attribute="href"]').remove()
                    $('[data-trix-attribute="heading1"]').remove()
                }, 400)

                ngModel.$render = function() {
                    if (element[0].editor) {
                        element[0].editor.loadHTML(ngModel.$modelValue);
                    }
                    element.on('trix-change', function() {
                    });
                };

                element.on('DOMSubtreeModified', function() {
                    ngModel.$setViewValue(element.html());
                    if(element.text().length > 0) {
                        scope.ngChange()
                    }
                })

                var registerEvents = function(type, method) {
                    element[0].addEventListener(type, function(e) {
                        if (type === 'trix-file-accept' && attrs.preventTrixFileAccept === 'true') {
                            e.preventDefault();
                        }

                        scope[method]({
                            e: e,
                            editor: element[0].editor
                        });
                    });
                };

                registerEvents('trix-initialize', 'trixInitialize');
                registerEvents('trix-change', 'trixChange');
                registerEvents('trix-selection-change', 'trixSelectionChange');
                registerEvents('trix-focus', 'trixFocus');
                registerEvents('trix-blur', 'trixBlur');
                registerEvents('trix-file-accept', 'trixFileAccept');
                registerEvents('trix-attachment-add', 'trixAttachmentAdd');
                registerEvents('trix-attachment-remove', 'trixAttachmentRemove');

            }
        };
    });

}());

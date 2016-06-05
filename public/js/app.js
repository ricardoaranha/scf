var app = angular.module('app', ['ngAnimate'], function($interpolateProvider) {
   $interpolateProvider.startSymbol('<%');
   $interpolateProvider.endSymbol('%>');
});

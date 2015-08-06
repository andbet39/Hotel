'use strict';

// Declare app level module which depends on views, and components
angular.module('myApp', [
  'ngRoute',
  'myApp.view1',
  'myApp.view2',
  'myApp.version',
  'myApp.roomAdmin',
  'myApp.book',
  'myApp.finalize'
]).
config(['$routeProvider', function($routeProvider) {
  $routeProvider.otherwise({redirectTo: '/room_type'});
}])


.service('reservationData', function () {

  var hashtable = {};

  return {
    setValue: function (key, value) {
      hashtable[key] = value;
    },
    getValue: function (key) {
      return hashtable[key];
    }
  }
});
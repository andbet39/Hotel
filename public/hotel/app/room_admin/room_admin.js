'use strict';

angular.module('myApp.roomAdmin', ['ngRoute','ui.materialize'])

    .config(['$routeProvider', function($routeProvider) {
      $routeProvider.when('/room_admin', {
        templateUrl: 'room_admin/room_admin.html',
        controller: 'RoomAdminCtrl'
      });
    }])

    .controller('RoomAdminCtrl', function($scope,$http,$location) {

      $scope.room_types = [];
      $scope.new_type = {};
      $scope.selected_idx;
      $scope.selected_type= {};
      $scope.message=null;
      $scope.update_data= {};

      $scope.init = function(){
        $http.get('/adminapi/room_type').success(function(data){
          $scope.room_types=data;
        });
      }

      $scope.init();

      $scope.create = function(){
        $http.post('/adminapi/room_type',$scope.new_type).success(function(data){

          $scope.room_types.push(data);
          $scope.new_type.name="";
          $scope.new_type.short_name="";
          $scope.new_type.base_price="";
          $scope.new_type.base_availability="";
          $scope.new_type.max_occupancy="";

        });
      };

      $scope.select_type = function(index){
        $scope.selected_idx=index;
        $scope.selected_type =$scope.room_types[index];
        $scope.update_data.room_type= $scope.selected_type.id;
        $scope.message = null;

      };

      $scope.setprice = function(){

        $http.post('/adminapi/setpriceinrange',$scope.update_data).success(function(data){
          $scope.selected_idx=-1;
          $scope.selected_type=null;
          $scope.update_data={};

          $scope.message = data;
        });

      }

    }
);
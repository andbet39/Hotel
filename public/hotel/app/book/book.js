'use strict';

angular.module('myApp.book', ['ngRoute','ui.materialize'])

    .config(['$routeProvider', function($routeProvider) {
        $routeProvider.when('/book', {
            templateUrl: 'book/book.html',
            controller: 'BookController'
        });
    }])

    .controller('BookController', function($scope,$http,reservationData,$location) {


        $scope.select_occupancy = [1,2,3,4,5];
        $scope.available_room_types;
        $scope.search_param={};

        $scope.search = function(){

            $http.post('/api/searchavailabity',$scope.search_param).success(function(data){
                $scope.available_room_types = data;
            });

        };

        $scope.book = function (id) {

            console.log($scope.search_param);

            reservationData.setValue('start_dt',$scope.search_param.start_dt);
            reservationData.setValue('end_dt',$scope.search_param.end_dt);
            reservationData.setValue('occupancy',$scope.search_param.min_occupancy);
            reservationData.setValue('room_info', $scope.available_room_types[id]);


            $location.path( "/finalize" );

        };

    }
);
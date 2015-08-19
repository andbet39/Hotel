'use strict';

angular.module('myApp.pay', ['ngRoute','ui.materialize'])

    .config(['$routeProvider', function($routeProvider) {
        $routeProvider.when('/pay/:reserv_id', {
            templateUrl: 'payment/pay.html',
            controller: 'PayController'
        });
    }])

    .controller('PayController', function($scope,$http,reservationData,$location,$routeParams) {

        $scope.res_id = $routeParams.reserv_id;
        $scope.paid = false;

        $scope.handleStripe = function(status, response){
            if(response.error) {
                $scope.paid= false;
                $scope.message = "Error from Stripe.com"
            } else {
                console.log(response.id);
                var $payInfo = {
                    'token' : response.id,
                    'customer_id' : $scope.reservation_info.customer_id,
                    'total':$scope.reservation_info.total_price
                };

                $http.post('/api/payreservation', $payInfo).success(function(data){
                    if(data.status=="OK"){
                        $scope.paid= true;
                        $scope.message = data.message;
                    }else{
                        $scope.paid= false;
                        $scope.message = data.message;
                    }
                });

            }
        };

        $scope.init = function(){

            $scope.loaded = false;

            $http.get('/api/reservation/'+$scope.res_id).success(function(data){
                $scope.reservation_info = data;
                console.log(data);
                $scope.loaded=true;
            });
        };

        $scope.init();

    }
);
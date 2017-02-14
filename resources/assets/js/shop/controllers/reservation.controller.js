'use strict';

function reserveCtrl($scope, $filter, areasService, reservationService){

    var currentDate = new Date();
    var time = new Date()
    time.setHours(currentDate.getHours(), 0, 0, 0);
    //time.setUTCHours();


    $scope.reservationinfo = true;
    $scope.preorderinfo = false;
    $scope.customerinfo = false;



    $scope.reservation = {
        guest_count: 1,
        environment: null,
        reserved_at: currentDate,
        reserved_time: time ,
        customer_name: '',
        phone: '',
        email: '',
    };
    $scope.preorder = [];
    // $scope.categories = [];

    $scope.popup2 = {
        opened: false
    };
    $scope.open2 = function() {
        $scope.popup2.opened = true;
    };

    $scope.dateOptions = {
        formatYear: 'yy',
        maxDate: new Date(2020, 5, 22),
        minDate: new Date(),
        startingDay: 1,
    };



    $scope.format = 'dd-MMMM-yyyy';

    areasService.query({}, function(result){
        $scope.environments = result.data;
    }, function(err){
        alert(err);
    });

    $scope.preorderInfo = function(){
        $scope.reservationinfo = false;
        $scope.preorderinfo = true;
        $scope.customerinfo = false;
    };
    $scope.customerInfo = function(){
        $scope.reservationinfo = false;
        $scope.preorderinfo = false;
        $scope.customerinfo = true;
    };
    $scope.reservationInfo = function(){
        $scope.reservationinfo = true;
        $scope.preorderinfo = false;
        $scope.customerinfo = false;
    };


    //submit
    $scope.submitForm = function(isValid) {
        // check to make sure the form is completely valid

        if (isValid) {
            reservationService.save({}, $scope.reservation, function(result){
                alert('Reservation Sent');
                //$state.go('pages.index');
            }, function(err){
                console.log(err);
            });
        }
    };
}

reserveCtrl.$inject = ["$scope", "$filter", "areasService", "reservationService"];

angular
      .module("copya-restaurant")
      .controller("reserveCtrl", reserveCtrl);


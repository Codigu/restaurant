'use strict';

function reserveCtrl($scope, $filter, areasService, reservationService, cuisinesService, categoriesService){

    var currentDate = new Date();
    var time = new Date()
    time.setHours(currentDate.getHours(), 0, 0, 0);
    //time.setUTCHours();


    $scope.reservationinfo = true;
    $scope.preorderinfo = false;
    $scope.customerinfo = false;

    $scope.cuisines = [];
    $scope.categories = [];
    $scope.bag = [];
    $scope.selectedCategory = [];
    $scope.selectedCategoryTemp = [];
    $scope.filterByCategory = function(cuisine) {
        return ($scope.selectedCategory.indexOf(cuisine.category_id) !== -1);
    };

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

    categoriesService.query({}, function(result){
        $scope.categories = result.data;
        angular.forEach($scope.categories, function(value, key) {
            $scope.selectedCategory.push(value.id);
        });
    }, function(err){
        alert(err);
    });

    $scope.preorderInfo = function(){

        $scope.reservationinfo = false;
        $scope.preorderinfo = true;
        $scope.customerinfo = false;
        cuisinesService.query({}, function(result){
            $scope.cuisines = result.data;
        }, function(){

        });
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
        console.log(isValid);
        if (isValid) {
            reservationService.save({}, {reservation: $scope.reservation, bag: $scope.bag}, function(result){
                alert('Reservation Sent');
                //$state.go('pages.index');
            }, function(err){
                console.log(err);
            });
        }
    };

    $scope.addToBag = function(item){
        item.quantity = 1;
        $scope.bag.push(item);

        var pos = $scope.cuisines.indexOf(item);

        $scope.cuisines.splice(pos, 1);
    };

    $scope.loadCategoryMenus = function(category){
        $scope.selectedCategory = $scope.selectedCategoryTemp;

        var pos = $scope.selectedCategory.indexOf(category.id);

        if(pos == -1){
            $scope.selectedCategory.push(category.id)
        } else {
            $scope.selectedCategory.splice(pos, 1);
        }

        $scope.selectedCategoryTemp = $scope.selectedCategory;
    };

    $scope.getBagTotal = function() {
        var total = 0;
        for (var i = 0; i < $scope.bag.length; i++) {
            var cuisine = $scope.bag[i];
            total += (cuisine.price * cuisine.quantity);
        }
        return total;
    }
}

reserveCtrl.$inject = ["$scope", "$filter", "areasService", "reservationService", "cuisinesService", "categoriesService"];

angular
      .module("copya-restaurant")
      .controller("reserveCtrl", reserveCtrl);


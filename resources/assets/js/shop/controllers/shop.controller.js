'use strict';

function shopCtrl(
        $scope,
        shopCategoryService,
        productsService,
        cartService
    ){
    $scope.categories = [];
    $scope.products = [];
    $scope.cart = [];

    $scope.selectedCategory = [];
    $scope.selectedCategoryTemp = [];
    $scope.filterByCategory = function(product) {
        return ($scope.selectedCategory.indexOf(product.category_id) !== -1);
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

    $scope.addToCart = function(product){
        cartService.save({id: ''}, product, function(result){

            product.quantity = 1;
            $scope.cart.push(product);
            var pos = $scope.products.indexOf(product);
            $scope.products.splice(pos, 1);
        }, function(err){
            console.log(err);
        });
    };

    shopCategoryService.query({}, function(result){
        $scope.categories = result.data;
        angular.forEach($scope.categories, function(value, key) {
            $scope.selectedCategory.push(value.id);
        });
    }, function(err){
        console.log(err);
    });

    productsService.query({}, function(result){
        $scope.products = result.data;
        console.log(result.data);
    }, function(err){
        console.log(err);
    });

    $scope.getCartTotal = function() {
        var total = 0;
        if($scope.cart.length > 0){
            for (var i = 0; i < $scope.cart.length; i++) {
                var product = $scope.cart[i];
                total += (product.price * product.quantity);
            }
        }

        return total;
    };

    $scope.doCheckout = function()
    {
        console.log('asdfasf');
        window.location.replace("/checkout");
    }

}

shopCtrl.$inject = [
    "$scope",
    "shopCategoryService",
    "productsService",
    "cartService"
];

angular
      .module("copya-shop")
      .controller("shopCtrl", shopCtrl);


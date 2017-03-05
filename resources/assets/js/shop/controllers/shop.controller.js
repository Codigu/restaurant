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
            //product.rowId = result.data.rowId;
            var rowId = result.data.rowId;
            if($scope.cart[rowId].id){
                $scope.cart[rowId].qty++;
                alert("Cart Updated");
            } else {
                $scope.cart[rowId] = result.data;
                alert("Product added to cart");
            }

        }, function(err){
            console.log(err);
        });
    };

    $scope.removeFromBag = function(key, item){
        console.log(key);
        cartService.delete({id: key}, function(result){
            delete $scope.cart[key];
            $scope.products[key] = item;
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
    }, function(err){
        console.log(err);
    });

    cartService.query({}, function(result){
        $scope.cart = result.data;
    }, function(err){
        console.log(err);
    });

    $scope.getCartTotal = function() {
        var total = 0;

        angular.forEach($scope.cart, function(value, key) {
            console.log(value);
            total += (value.price * value.qty);
        });

        return total;
    };

    $scope.doCheckout = function() {
        window.location.replace("/checkout");
    };

    $scope.updateQty = function(key, item){
        cartService.update({id: key}, item, function(result){}, function(err){
            console.log(err);
        });
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


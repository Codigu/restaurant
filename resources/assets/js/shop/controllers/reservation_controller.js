angular
  .module("reserve.controller", [])
  .controller("reserveCtrl", reserveCtrl);

  reserveCtrl.$inject = ["$scope", "$filter", "restMenu"];
  function reserveCtrl($scope, $filter, restMenu){
    var vm = this;

    $scope.reservationinfo = true;
    $scope.preorderinfo = false;
    $scope.customerinfo = false;

    $scope.reservation = [];
    $scope.preorder = [];
    // $scope.categories = [];
    
    restMenu.menu().then(function(response){
      $scope.categories = response.data.menu_categories;
    });

    // functions
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
    $scope.loadCategoryMenus = function(obj){
      var currentid = angular.element(obj.currentTarget).attr("data-id");
      var default_category = $filter('filter')($scope.categories, function(d){return d.id === currentid;})[0];
      $scope.default_catmenu = default_category.menu;
      $scope.default_catname = default_category.name;
      $scope.default_catid = currentid;
      $scope.catactive = "catactive" + currentid;
    };
    $scope.addToBag = function(obj){
      var catid = angular.element(".listing-menu").attr("data-catid");
      var itemid = angular.element(obj.currentTarget).attr("data-item");
      var menucat = $filter('filter')($scope.categories, function(d){return d.id === catid;})[0];
      var menuitem = $filter('filter')(menucat.menu, function(d){return d.id === itemid;})[0];
      var exist = $filter('filter')($scope.preorder, function(d){return d.item_id === itemid;})[0];
      // console.log(exist);
      if(exist){
        alert("To ADD MORE" + " " + exist.name + " " + "change it's quantity in the summary section.");
      }else{
        $scope.preorder.push({
          "id": "0"+itemid,
          "item_cat": catid,
          "item_id": itemid,
          "name": menuitem.name,
          "price": menuitem.price,
          "quantity": "1",
          "subtotal": menuitem.price
        });
      }
    };
    $scope.removeFromBag = function(obj){
      var pos = $scope.preorder.indexOf(obj);
      $scope.preorder.splice(pos, 1);
    };
    $scope.hello = function(obj){
      var itemid = angular.element().attr("data-id");
      $scope.preorderItem = $filter('filter')($scope.preorder, function(d){return d.item_id === itemid;})[0];
      console.log(itemid);
    };
    $scope.updateQuantity = function(){

    };
    function defaultMenu(){
      $scope.catFirstItem = angular.element(".category-menu >li a").attr("data-id");
      $scope.default_category = $filter('filter')($scope.categories,function(d){return d.id === $scope.catFirstItem;})[0];
      $scope.default_catmenu = $scope.default_category.menu;
      $scope.default_catname = $scope.default_category.name;
      $scope.default_catid = $scope.catFirstItem;
      $scope.catactive = "catactive" + $scope.catFirstItem;
    }

    // function call
    angular.element(document).ready(function(){
      defaultMenu();
    });
  }
})();

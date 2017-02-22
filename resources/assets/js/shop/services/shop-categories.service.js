'use strict';

function shopCategoryService($resource) {
	return $resource('/api/shop-categories/:id',{id: '@id'},
		{ query: {method:'GET', isArray:false}, get: {method: "GET"}, destroy: { method: "DELETE" }, update: { method: "PUT" } }
	);

}

shopCategoryService.$inject = ['$resource'];

angular
	.module('copya-shop')
	.factory('shopCategoryService', shopCategoryService);

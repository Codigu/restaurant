'use strict';

function categoriesService($resource) {
	return $resource('/api/bistro-categories/:id',{id: '@id'},
		{ query: {method:'GET', isArray:false}, get: {method: "GET"}, destroy: { method: "DELETE" }, update: { method: "PUT" } }
	);

}

categoriesService.$inject = ['$resource'];

angular
	.module('copya-restaurant')
	.factory('categoriesService', categoriesService);

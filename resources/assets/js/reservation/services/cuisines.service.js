'use strict';

function cuisinesService($resource) {
	return $resource('/api/cuisines/:id',{id: '@id'},
		{ query: {method:'GET', isArray:false}, get: {method: "GET"}, destroy: { method: "DELETE" }, update: { method: "PUT" } }
	);

}

cuisinesService.$inject = ['$resource'];

angular
	.module('copya-restaurant')
	.factory('cuisinesService', cuisinesService);

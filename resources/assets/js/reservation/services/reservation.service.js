'use strict';

function reservationService($resource) {
	return $resource('/api/reservations/:id',{id: '@id'},
		{ query: {method:'GET', isArray:false}, get: {method: "GET"}, destroy: { method: "DELETE" }, update: { method: "PUT" } }
	);

}

reservationService.$inject = ['$resource'];

angular
	.module('copya-restaurant')
	.factory('reservationService', reservationService);

<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use CopyaRestaurant\Eloquent\Reservation;

class ReservationTest extends RestaurantTestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_reservation_has_a_customer_name()
    {

    }

}
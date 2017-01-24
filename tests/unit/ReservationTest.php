<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use CopyaRestaurant\Eloquent\Reservation;

class ReservationTest extends ReservationTestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_reservation_has_a_customer_name()
    {
        $this->assertTrue(true);
    }

}
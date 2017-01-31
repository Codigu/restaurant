<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use CopyaRestaurant\Eloquent\Reservation;
use CopyaRestaurant\Eloquent\Area;
use CopyaRestaurant\Eloquent\Status;
use CopyaRestaurant\Eloquent\Cuisine;

class ReservationTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    /** @test */
    public function a_reservation_can_be_assigned_to_an_area()
    {
        $reservation = factory(Reservation::class)->create();
        $area = factory(Area::class)->create();
        $reservation->assign($area);

        $this->assertEquals($area->id, $reservation->area_id);
    }

    /** @test */
    public function a_reservation_can_be_reassigned_to_another_area()
    {
        $reservation = factory(Reservation::class)->create();
        $area = factory(Area::class)->create();
        $areaTwo = factory(Area::class)->create();

        $reservation->assign($area);
        $reservation->assign($areaTwo);

        $this->assertEquals($areaTwo->id, $reservation->area_id);
    }



    /** @test */
    public function a_reservation_can_have_a_valid_discount()
    {
        $reservation = factory(Reservation::class)->create();
        $reservation->amount = 110;
        $reservation->set_discount(100);

        $this->assertEquals(100, $reservation->discount);
    }

    /** @test */

    public function a_reservation_discount_should_be_less_than_amount()
    {
        $reservation = factory(Reservation::class)->create();
        $reservation->amount = 100;

        $this->setExpectedException('Exception');
        $reservation->set_discount(100);

    }

    /** @test */
    public function a_reservation_can_set_a_status()
    {
        $reservation = factory(Reservation::class)->create();
        $status = factory(Status::class)->create();
        $reservation->set_status($status);

        $this->assertEquals($status->id, $reservation->status_id);
    }

    /** @test */
    public function a_reservation_can_change_from_a_status_to_another_status()
    {
        $reservation = factory(Reservation::class)->create();
        $status = factory(Status::class)->create();
        $statusTwo = factory(Status::class)->create();

        $reservation->set_status($status);
        $reservation->set_status($statusTwo);

        $this->assertEquals($statusTwo->id, $reservation->status_id);
    }

    /** @test */
    public function a_reservation_can_add_a_reservation_date_time()
    {
        $reservation = new Reservation(['customer_name' => "Arnel Basiliote"]);
        $date_time = \Carbon\Carbon::now()->addDays(10);
        $reservation->set_reservation_date($date_time);

        $this->assertEquals($date_time, $reservation->reserved_at);
    }

    /** @test */
    public function reservation_date_should_be_at_least_three_days_from_now()
    {
        $reservation = new Reservation(['customer_name' => "Arnel Basiliote"]);
        $date_time = \Carbon\Carbon::now()->addDays(2);

        $this->setExpectedException('Exception');
        $reservation->set_reservation_date($date_time);
    }

    /** @test */
    public function reservation_can_add_a_cuisine()
    {
        $reservation = factory(Reservation::class)->create();
        $cuisine = factory(Cuisine::class)->create();

        $reservation->add_cuisine($cuisine);

        $this->assertEquals(1, $reservation->cuisines()->count());
    }

    /** @test */
    public function reservation_can_add_multiple_cuisines()
    {
        $reservation = factory(Reservation::class)->create();
        $cuisines = factory(Cuisine::class, 5)->create();

        $reservation->add_cuisine($cuisines);

        $this->assertEquals(5, $reservation->cuisines()->count());
    }

    /** @test */
    public function reservation_can_remove_a_cuisine()
    {
        $reservation = factory(Reservation::class)->create();
        $cuisines = factory(Cuisine::class, 3)->create();
        $reservation->add_cuisine($cuisines);
        $cuisine = factory(Cuisine::class)->create();
        $reservation->add_cuisine($cuisine);

        $reservation->remove_cuisine($cuisine);

        $this->assertEquals(3, $reservation->cuisines()->count());

    }




}
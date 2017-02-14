<?php

namespace CopyaRestaurant\Eloquent;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Exception;
use CopyaRestaurant\Eloquent\Status;
use Illuminate\Database\Eloquent\Collection;
use CopyaRestaurant\Eloquent\Area;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $fillable = array(
        'customer_name',
        'email',
        'guest_count',
        'phone',
        'is_agent',
        'amount',
        'discount',
        'deposit',
        'note'
    );

    protected $dates = array(
        'reserved_at'
    );


    public function tables()
    {
        return $this->belongsToMany('CopyaRestaurant\Eloquent\Table');
    }

    public function cuisines()
    {
        return $this->belongsToMany('CopyaRestaurant\Eloquent\Cuisine');
    }

    public function assign(Area $area)
    {
        $this->area()->associate($area);
    }

    public function area()
    {
        return $this->belongsTo('CopyaRestaurant\Eloquent\Area');
    }


    public function set_discount($discount = 0)
    {
        //exception if amount is not set
        if (!$this->amount || $this->amount == 0 || $this->amount <= $discount) {
            throw new Exception;
        }

        $this->discount = $discount;
    }

    public function status()
    {
        return $this->belongsTo('CopyaRestaurant\Eloquent\Status');
    }

    public function set_status(Status $status)
    {
        $this->status()->associate($status);
    }

    public function set_reservation_date(Carbon $date)
    {
        if ($date->diffInDays(Carbon::now()) < 3) {
            throw new Exception;
        }
        $this->reserved_at = $date;
    }

    public function add_cuisine($cuisines)
    {
        if($cuisines instanceof Collection){
            foreach($cuisines as $cuisine){
                $this->do_add_cuisine($cuisine);
            }
        } else {
            $this->do_add_cuisine($cuisines);
        }

    }

    protected function do_add_cuisine(Cuisine $cuisine)
    {
        $this->cuisines()->attach($cuisine, ['price' => $cuisine->price, 'quantity' => 1]);
    }

    public function remove_cuisine(Cuisine $cuisine)
    {
        $this->cuisines()->detach($cuisine->id);
    }

}

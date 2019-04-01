<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;
use App\Room;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_booking_room()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create();

        $this->visit('rooms/'.$room->id);

        $this->submitForm('Submit Room', [
            'customer_name' => 'Ariyanur Rahman',
            'status' => 'Booking',
        ]);

        $this->seeInDatabase('rooms', [
            'customer_name' => 'Ariyanur Rahman',
            'status' => 'Booking',
            'booking_time' => date('Y-m-d H:i:s'),
        ]);

        $this->seePageIs('rooms/'.$room->id);

        $this->see('Ariyanur Rahman');
        $this->see('Booking');
        $this->see('Booking Time');
        $this->see(date('Y-m-d H:i:s'));

        // dump(\DB::table('rooms')->get());
    }

    /** @test */
    public function user_can_checkin()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create();

        $this->visit('rooms/'.$room->id);

        $this->submitForm('Submit Room', [
            'customer_name' => 'Ariyanur Rahman',
            'status' => 'Check In',
        ]);

        $this->seeInDatabase('rooms', [
            'customer_name' => 'Ariyanur Rahman',
            'status' => 'Check In',
            'checkin_time' => date('Y-m-d H:i:s'),
        ]);

        $this->seePageIs('rooms/'.$room->id);

        $this->see('Ariyanur Rahman');
        $this->see('Check In');
        $this->see('Check In Time');
        $this->see(date('Y-m-d H:i:s'));
    }

    /** @test */
    public function user_can_check_in_from_booking_page()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create(['status' => 'Booking', 'booking_time' => date('y-m-d H:i:s')]);

        $this->visit('rooms/'.$room->id);

        $this->press('checkin');

        $this->seeInDatabase('rooms', [
            'status' => 'Check In',
            'checkin_time' => date('Y-m-d H:i:s'),
        ]);

        $this->seePageIs('rooms/'.$room->id);

        $this->see('Check In');
        $this->see('Check In Time');
        $this->see(date('Y-m-d H:i:s'));
        // dump(\DB::table('rooms')->get());
    }

    /** @test */
    public function user_can_check_out()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create(['status' => 'Check In', 'checkin_time' => date('Y-m-d H:i:s'), 'checkout_time' => date('Y-m-d H:i:s')]);

        $this->visit('rooms/'.$room->id);
        
        $this->press('checkout');

        $this->seePageIs('rooms/'.$room->id);

        $this->seeInDatabase('rooms', [
            'status' => 'Check Out',
            'checkout_time' => date('Y-m-d H:i:s'),
        ]);

        $this->see('Check Out');
        $this->see('Check Out Time');
        $this->see(date('Y-m-d H:i:s'));
    }

    /** @test */
    public function user_can_make_room_available_from_checkout_page()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create(['status' => 'Check Out']);

        $this->visit('rooms/'.$room->id);

        $this->press('make_available');

        $this->seePageIs('rooms/'.$room->id);

        $this->seeInDatabase('rooms', [
            'status' => 'Available',
        ]);

        $this->see('Available');
    }

    /** @test */
    public function user_can_make_room_onservice_from_checkout_page()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create(['status' => 'Check Out']);

        $this->visit('rooms/'.$room->id);

        $this->press('make_onservice');

        $this->seePageIs('rooms/'.$room->id);

        $this->seeInDatabase('rooms', [
            'status' => 'On Service',
        ]);

        $this->see('On Service');
    }

    /** @test */
    public function user_can_make_room_available_from_onservice_page()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create(['status' => 'On Service']);

        $this->visit('rooms/'.$room->id);

        $this->press('make_available_from_onservice');

        $this->seePageIs('rooms/'.$room->id);

        $this->seeInDatabase('rooms', [
            'status' => 'Available',
        ]);

        $this->see('Available');
    }

    /** @test */
    public function user_can_make_room_not_available_from_onservice_page()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create(['status' => 'On Service']);

        $this->visit('rooms/'.$room->id);

        $this->press('make_unavailable_from_onservice');

        $this->seePageIs('rooms/'.$room->id);

        $this->seeInDatabase('rooms', [
            'status' => 'Not Available',
        ]);

        $this->see('Not Available');
    }

    /** @test */
    public function user_can_make_room_available_from_not_available_page()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create(['status' => 'Not Available']);

        $this->visit('rooms/'.$room->id);

        $this->press('make_room_available_from_notavailable');

        $this->seePageIs('rooms/'.$room->id);

        $this->seeInDatabase('rooms', [
            'status' => 'Available'
        ]);

        $this->see('Available');
    }

    /** @test */
    public function user_can_make_room_not_available_from_available_status_page()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create();    

        $this->visit('rooms/'.$room->id);

        $this->press('make_room_not_available_from_available_page');

        $this->seePageIs('rooms/'.$room->id);

        $this->seeInDatabase('rooms', [
            'status' => 'Not Available'
        ]);

        $this->see('Not Available');
    }

}

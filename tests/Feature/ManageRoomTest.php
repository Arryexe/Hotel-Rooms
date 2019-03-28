<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;
use App\Room;

class ManageRoomTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_make_a_new_room()
    {
        $category = new Category;
        $category->name = 'VIP';
        $category->price = 3000;
        $category->save();

        $this->visit('/rooms/create');

        $this->submitForm('Create Room', [
            'number' => '101',
            'category_name' => $category->id,
            'status' => 'Available',
        ]);

        $this->seeInDatabase('rooms', [
            'number' => '101',
            'category_id' => 1,
            'status' => 'Available',
            'customer_name' => null,
            'checkin_time' => null,
            'booking_time' => null,
            'notes' => null,
        ]);

        $this->seePageIs('/rooms');

        $this->see('101');
        $this->see('Available');
        $this->see('VIP');
    }

    /** @test */
    public function user_can_see_room_page()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create();

        $this->visit('/rooms');

        $this->see($room->number);        

        $this->seeElement('a', [
            'id' => 'room_view_'.$room->id,
            'href' => url('rooms/'.$room->id),
        ]);
    }

    /** @test */
    public function user_can_see_detail_room_page()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create();

        $this->visit('/rooms/'.$room->id);

        $this->see('Room Number');
        $this->see('Category');
        $this->see('Status');

        $this->seeElement('a', [
            'id' => 'room_update_'.$room->id,
            'href' => url('rooms/'.$room->id.'/update'),
        ]);
    }

    /** @test */
    public function user_can_edit_room()
    {
        $category = factory(Category::class)->create();
        $room = factory(Room::class)->create();

        $this->visit('rooms/'.$room->id);

        $this->click('room_update_'.$room->id);

        $this->seePageIs('rooms/'.$room->id.'/update');

        $this->seeElement('form', [
            'id' => 'edit_room_'.$room->id,
            'action' => url('rooms/'.$room->id),
        ]);

        $this->submitForm('Update Room', [
            'number' => '101',
            'category_name' => $category->id,
            'notes' => 'Updated Notes',
        ]);

        $this->seeInDatabase('rooms', [
            'number' => '101',
            'category_id' => $category->id,
            'status' => 'Available',
            'customer_name' => null,
            'checkin_time' => null,
            'checkout_time' => null,
            'booking_time' => null,
            'notes' => 'Updated Notes'
        ]);

        $this->seePageIs('rooms/'.$room->id);
    }

    /** @test */
    public function user_can_delete_an_existing_room()
    {
        factory(Category::class)->create();
        $room = factory(Room::class)->create();

        $this->visit('rooms/'.$room->id);

        $this->press('delete_room_'.$room->id);

        $this->seePageIs('rooms');

        $this->dontSeeInDatabase('rooms', [
            'id' => $room->id,
        ]);
    }
}
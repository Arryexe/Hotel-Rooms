<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;
use App\Room;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function user_can_see_index_page()
    {
        $this->visit('categories');

        $this->see('List Categories');
        $this->see('Name');
        $this->see('Price');
    }

    /** @test */
    public function user_can_create_a_new_category()
    {
        $this->visit('categories');

        $this->click('create_new_category');

        $this->seePageIs('categories/create');

        $this->submitForm('Create Category', [
            'name' => 'Normal',
            'price' => 1500,
        ]);

        $this->seeInDatabase('categories', [
            'name' => 'Normal',
            'price' => 1500,
        ]);

        $this->seePageIs('categories');

        $this->see('Normal');
        $this->see('1500');
    }

    /** @test */
    public function user_can_see_category_detail()
    {
        $category = factory(Category::class)->create();

        $this->visit('categories');

        $this->click('edit_category_'.$category->id);

        $this->seePageIs('categories/'.$category->id);

        $this->see($category->name);
        $this->see($category->price);
    }

    /** @test */
    public function user_can_edit_category()
    {
        $category = factory(Category::class)->create();

        $this->visit('categories/'.$category->id);

        $this->click('edit_category_'.$category->id);

        $this->seePageIs('categories/'.$category->id.'/edit');

        $this->seeElement('form', [
            'action' => url('categories/'. $category->id),
            'id' => 'edit_category_'.$category->id,
        ]);

        $this->submitForm('Edit Category', [
            'name' => 'VIP',
            'price' => 3000,
        ]);

        $this->seeInDatabase('categories', [
            'name' => 'VIP',
            'price' => 3000,
        ]);

        $this->seePageIs('categories/'.$category->id);

        $this->see('VIP');
        $this->see('3000');
    }

    /** @test */
    public function user_can_delete_category()
    {
        $category = factory(Category::class)->create();

        $this->visit('categories/'.$category->id);

        $this->press('delete_category_'.$category->id);

        $this->dontSeeInDatabase('categories', [
            'id' => $category->id,
        ]);
    }
}
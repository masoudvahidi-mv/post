<?php

namespace Tests\Unit\Http\Controllers;

use PHPUnit\Framework\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user_id = 1;
        $message = 'It has survived not only five centuries?Investor Spotlight';
        $response = $this->post('/post/create', [
            'user_id' =>$user_id,
            'message' => $message
        ]);

        $this->assertDatabaseHas('posts', [
            'name' => $user_id,
            'email' => $message
        ]);
    }
}

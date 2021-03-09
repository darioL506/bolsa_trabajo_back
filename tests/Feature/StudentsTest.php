<?php

namespace Tests\Feature;

use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Student;

class StudentsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function  testPrueba() {
        $st = app(StudentController::class)->get(2);
        //var_dump($st);
        echo($st->getdata());
    }
}

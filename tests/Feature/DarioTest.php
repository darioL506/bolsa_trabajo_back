<?php

namespace Tests\Feature;

use App\Http\Controllers\StudentController;
use App\Models\User;
use http\Env\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Passport\Passport;
use Tests\TestCase;
use App\Models\Student;

class DarioTest extends TestCase
{
    /**
     * @env USER_ID
     */

    public function  testReciboUnEstudiantePorSuIdDeUsuario() {
        $aux= app(StudentController::class)->get(2);
        $this->assertInstanceOf(JsonResponse::class,$aux);
        //var_dump($aux);
        $this->assertEquals(200,$aux->getOriginalContent()['code']);

        $st = json_decode($aux->getOriginalContent()[0]);
        //var_dump($st);
        //echo($aux->id);

        $this->assertIsInt($st->id);
        $this->assertEquals($st->name,'Dario');
        $this->assertEquals(2,$st->user_id);
    }

    public function  testActualizoElPerfilDeUnAlumno() {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $json = '{"name":"Dario","lastName":"Leon",
        "birthdate":{"year":1997,"month":4,"day":28},
        "dni":"06284568Q","phone":728012913,
        "aptitudes":"Voluptatem aut qui accusantium maiores pariatur iste qui iure. Similique exercitationem cupiditate eos quos explicabo non repellat soluta. Beatae ab quo non voluptates. Quisquam maiores aut officiis facere voluptatem.",
        "status":0,"areas":[7,16,18,19,1]}';

        $array = json_decode($json,true);

        $response = $this->put('api/student/2',$array);

        $response->assertStatus(200);
    }

    public function  testActualizoUnUsuario() {
        $user = User::factory()->make();
        Passport::actingAs($user);

        $json = '{"id":2,"email":"dario@gmail.com"}';

        $array = json_decode($json,true);

        $response = $this->put('api/user/2',$array);

        $response->assertStatus(200);
    }

    public function testRegistroAlumno() {
        $json = '{"email":"pepa@gmail.com","password":"123","condicion":"student"}';
        $array = json_decode($json,true);
        $response = $this->post('api/register',$array);
        $response->assertStatus(201);

        $aux = json_decode($response->getOriginalContent()['message']['user'],true);
        //var_dump($aux);
        //$this->id = $aux['id'];

        $_ENV['USER_ID'] = $aux['id'];

        $json = '{"id":'.$_ENV['USER_ID'].',"name":"Pepa","lastName":"Pelaez",
        "birthdate":{"year":1997,"month":4,"day":28},
        "dni":"12345678B","phone":728012913,
        "aptitudes":"Voluptatem aut qui accusantium maiores pariatur iste qui iure. Similique exercitationem cupiditate eos quos explicabo non repellat soluta. Beatae ab quo non voluptates. Quisquam maiores aut officiis facere voluptatem.",
        "status":0,"areas":[7,16,18,19,1]}';
        $array = json_decode($json,true);
        $response = $this->post('api/student/insert',$array);
        $response->assertStatus(201);
    }

    public function testEliminoAUnUsuario() {
        $user = User::factory()->make();
        Passport::actingAs($user);
        $url = 'api/user/'.$_ENV['USER_ID'];
        $response = $this->delete($url);

        $response->assertStatus(200);
    }
}

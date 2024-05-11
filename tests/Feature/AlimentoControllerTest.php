<?php

namespace Tests\Feature;

use App\Http\Controllers\AlimentoController;
use App\Models\Alimento;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class AlimentoControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //use RefreshDatabase;
    use WithFaker;
    public function test_listado_alimentos(): void
    {
        $response1 = $this->get('/alimento');
        $response1->assertRedirect('/login');

        $this->actingAs($user = User::factory()->create());

        $response = $this->get('/alimento');
        $response->assertStatus(200)
            ->assertSee('Datos de los alimentos');
    }

    public function test_creacion_registro(): void
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->post(route('corral.store'), [
            'corral_nombre' => 'Rancho 1',
            'corral_estado' => 'Ocupado',
        ]);

        $this->assertDatabaseHas('corrals', [
            'corral_nombre' => 'Rancho 1',
        ]);
        $response->assertRedirect(route('corral.index'));
    }

    public function test_validacion_creacion(): void
    {
        $this->actingAs($user = User::factory()->create());
        $datosIncorrectos = [
            'corral_nombre' => '', 
            'corral_estado' => 'valor_correcto',
        ];
    
        $response = $this->post(route('corral.store'), $datosIncorrectos);
    
        $response->assertRedirect();
        $validator = Validator::make($datosIncorrectos, [
            'corral_nombre' => 'required',
        ]);
    
        $this->assertTrue($validator->fails());
    }

    public function test_eliminacion_registro(): void
    {
        $this->actingAs($user = User::factory()->create());
        $registro = Alimento::factory()->create();

        $url = route('alimento.destroy', ['alimento' => $registro->id]);

        $response = $this->delete($url);
        $response->assertRedirect();
    }
}

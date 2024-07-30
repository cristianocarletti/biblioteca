<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Emprestimo;

class EmprestimoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Emprestimo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->id,
            'livro_id' => $this->faker->id,
            'data_emprestimo' => date('Y-m-d'),
            'data_devolucao' => date("Y-m-d", strtotime(date('Y-m-d')." +1 month")),
        ];
    }
}

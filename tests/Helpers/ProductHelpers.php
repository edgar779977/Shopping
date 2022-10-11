<?php

namespace Tests\Helpers;

use App\Models\Product;
use Faker\Factory;

trait ProductHelpers
{

    /**
     * @return array
     * @throws \Exception
     */
    protected function productFactory(): array {
        $faker = Factory::create();
        return [
            'user_id' => auth()->id(),
            'name' => $faker->text(),
            'type' => $faker->text(),
            'description' => $faker->text(),
            'price' => random_int(10,10000),
        ];
    }

    /**
     * @return Product
     * @throws \Exception
     */
    public function createProduct(): Product
    {
        $attributes = $this->productFactory();
        return create(Product::class, $attributes);
    }

}

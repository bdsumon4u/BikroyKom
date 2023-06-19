<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $data = [
        'user_id' => $faker->boolean ? mt_rand(1, 21) : NULL,
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->e164PhoneNumber,
        'address' => $faker->address,
    ];

    $shippingArea = $faker->boolean ? 'Inside Dhaka' : 'Outside Dhaka';

    $data['products'] = [];
    $limit = mt_rand(1, 4);
    for ($i=0; $i < $limit; $i++) { 
        $data['products'][mt_rand(91, 137)] = mt_rand(1, 3);
    }

    $products = Product::find(array_keys($data['products']))
        ->map(function (Product $product) use ($data) {
            $id = $product->id;
            $quantity = $data['products'][$id];

            // Manage Stock
            if ($product->should_track) {
                if ($product->stock_count <= 0) {
                    return null;
                }
                $product->decrement('stock_count', $quantity);
            }

            // Needed Attributes
            return [
                'id' => $id,
                'name' => $product->name,
                'slug' => $product->slug,
                'image' => $product->base_image->src,
                'price' => $product->selling_price,
                'quantity' => $product->stock_count >= $quantity ? $quantity : $product->stock_count,
                'total' => $quantity * $product->selling_price,
            ];
        })->filter(function ($product) {
            return $product != null; // Only Available Products
        })->toArray();

    $data['products'] = json_encode($products);
    $data += [
        'status' => data_get(config('app.orders', []), mt_rand(0, 3), 'PENDING'), // Default Status
        // Additional Data
        'data' => json_encode([
            'shipping_area' => $shippingArea,
            'shipping_cost' => config('services.shipping.'.$shippingArea),
            'subtotal'      => array_reduce($products, function ($sum, $product) {
                return $sum += $product['total'];
            }),
        ]),
    ];

    return $data;
});

<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmptyContentResource;
use App\Http\Resources\ErrorResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResource
     */
    public function create(Request $request): JsonResource
    {

        try {
            DB::beginTransaction();
                $price = Product::where('id',$request->product)->first()->price;

                $source = $request->source;
                $user_id = \auth()->id();
                $message = "User {$user_id} bought product {$request->product}";

                $stripe = new StripeClient(config('services.stripe.secret'));
                $payment = $stripe->charges->create([
                    'amount' => $price,
                    'currency' => 'usd',
                    'source' => $source,
                    'description' => $message,
                ]);
                if ($payment->status === 'succeeded') {
                    \auth()->user()->payments()->create([
                        'product_id' => $request->product,
                        'amount' => $price,
                        'description' => $message,
                        'amount_id' => $payment->id
                    ]);
                }
            DB::commit();
            return new EmptyContentResource(['status'=>200]);
        } catch(\Exception $e) {
            DB::rollBack();
            if (isset($payment)) {
                $refundedAmount = $payment->amount-ceil($payment->amount*3/100);
                $stripe->refunds->create(['charge' => $payment->id, 'amount' => $refundedAmount]);
            }

            return new ErrorResource(['message'=>$e->getMessage(), 'status' => 400]);
        }
    }
}

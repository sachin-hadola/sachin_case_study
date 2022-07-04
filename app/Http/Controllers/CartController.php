<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Resources\Cart as CartResource;
use Illuminate\Support\Str;

class CartController extends BaseController
{
    public function __construct(Request $request)
    {
        $this->user_id = 0;
        $access_token = $request->header('Authorization');
        if(isset($access_token) && !empty($access_token)){
            $this->user_id = auth()->guard('api')->user()->id;            
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();   

        $validator = Validator::make($input, [
            'product_id' => 'required|numeric',
            'qty' => 'required|numeric'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['session_id'] = Str::uuid()->toString();
        $input['user_id'] = $this->user_id;
        
        $cart = Cart::create($input);  

        $cart = Cart::with('product.category')->where('session_id',$input['session_id'])->first();

        return $this->sendResponse(new CartResource($cart), 'Item added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = Cart::with('product.category')->where('session_id',$id)->where('user_id',$this->user_id)->first();

        if (is_null($cart)) {
            return $this->sendError('Cart not found.');
        }

        return $this->sendResponse(new CartResource($cart), 'Cart retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();   

        $validator = Validator::make($input, [
            'product_id' => 'required|numeric',
            'qty' => 'required|numeric'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['user_id'] = $this->user_id;
        
        Cart::where('session_id',$id)->update($input);
        $cart = Cart::with('product.category')->where('session_id',$id)->first();

        return $this->sendResponse(new CartResource($cart), 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Cart::where('session_id',$id)->where('user_id',$this->user_id)->delete();

        $msg = "Cart not found.";
        if($result == 1){
            $msg = "Cart deleted successfully.";
        }
        return $this->sendResponse([], $msg);
    }
}

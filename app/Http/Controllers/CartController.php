<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;


class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('website.cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
    //    dd($request->all());
            $total_item = \Cart::getContent()->count();
            if($total_item <100){
                \Cart::add([
                    'id' => $request->id,
                    'name' => $request->name,
                    'price' => '500',
                    'quantity' => 1,
                    'attributes' => array(
                        'image' => $request->image,
                        'slug' => $request->slug,
                    )
                ]);
            }
            
        
           
    }

    public function addToCartAjax(Request $request,$id)
    {
       $product = Product::where('id',$id)->first();
       
       $total_item = \Cart::getContent()->count();
       if($total_item <100){
        
        try {
            \Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => array(
                    'image' => $product->image,
                    'slug' => $product->slug,
                )
            ]);
            return response()->json(['success' => 'Cart added successfully']);
          
        } catch (\Throwable $th) {
            
        }
       }
    //    
    }

    public function addToCartAjaxUpdate(Request $request,$id)
    {

        foreach(\Cart::getContent() as $item){
            $product = Product::with('inventory')->where('id',$id)->first();
            $stock = $product->inventory->purchage;
            $total_item = \Cart::getContent()->count();
            if($total_item <100){
                if($request->quantity > 100){
                    return response()->json(['error' => 'Maximum order quantity 100']);
                }
                else{
                    if($item->id == $id){
                        if($request->quantity<=$stock){
                          
                                 \Cart::update(
                                     $request->id,
                                     [
                                         'quantity' => [
                                             'relative' => false,
                                             'value' => $request->quantity
                                         ],
                                     ]
                                 );
                                 return response()->json(['success' => 'Cart successfully updated']);
                            
                        }
                        else{
                         return response()->json(['error' => 'Stock not available']);
                        }
                         
                     }
                }
            }
           
            
           
        }
        // dd($request->quantity);
        
        
    }
   
    public function buyToCart(Request $request)
    {
        $total_item = \Cart::getContent()->count();
            if($total_item <100){
                try {
                    \Cart::update(
                        $request->id,
                        [
                            'quantity' => [
                                'relative' => false,
                                'value' => $request->quantity
                            ],
                        ]
                    );
                    session()->flash('cart', 'Buy Now');
        
                    return redirect()->route('checkout.user');
                } catch (\Throwable $th) {
                    session()->flash('error', 'Faild to Buy');
        
                    return redirect()->back();
                }
            }
       
    }

    public function updateCart(Request $request)
    {
        $total_item = \Cart::getContent()->count();
            if($total_item <100){
                \Cart::update(
                    $request->id,
                    [
                        'quantity' => [
                            'relative' => false,
                            'value' => $request->quantity
                        ],
                    ]
                );
            }
       
        session()->flash('update', 'Cart is Updated Successfully !');

        return redirect()->back();
    }


    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('remove', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCartAjax( $id)
    {
        \Cart::remove($id);
        $remove = session()->flash('remove', 'Item Cart Remove Successfully !');

        return response()->json(['success' => 'Cart remove successfully']);
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
    public function cartAllData(){
        $cartAll = \Cart::getContent();
        return response()->json($cartAll);
    }
    public function cartContent(){
        $cart['total_amount'] = \Cart::getTotal();
        $cart['total_item'] = \Cart::getContent()->count();
        
        return response()->json($cart);
    }

   public function decrement($id){
        $product = Product::where('id',$id)->first();
        foreach(\Cart::getContent() as $item){
            if($item->quantity == 1){
                $cart = 'data updated successfully';
            }
            else{
                 if($item->id == $product->id){
                    
                \Cart::update(
                    $item->id,
                    [
                        'quantity' => [
                            'relative' => false,
                            'value' => $item->quantity -1
                        ],
                    ]
                    );
                }
            } 
        }
       
        $cart = 'data updated successfully';
        return response()->json($cart);
    }
     public function increment($id){
        $product = Product::with('inventory')->where('id',$id)->first();
         $stock = $product->inventory->purchage;

        foreach(\Cart::getContent() as $item){
            if($item->id == $product->id){
                if($item->quantity+1 > 100){
                    return response()->json(['error' => 'Maximum order quanity 100']);
                }
                else{
                    if($item->quantity + 1 <= $stock){
                        if($item->id == $product->id){
                            \Cart::update(
                                $item->id,
                                [
                                    'quantity' => [
                                        'relative' => false,
                                        'value' => $item->quantity +1
                                    ],
                                ]
                            ); 
    
                        }
                    }
                    else{
                        return response()->json(['error' => 'Stock have no available.']);
                    }
                }
            }   
        }
            
    }

    public function cartRemoveAuto(){
        \Cart::clear();
        return response()->json('cart remove auto after 30 minutes');
    }
    
    
}

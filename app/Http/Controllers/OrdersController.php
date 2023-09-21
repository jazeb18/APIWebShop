<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use Illuminate\Support\facades\Validator;
use Ixudra\Curl\Facades\Curl;


class OrdersController extends Controller
{
    // Display all the records from order table

    public function index(){

        $orders = Orders::all();

        if(count($orders)>0){
        return response()->json([
            'status' => 200,
            'orders' => $orders
            ],200);

        }else{
            return response()->json([
                'status' => 404,
                'orders' => 'No Data Found!!!'
                ],404);
        }
    }
    // Store new record in order table
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'customer' => 'required|max:191',            
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        }else{
            $orders = Orders::Create([
                'customer' => $request->customer,
                'payStatus' => $request->payed
            ]);
            if($orders){
                return response()->json([
                    'status' => 200,
                    'message' => 'Order Created Successfully'
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => 'Something Goes Wrong!!!!'
                ],500);
            }
        }
    }
    // Search for record
    public function show($id){

        $orders = Orders::find($id);
        if($orders){          
            return response()->json([
                'status' => 200,
                'data' => $orders
                ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No Such Records!!!!'
                ],404);
        }
    }
    // Search for record to update it
    public function edit($id){
        
        $orders = Orders::find($id);
        if($orders){          
            return response()->json([
                'status' => 200,
                'data' => $orders
                ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No Such Records!!!'
                ],404);

        }

    }
    // Update record
    public function update(Request $request, int $id){

        $validator = Validator::make($request->all(),[
            'customer' => 'required|max:191',            
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        }else{
           
            $orders = Orders::find($id);
            if($orders){
                $orders->update([
                'customer' => $request->customer,
                'payedAmount' => $request->payed
            ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Order updated successfully'
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'No order found!!!'
                ],404);
            }
        }

    }
    // Delete record
    public function destroy($id){
        $order = orders::find($id);
        if($order){
            $order->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Record deleted successfully'
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No order found'
            ],404);
        }
    }
    // Add product to order
    public function addProduct(Request $request, int $id){
        $order = orders::find($id);
        if($order){    
            
            if($order->payed==''){
            $order->update([
                'product' => $request->product_id,
            ]);            
            return response()->json([
                'status' => 200,
                'message' => 'Product Attached to order successfully'
            ],200);        
            }else{
                return response()->json([
                    'status' => 200,
                    'message' => 'Order is payed already'
                ],200);  
            }            
        }
        else{
           
            return response()->json([
                'status' => 404,
                'message' => 'No order found!!!'
            ],404);

        }
    }
    /* Payment Integration function
    curl call with request paramter by post method.
    If payment succesful then status of record in order table is updated
    */
    public function payProduct(Request $request, int $id){

        $order = orders::find($id);
        
        if($order){
            
            $response = Curl::to('https://superpay.view.agentur-loop.com/pay')
            ->withData( array( 'order_id' => $request->order_id, 'customer_email' => $request->customer_email, 'value' => $request->value ) )
            ->asJson()
            ->post();        
          
           //dd($request->value);
            if($response->message == 'Payment Successful'){

                orders::where('id', $id)
                ->update(['order_id' => $request->order_id, 'customer' => $request->customer_email, 'payedAmount' => $request->value, 'payStatus' =>'Payed']);

                return response()->json([
                    'status' => 200,
                    'message' => 'Payment has been done successfully'
                ],200);
            }
            else{            
                return response()->json([
                    'status' => 500,
                    'message' => $response->message
                ],500);

            }
        } 
        else{
            return response()->json([
                'status' => 404,
                'message' => "No record found!!!"
            ],404);
        }  

    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductsModel;
use App\ProductsMovementsModel;
use App\ProductsDetailsModel;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    //
    public function view(Request $request){
        return view('productos', [ ] );
    }

    public function get(Request $request){
        try{
            
            $products = ProductsModel::orderBy('id', 'asc')
            ->get();

            $result = [
                "message" => $products,
                "status" => 'success',
                "code" => 200
            ];

        }catch(\Exception $e){             
            
            $result = [
                "message" => $e->getMessage(),
                "status" => 'success',
                "code" => 400
            ];
        }

        return $result;
    }

    public function obtener(Request $request){
        try{
            
            $products = ProductsModel::orderBy('products.id', 'asc')
            ->join('products_details', 'id_product_id', '=', 'products.id')
            ->where("code" , $request->code)
            ->get();

            $result = [
                "message" => $products,
                "status" => 'success',
                "code" => 200
            ];

        }catch(\Exception $e){             
            
            $result = [
                "message" => $e->getMessage(),
                "status" => 'success',
                "code" => 400
            ];
        }
        
        return $result;
    }


    public function crear(Request $request){
        return view('crearProductos', [ "concepto" => 1 ] );
    }

    public function descontar(Request $request){
        return view('crearProductos', [ "concepto" => 2 ] );
    }

    

    public function create(Request $request){
        try{
            $user = json_decode($request->session()->get('userData'), true);
            $detalles = [];
            

            try{
                

                $products = ProductsModel::orderBy('id', 'asc')
                    ->where("code" , $request->code)
                    ->where("partner_id" , $user['id'])
                    ->get();

                if(!empty($products)){
                    $productId = $products[0]['id'];
                }

                if($request->concepto == 1 && !isset($productId)){
                    $product = new ProductsModel();
                    $product->name = $request->name;
                    $product->code = $request->code;
                    $product->total_quantity = $request->quantity;
                    $product->sale_price = $request->sale_price;
                    $product->purchase_price = $request->purchase_price;
                    $product->partner_id = $user['id'];
                    $product->status = 1;
                    $product->created_at = new \DateTime();
                    $product->updated_at = new \DateTime();
                    $product->save();

                    $productId = $product->id;

                    $detalles = $this->registerDetails($request, $productId);
                }               

                $movimiento = $this->registerInventoryMovementModel($request, $productId, $user);
                $inventario = $this->UpdateQuantityByProduct($productId);
                

                $result = [
                    "message" => [ 
                        "producto" => $productId, 
                        "movimiento" => $movimiento,
                        "detalles" => $detalles,
                        "inventario" => $inventario
                    ],
                    "status" => 'success',
                    "code" => 200
                ];
                
            }catch (\Exception $e) {
                $result = [
                    "message" => 'El Producto ya se encuentra registrado: '.$e->getMessage(),
                    "status" => 'success',
                    "code" => 400
                ];
            }
            
        }
        catch(\Exception $e){             
            $result = [
                "message" => $e->getMessage(),
                "status" => 'success',
                "code" => 400
            ];
        }        

        return json_encode($result);
    }

    public function registerInventoryMovementModel($request, $productId, $user) {
        try {

            $productMovement = new ProductsMovementsModel();
            $productMovement->quantity = $request->quantity;
            $productMovement->sales_price = $request->sale_price;
            $productMovement->purchase_price = $request->purchase_price;
            $productMovement->user_id = $user['id'];
            $productMovement->product_id = $productId;
            $productMovement->concept_id = $request->concepto;
            $productMovement->created_at=new \DateTime();
            $productMovement->updated_at=new \DateTime();
            $productMovement->save();

            $result = [
                "message" => $productMovement->id,
                "status" => 'success',
                "code" => 200
            ];

            return $result;
        } catch (\Exception $e) {
            $result = [
                "message" => $e->getMessage() . ': ' . $e->getLine(). ': ' . $e->getFile(),
                "status" => 'error',
                "code" => $e->getCode()
            ];

            return $result;
        }
    }

    public function registerDetails($request, $productId) {
        try {

            $productDetails = new ProductsDetailsModel();
            $productDetails->id_product_id = $productId;
            $productDetails->details = json_encode($request->details);
            $productDetails->created_at=new \DateTime();
            $productDetails->updated_at=new \DateTime();
            $productDetails->save();

            $result = [
                "message" => $productDetails->id,
                "status" => 'success',
                "code" => 200
            ];

            return $result;
        } catch (\Exception $e) {
            $result = [
                "message" => $e->getMessage() . ': ' . $e->getLine(). ': ' . $e->getFile(),
                "status" => 'error',
                "code" => 400
            ];

            return $result;
        }
    }

    public function UpdateQuantityByProduct($productId){
        try {

            $entradas = DB::table('products_movements')
            ->select(DB::raw('SUM(quantity) as entradas'))
            ->where('product_id', $productId)
            ->where('concept_id', 1)
            ->get();

            $salidas = DB::table('products_movements')
                ->select(DB::raw('SUM(quantity) as salidas'))
                ->where('product_id', $productId)
                ->where('concept_id', 2)
                ->get();
                
            $total = $entradas[0]->entradas - $salidas[0]->salidas;

            $product = ProductsModel::find($productId);

            $product->total_quantity = $total;

            $product->save();

            $result = [
                "message" => $product->id,
                "status" => 'success',
                "code" => 200
            ];

            return $result;
        } catch (\Exception $e) {
            $result = [
                "message" => $e->getMessage() . ': ' . $e->getLine(). ': ' . $e->getFile(),
                "status" => 'error',
                "code" => 400
            ];

            return $result;
        }

    }



    

}

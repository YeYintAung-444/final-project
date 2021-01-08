<?php

namespace App\Http\Controllers;

use App\Product;
use App\Price_stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::orderBy('id','desc')->get();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=Product::all();
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
       //      'shop_name' => 'required|min:5',
    
       //  ]);

        // store data
        $product = new Product;
        $product->code_no = $request->codeno;
        $product->name = $request->name;
        $product->photo = $request->photo;
        $product->description = $request->description;
        $product->subcategory_id = $request->subcategoryid;
        $product->brand_id = $request->brandid;
        $product->save();


        $price_stock = new Price_stock;
        $price_stock->pc_price = $request->pcprice;
        $price_stock->dozen_price = $request->dozenprice;
        $price_stock->set_price = $request->setprice;
        $price_stock->pcs_count = $request->pccount;
        $price_stock->sets_count = $request->setcount;
        $price_stock->dozens_count = $request->dozencount;
        $price_stock->product_id=$product->id;
        $price_stock->save();


        // redirect
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
         return view('admin.order.product',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Price_stock $price_stock)
    {
        return view('admin.products.edit',compact('product'),compact('price_stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product,Price_stock $price_stock)
    {
        
        // dd($product->id);
        $product->code_no = $request->codeno;
        $product->name = $request->name;
        $product->photo = $request->photo;
        $product->description = $request->description;
        $product->subcategory_id = $request->subcategoryid;
        $product->brand_id = $request->brandid;
        $product->save();

        $price_stock=Price_stock::where('product_id','=',$product->id)->first();
        // dd($product->id);
        $price_stock->pc_price = $request->pcprice;
        $price_stock->dozen_price = $request->dozenprice;
        $price_stock->set_price = $request->setprice;
        $price_stock->pcs_count = $request->pccount;
        $price_stock->sets_count = $request->setcount;
        $price_stock->dozens_count = $request->dozencount;
        $price_stock->product_id=$product->id;
        $price_stock->save();
        // redirect
        return redirect()->route('products.index');
    }


    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
       

         $price_stock=Price_stock::where('product_id','=',$product->id)->first();
         $product->delete();
         $price_stock->delete();
        // redirect
        return redirect()->route('products.index');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function qty_reactive(Request $request){
    DB::transaction(function() use ($request){
        $id=$request->id;
        $newQty=$request->qty;
        $oldQty=$request->oqty;
        $unit=$request->unit;
        if ($unit=='pc') {
            $count='pcs_count';
        }elseif ($unit=='dozen') {
            $count='dozens_count';
        }else{
            $count='sets_count';
        }

        // $product=Price_stock::where('product_id','=', $id)->get();
        //     ->sharedLock()
        //     ->lockForUpdate()
        //     ->get();

        $product=Price_stock::where('product_id','=', $id)
                 ->sharedLock()
                 ->lockForUpdate()
                 ->get();

        // if ($newQty>$oldQty) {
        $ans=array(
            'error'=>null,
            'pcs'=>0,
            'doz'=>0,
            'set'=>0,
        );
        if ($product[0]->$count<($newQty-$oldQty)) {
            if ($count=='pcs_count') {
                $debt_temp=round(($newQty)/12,0); 
                if($debt_temp<1){
                    $debt_temp=1;
                }
                $bal_temp=(($debt_temp*12)+$product[0]->$count)-$newQty;

                if ($bal_temp>=12) { // 22 ~ 12
                    $debt_temp--;
                }

                $final_temp=(($debt_temp*12)+$product[0]->$count)-$newQty;   
                if ($product[0]->dozens_count>=$debt_temp) {
                    $product[0]->dozens_count=$product[0]->dozens_count-$debt_temp;
                    $product[0]->$count=$final_temp;
                    // dd($product[0]->dozens_count);
                    // var_dump($newQty-$oldQty);
                    // var_dump($product[0]->$count);
                    // dd($product[0]->sets_count);
                    $product[0]->save();
                    $ans['pcs']=$product[0]->pcs_count;
                    $ans['doz']=$product[0]->dozens_count;
                    $ans['set']=$product[0]->sets_count;
                    echo json_encode($ans);
                }else{
                    // echo "error";
                    $ans['error']='error';
                    echo json_encode($ans);
                }


            }elseif ($count=='dozens_count') {
                 // dd('kdkdk');
                $debt_temp=round(($newQty-$oldQty)/8,0);   //ans 2
                // dd($debt_temp);
                 if($debt_temp<1){
                    $debt_temp=1;
                }
                $bal_temp=(($debt_temp*8)+$product[0]->$count)-($newQty-$oldQty);
                if ($bal_temp>=8) { // 22 ~ 12
                    $debt_temp--;
                }
                $final_temp=(($debt_temp*8)+$product[0]->$count)-($newQty-$oldQty);
                // dd($final_temp);
                if ($product[0]->sets_count>=$debt_temp) {
                    $product[0]->sets_count=$product[0]->sets_count-$debt_temp;
                    $product[0]->$count=$final_temp;
                    // var_dump($newQty-$oldQty);
                    // var_dump($product[0]->$count);
                    // dd($product[0]->sets_count);
                    $product[0]->save();
                    $ans['pcs']=$product[0]->pcs_count;
                    $ans['doz']=$product[0]->dozens_count;
                    $ans['set']=$product[0]->sets_count;
                    echo json_encode($ans);
                }else{
                    // echo "error";
                    $ans['error']='error';
                    echo json_encode($ans);
                }
                // $product[0]->sets_count=$product[0]->sets_count-$debt_temp;
                // dd($debt_temp);

                
                // $product[0]->$count
            }else{
               $ans['error']='error';
               echo json_encode($ans);
            }
        }else{
            $product[0]->$count=$product[0]->$count-($newQty-$oldQty);
            $product[0]->save();
            $ans['pcs']=$product[0]->pcs_count;
            $ans['doz']=$product[0]->dozens_count;
            $ans['set']=$product[0]->sets_count;
            echo json_encode($ans);
        }        
    });
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @param  \App\Product  $product

     * @return \Illuminate\Http\Response
     */
    public function stockadd(Request  $request)
    {   
        // dd($request->id);
        $state=$request->state; // dount see it
        if ($state=='idcarried') {
            $id=$request->id;
            $product=Product::find($id);
            $price_stock=Price_stock::where('product_id','=',$id)->get();
            return view('admin.products.stockadd',compact('product'),compact('price_stock'));
        }elseif ($state=='dbset') {
            $id=$request->id;
            $pc=$request->pc;
            $dozen=$request->dozen;
            $set=$request->set;
            $price_stock=Price_stock::where('product_id','=',$id)->first();
            $price_stock->pcs_count+=$pc;
            $price_stock->dozens_count+=$dozen;
            $price_stock->sets_count+=$set;
            $price_stock->save();
            return redirect()->route('products.index');
        }

    }

}

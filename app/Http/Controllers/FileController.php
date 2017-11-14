<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCivil;
use App\ProductContabil;
use App\ProductImovela;
use App\ProductImovelg;
use App\ProductTecfins;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class FileController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$products = Product::orderBy('id','DESC')->paginate(5);
        $products = Product::where("user_id", Auth::user()->id)
                            ->orderBy('id', 'ASC')->paginate(5);

        $contabils = ProductContabil::where("user_id", Auth::user()->id)
            ->orderBy('id', 'ASC')->paginate(5);

        $tecfins = ProductTecfins::where("user_id", Auth::user()->id)
            ->orderBy('id', 'ASC')->paginate(5);

        $civils = ProductCivil::where("user_id", Auth::user()->id)
            ->orderBy('id', 'ASC')->paginate(5);

        $imovelgs = ProductImovelg::where("user_id", Auth::user()->id)
            ->orderBy('id', 'ASC')->paginate(5);

        $imovelas = ProductImovela::where("user_id", Auth::user()->id)
            ->orderBy('id', 'ASC')->paginate(5);

        return view('files.index',compact(['products', 'contabils', 'tecfins', 'civils', 'imovelgs', 'imovelas']))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'details' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product($request->input()) ;
        if($file = $request->hasFile('product_image')) {

            $file = $request->file('product_image');

            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/';
            $file->move($destinationPath,$fileName);
            $product->product_image = $fileName;
            $product->user_id = Auth::user()->id;

        }
        $product->save() ;

        //dd($product);

        return redirect()->route('upload-files.index')
            ->with('success','Você conseguiu realizar o upload do documento!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('files.edit', compact('product', 'id'));
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

        $product = Product::find($id);

        $product->name = $request->name;
        $product->details = $request->details;
        $product->product_image = $request->product_image;
        if($file = $request->hasFile('product_image')) {

            $file = $request->file('product_image');

            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/';
            $file->move($destinationPath,$fileName);
            $product->product_image = $fileName;
            $product->user_id = Auth::user()->id;

        }
        $product->save();

        return redirect('/upload-files')->with('success', 'Produto editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

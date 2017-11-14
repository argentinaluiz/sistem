<?php

namespace App\Http\Controllers;

use App\ProductImovela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileImovelaController extends Controller
{
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
        return view('files.create_imovela');
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

        $imovela = new ProductImovela($request->input());
        $imovela->name = $request->get('name');
        $imovela->details = $request->get('details');
        if($file = $request->hasFile('product_image')) {

            $file = $request->file('product_image');

            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/imovela/';
            $file->move($destinationPath,$fileName);
            $imovela->product_image = $fileName;
            $imovela->user_id = Auth::user()->id;

        }
        $imovela->save();
        //ProductContabil::create($imovela);

        return redirect()->route('upload-imovela.create')
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
        $imovela = ProductImovela::findOrFail($id);

        return view('files.edit_imovela', compact('tecfin', 'id'));
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
        $imovela = ProductImovela::find($id);

        $imovela->name = $request->name;
        $imovela->details = $request->details;
        $imovela->product_image = $request->product_image;
        if($file = $request->hasFile('product_image')) {

            $file = $request->file('product_image');

            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/imovela/';
            $file->move($destinationPath,$fileName);
            $imovela->product_image = $fileName;
            $imovela->user_id = Auth::user()->id;

        }
        $imovela->save();

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

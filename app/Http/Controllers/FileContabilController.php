<?php

namespace App\Http\Controllers;

use App\ProductContabil;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FileContabilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        return view('files.createc');
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

        $contabil = new ProductContabil($request->input());
        $contabil->name = $request->get('name');
        $contabil->details = $request->get('details');
        if($filec = $request->hasFile('product_image')) {

            $filec = $request->file('product_image');

            $fileName = $filec->getClientOriginalName();
            $destinationPath = public_path().'/images/contabil/';
            $filec->move($destinationPath,$fileName);
            $new_path = public_path().'/images/contabil';
            copy($destinationPath.$fileName, $new_path.$fileName);
            $contabil->product_image = $fileName;
            $contabil->user_id = Auth::user()->id;

        }
        $contabil->save();
        //ProductContabil::create($contabil);

        return redirect()->route('upload-contabil.create')
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
        $contabil = ProductContabil::findOrFail($id);

        return view('files.editc', compact('contabil', 'id'));
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
        $contabil = ProductContabil::find($id);

        $contabil->name = $request->name;
        $contabil->details = $request->details;
        $contabil->product_image = $request->product_image;

        if($file = $request->hasFile('product_image')){
            $file = $request->file('product_image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/contabil/';
            $file->move($destinationPath,$fileName);
            $contabil->product_image = $fileName;
            $contabil->user_id = Auth::user()->id;
        }

        $contabil->save();

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

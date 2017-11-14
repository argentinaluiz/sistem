<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCivil;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FileCivilController extends Controller
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
        return view('files.create_civil');
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

        $civil = new ProductCivil($request->input());
        $civil->name = $request->get('name');
        $civil->details = $request->get('details');
        if($filec = $request->hasFile('product_image')) {

            $file = $request->file('product_image');

            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/civil/';
            $file->move($destinationPath,$fileName);
            $new_path = public_path().'/images/civil';
            copy($destinationPath.$fileName, $new_path.$fileName);
            $civil->product_image = $fileName;
            $civil->user_id = Auth::user()->id;

        }
        $civil->save();
        //ProductContabil::create($contabil);

        return redirect()->route('upload-civil.create')
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
        $civil = ProductCivil::findOrFail($id);

        return view('files.edit_civil', compact('civil', 'id'));
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
        $civil = ProductCivil::find($id);

        $civil->name = $request->name;
        $civil->details = $request->details;
        $civil->product_image = $request->product_image;

        if($file = $request->hasFile('product_image')){
            $file = $request->file('product_image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/contabil/';
            $file->move($destinationPath,$fileName);
            $civil->product_image = $fileName;
            $civil->user_id = Auth::user()->id;
        }

        $civil->save();

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

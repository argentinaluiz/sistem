<?php

namespace App\Http\Controllers;

use App\ProductImovelg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileImovelgController extends Controller
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
        return view('files.create_imovelg');
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

        $imovelg = new ProductImovelg($request->input());
        $imovelg->name = $request->get('name');
        $imovelg->details = $request->get('details');
        if($filec = $request->hasFile('product_image')) {

            $filec = $request->file('product_image');

            $fileName = $filec->getClientOriginalName();
            $destinationPath = public_path().'/images/imovelg/';
            $filec->move($destinationPath,$fileName);
            $new_path = public_path().'/images/imovelg/';
            copy($destinationPath.$fileName, $new_path.$fileName);
            $imovelg->product_image = $fileName;
            $imovelg->user_id = Auth::user()->id;

        }
        $imovelg->save();
        //ProductContabil::create($contabil);

        return redirect()->route('upload-imovelg.create')
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
        $imovelg = ProductImovelg::findOrFail($id);

        return view('files.editc', compact('imovelg', 'id'));
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
        $imovelg = ProductImovelg::find($id);

        $imovelg->name = $request->name;
        $imovelg->details = $request->details;
        $imovelg->product_image = $request->product_image;

        if($file = $request->hasFile('product_image')){
            $file = $request->file('product_image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/imovelg/';
            $file->move($destinationPath,$fileName);
            $imovelg->product_image = $fileName;
            $imovelg->user_id = Auth::user()->id;
        }

        $imovelg->save();

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

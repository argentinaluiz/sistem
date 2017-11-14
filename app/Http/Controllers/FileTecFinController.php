<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductTecfins;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FileTecFinController extends Controller
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
        return view('files.createtf');
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

        $tecfin = new ProductTecfins($request->input());
        $tecfin->name = $request->get('name');
        $tecfin->details = $request->get('details');
        if($filetf = $request->hasFile('product_image')) {

            $filetf = $request->file('product_image');

            $fileName = $filetf->getClientOriginalName();
            $destinationPath = public_path().'/images/tecfin/';
            $filetf->move($destinationPath,$fileName);
            $tecfin->product_image = $fileName;
            $tecfin->user_id = Auth::user()->id;

        }
        $tecfin->save();
        //ProductContabil::create($tecfin);

        return redirect()->route('upload-tecfin.create')
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
        $tecfin = ProductTecfins::findOrFail($id);

        return view('files.edittf', compact('tecfin', 'id'));
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
        $tecfin = ProductTecfins::find($id);

        $tecfin->name = $request->name;
        $tecfin->details = $request->details;
        $tecfin->product_image = $request->product_image;
        if($file = $request->hasFile('product_image')) {

            $file = $request->file('product_image');

            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images/tecfin/';
            $file->move($destinationPath,$fileName);
            $tecfin->product_image = $fileName;
            $tecfin->user_id = Auth::user()->id;

        }
        $tecfin->save();

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

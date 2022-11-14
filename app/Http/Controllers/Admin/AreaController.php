<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Thana;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['thana'] = Thana::latest()->get();
        $data['areas'] = Area::all();
        return view('admin.area.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:areas|max:50',
            'amount' => 'required',
            'thana_id'  => 'required'
        ]);
        try {
           
        $area = new Area();
        $area->name = $request->name;
        $area->thana_id = $request->thana_id;
        $area->amount = $request->amount;
        $area->save();
        return back()->with('success', 'Area Inserted Successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Ooops! Something Errors');
        }


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
        $data['thana'] = Thana::latest()->get();
        $data['area'] = Area::where('id',$id)->first();
        return view('admin.area.edit',$data);
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
        // dd($request->all());
        $this->validate($request, [
            'name'          => 'required|unique:areas,id',
            'amount' => 'required',
            'thana_id'       => 'required'
        ]);
        $area = Area::find($id);
        $area->name = $request->name;
        $area->thana_id = $request->thana_id;
        $area->amount = $request->amount;
        $area->save();
        return redirect()->route('area.index')->with('success', 'Area updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    public function destroy($id)
    {
        Area::where('id', $id)->delete();
        return back()->with('success', 'Area Deleted successfully');
    }
    public function change(Request $request){
      $area = Area::where('id',$request->area_id)->first();
      $charge = $area->amount;
      return response()->json($charge);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\DeliveryTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TimeSetController extends Controller
{
    public function setTime(){
        $time = DeliveryTime::select('group_id')->groupBy('group_id')->get();
        return view('admin.set_time.index',compact('time'));
    }
    
    public function setTimeStore(Request $request){
        // dd($request->all());
        try {
            $f_count = count($request->time);

            for ($i = 0; $i < $f_count; $i++) {
                $delivery_time = new DeliveryTime();
                $delivery_time->time = $request->time[$i];
                $delivery_time->group_id = $request->group_id;
                $delivery_time->save();
            }
            DB::commit();
            return back()->with('success','set time created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('faild', 'Set Time create faild');
            return back();
        }
    }

    public function destroy($id){
        $time = DeliveryTime::select('group_id')->groupBy('group_id')->where('group_id',$id)->delete();
    }

    public function show($id){
        $time = DeliveryTime::where('group_id',$id)->get();
       return view('admin.set_time.show',compact('time'));
    }
}

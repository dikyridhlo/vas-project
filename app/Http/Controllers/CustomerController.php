<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\CustomerModel as Customer;
use DB;
class CustomerController extends Controller
{
    //
    public function index(){
        return view('pages/customer/index');
    }
    public function get_data(){
        $data=DB::table('customers')->select('customers.*' , 'location_name')
        ->join('location', 'location.location_id', '=', 'customers.location_id');
        return DataTables::of($data)
            ->addColumn('action', function ($data) {

                $delete = '<a class="text-danger mx-auto delete-data" href="'.url('customer/delete/'.$data->customer_id).'">Delete</a>';
                $action = '<div class="row text-center">'.$delete.'</div>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function form(){
        return view('pages/customer/form');
    }
    public function get_location(Request $request){
        $data_location = DB::table('location')->where('location_name' , 'like' , '%'.$request->q.'%')->get();
        return response()->json($data_location, 200);
    }
    public function save(Request $request){
        $this->validate($request,[
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'location_id' => 'required',
        ]);
        DB::table('customers')->insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'location_id' => $request->location_id,
        ]);
        return response()->json(['code' => 1], 200);
    }
    public function delete($id){
        DB::table('customers')->where('customer_id' , '=' , $id)->delete();
        $responses = array('code' => 1 , 'messages' => 'Deleted !');
        echo json_encode($responses , JSON_PRETTY_PRINT);
    }
}

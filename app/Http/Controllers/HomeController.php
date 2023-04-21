<?php

namespace App\Http\Controllers;

use App\Models\Citys;
use App\Models\Couriers;
use App\Models\Provinces;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $province = $this->getProvince();
        $courier = $this->getCourier();
        return view ('home', compact('province', 'courier'));

    }
    public function store(Request $request){
        // dd($request->all());

        $courier = $request->input('courier');

        if ($courier) {
            
            

            $data = [
                'origin' => $this->getCity($request->city_origin),
                'destination' => $this->getCity($request->destination),
                'weight' => 1300,
                'result' => []
            ];

            foreach ($courier as $value) {
                 $cost = RajaOngkir::ongkosKirim([
                    'origin'        => $request->city_origin,     // ID kota/kabupaten asal
                    'destination'   => $request->destination,      // ID kota/kabupaten tujuan
                    'weight'        => $data['weight'],    // berat barang dalam gram
                    'courier'       => $value   // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
                    ])->get();
                    $data['result'][]= $cost;
                }
                // return $result;

                return view('cost')->with($data);
            }

            return redirect()->back();
        }
    public function getCourier(){
        return Couriers::all();
    }
    public function getProvince(){
        return Provinces::pluck('title', 'code');
    }
    public function getCity($code){
        return Citys::where('code', $code)->first();
    }
    public function getCitys($id){
        return Citys::where('province_code', $id)->pluck('title', 'code');
    }
    
   
    public function searchCitys(Request $request){
        $search = $request->search;

        if (empty($search)) {
            $citys = Citys::orderBy('title', 'asc')
            ->select('id', 'title')
            ->limit(5)->get();
        } else {
            $citys = Citys::orderBy('title', 'asc')->
            where('title', 'like', '%'.$search.'%')->
            select('id', 'title')->limit(5)->get();
        }


        $response = [];

        foreach ($citys as $city ) {
            $response[] = [
                'id' => $city->id,
                'text' => $city->title
            ];
        }

        return json_encode($response);
    }
}

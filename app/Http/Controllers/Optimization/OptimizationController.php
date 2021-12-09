<?php

namespace App\Http\Controllers\Optimization;

use App\Http\Controllers\Controller;
use App\Models\Optimization;
use App\Repositories\OptimizationRepository;
use Illuminate\Http\Request;

class OptimizationController extends Controller
{
    protected $optimizationRepository;

    public function __construct()
    {
        $this->optimizationRepository = app(OptimizationRepository::class);
    }

    public function index(){
        return view('optimization.index');
    }

    public function calculate(Request $request){
        $data = $request->input();

        $item = new \stdClass();
        $item->D = (float)$data['D'];
        $item->K = (float)$data['K'];
        $item->L = (float)$data['L'];
        $item->q = (float)$data['q'];
        $item->c1 = (float)$data['c1'];
        $item->c2 = (float)$data['c2'];
        $item->h = (float)$data['h'];

        $item->Ym = (float)$this->optimizationRepository
            ->Ym($item->K, $item->D, $item->h );
        $item->Q = (float)$this->optimizationRepository
            ->Q($item->K, $item->D, $item->h, $item->c1, $item->c2);
        $item->y = (float)$this->optimizationRepository
            ->y($item->Ym, $item->Q, $item->q);
        $item->result = (float)$this->optimizationRepository
            ->result($item->D, $item->y, $item->L);

//        dd($item);

        return view('optimization.calculate', compact('item'));
    }
}

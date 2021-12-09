<?php

namespace App\Repositories;

use App\Models\User;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class OptimizationRepository.
 */
class OptimizationRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @param $K
     * @param $D
     * @param $h
     * @return float
     */
    public function Ym($K, $D, $h){
        return sqrt((2*$K*$D)/$h);
    }

    public function TCU_1_byYm($K, $D, $h, $c1){
        return $D * $c1 + (($K * $D)/ $this->Ym($K, $D, $h)) + ($h/2) * $this->Ym($K,$D, $h);
    }

    public function Q($K, $D, $h, $c1, $c2){
        $d = pow(($this->TCU_1_byYm($K, $D, $h, $c1) -($D*$c2)),2) - 4*($h/2)*($K*$D);

        $Q1 = ($this->TCU_1_byYm($K, $D, $h, $c1) -($D*$c2) - sqrt($d))/$h;

        $Q2 = ($this->TCU_1_byYm($K, $D, $h, $c1) -($D*$c2) + sqrt($d))/$h;

        return max($Q1, $Q2);
    }

    public function y($Ym, $Q, $q){

        if($q<$Ym){
            return $Ym;
        }
        elseif (($Ym <= $q )&& ($q <= $Q)){
            return $q;
        }
        elseif ($q >= $Q){
            return $Ym;
        }
    }

    function t0($D, $y){
        return $y/$D;
    }

    function Le($D, $y, $L)
    {
        if ($this->t0($D, $y) >= $L) {
            return $L;
        } else {
            $n = $L / $this->t0($D, $y);
            return $L - (floor($n) * $this->t0($D, $y));
        }
    }

    function result($D, $y, $L){
        return $this->Le($D, $y, $L) * $D;
    }
}

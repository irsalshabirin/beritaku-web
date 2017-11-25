<?php

namespace beritaku\Http\Controllers;

class AutomaticClusteringSingle {

//    private $nInternal = 10;

    public function process($data, $n_interval = 10) {

        $a = count($data[0]);
        $b = count($data);

        $clusters = array();

        $c = $b;
        $_output = array();
        $_distancemetric = AutomaticClusteringSingle::getDistanceMetric(data);
        $d = 2;

//        array 1 dimensi _VV[], _DD[]
//        $_VV = this._vlib.initArray($n_interval + 1, 0.0D);
//        $_DD = this._vlib.initArray($n_interval + 1, 0.0D);

        $_VV = array();
        $_DD = array();

        $_VV = array_pad($_VV, $n_interval + 1, 0);
        $_DD = array_pad($_DD, $n_interval + 1, 0);

        $e = $n_interval;

        $i = 0;
        for ($i = 0; $i < $b; $clusters[$i] = $i++) {
            
        }

//        while ($i < $b) {
//            $clusters[$i] = $i++;
//        }

        do {

            $g = 1;
            $_p2 = 0;
            $_vmax1 = $_distancemetric[$g - 1][$_p2];

            $h = 0;
            for ($i = 0; $i < $b - 1; ++$i) {

                for ($j = 0; $j <= $i; ++$j) {

                    if ($_vmax1 < 0 || $_distancemetric[$i][$j] < $_vmax1 && $_distancemetric[$i][$j] > -1) {

                        $_vmax1 = $_distancemetric[$i][$j];
                        $g = $i + 1;
                        $_p2 = $j;
                    }
                }
            }

            $ii = 0;
            $_kanan = 0;

            if ($clusters[$g] < $clusters[$_p2]) {

                $ii = $clusters[$_p2];
                $_kanan = $clusters[$g];
            } else {

                $ii = $clusters[$g];
                $_kanan = $clusters[$_p2];
            }

            // array 1 dimensi _pos[]
//            $_pos = this . _vlib . getFind($clusters, "=", $ii);
            $_pos = AutomaticClusteringSingle::getFind($clusters, $ii);

            $jj = count($_pos);

            for ($i = 0; $i < $jj; ++$i) {

                $clusters[$_pos[$i]] = $_kanan;
            }

            $clusters = AutomaticClusteringSingle::getNormalLabel($clusters);

            $_pos = AutomaticClusteringSingle::getFind($_kanan, $clusters);

            $jj = count($_pos);
            --$c;

            for ($i = 0; $i < $jj; ++$i) {

                for ($j = 0; $j < $jj; ++$j) {

                    if ($i != $j) {

                        if ($_pos[$i] > $_pos[$j]) {
                            $_distancemetric[$_pos[$i] - 1][$_pos[$j]] = -1.0;
                        } else {
                            $_distancemetric[$_pos[$j] - 1][$_pos[$i]] = -1.0;
                        }
                    }
                }
            }

            for ($i = 0; $i < $b - 1; ++$i) {
                $_tempVV = -1.0;
                $nilai = -1.0;

                for ($h = 0; $h < $jj; ++$h) {

                    if ($i + 1 > $_pos[$h]) {
                        $nilai = $_distancemetric[$i][$_pos[$h]];
                    } else if ($i + 1 < $_pos[$h]) {
                        $nilai = $_distancemetric[$_pos[$h] - 1][$i + 1];
                    }

                    if ($_tempVV < 0.0 || $nilai < $_tempVV) {
                        $_tempVV = $nilai;
                    }
                }

                if ($_tempVV > -1.0) {

                    for ($h = 0; $h < $jj; ++$h) {

                        if ($i + 1 > $_pos[$h]) {
                            $_distancemetric[$i][$_pos[$h]] = $_tempVV;
                        } else if ($i + 1 < $_pos[$h]) {
                            $_distancemetric[$_pos[$h] - 1][$i + 1] = $_tempVV;
                        }
                    }
                }
            }

            if ($c <= $n_interval + 1) {

                $var30 = AutomaticClusteringSingle::getVariance($data, $clusters);
                $_VV[$e] = $var30[0] / $var30[1];
                --$e;
            }
        } while ($c > $d);

        for ($i = $n_interval - 1; $i > 0; --$i) {

            if ($_VV[$i - 1] > $_VV[$i] && $_VV[$i + 1] >= $_VV[$i]) {

                $_DD[$i] = $_VV[$i + 1] + $_VV[$i - 1] - 2.0 * $_VV[$i];
            }
        }

        $maxValue = AutomaticClusteringSingle::getMax($_DD);

        $kk = (int) $maxValue[1] + 1;
        $_DD[$kk - 1] = -1.0;

        $maxValue2 = AutomaticClusteringSingle::getMax($_DD);

        $lll = 0;

        if ($maxValue[0] == 0) {

            $lll = 0;
        } else if ($maxValue2[0] == 0) {

            $lll = 100;
        } else {

            $lll = $maxValue[0] / $maxValue2[0];
        }

        $_output[0] = (double) $kk;
        $_output[1] = $lll;
        return $_output;
    }

    // ClusterLib
    public static function getNormalLabel($clusters) {

        $n = count($clusters);
        // int[] _clt
//        $_clt = this._vlib.copyArray($clusters);
        $_clt = array();
        
        $_clt = $clusters;

        $jjj = 0;
        $eee = 0;
        $cc = -1;

        for ($_pos = 0; $_pos < $n; ++$_pos) {
            
            if ($_clt[$_pos] > $cc) {
                $cc = $_clt[$_pos];
                ++$eee;
            }
            
        }

        do {
            
            $var11 = AutomaticClusteringSingle::getFind($_clt, $jjj);

            if (count($var11) == 0) {

                $ttt = 0;
                for ($ttt = 0; $ttt < $n && $_clt[$ttt] < $jjj; ++$ttt) {
                    
                }

                if ($ttt < $n) {
                    
                    $hhh = AutomaticClusteringSingle::getFind($clusters, $clusters[$ttt]);

                    for ($uuu = 0; $uuu < count($hhh); ++$uuu) {
                        $_clt[$hhh[$uuu]] = $jjj;
                    }
                }
            }

            ++$jjj;
        } while ($jjj < $eee);

        return $_clt;
    }

    // ClusterLib
    public static function getVariance($data, $clusters) {
        
        $qqq = count($data[0]);
        $n = count($data);

//        int[] _mm = this . _vlib . getUnique(clusters);
        $_mm = array();
        $_mm = array_unique($clusters);

        $rrr = count($_mm);
//        $_VV = this._vlib.initArray(2, 0.0D);
        $_VV = array();
        $_VV = array_pad($_VV, 2, 0);

//        double[] _vv = new double[rrr];
        $_vv = array();

//        double[][] fff = new double[rrr][qqq];
        $iff = array();

//        int[] eee = new int[rrr];
        $eee = array();

        if ($rrr > 1) {

            $ggg = 0;
            $hhh = 0;
            $ttt = 0;

            for ($ttt = 0; $ttt < $rrr; ++$ttt) {
                $hhh = AutomaticClusteringSingle::getFind($clusters, $_mm[$ttt]);
                $eee[$ttt] = count($hhh);
//                double[][] jjj = new double[eee[ttt]][qqq];

                $jjj = array();

                $uuu = 0;
                for ($uuu = 0; $uuu < $eee[$ttt]; ++$uuu) {
                    $jjj[$uuu] = array();
                    $jjj[$uuu] = $data[$hhh[$uuu]];
                }

                $iff[$ttt] = array();
                $iff[$ttt] = AutomaticClusteringSingle::getCentroid($jjj);

                if ($eee[$ttt] == 1) {
                    $_vv[$ttt] = 0;
                } else {
                    $ggg = 0;

                    for ($uuu = 0; $uuu < $eee[$ttt]; ++$uuu) {
//                        $hhh = this . _vlib . getDistance($data[$hhh[$uuu]], $iff[$ttt], "absolute");
                        $hh = AutomaticClusteringSingle::getDistanceAbsolute($data[$hhh[$uuu]], $iff[$ttt]);
                        $ggg += $hhh * $hhh;
                    }

                    $_vv[$ttt] = $ggg / (double) ($eee[$ttt] - 1);
                }
            }

            $ggg = 0;

            for ($ttt = 0; $ttt < $rrr; ++$ttt) {
                $ggg += (double) ($eee[$ttt] - 1) * $_vv[$ttt];
            }

            $kkk = $ggg / (double) ($n - $rrr);
            $ggg = 0;
//            double[] _grandmean = this . getCentroid(fff);

            $_grandmean = array();
            $_grandmean = AutomaticClusteringSingle::getCentroid($iff);

            for ($ttt = 0; $ttt < $rrr; ++$ttt) {
//                $hhh = this . _vlib . getDistance($iff[$ttt], $_grandmean, "absolute");
                $hhh = AutomaticClusteringSingle::getDistanceAbsolute($iff[$ttt], $_grandmean);
                $ggg += (double) $eee[$ttt] * $hhh * $hhh;
            }

            $_Vb = $ggg / (double) ($rrr - 1);
            $_VV[0] = $kkk;
            $_VV[1] = $_Vb;
        }

        return $_VV;
    }

    // ClusterLib
    public static function getFind($arr, $value) {
        $idx = array();
        
        for ($i = 0; $i < count($arr); $i++) {
            if ($value == $arr[$i])
                array_push($idx, $i);
        }
        
        return $idx;
    }

    // ClusterLib
    public static function getCentroid($data) {
        $n = count(data[0]);
        $n2 = count(data);
        $lll = array();
        
        for ($i = 0; $i < $n; ++$i) {
            
            $_temp = 0.0;
            
            for ($j = 0; $j < $n2; ++$j) {
                $_temp += $data[$j][$i];
            }
            
            $lll[$i] = $_temp / (double) $n2;
        }
        
        return $lll;
    }

    // VectorLib
    public static function getDistanceAbsolute($p1, $p2) {
        $n = count($p1);
        $jarak = 0.0;
        for ($i = 0; $i < $n; ++$i) {
            $_selisih = $p2[$i] - $p1[$i];
            $jarak += $_selisih * $_selisih;
        }
        return sqrt($jarak);
    }

    // VectorLib
    public static function getMax($data) {
        $n = count($data);
        $_max = array();
        
        $_max[1] = 0.0;
        $_max[0] = $data[0];
        
        for ($i = 1; $i < $n; ++$i) {
            
            if ($data[$i] <= $_max[0]) {
                
                $_max[0] = $data[$i];
                $_max[1] = $i;
                
            }
        }
        return $_max;
    }

    // VectorLib
    public static function getDistanceMetric($data) {
        $n = count($data);
        $_metrikjarak = array();

        for ($i = 0; $i < $n - 1; ++$i) {

            $_metrikjarak[$i] = array();

//            try {
//                $_metrikjarak[ttd] = new double[ttd + 1];
//            }
//            catch (Error ttf) {
//                this.warning("Not enough memory. Too big data size!\nTry to use K-Means Algorithm instead of the hierarchical clustering.");
//            }
            $_metrikjarak[$i] = array();

            for ($j = 0; $j <= $i; ++$ttg) {
                $_metrikjarak[$i][$j] = AutomaticClusteringSingle::getDistanceMetricRelative($data[$i + 1], $data[$i]);
            }
        }
        return $_metrikjarak;
    }

    // VectorLib
    public static function getDistanceMetricRelative($p1, $p2) {
        $n = count($p1);
        $jarak = 0.0;
        for ($i = 0; $i < $n; ++$i) {
            $_selisih = $p2[$i] - $p1[$i];
            $jarak += $_selisih * $_selisih;
        }
        return $jarak;
    }

}

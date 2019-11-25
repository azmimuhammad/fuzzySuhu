<?php

class Fuzzy
{
    protected $suhuDingin = 0;
    protected $suhuCukup = 0;
    protected $suhuPanas = 0;
    protected $cahayaTeduh = 0;
    protected $cahayaCukup = 0;
    protected $cahayaSgtTerang = 0;
    protected $NkTidakBaik = [];
    protected $NkBaik = [];
    protected $tidakBaikAkhir;
    protected $baikAkhir;
    protected $max_output = 100;
    protected $min_output = 0;
    protected $crispOutput;

    public function Suhu($inputSuhu)
    {
        // Keanggotaan Linguistik Suhu Dingin
        if ($inputSuhu <= 10.0) {
            $this->suhuDingin = 1;
        } else {
            if (($inputSuhu > 10) && ($inputSuhu < 15)) {
                $this->suhuDingin = ((-$inputSuhu + 15) / 5);
            } else {
                $this->suhuDingin = 0;
            }
        }

        // Keanggotaan Linguisik Suhu Cukup
        if (($inputSuhu <= 10) || ($inputSuhu >= 35)) {
            $this->suhuCukup = 0;
        } else {
            if (($inputSuhu > 10) && $inputSuhu < 15) {
                $this->suhuCukup = (($inputSuhu - 10) / 5);
            } else {
                if (($inputSuhu > 30) && $inputSuhu < 35) {
                    $this->suhuCukup = ((-$inputSuhu + 35) / 5);
                } else {
                    $this->suhuCukup = 1;
                }
            }
        }

        // Keanggotaan linguisik Suhu Panas
        if ($inputSuhu <= 30) {
            $this->suhuPanas = 0;
        } else {
            if (($inputSuhu > 30) && $inputSuhu > 35) {
                $this->suhuPanas = (($inputSuhu - 30) / 5);
            } else {
                $this->suhuPanas = 1;
            }
        }
    }

    public function intCahaya($inputIntCahaya)
    {
        // keanggotaan linguisik Intensitas Cahaya Teduh
        if ($inputIntCahaya <= 2000) {
            $this->cahayaTeduh = 1;
        } else {
            if ($inputIntCahaya < 3000) {
                $this->cahayaTeduh = ((- $inputIntCahaya + 3000) / 1000);
            } else {
                $this->cahayaTeduh = 0;
            }
        }

        // Keanggotaan linguisik Intensitas Cahaya Cukup Terang
        if (($inputIntCahaya >= 3000) && ($inputIntCahaya <= 5000)) {
            $this->cahayaCukup = 1;
        } else {
            if ($inputIntCahaya < 3000) {
                $this->cahayaCukup = (($inputIntCahaya - 2000) / 1000);
            } else {
                if (($inputIntCahaya > 5000) && $inputIntCahaya < 6000) {
                    $this->cahayaCukup = ((-$inputIntCahaya + 6000) / 1000);
                } else {
                    $this->cahayaCukup = 0;
                }
            }
        }

        // Keanggotaan linguisik Intensitas Cahaya Sangat Terang
        if ($inputIntCahaya >= 6000) {
            $this->cahayaSgtTerang = 1;
        } else {
            if (($inputIntCahaya > 5000) && $inputIntCahaya < 6000) {
                $this->cahayaSgtTerang = (($inputIntCahaya - 5000) / 1000);
            } else {
                $this->cahayaSgtTerang = 0;
            }
        }
    }

    public function Fuzzifikasi()
    { ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Keanggotaan Suhu : <br></h3>
            </div>
            <div class="panel-body">
                <?php
                    echo "Dingin : " . $this->suhuDingin . "<br>";
                    echo "Cukup : " . $this->suhuCukup . "<br>";
                    echo "Panas : " . $this->suhuPanas . "<br>";
                ?>
            </div>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Keanggotaan Intensitas Cahaya : <br></h3>
            </div>
            <div class="panel-body">
                <?php
                    
        echo "Teduh : " . $this->cahayaTeduh . "<br>";
        echo "Cukup Terang : " . $this->cahayaCukup . "<br>";
        echo "Sangat Terang : " . $this->cahayaSgtTerang . "<br>";
                ?>
            </div>
        </div>
        
    <?php }

    public function min($x, $y)
    {
        if ($x < $y) {
            return $x;
        } else {
            return $y;
        }
    }

    public function max($x, $y)
    {
        if ($x > $y) {
            return $x;
        } else {
            return $y;
        }
    }

    public function maxArray($x, $n)
    {
        $max = 0;
        for ($i=0; $i < $n ; $i++) { 
            if ($x[$i] > $max) {
                $max = $x[$i];
            }
        }
        return $max;
    }

    public function inferensi()
    {
        $i = 0; 
        $j = 0;
        if ($this->suhuDingin != 0 && $this->cahayaTeduh != 0) {
            $this->NkTidakBaik[$i] = $this->min($this->suhuDingin, $this->cahayaTeduh);
            echo "Rules 1 --> NK Tidak Baik : " . $this->NkTidakBaik[$i] . "<br>";
            $i++;
        }
        if ($this->suhuDingin != 0 && $this->cahayaCukup != 0) {
            $this->NkBaik[$j] = $this->min($this->suhuDingin, $this->cahayaCukup);
            echo "Rules 2 --> NK Baik : " . $this->NkBaik[$j] . "<br>";
            $j++;
        }
        if ($this->suhuDingin != 0 && $this->cahayaSgtTerang != 0) {
            $this->NkTidakBaik[$i] = $this->min($this->suhuDingin, $this->cahayaSgtTerang);
            echo "Rules 3 --> NK Tidak Baik : " . $this->NkTidakBaik[$i] . "<br>";
            $i++;
        }
        if ($this->suhuCukup != 0 && $this->cahayaTeduh != 0) {
            $this->NkBaik[$i] = $this->min($this->suhuCukup, $this->cahayaTeduh);
            echo "Rules 4 --> NK Baik : " . $this->NkBaik[$j] . "<br>";
            $j++;
        }
        if ($this->suhuCukup != 0 && $this->cahayaCukup != 0) {
            $this->NkBaik[$j] = $this->min($this->suhuCukup, $this->cahayaCukup);
            echo "Rules 5 --> NK Baik : " . $this->NkBaik[$j] . "<br>";
            $j++;
        }
        if ($this->suhuCukup != 0 && $this->cahayaSgtTerang != 0) {
            $this->NkTidakBaik[$i] = $this->min($this->suhuCukup, $this->cahayaSgtTerang);
            echo "Rules 6 --> NK Tidak Baik : " . $this->NkTidakBaik[$i] . "<br>";
            $i++;
        }
        if ($this->suhuPanas != 0 && $this->cahayaTeduh != 0) {
            $this->NkTidakBaik[$i] = $this->min($this->suhuPanas, $this->cahayaTeduh);
            echo "Rules 7 --> NK Tidak Baik : " . $this->NkTidakBaik[$i] . "<br>";
            $i++;
        }
        if ($this->suhuPanas != 0 && $this->cahayaCukup != 0) {
            $this->NkTidakBaik[$i] = $this->min($this->suhuPanas, $this->cahayaCukup);
            echo "Rules 8 --> NK Tidak Baik : " . $this->NkTidakBaik[$i] . "<br>";
            $i++;
        }
        if ($this->suhuPanas != 0 && $this->cahayaSgtTerang != 0) {
            $this->NkTidakBaik[$i] = $this->min($this->suhuPanas, $this->cahayaSgtTerang);
            echo "Rules 9 --> NK Tidak Baik : " . $this->NkTidakBaik[$i] . "<br>";
            $i++;
        }

        if ($i == 0) {
            $this->tidakBaikAkhir = 0;
        } else {
            $this->tidakBaikAkhir = $this->maxArray($this->NkTidakBaik, $i);
        }
        // dump($this->NkBaik);exit;
        if ($j == 0) {
            $this->baikAkhir = 0;
        } else {
            $this->baikAkhir = $this->maxArray($this->NkBaik, $j);
        }

        echo "<br>" . "Hasil Akhir Inferensi : " . "<br>";
        echo "NK Tidak Baik : " . $this->tidakBaikAkhir . "<br>";
        echo "NK Baik : " . $this->baikAkhir . "<hr>";
    }
        
    public function valNkTidakBaik($x)
    {
        if ($x <= 40) {
            return 1;
        } else {
            if ($x <= 60) {
                return ((-$x + 60) / 20);
            } else {
                return 0;
            }
        }
    }

    public function valNkBaik($x)
    {
        if ($x <= 40) {
            return 0;
        } else {
            if ($x <= 60) {
                return (($x - 40) / 20);
            } else {
                return 1;
            }
        }
    }

    public function def_Cen($sampel)
    {
        $t = ($this->max_output - $this->min_output) / $sampel;
        $pengali_tidakBaik = $pengali_Baik = $pengali_others = $others = $pengali = $sampels = [];
        $valNkTidakBaik = $valNkBaik = '';
        $i = 0;
        $sumX = 0;
        $crisp_val = 0;
        $x = $this->min_output;
        $iTidakBaik = $iBaik = $iOthers = 0;
        for ($i=0; $i < $sampel; $i++) { 
            $x = $x + $t;
            $sampels[$i] = $x;
            $valNkTidakBaik = $this->valNkTidakBaik($x);
            $valNkBaik = $this->valNkBaik($x);
            if ($valNkTidakBaik > $this->tidakBaikAkhir) {
                $valNkTidakBaik = $this->tidakBaikAkhir;
            }
            if ($valNkBaik > $this->baikAkhir) {
                $valNkBaik = $this->baikAkhir;
            }
            $pengali[$i] = $this->max($valNkTidakBaik, $valNkBaik);
            if ($pengali[$i] == $this->tidakBaikAkhir) {
                $pengali_tidakBaik[$iTidakBaik] = $x;
                $iTidakBaik++;
            } else {
                if ($pengali[$i] == $this->baikAkhir) {
                    $pengali_Baik[$iBaik] = $x;
                    $iBaik++;
                } else {
                    $pengali_others[$iOthers] = $x;
                    $others[$iOthers] = $pengali[$i];
                    $iOthers++;
                }
            }
            $crisp_val = $crisp_val + $x * $pengali[$i];
            $sumX = $sumX + $pengali[$i];
        }
        $this->crispOutput = $crisp_val / $sumX;

        ?>
        <!-- // cetak perhitungan centroid method -->
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Perhitungan centroid method</h3>
            </div>
            <div class="panel-body">
                <?php echo "Y* = " . $this->crispOutput; ?>
            </div>
        </div>
        
    <?php }
}
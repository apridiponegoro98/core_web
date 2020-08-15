
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class raita extends CI_Model
{

    public $n, $y, $yy, $m, $x, $xx, $BmBc, $matches = false;
    public $firstCh, $middleCh, $lastCh, $secondCh;
    public $STEP = [];


    public function search($yy, $xx)
    {
        $this->matches = false;
        $this->setText($yy);
        var_dump("tes");
        $this->setPattern($xx);
        $this->raitasearch();

        return array(
            'step' => $this->STEP,
            "result" => $this->raitasearch()
        );
    }
    // search("aco","vvvv");
    public function setText($yy)
    {
        //mengambil panjang text uji
        $this->n = strlen($yy); //mengambil setiap karakter text uji
        $this->y = str_split($yy);

        $this->STEP[] = "menset text";
    }
    public function setPattern($xx)
    {
        //mengambil panjang text input user
        $this->m = strlen($xx); //mengambil setiap karakter text input user
        $this->x = str_split($xx); //memanggil fungsi preprocess
        $this->raitaPreprocess();

        $this->firstCh = $this->x[0]; //
        //$this->secondCh = $this->x + 1;
        $this->middleCh = $this->x[$this->m / 2];
        $this->lastCh = $this->x[$this->m - 1];
    }
    public function raitaPreprocess()
    {
        //memasukan panjang dari text input user dari 0 sampai 256 ke dalam array
        //sebagai bmbc
        for ($i = 0; $i < 256; $i++) {
            $this->BmBc[$i] = $this->m;
        }
        //fungsi ord mengambil nilai tabel ascii, jadi angka m-1i disisipkan kedalam 0-256
        //sesuai dengan tabel ascii
        for ($i = 0; $i < $this->m - 1; $i++) {
            $this->BmBc[ord($this->x[$i])] = $this->m - 1 - $i;
        }
    }

    public function raitasearch()
    {
        $k = 0;
        while ($k <= $this->n - $this->m) {
            $c = $this->y[$k + $this->m - 1];
            if ($this->lastCh == $c && $this->firstCh == $this->y[$k] && $this->middleCh == $this->y[$k + $this->m / 2] && strcmp(substr($this->yy, $k, $this->m), $this->xx) == 0) {
                $this->matches = true;
                 // $DITEMUKAN=true;
                // $this->STEP[] = "<b>Dapat</b>";
                // $this->STEP[] = "Pada index =" . $k;
                break;
            } else {
                $k += $this->BmBc[ord($c)];
            }
        }
    }
    public function report()
    {
        return $this->matches;
    }
}

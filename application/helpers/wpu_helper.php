<?php

class raita
{
    private  $n, $y, $setT, $m, $x, $setP, $BmBc, $matches = false;
    private $firstCh, $middleCh, $lastCh, $secondCh;
    public $STEP = [];
    public $cd;
    public $start, $Rtime = 0;

    public function search($setT, $setP)
    {
        $this->start = microtime(true);
        $this->matches = false;
        $this->setText($setT);
        $this->setPattern($setP);
        $this->raitasearch();
        return $this->STEP;
    }
    private function setText($setT)
    {
        $this->STEP[] = "Menset text " . $setT;
        //mengambil panjang text uji
        $this->n = strlen($setT); //mengambil setiap karakter text uji
        $this->y = str_split($setT);
    }
    private function setPattern($setP)
    {
        $this->STEP[] = "Pattern : " . $setP;
        //mengambil panjang text input user
        $this->m = strlen($setP); //mengambil setiap karakter text input user
        $this->x = str_split($setP); //memanggil fungsi preprocess
        $this->raitaPreprocess();

        $this->firstCh = $this->x[0]; //
        //$this->secondCh = $this->x + 1;
        $this->middleCh = $this->x[$this->m / 2];
        $this->lastCh = $this->x[$this->m - 1];
    }

    private function raitaPreprocess()
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

    private function raitasearch()
    {
        $k = 0;
        $jum1 = 0;
        $jum2 = 0;
        $i = 0;
        $total = 0;
        while ($k <= $this->n - $this->m) {
            $c = $this->y[$k + $this->m - 1];
            if ($this->lastCh == $c && $this->firstCh == $this->y[$k] && $this->middleCh == $this->y[$k + $this->m / 2] && strcmp(substr($this->setT, $k, $this->m), $this->setP) == 0) {
                $this->matches = true;
                $this->STEP[] = number_format((float) microtime(true) -  (float) $this->start, 10) . "ms";
                break;
            } else {
                // $this->matches = false;
                $k += $this->BmBc[ord($c)];
                $jum2 = $jum2 + $i;
            }
            $i++;
            $jum1 = $jum1 + $i;
            $total++;
        }
        // if (!$this->matches) {
        if (!$this->matches) {
            $this->STEP[] = number_format((float) microtime(true) -  (float) $this->start, 10) . "ms";
        }
        $total = $jum1 + $jum2;
        // $this    ->STEP[] = $total . " total";
    }
    public function report()
    {
        return $this->matches;
    }

    public function fastData($cd)
    {

        // $this->STEP[] = "Dapat pada index =" . $k;   
    }
}

function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);
        $menu2 = $ci->uri->segment(2);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];
        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);
        if ($userAccess->num_rows() < 1) {

            redirect('auth/blocked');
            // }
        } else {
            // echo "anda lolos cuk";
        }

        // if ($userAccess->num_rows()) {
        // }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);

    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}


// function raita(tes){
//     $text = $this->data_pbl[]['kata'].tolowercase().replace();;
//     $pattern = tes.tolowercase().split('');
//     $index =  $pattern.length-1;
//     $BmBc = [];
//     $Bm = [];
//     $bc = [];
//     for($i=0; $i< $pattern.length ; $i++){
//         $bcx = $pattern[$i];
//         $bmx = $pattern.lenght-$i-1;

//         if($bmx == 0){
//             $bmx= $pattern.length;
//         }
//             $BmBc.push('bc' : $bcx, 'bm' : $bmx);
//             $Bm.push($bmx);
//             $Bm.push($bcx);      
//     }

//     $jump = 0;
//     while($index<$text.lenght){
//         $check = 0;
        
//         if($BmBc[Object.keys($BmBc)[Object.keys(bmbc).lenght-1]])
//     }

// }
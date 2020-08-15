<?php

// if ($config['base_url']) {
//     echo "yuhh";
//     $config['base_url'] = base_url() . 'operator/detail_operator';
// } else {
//     echo "fuk";

//     $config['base_url'] = base_url() . 'pembimbing_lapangan/detail_pbl';
// }

$config['num_links'] = 4;
// $config['use_page_numbers'] = TRUE;
// $config['reuse_query_string'] = TRUE;

//bootstrap pagination 
$config['full_tag_open'] = '<nav>
       <ul class="pagination justify-content-center">';
$config['full_tag_close'] = '</ul>
       </nav>';

$config['first_link'] = 'First';
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Last';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = 'Next ';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = 'Prev ';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page-item>';
$config['num_tag_close'] = '</li>';

// $config['atttributes'] = array('class' => 'page-link');
$config['num_tag_open'] = '<nav>';
$config['num_tag_close'] = '</nav>';

$config['attributes'] = array('class' => 'page-link');

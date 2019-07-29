<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delay_check_admin extends Admin_Controller 
{
    // this class using for administrator not user/public on admin
    // can access by admin
    public function __construct()
    {
        parent::__construct();
	
        $this->load->model(array('airlines_model', 'airports_model', 'flight_model', 'data_model', 'laporan_model'));
        $this->load->library(array('template', 'form_validation'));
        // $this->load->library('database');
        $this->load->helper(array('adminlte_helper','language','url', 'form'));

        // load ion auth
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        $this->lang->load('auth');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        // users can access by admin
        if(!$this->ion_auth->logged_in() or !$this->ion_auth->in_group(['1', '2','3', '5']))
        {
             redirect('auth', 'refresh');
        }
    }

    public function index()
	{   
        $this->load->library('datatables');
        $data['page_title'] = 'Delay Check';
        $data['page_description'] = '';

        if(!empty($_GET)){
            $_GET['schedule_time'] = !empty($_GET['schedule_time']) ? date('H:i:s', strtotime($_GET['schedule_time'])) : '';
            $_GET['tanggal'] = !empty($_GET['due_date']) ? date('Y-m-d H:i:s', strtotime($_GET['due_date'])) : ''; 
            $this->mining_c45();
            $data['dt_users'] = $this->data_model->_read($_GET);

        }else{
            // $this->miningC45('', '');
            $data['dt_users'] = [];

        }
        $data['message'] = $this->session->flashdata('message');
        $data['airlines'] = $this->airlines_model->_list();
        $data['airports'] = $this->airports_model->_list();
        $data['flights'] = $this->flight_model->_list();
        $this->template->_set_css2('admin', 'header', 'select2.css','https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css', TRUE)
                    ->_set_js('admin','footer','select2.full.js','https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js', TRUE)
                    ->_set_css('admin','dataTables.bootstrap.min.css','adminlte/bower_components/datatables.net-bs/css')
                    ->_set_js('admin','footer','jquery.dataTables.min.js','adminlte/bower_components/datatables.net/js')
                    ->_set_js('admin','footer','dataTables.bootstrap.min.js','adminlte/bower_components/datatables.net-bs/js')
                    // ->_set_js('admin','footer','serverside.dataTables.js','adminlte/script')
                    ->_set_js('admin','footer','htmldom.dataTables.js','adminlte/script')
                    ->_set_js('admin','footer','dataTables.buttons.min.js','https://cdn.datatables.net/buttons/1.5.2/js', TRUE)
                    ->_set_js('admin','footer','buttons.flash.min.js','https://cdn.datatables.net/buttons/1.5.2/js', TRUE)
                    ->_set_js('admin','footer','jszip.min.js','https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3', TRUE)
                    ->_set_js('admin','fopdfmake.min.js','https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36', TRUE)
                    ->_set_js('admin','footer','vfs_fonts.js','https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36', TRUE)
                    ->_set_js('admin','footer','buttons.html5.min.js','https://cdn.datatables.net/buttons/1.5.2/js', TRUE)
                    ->_set_js('admin','footer','buttons.print.min.js','https://cdn.datatables.net/buttons/1.5.2/js', TRUE)
                    ->_render_admin('index_delay_check_admin', $data);
    }

    public function mining_c45()
    {
        $this->laporan_model->populateDB();
        $this->miningC45('airlines', 'GARUDA');
        // $this->session->set_flashdata('message', 'Sukses melakukan proses mining');
        // redirect('admin'. DIRECTORY_SEPARATOR .'laporan/perhitungan', 'refresh');


    }

    public function miningC45($atribut, $nilai_atribut)
    {            
        $this->perhitunganC45($atribut, $nilai_atribut);
        $this->getInfGainMax($atribut, $nilai_atribut);
        $this->replaceNull();
    }

    public function perhitunganC45($atribut, $nilai_atribut) 
    {
        if (empty($atribut) AND empty($nilai_atribut)) {
            //#2# Jika atribut yg diinputkan kosong, maka lakukan perhitungan awal
            $kondisiAtribut = ""; // set kondisi atribut kosong
        } else if (!empty($atribut) AND !empty($nilai_atribut)) { 
            // jika atribut tdk kosong, maka select kondisi atribut dari DB
            $sqlKondisiAtribut = $this->laporan_model->select_attribute($atribut, $nilai_atribut);
            $kondisiAtribut = str_replace("~", "'", $sqlKondisiAtribut['kondisi_atribut']); // replace string ~ menjadi '
        } 

        // ambil seluruh atribut
        $sqlAtribut = $this->laporan_model->select_attribute_from_attr();
        foreach($sqlAtribut as $key => $rowAtribut) {
            $getAtribut = $rowAtribut['attribute'];
            if ($getAtribut === 'total') { 
                //#3# Jika atribut = total, maka hitung jumlah kasus total, jumlah kasus delay dan jumlah kasus tdk delay
                // hitung jumlah kasus total
                $sqlJumlahKasusTotal = $this->laporan_model->getTotalData($kondisiAtribut);
                $getJumlahKasusTotal = $sqlJumlahKasusTotal->jumlah_total;

                // hitung jumlah kasus delay
                // $sqlJumlahKasusLayak = mysql_query("SELECT COUNT(*) as jumlah_layak FROM data_survey WHERE status = 'Laris' AND status is not null $kondisiAtribut");
                $sqlJumlahKasusDelay = $this->laporan_model->getTotalDelay($kondisiAtribut);
                $getJumlahKasusDelay = $sqlJumlahKasusDelay->jumlah_delay;

                // hitung jumlah kasus tdk layak
                // $sqlJumlahKasusTidakLayak = mysql_query("SELECT COUNT(*) as jumlah_tidak_layak FROM data_survey WHERE status = 'Tidak Laris' AND status is not null $kondisiAtribut");
                $sqlJumlahKasusTidakDelay = $this->laporan_model->getTotalOnSchedule($kondisiAtribut);
                $getJumlahKasusTidakDelay = $sqlJumlahKasusTidakDelay->jumlah_tidak_delay;

                //#4# Insert jumlah kasus total, jumlah kasus layak dan jumlah kasus tdk layak ke DB
                // insert ke database mining_c45
                $this->laporan_model->insert_mining_c45(array('atribut' => 'total', 'nilai_atribut' => 'total', 'jml_kasus_total' => $getJumlahKasusTotal, 'jml_delay' => $getJumlahKasusDelay, 'jml_tdk_delay' => $getJumlahKasusTidakDelay, 'entropy' => '','inf_gain' => '', 'inf_gain_temp' => '', 'split_info' => '', 'split_info_temp' => '','gain_ratio' => ''));
                // mysql_query("INSERT INTO mining_c45 VALUES ('', 'Total', 'Total', '$getJumlahKasusTotal', '$getJumlahKasusDelay', '$getJumlahKasusTidakDelay', '', '', '', '', '', '')");

            } else {
                //#5# Jika atribut != total (atribut lainnya), maka hitung jumlah kasus total, jumlah kasus layak dan jumlah kasus tdk layak masing2 atribut
                // ambil nilai atribut

                // $sqlNilaiAtribut = mysql_query("SELECT nilai_atribut FROM atribut WHERE atribut = '$getAtribut' ORDER BY id");
                $sqlNilaiAtribut = $this->laporan_model->getNilaiAttribute($getAtribut);
                foreach($sqlNilaiAtribut as $rowNilaiAtribut) {
                    $getNilaiAtribut = $rowNilaiAtribut['nilai_attribute'];
                    if($getAtribut == 'delay'){
                        $getAtribut = 'status';
                    }
                    // set kondisi dimana nilai_atribut = berdasakan masing2 atribut dan status data = data training
                    $kondisi = "$getAtribut = '$getNilaiAtribut' AND status is not null $kondisiAtribut";

                    // hitung jumlah kasus per atribut
                    $sqlJumlahKasusTotalAtribut = $this->laporan_model->getTotalData($kondisi);
                    $getJumlahKasusTotalAtribut = $sqlJumlahKasusTotalAtribut->jumlah_total;

                    // hitung jumlah kasus delay
                    $sqlJumlahKasusLayakAtribut = $this->laporan_model->getTotalDelay($kondisi);
                    $getJumlahKasusLayakAtribut = $sqlJumlahKasusLayakAtribut->jumlah_delay;

                    // hitung jumlah kasus TDK delay
                    $sqlJumlahKasusTidakLayakAtribut = $this->laporan_model->getTotalOnSchedule($kondisi);
                    $getJumlahKasusTidakLayakAtribut = $sqlJumlahKasusTidakLayakAtribut->jumlah_tidak_delay;

                    //#6# Insert jumlah kasus total, jumlah kasus layak dan jumlah kasus tdk layak masing2 atribut ke DB
                    // insert ke database mining_c45
                    $this->laporan_model->insert_mining_c45(array('atribut' => "$getAtribut", 'nilai_atribut' => "$getNilaiAtribut", 'jml_kasus_total' => $getJumlahKasusTotalAtribut, 'jml_delay' => $getJumlahKasusLayakAtribut, 'jml_tdk_delay' => $getJumlahKasusTidakLayakAtribut, 'entropy' => '','inf_gain' => '', 'inf_gain_temp' => '', 'split_info' => '', 'split_info_temp' => '','gain_ratio' => ''));


                    //#7# Lakukan perhitungan entropy
                    // perhitungan entropy
                    $sqlEntropy = $this->laporan_model->select_entropy();
                    foreach($sqlEntropy as $rowEntropy) {
                        $getJumlahKasusTotalEntropy = $rowEntropy['jml_kasus_total'];
                        $getJumlahKasusLayakEntropy = $rowEntropy['jml_delay'];
                        $getJumlahKasusTidakLayakEntropy = $rowEntropy['jml_tdk_delay'];
                        $idEntropy = $rowEntropy['id'];

                        // jika jml kasus = 0 maka entropy = 0
                        if ($getJumlahKasusTotalEntropy == 0 OR $getJumlahKasusLayakEntropy == 0 OR $getJumlahKasusTidakLayakEntropy == 0) {
                            $getEntropy = 0;
                        // jika jml kasus layak = jml kasus tdk layak, maka entropy = 1
                        } else if ($getJumlahKasusLayakEntropy == $getJumlahKasusTidakLayakEntropy) {
                            $getEntropy = 1;
                        } else { // jika jml kasus != 0, maka hitung rumus entropy:
                            $perbandingan_layak = $getJumlahKasusLayakEntropy / $getJumlahKasusTotalEntropy;
                            $perbandingan_tidak_layak = $getJumlahKasusTidakLayakEntropy / $getJumlahKasusTotalEntropy;

                            $rumusEntropy = (-($perbandingan_layak) * log($perbandingan_layak,2)) + (-($perbandingan_tidak_layak) * log($perbandingan_tidak_layak,2));
                            $getEntropy = round($rumusEntropy,4); // 4 angka di belakang koma
                        }

                        //#8# Update nilai entropy
                        // update nilai entropy
                        $data = array('entropy' => "$getEntropy");
                        $this->laporan_model->update_entropy($idEntropy, $data);
                    }
                    
                    //#9# Lakukan perhitungan information gain
                    // perhitungan information gain
                    // ambil nilai entropy dari total (jumlah kasus total)
                    // $sqlJumlahKasusTotalInfGain = mysql_query("SELECT jml_kasus_total, entropy FROM mining_c45 WHERE atribut = 'Total'");
                    $sqlJumlahKasusTotalInfGain = $this->laporan_model->getInfGain();
                    $getJumlahKasusTotalInfGain = $sqlJumlahKasusTotalInfGain ? $sqlJumlahKasusTotalInfGain[0]['jml_kasus_total'] : 0;
                    // rumus information gain
                    $getInfGain = (-(($getJumlahKasusTotalEntropy / $getJumlahKasusTotalInfGain) * ($getEntropy))); 

                    //#10# Update information gain tiap nilai atribut (temporary)
                    // update inf_gain_temp (utk mencari nilai masing2 atribut)
                    $data = array('inf_gain_temp' => $getInfGain);
                    $this->laporan_model->updateInfGain($idEntropy, $data);
                    $getEntropy = $sqlJumlahKasusTotalInfGain[0]['entropy'];

                    // jumlahkan masing2 inf_gain_temp atribut 

                    // $sqlAtributInfGain = mysql_query("SELECT SUM(inf_gain_temp) as inf_gain FROM mining_c45 WHERE atribut = '$getAtribut'");
                    $sqlAtributInfGain = $this->laporan_model->sum_inf_gain_temp($getAtribut);
                    foreach ($sqlAtributInfGain as $key => $rowAtributInfGain) {
                        $getAtributInfGain = $rowAtributInfGain['inf_gain'];

                        // hitung inf gain
                        $getInfGainFix = round(($getEntropy + $getAtributInfGain),4);

                        //#11# Looping perhitungan information gain, sehingga mendapatkan information gain tiap atribut. Update information gain
                        // update inf_gain (fix)
                        $data = array('inf_gain' => "$getInfGainFix");
                        $this->laporan_model->update_inf_gain($getAtribut, $data);
                    }
                    
                    //#12# Lakukan perhitungan split info
                    // rumus split info
                    $getSplitInfo = (($getJumlahKasusTotalEntropy / $getJumlahKasusTotalInfGain) * (log(($getJumlahKasusTotalEntropy / $getJumlahKasusTotalInfGain),2)));
                    
                    //#13# Update split info tiap nilai atribut (temporary)
                    // update split_info_temp (utk mencari nilai masing2 atribut)
                    $data = array('split_info_temp' => "$getSplitInfo");
                    $this->laporan_model->update_split_info_temp($idEntropy, $data);

                    // jumlahkan masing2 split_info_temp dari tiap atribut 


                    // $sqlAtributSplitInfo = mysql_query("SELECT SUM(split_info_temp) as split_info FROM mining_c45 WHERE atribut = '$getAtribut'");
                    $sqlAtributSplitInfo = $this->laporan_model->sum_split_info_temp($getAtribut);
                    foreach ($sqlAtributSplitInfo as $key => $rowAtributSplitInfo) {
                        $getAtributSplitInfo = $rowAtributSplitInfo['split_info'];

                        // split info fix (4 angka di belakang koma)
                        $getSplitInfoFix = -(round($getAtributSplitInfo,4));
                        //#14# Looping perhitungan split info, sehingga mendapatkan information gain tiap atribut. Update information gain
                        // update split info (fix)
                        $data = array('split_info' => "$getSplitInfoFix");
                        $this->laporan_model->update_split_info($getAtribut, $data);
                    }
                }
                
                 //#15# Lakukan perhitungan gain ratio


                // $sqlGainRatio = mysql_query("SELECT id, inf_gain, split_info FROM mining_c45");
                $sqlGainRatio = $this->laporan_model->hitung_gain_ratio();
                foreach ($sqlGainRatio as $key => $rowGainRatio) {
                    $idGainRatio = $rowGainRatio['id'];
                    // jika nilai inf gain == 0 dan split info == 0, maka gain ratio = 0
                    if ($rowGainRatio['inf_gain'] == 0 AND $rowGainRatio['split_info'] == 0){
                        $getGainRatio = 0;
                    } else {
                        // rumus gain ratio
                        $getGainRatio = round(($rowGainRatio['inf_gain'] / $rowGainRatio['split_info']),4);
                    }
                    
                    //#16# Update gain ratio dari setiap atribut

                    $data = array('gain_ratio' => "$getGainRatio");
                    $this->laporan_model->update_gain_ratio($idGainRatio, $data);
                }
            }
            $this->insertAtributPohonKeputusan($getAtribut, $rowAtribut['nilai_attribute']);

        }
    }

    public function getInfGainMax($atribut, $nilai_atribut)
    {
        // select inf gain max
        $sqlInfGainMaxAtribut = $this->laporan_model->sqlInfGainMaxAtribut();
        if(!is_null($sqlInfGainMaxAtribut)){
            foreach ($sqlInfGainMaxAtribut as $key => $rowInfGainMaxAtribut) {
                $inf_gain_max_atribut = $rowInfGainMaxAtribut['atribut'];
                if (empty($atribut) AND empty($nilai_atribut)) {
                    // jika atribut kosong, proses atribut dgn inf gain max pada fungsi loopingMiningC45()
                    $this->loopingMiningC45($inf_gain_max_atribut);
                } else if (!empty($atribut) AND !empty($nilai_atribut)) {
                    // jika atribut tdk kosong, maka update diproses = sudah pada tabel pohon_keputusan_c45

                    $data = array('diproses' => 'Sudah');
                    $this->laporan_model->update_keputusan_diproses($nilai_atribut, $data);
                    // proses atribut dgn inf gain max pada fungsi loopingMiningC45()
                    $this->loopingMiningC45($inf_gain_max_atribut);
                }
            }            
        }
    }

    public function replaceNull()
    {

        $sqlReplaceNull = $this->laporan_model->sqlReplaceNull();
        if(!is_null($sqlReplaceNull)){
            foreach ($sqlReplaceNull as $key => $rowReplaceNull) {


                // $sqlReplaceNullIdParent = mysql_query("SELECT jml_laris, jml_tdk_laris, keputusan FROM pohon_keputusan_c45 WHERE id = $rowReplaceNull[id_parent]");
                $sqlReplaceNullIdParent = $this->laporan_model->getCountFromKeputusan($rowReplaceNull['id_parent']);
                if ($rowReplaceNullIdParent['jml_laris'] > $rowReplaceNullIdParent['jml_tdk_laris']) {
                    $keputusanNull = 'Laris'; // jika jml_laris != 0 dan jml_tdk_laris = 0, maka keputusan Layak
                } else if ($rowReplaceNullIdParent['jml_laris'] < $rowReplaceNullIdParent['jml_tdk_laris']) {
                    $keputusanNull = 'Tidak Laris'; // jika jml_laris = 0 dan jml_tdk_laris != 0, maka keputusan Tidak Layak
                }

                $data = array('keputusan' => $keputusanNull);
                $this->laporan_model_update_pohon_keputusan($rowReplaceNull['id']);
            }


        }
    }

    public function insertAtributPohonKeputusan($atribut, $nilai_atribut)
    {
        // ambil nilai inf gain tertinggi dimana hanya 1 atribut saja yg dipilih

        // $sqlInfGainMaxTemp = mysql_query("SELECT distinct atribut, gain_ratio FROM mining_c45 WHERE gain_ratio in (SELECT max(gain_ratio) FROM `mining_c45`) LIMIT 1");
        $rowInfGainMaxTemp = $this->laporan_model->get_max_inf_gain();
        // hanya ambil atribut dimana jumlah kasus totalnya tidak kosong
        foreach ($rowInfGainMaxTemp as $key => $rowInfGainMaxTemp) {
            if ($rowInfGainMaxTemp['gain_ratio'] <= 0) {
                // ambil nilai atribut yang memiliki nilai inf gain max
                $sqlInfGainMax = $this->laporan_model->sqlInfGainMax($rowInfGainMaxTemp['atribut']);
                foreach ($sqlInfGainMax as $key => $rowInfGainMax) {
                    if ($rowInfGainMax['jml_delay'] == 0 AND $rowInfGainMax['jml_tdk_delay'] == 0) {
                        $keputusan = 'Kosong'; // jika jml_laris = 0 dan jml_tdk_laris = 0, maka keputusan Null
                    } else if ($rowInfGainMax['jml_delay'] != 0 AND $rowInfGainMax['jml_tdk_delay'] == 0) {
                        $keputusan = 'Delay'; // jika jml_laris != 0 dan jml_tdk_laris = 0, maka keputusan Layak
                    } else if ($rowInfGainMax['jml_delay'] == 0 AND $rowInfGainMax['jml_tdk_delay'] != 0) {
                        $keputusan = 'Tidak Delay'; // jika jml_laris = 0 dan jml_tdk_laris != 0, maka keputusan Tidak Layak
                    } else {
                        $keputusan = '?'; // jika jml_laris != 0 dan jml_tdk_laris != 0, maka keputusan ?
                    }
                    
                    if (empty($atribut) AND empty($nilai_atribut)) {
                        //#18# Jika atribut yang diinput kosong (atribut awal) maka insert ke pohon keputusan id_parent = 0
                        // set kondisi atribut = AND atribut = nilai atribut
                        $att = $rowInfGainMax['atribut'];
                        $nilai = $rowInfGainMax['nilai_atribut'];
                        $kondisiAtribut = "AND " . $att . " = ~ " . $nilai . " ~";
                        // insert ke tabel pohon keputusan
                        $data = array('atribut' => $rowInfGainMax['atribut'], 'nilai_atribut' => $rowInfGainMax['nilai_atribut'], 'id_parent' => 0, 'jml_delay' => $rowInfGainMax['jml_delay'], 'jml_tdk_delay' => $rowInfGainMax['jml_tdk_delay'], 'keputusan' => $keputusan, 'diproses' => 'Belum', 'looping_kondisi' => $kondisiAtribut);
                        $this->laporan_model->insert_pohon($data);
                    }


                    //#19# Jika atribut yang diinput tidak kosong maka insert ke pohon keputusan dimana id_parent diambil dari tabel pohon keputusan sebelumnya (where atribut = atribut yang diinput)
                    else if (!empty($atribut) AND !empty($nilai_atribut)) {
                        // TODO

                        // $sqlIdParent = mysql_query("SELECT id, atribut, nilai_atribut, jml_laris, jml_tdk_laris FROM pohon_keputusan_c45 WHERE atribut = '$atribut' AND nilai_atribut = '$nilai_atribut' order by id DESC LIMIT 1");

                        // insert ke tabel pohon keputusan
                        $data = array('atribut' => $atribut, 'nilai_atribut' => $nilai_atribut, 'id_parent' => $rowInfGainMax['id'], 'jml_delay' => $rowInfGainMax['jml_delay'], 'jml_tdk_delay' => $rowInfGainMax['jml_tdk_delay'], 'keputusan' => $keputusan, 'diproses' => 'Belum', 'looping_kondisi' => '');
                        $this->laporan_model->insert_pohon($data);                        
                        
                        //#PRE PRUNING (dokumentasi -> http://id3-c45.xp3.biz/dokumentasi/Decision-Tree.10.11.ppt)#
                        // hitung Pessimistic error rate parent dan child 
                        $perhitunganParentPrePruning = $this->loopingPerhitunganPrePruning($rowInfGainMax['jml_delay'], $rowInfGainMax['jml_tdk_delay']);
                        $perhitunganChildPrePruning = $this->loopingPerhitunganPrePruning($rowInfGainMax['jml_delay'], $rowInfGainMax['jml_tdk_delay']);
                        
                        // hitung average Pessimistic error rate child 
                        $perhitunganPessimisticChild = (($rowInfGainMax['jml_delay'] + $rowInfGainMax['jml_tdk_delay']) / ($rowInfGainMax['jml_delay'] + $rowInfGainMax['jml_tdk_delay'])) * $perhitunganChildPrePruning;
                        // Increment average Pessimistic error rate child
                        $perhitunganPessimisticChildIncrement = 0;
                        $perhitunganPessimisticChildIncrement += $perhitunganPessimisticChild;
                        $perhitunganPessimisticChildIncrement = round($perhitunganPessimisticChildIncrement, 4);
                        // jika error rate pada child lebih besar dari error rate parent
                        if ($perhitunganPessimisticChildIncrement > $perhitunganParentPrePruning) {
                            // hapus child (child tidak diinginkan)
                            
                            // jika jml kasus layak lbh besar, maka keputusan == layak
                            if ($rowInfGainMax['jml_delay'] > $rowInfGainMax['jml_tdk_delay']) {
                                $keputusanPrePruning = 'Delay';
                            // jika jml tdk kasus layak lbh besar, maka keputusan == tdk layak
                            } else if ($rowInfGainMax['jml_delay'] < $rowInfGainMax['jml_tdk_delay']) {
                                $keputusanPrePruning = 'Tidak Delay';
                            }
                            // update keputusan parent
                            $this->laporan_model->update_keputusan($rowInfGainMax['id'], array('keputusan' => $keputusanPrePruning));

                        }
                    }
                }
            }

        }
        $this->loopingKondisiAtribut();
    }

    public function loopingKondisiAtribut() 
    {
        // ambil semua id dan kondisi atribut

        $sqlLoopingKondisi = $this->laporan_model->select_from_pohon_keputusan();
        foreach ($sqlLoopingKondisi as $key => $rowLoopingKondisi) {
            // select semua data dimana id_parent = id awal
            $sqlUpdateKondisi = $this->laporan_model->select_from_pohon_keputusan_where($rowLoopingKondisi['id']);
            foreach ($sqlUpdateKondisi as $key => $rowUpdateKondisi) {
                // set kondisi: kondisi sebelumnya yg diselect berdasarkan id_parent ditambah 'AND atribut = nilai atribut'
                $nilai_atribut = $rowLoopingKondisi['nilai_atribut'];
                $attribute = $rowUpdateKondisi['atribut'];
                $updated_nilai_kondisi = '~$rowUpdateKondisi["nilai_atribut"]~';
                // update kondisi atribut
                $data = array('kondisi_atribut' => $nilai_atribut . ' AND ' . $attribute . ' = ' . $updated_nilai_kondisi, 'looping_kondisi' => 'Sudah');
                $this->laporan_model->update_looping_attribute($rowUpdateKondisi['id'], $data);
            }
        }
        $this->insertIterasi();
    }

 //#21# Insert iterasi nilai perhitungan ke DB
    public function insertIterasi()
    {

        $sqlInfGainMaxIterasi = $this->laporan_model->sqlInfGainMaxIterasi();
        // hanya ambil atribut dimana jumlah kasus totalnya tidak kosong
        foreach ($sqlInfGainMaxIterasi as $key => $sqlInfGainMaxIterasi) {
            if ($sqlInfGainMaxIterasi->gain_ratio < 0) {
                $kondisiAtribut = $sqlInfGainMaxIterasi->atribut;
                $iterasiKe = 1;

                $sqlInsertIterasiC45 = $this->laporan_model->select_mining();
                foreach ($sqlInsertIterasiC45 as $key => $rowInsertIterasiC45) {
                    // insert ke tabel iterasi
                    $data = array('id' => '', 'iterasi' => $iterasiKe, 'atribut_gain_ratio_max' => $rowInsertIterasiC45['atribut'], 'atribut' => $rowInsertIterasiC45['atribut'], 'nilai_atribut' => $rowInsertIterasiC45['nilai_atribut'], 'jml_kasus_total' => $rowInsertIterasiC45['jml_kasus_total'], 'jml_delay'=> $rowInsertIterasiC45['jml_delay'], 'jml_tdk_delay' =>  $rowInsertIterasiC45['jml_tdk_delay'], 'entropy' => $rowInsertIterasiC45['entropy'], 'inf_gain' => $rowInsertIterasiC45['inf_gain'], 'split_info' => $rowInsertIterasiC45['split_info'], 'gain_ratio' => $rowInsertIterasiC45['gain_ratio']);

                    $this->laporan_model->insert_iterasi($data);
                    $iterasiKe++;
                }
            }  
        }
    }


    //#23# Looping proses mining dimana atribut dgn information gain max yang akan diproses pada fungsi miningC45()
    public function loopingMiningC45($inf_gain_max_atribut) 
    {

        // $sqlBelumAdaKeputusanLagi = mysql_query("SELECT * FROM pohon_keputusan_c45 WHERE keputusan = '?' and diproses = 'Belum' AND atribut = '$inf_gain_max_atribut'");
        $sqlBelumAdaKeputusanLagi = $this->laporan_model->sqlBelumAdaKeputusanLagi($inf_gain_max_atribut);
        foreach ($sqlBelumAdaKeputusanLagi as $key => $rowBelumAdaKeputusanLagi) {
            if ($rowBelumAdaKeputusanLagi['id_parent'] == 0) {
                $this->populateAtribut();
            }
            $atribut = $rowBelumAdaKeputusanLagi['atribut'];
            $nilai_atribut = $rowBelumAdaKeputusanLagi['nilai_atribut'];
            $kondisiAtribut = "AND $atribut = \'$nilai_atribut\'";
            $this->laporan_model->turncate_mining_c45();
            $this->laporan_model->delete_attribute($inf_gain_max_atribut);            
            $this->miningC45($atribut, $nilai_atribut);
            $this->populateAtribut();
        }
    }

    // rumus menghitung Pessimistic error rate
    public function perhitunganPrePruning($r, $z, $n)
    {
        $rumus = ($r + (($z * $z) / (2 * $n)) + ($z * (sqrt(($r / $n) - (($r * $r) / $n) + (($z * $z) / (4 * ($n * $n))))))) / (1 + (($z * $z) / $n));
        $rumus = round($rumus, 4);
        return $rumus;
    }

    // looping perhitungan Pessimistic error rate
    public function loopingPerhitunganPrePruning($positif, $negatif)
    {
        $z = 1.645; // z = batas kepercayaan (confidence treshold)
        $n = $positif + $negatif; // n = total jml kasus
        $n = round($n, 4);
        // r = perbandingan child thd parent
        if ($positif < $negatif) {
            $r = $positif / ($n);
            $r = round($r, 4);
            return $this->perhitunganPrePruning($r, $z, $n);
        } elseif ($positif > $negatif) {
            $r = $negatif / ($n);
            $r = round($r, 4);
            return $this->perhitunganPrePruning($r, $z, $n);
        } elseif ($positif == $negatif) {
            $r = $negatif / ($n);
            $r = round($r, 4);
            return $this->perhitunganPrePruning($r, $z, $n);
        }
    }

    /**
	 * @return array A CSRF key-value pair
	 */
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
    }
    
    /**
	 * @return bool Whether the posted CSRF token matches
	 */
	public function _valid_csrf_nonce(){
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')){
			return TRUE;
		}
			return FALSE;
	}
}

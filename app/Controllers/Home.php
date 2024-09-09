<?php

namespace App\Controllers;
use Codeigniter\Controller;
use App\Models\M_kue;


class Home extends BaseController
{
    public function dashboard()
    {
         if (session()->get('level')>0){
        echo view('header');
        echo view('menu');
        echo view('dashboard');
      } else{
        return redirect()->to('home/login');
      }
    }


 public function login()
    {
        echo view('header');
        echo view('login');
    }
   public function aksi_login()
    {
        $u=$this->request->getPost('username');
        $p=$this->request->getPost('password');

        $model = new M_kue();
        $where=array(
            'username'=> $u,
            'password' => $p
        );

        $model = new M_kue();
        $cek = $model->getWhere('user',$where);
        
        if ($cek>0){
         session()->set('id_user',$cek->id_user);
         session()->set('username',$cek->username);
         session()->set('level',$cek->level);
         return redirect()->to('home/dashboard');
     }else{
        return redirect()->to('home/login');
    }
}
public function logout()
{
    session()->destroy();
    return redirect()->to('home/login');
}

public function user()
{
    if (session()->get('level')> 0) {
        $model = new M_kue();
        $data['jel'] = $model->tampil('user');
        // $data['jes'] = $model->tampilgambar('toko');
       /* $id = 1; // id_toko yang diinginkan

        // Menyusun kondisi untuk query
        $where = array('id_toko' => $id);*/

        // Mengambil data dari tabel 'toko' berdasarkan kondisi
       /* $data['user'] = $model->getWhere('', $where);
*/
        // Memuat view
        // $data['setting'] = $model->getWhere('toko', $where);

        $user_id = session()->get('id');
        $model->logActivity($user_id, 'user', 'User in user page');

        echo view('header');
        echo view('menu', $data);
        echo view('user', $data);
    } else {
        return redirect()->to(base_url('home/login'));
    }
}

public function t_user()
{
    $model= new M_kue;
    $user_id = session()->get('id');
    $data['jes'] = $model->tampilgambar('toko'); // Mengambil data dari tabel 'toko'
    $data['jel']= $model->tampil('user');
    $model->logActivity($user_id, 'tambah user', 'User in tambah user page');
    echo view('header');
    echo view('menu', $data);
    echo view('t_user',$data);
}
public function aksi_t_user()
{
    $user_id = session()->get('id');
    $a = $this->request->getPost('nama');
    $b = md5($this->request->getPost('pass'));
    $c = $this->request->getPost('jk');
    $u = $this->request->getPost('level');

    // Prepare the data for inserting into the 'user' table
    $sis = array(
        'level' => $u,
        'username' => $a,
        'pw' => $b,
        'jk' => $c
    );

    // Instantiate the model and add the new user data
    $model = new M_kue;
    $model->tambah('user', $sis);

    $model->logActivity($user_id, 'user', 'User added a new account');  

    // Redirect the user after the operation is completed
    return redirect()->to('http://localhost:8080/home/user');
}
public function h_user($id)
{
    $model = new M_kue();
    $id_user = session()->get('id');
    $kil = array('id_user' => $id);
    $model->hapus('user', $kil);
    $model->logActivity($id_user, 'user', 'User deleted a user data.');
    return redirect()->to(base_url('home/user'));
}
public function aksi_e_user()
{
    $model= new M_kue;
     $user_id = session()->get('id');
    $a= $this->request->getPost('username');
    $b= $this->request->getPost('pw');
    $c= $this->request->getPost('jk');
    $d= $this->request->getPost('level');
    $id=$this->request->getPost('id');
    $where = array('id_user'=>$id);
    $isi= array(
        'username'=>$a,
        'pw'=>$b,
        'jk'=>$c,
        'level'=>$d);
    $model->edit('user',$isi,$where);
    $model->logActivity($user_id, 'user', 'User updated a menu burger data');
    return redirect()-> to ('http://localhost:8080/home/user');
}

 public function list_kerusakan() {
        $data['kerusakan'] = $this->Kerusakan_model->get_all_kerusakan();
        $this->load->view('kerusakan/index', $data);
    }

    // Menampilkan detail kerusakan dan solusinya
    public function detail_kerusakan($id) {
        $data['kerusakan'] = $this->Kerusakan_model->get_kerusakan_by_id($id);
        $data['solusi'] = $this->Kerusakan_model->get_solusi_by_kerusakan($id);
        $this->load->view('kerusakan/detail', $data);
    }

public function kerusakan() {
        // Mengecek apakah user memiliki level akses lebih dari 0
        if (session()->get('level') > 0) {
            // Menggunakan model M_kue
            $model = new M_kue();
            
            // Mengambil data kerusakan dari model
            $data['kerusakan'] = $model->tampil('kerusakan', 'id_kerusakan');
            
            // Menyaring data berdasarkan session id jika diperlukan
            $where = array('id_kerusakan' => session()->get('id'));
            $data['kerusakan'] = $model->get_kerusakan_by_id($where);

            // Memuat view dengan header, menu, dan footer
            echo view('header');
            echo view('menu');
            echo view('kerusakan', $data);
        
        } else {
            // Jika user tidak memiliki akses, redirect ke login
            return redirect()->to('home/login');
        }
    }
public function hasil() {
        // Mengecek apakah user memiliki level akses lebih dari 0
        if (session()->get('level') > 0) {
            // Menggunakan model M_kue
            $model = new M_kue();
            
            // Mengambil data kerusakan dari model
            $data['hasil'] = $model->tampil('hasil', 'id_hasil');
            
            // Menyaring data berdasarkan session id jika diperlukan
            $where = array('id_hasil' => session()->get('id'));
            $data['hasil'] = $model->get_all_kerusakan(); 

            // Memuat view dengan header, menu, dan footer
            echo view('header');
            echo view('menu');
            echo view('hasil', $data);
        
        } else {
            // Jika user tidak memiliki akses, redirect ke login
            return redirect()->to('home/login');
        }
    }
 public function gejala_kerusakan()
    {
        $model = new M_kue();

        // Mengambil data gejala kerusakan dari model
        $data['gejala_kerusakan'] = $model->get_all_gejala_kerusakan(); // Sesuaikan metode dengan yang ada di model

        // Memuat view dan passing data gejala kerusakan
        echo view('header');
        echo view('menu');
        echo view('gejala_kerusakan', $data);
        echo view('footer');
    }
  // Menampilkan form diagnosa
   /* public function form_diagnosa() {
        // Memuat model M_kue
        $model = new M_kue();
        
        // Mengambil semua data gejala dari model
        $data['gejala'] = $model->get_all_gejala();
        
        // Memuat view form diagnosa
        echo view('header');
        echo view('diagnosa_form', $data);
        echo view('footer');
    }
    public function proses_diagnosa() {
        // Memuat model M_kue secara langsung
        $model = new M_kue();
        
        // Mengambil data gejala yang dipilih dari form
        $gejala_terpilih = $this->request->getPost('gejala');

        if (empty($gejala_terpilih)) {
            // Jika tidak ada gejala yang dipilih, kembali ke form
            $this->session->setFlashdata('error', 'Pilih gejala terlebih dahulu.');
            return redirect()->to('/diagnosa/tampilkan_form_diagnosa');
        }

        // Mencari kerusakan yang sesuai berdasarkan gejala
        $kerusakan = $model->get_kerusakan_by_gejala($gejala_terpilih);

        if (empty($kerusakan)) {
            // Jika tidak ada kerusakan yang ditemukan, tampilkan pesan
            $this->session->setFlashdata('error', 'Tidak ada kerusakan yang sesuai dengan gejala yang dipilih.');
            return redirect()->to('/diagnosa/tampilkan_form_diagnosa');
        }

        // Mengambil solusi berdasarkan kerusakan
        $solusi = array();
        foreach ($kerusakan as $k) {
            $solusi[$k->id_kerusakan] = $model->get_solusi_by_kerusakan($k->id_kerusakan);
        }

        // Menyediakan data untuk view
        $data['kerusakan'] = $kerusakan;
        $data['solusi'] = $solusi;
        
        // Memuat view hasil diagnosa
        echo view('header');
        echo view('hasil_diagnosa', $data);
        echo view('footer');
    }*/
      public function form_diagnosa() {
        // Mengecek apakah user memiliki level akses lebih dari 0
        if (session()->get('level') > 0) {
            // Menggunakan model M_kue
            $model = new M_kue();
            
            // Mengambil data gejala dari model
            $data['gejala'] = $model->get_all_gejala();
            
            // Memuat view dengan header, menu, dan footer
            echo view('header');
            echo view('menu');
            echo view('diagnosa_form', $data);
            echo view('footer');
        
        } else {
            // Jika user tidak memiliki akses, redirect ke login
            return redirect()->to('home/login');
        }
    }

    public function proses_diagnosa() {
        // Mengecek apakah user memiliki level akses lebih dari 0
        if (session()->get('level') > 0) {
            // Menggunakan model M_kue
            $model = new M_kue();
            
            // Mengambil data gejala yang dipilih dari form
            $gejala_terpilih = $this->request->getPost('gejala');

            if (empty($gejala_terpilih)) {
                // Jika tidak ada gejala yang dipilih, kembali ke form
                $this->session->setFlashdata('error', 'Pilih gejala terlebih dahulu.');
                return redirect()->to('/diagnosa/form_diagnosa');
            }

            // Mencari kerusakan yang sesuai berdasarkan gejala
            $kerusakan = $model->get_kerusakan_by_gejala($gejala_terpilih);

            if (empty($kerusakan)) {
                // Jika tidak ada kerusakan yang ditemukan, tampilkan pesan
                $this->session->setFlashdata('error', 'Tidak ada kerusakan yang sesuai dengan gejala yang dipilih.');
                return redirect()->to('/diagnosa/form_diagnosa');
            }

            // Mengambil solusi berdasarkan kerusakan
            $solusi = array();
            foreach ($kerusakan as $k) {
                $solusi[$k->id_kerusakan] = $model->get_solusi_by_kerusakan($k->id_kerusakan);
            }

            // Menyediakan data untuk view
            $data['kerusakan'] = $kerusakan;
            $data['solusi'] = $solusi;
            
            // Memuat view dengan header, menu, dan footer
            echo view('header');
            echo view('menu');
            echo view('hasil_diagnosa', $data);
            echo view('footer');
        
        } else {
            // Jika user tidak memiliki akses, redirect ke login
            return redirect()->to('home/login');
        }
    }
public function diagnosa()
    {
        $model = new M_kue();
        
        // Fetch the data from the 'gejala' table, ordered by 'id_gejala'
        $data['gejala'] = $model->tampil2('gejala', 'id_gejala');
      
        
        // Load the views and pass the data to 'dashboard' view
        echo view('header');
        echo view('menu');
        echo view('diagnosa', $data);  // Make sure to pass the $data array here
        echo view('footer');
    }
}


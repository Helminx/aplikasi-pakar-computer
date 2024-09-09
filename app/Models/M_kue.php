<?php

namespace App\Models;
use CodeIgniter\Model;


class M_kue extends Model{
  public function tampil_data(){
    return $this->db->get('menu');
    
  }

  public function update_user($id_user, $data) {
        $this->db->where('id_user', $id_user);
        return $this->db->update('user', $data); // Assuming your user table is named 'users'
    }
public function edituser($table, $data, $where)
    {
        return $this->db->table($table)
                        ->where($where)
                        ->update($data);
    }
    
   public function tampil($org)
{
    $query = $this->db->table($org)->get();
    if ($query === false) {
        log_message('error', 'Query failed for table: ' . $org);
        return false; // Or handle the error appropriately
    }
    return $query->getResult();
}

    public function tambah($tabel,$isi){
   return $this->db->table($tabel)
                   ->insert($isi);
}
public function joinWhere($tabel,$tabel2, $on,$where){
   return $this->db->table($tabel , $where)
                   ->join($tabel2, $on,'left')
                   ->get()
                   ->getRow();
}
public function join($tabel,$tabel2, $on){
   return $this->db->table($tabel)
                   ->join($tabel2, $on,'left')
                   // ->orderby($id,'desc')
                   ->get()
                   ->getResult();
                    // return $this->db->query('Select * from brg_msk join barang on brg_msk.id_brg=barang.id_brg')
                    // ->getResult();
}
public function join1($tabel,$tabel2, $on){
   return $this->db->table($tabel)
                   ->join($tabel2, $on,'left')
                   // ->orderby($id,'desc')
                   ->get()
                   ->getResult();
                    // return $this->db->query('Select * from brg_msk join barang on brg_msk.id_brg=barang.id_brg')
                    // ->getResult();
}
    public function edit($tabel,$isi,$where){
   return $this->db->table($tabel)->update($isi,$where);
           
}
public function editkue($table, $data, $where)
    {
        return $this->db->table($table)->update($data, $where);
    }
    public function hapus($tabel,$where){
     return $this->db->table($tabel)
                     ->delete($where);
             
            
}
public function hapuskue($table, $where)
    {
        return $this->db->table($table)->delete($where);
    }
public function hapus1($table, $where)
{
    return $this->db->table($table)->where($where)->delete();
}

//     public function getWhere($tabel, $where) {
//     $result = $this->db->table($tabel)
//                        ->getWhere($where);

//     if ($result === false) {
//         // Handle the error, you can return null, an empty object, or throw an exception
//         return null; // or you can handle it differently
//     }

//     return $result->getRow();
// }
/*public function getWhere($tabel,$where){
    return $this->db->table($tabel)
             ->getWhere($where)
             ->getRow();
             
}*/

public function getWhere($tabel, $where) {
    $result = $this->db->table($tabel)
                       ->getWhere($where);
    
    if ($result !== false) {
        return $result->getRow();
    } else {
        return null;
    }
}

public function getWherecon($table, $conditions)
{
    return $this->db->table($table)->where($conditions)->get()->getResult();
}
             

public function upload1($file)
{
    $targetPath = ROOTPATH . 'public/images/logo.png';
    
    // Hapus file lama jika ada
    if (file_exists($targetPath)) {
        unlink($targetPath);
    }

    // Simpan file baru
    $file->move(ROOTPATH . 'public/images', 'logo.png');
    
    return 'logo.png'; // Mengembalikan nama file baru
}
/*public function tambah1($table, $data) {
    $db = \Config\Database::connect();
    $builder = $db->table($table);
    return $builder->insert($data);
}*/

 public function tambah1($table, $data) {
        return $this->db->table($table)->insert($data);
    }

public function editpw($tabel, $isi, $where){
    return $this->db->table($tabel)
    ->update($isi, $where);
 }
  public function upload($photo){
$imageName = $photo->getName();
$photo->move(ROOTPATH.'public/img',$imageName);

}
public function cari($table, $awal, $akhir, $field,){
return $this->db->table($tabel)
                ->join($tabel2,$on,'left')
                ->getWhere($field." between '$awal' and '$akhir'")
                ->getResult();
}
public function joinnelson($tabel, $tabel2, $tabel3,$tabel4, $on, $on2,$on3, $id){
 return $this->db->table($tabel)
 ->join($tabel2, $on,'left')
 ->join($tabel3, $on2,'left')
 ->join($tabel4, $on3,'left')
 ->orderby($id,'desc')
 ->get()
 ->getResult();

}

public function joinhistory($tabel, $tabel2, $tabel3,$tabel4, $on, $on2,$on3, $id,$where){
 return $this->db->table($tabel)
 ->join($tabel2, $on,'left')
 ->join($tabel3, $on2,'left')
 ->join($tabel4, $on3,'left')
 ->orderby($id,'desc')
 ->getWhere($where)
 ->getResult();


}

public function jointigawhere($tabel, $tabel2, $tabel3, $on, $on2, $id, $where) {
    $builder = $this->db->table($tabel)
        ->join($tabel2, $on, 'left')
        ->join($tabel3, $on2, 'left')
        ->orderby($id, 'desc')
        ->getWhere($where);

    if ($builder === false) {
        $error = $this->db->error(); // Get database error
        log_message('error', 'Database error: ' . print_r($error, true));
        return [];
    }

    return $builder->getResult();
}

public function uploadgambar($file, $storeId)
{
    // Generate a unique file name based on store ID and timestamp
    $newFileName = $storeId . '_' . time() . '.' . $file->getClientExtension();
    $targetPath = ROOTPATH . 'public/images/' . $newFileName;

    // Fetch the old file name from the database
    $query = $this->db->table('toko')->select('logo')->where('id_toko', $storeId)->get();
    $oldFile = $query->getRow();

    // Check if a record was found and if the old file exists
    if ($oldFile && isset($oldFile->logo) && file_exists(ROOTPATH . 'public/images/' . $oldFile->logo)) {
        unlink(ROOTPATH . 'public/images/' . $oldFile->logo);
    }

    // Save the new file
    $file->move(ROOTPATH . 'public/images', $newFileName);
    
    return $newFileName; // Return the new file name
}



public function get_all_kue() {
    $this->db->select('id_menu, nama_kue');
    $this->db->from('menu');
    $query = $this->db->get();
    return $query->result();
}



public function editgambar($table, $data, $where)
{
    return $this->db->table($table)->update($data, $where);
}
public function tampilgambar($table)
{
    $query = $this->db->table($table)->get();
    if ($query === false) {
        // Handle the error, e.g., log it, throw an exception, etc.
        return false;
    }
    return $query->getResult(); // Mengambil semua data dari tabel
}


public function getLaporanByDate($start_date, $end_date)
{
    return $this->db->table('transaksi')
    ->where('tgl_transaksi >=', $start_date)
    ->where('tgl_transaksi <=', $end_date)
    ->get()
    ->getResult();
}

public function getLaporanByDateForExcel($start_date, $end_date)
{
    $query = $this->db->table('transaksi')
    ->where('tgl_transaksi >=', $start_date)
    ->where('tgl_transaksi <=', $end_date)
    ->get();

    return $query->getResultArray();
}

public function getTransaksiById($id_transaksi)
{
    return $this->db->table('transaksi')
                    ->join('menu', 'transaksi.id_menu = menu.id_menu')
                    ->join('user', 'transaksi.id_user = user.id_user')
                    ->where('transaksi.id_transaksi', $id_transaksi)
                    ->get()
                    ->getRow();
}

public function updateTransaksi($id_transaksi, $data)
{
    return $this->db->table('transaksi')
                    ->where('id_transaksi', $id_transaksi)
                    ->update($data);
}


      // Mendapatkan semua data kerusakan
    public function get_all_kerusakan() {
        return $this->db->table('kerusakan')
                        ->get()
                        ->getResult();
    }

    // Mendapatkan kerusakan berdasarkan ID
    public function get_kerusakan_by_id($id) {
        return $this->db->table('kerusakan')
                        ->where('id_kerusakan', $id)
                        ->get()
                        ->getRow();
    }

    // Mendapatkan solusi berdasarkan ID kerusakan
    public function get_solusi_by_kerusakan($kerusakan_id) {
        return $this->db->table('solusi')
                        ->where('kerusakan_id', $kerusakan_id)
                        ->get()
                        ->getResult();
    }

    // Fungsi untuk mendapatkan semua gejala
    public function get_all_gejala() {
        return $this->db->table('gejala')
                        ->get()
                        ->getResult();
    }

    // Fungsi untuk mendapatkan kerusakan berdasarkan gejala yang dipilih
    public function get_kerusakan_by_gejala($gejala_ids) {
        $this->db->select('kerusakan.*');
        $this->db->from('kerusakan');
        $this->db->join('gejala_kerusakan', 'kerusakan.id_kerusakan = gejala_kerusakan.kerusakan_id');
        $this->db->where_in('gejala_kerusakan.gejala_id', $gejala_ids);
        $this->db->group_by('kerusakan.id_kerusakan');
        $this->db->having('COUNT(gejala_kerusakan.gejala_id) =', count($gejala_ids));
        return $this->db->get()->getResult();
    }

    // Mendapatkan semua gejala dan kerusakan
    public function get_all_gejala_kerusakan() {
        return $this->db->table('kerusakan')
                        ->select('id_kerusakan, nama_kerusakan, gejala')
                        ->get()
                        ->getResult();
    }

public function tampil2($table, $orderBy)
{
    return $this->db->table($table)->orderBy($orderBy)->get()->getResultArray();  // Keep it as an array
}
}
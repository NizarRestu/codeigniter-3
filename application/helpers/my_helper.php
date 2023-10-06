<?php
function convRupiah($value){
return 'Rp. ' . number_format($value);
}
function tampil_full_kelas_byid($id)
{
    $ci = &get_instance();
    $ci -> load->database();
    $result = $ci->db->where('id', $id)->get('kelas');
    foreach ($result->result() as $c) {
        $stmt = $c->tingkat_kelas . ' ' . $c->jurusan_kelas;
        return $stmt;
    }
}
function tampil_full_kelas_byid_guru($id)
{
    $ci = &get_instance();
    $ci -> load->database();
    $result = $ci->db->where('id_guru_walikelas', $id)->get('kelas');
    foreach ($result->result() as $c) {
        $stmt = $c->tingkat_kelas . ' ' . $c->jurusan_kelas;
        return $stmt;
    }
}
function tampil_full_siswa_byid($id)
{
    $ci = &get_instance();
    $ci -> load->database();
    $result = $ci->db->where('id_siswa', $id)->get('siswa');
    foreach ($result->result() as $c) {
        $stmt = $c->nama_siswa;
        return $stmt;
    }
}
function tampil_full_mapel_byid($id)
{
    $ci = &get_instance();
    $ci -> load->database();
    $result = $ci->db->where('id', $id)->get('mapel');
    foreach ($result->result() as $c) {
        $stmt = $c->nama_mapel;
        return $stmt;
    }
}

function get_id_kelas($id)
{
    $ci = &get_instance();
    $ci -> load->database();
    $result = $ci->db->where('id_siswa', $id)->get('siswa');
    foreach ($result->result() as $c) {
        $stmt = $c->id_kelas;
        return $stmt;
    }
}
function get_id_wali_kelas($id)
{
    $ci = &get_instance();
    $ci->load->database();
    $result = $ci->db->where('id', $id)->get('wali_kelas');

    if ($result->num_rows() > 0) {
        // Data ditemukan, kembalikan nilai id_guru
        foreach ($result->result() as $c) {
            $stmt = tampil_full_kelas_byid_guru($c->id_guru);
            return $stmt;
        }
    } else {
        // Data tidak ditemukan, kembalikan pesan "Tidak Menjadi Wali Kelas"
        return "Tidak Menjadi Wali Kelas";
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
class Keuangan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_model');
        $this->load->helper('my_helper');
        $this->load->library('upload');
        if ($this->session->userdata('logged_in') != true && $this->session->userdata('role') !== 'keuangan') {
            redirect(base_url() . 'auth');
        }
    }

	public function index()
	{
		$this->load->view('page/dashboard_keuangan');
	}
    public function pembayaran()
    {
        $data['pembayaran'] = $this->m_model->get_data('pembayaran')->result();
        $this->load->view('page/pembayaran', $data);
    }
    public function exportToCSV()
    {
        // Ambil data yang akan diekspor (gantilah dengan data Anda)
        $data = $this->m_model->get_data('pembayaran')->result();
    
        // Nama file CSV yang akan dihasilkan
        $filename = 'export_data.csv';
    
        // Set header HTTP untuk membuat browser mengenali file sebagai CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
    
        // Buat file CSV
        $output = fopen('php://output', 'w');
    
        // Tambahkan header
        fputcsv($output, array('ID', 'JENIS PEMBAYARAN' , 'TOTAL PEMBAYARAN' ));
    
        // Isi data
        foreach ($data as $item) {
            fputcsv($output, array($item->id, $item->jenis_pembayaran , $item->total_pembayaran)); 
        }
    
        fclose($output);
    }
    public function export(){
        require 'vendor/autoload.php';
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' =>[
                'top' =>['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'right' =>['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'bottom' =>['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                'left' =>['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
            ];
            $style_row =[
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'borders' =>[
                    'top' =>['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    'right' =>['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    'bottom' =>['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    'left' =>['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
                ]
                ];
                $sheet->setCellValue('A1', "DATA PEMBAYARAN");
                $sheet->mergeCells('A1:E1');
                $sheet->getStyle('A1')->getFont()->setBold(true);
                
                $sheet->setCellValue('A3', "ID");
                $sheet->setCellValue('B3', "JENIS PEMBAYARAN");
                $sheet->setCellValue('C3', "TOTAL PEMBAYARAN");
                $sheet->setCellValue('D3', "NAMA SISWA");
                $sheet->setCellValue('E3', "KELAS");

                $sheet->getStyle('A3')->applyFromArray($style_col);
                $sheet->getStyle('B3')->applyFromArray($style_col);
                $sheet->getStyle('C3')->applyFromArray($style_col);

                $data_pembayaran = $this->m_model->get_data('pembayaran')->result();
                $no = 1;
                $numrow=4;
                foreach($data_pembayaran as $data) {
                    $id_siswa = $data->id_siswa;
                    $siswa = $this-> m_model->get_by_id('siswa' , 'id_siswa', $id_siswa)->result();
                    $sheet->setCellValue('A'.$numrow, $data->id);
                    $sheet->setCellValue('B'.$numrow, $data->jenis_pembayaran);
                    $sheet->setCellValue('C'.$numrow, $data->total_pembayaran);
                    $sheet->setCellValue('D'.$numrow, $siswa->nama_siswa);
                    $sheet->setCellValue('E'.$numrow, tampil_full_kelas_byid($siswa->id_kelas));


                    $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
                    $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
                    $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
                    $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
                    $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);

                    $no++;
                    $numrow++;
                }

                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(25);
                $sheet->getColumnDimension('C')->setWidth(25);
                $sheet->getColumnDimension('D')->setWidth(30);
                $sheet->getColumnDimension('E')->setWidth(20);

                $sheet->getDefaultRowDimension()->setRowHeight(-1);

                $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                $sheet->setTitle("LAPORAN DATA PEMBAYARAN");

                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="PEMBAYARAN.xlsx"');
                header('Cache-Control: max-age=0');

                $writer = new Xlxs($spreadsheet);
                $writer->save('php://output');

            }
            public function tambah_pembayaran()
    {
        $data['siswa'] = $this->m_model->get_data('siswa')->result();
        $this->load->view('page/tambah_pembayaran', $data);

    }
    public function hapus_pembayaran($id)
    {
            $this->m_model->delete('pembayaran','id',$id);
            redirect(base_url('keuangan/pembayaran'));
    }
    public function ubah_pembayaran($id)
	{
        $data['pembayaran'] = $this-> m_model->get_by_id('pembayaran' , 'id', $id)->result();
        $data['siswa'] = $this-> m_model->get_data('siswa')->result();
		$this->load->view('page/ubah_pembayaran',$data);
	}
    public function aksi_tambah_pembayaran()
    {
        $data = [
            'id_siswa' => $this->input->post('siswa'),
            'jenis_pembayaran' => $this->input->post('jenis'),
            'total_pembayaran' => $this->input->post('pembayaran'),
        ];

        $this->m_model->add('pembayaran', $data);
        redirect(base_url('keuangan/pembayaran'));
    }
    public function aksi_ubah_pembayaran()
    {
        $data = [
            'id_siswa' => $this->input->post('siswa'),
            'jenis_pembayaran' => $this->input->post('jenis'),
            'total_pembayaran' => $this->input->post('pembayaran'),
        ];
        $eksekusi = $this->m_model->update('pembayaran', $data, array('id'=>$this->input->post('id')));
        if($eksekusi) {
            $this->session->set_flashdata('sukses' , 'berhasil');
            redirect(base_url('keuangan/pembayaran'));
        } else {
            $this->session->set_flashdata('error' , 'gagal...');
            redirect(base_url('keuangan/ubah_pembayaran/'.$this->input->post('id')));
        }
    }
    public function exportToExcel() {

        // Load autoloader Composer
        require 'vendor/autoload.php';
        
        $spreadsheet = new Spreadsheet();

        // Buat lembar kerja aktif
       $sheet = $spreadsheet->getActiveSheet();
        // Data yang akan diekspor (contoh data)
        $data = $this->m_model->get_data('pembayaran')->result();
        
        // Buat objek Spreadsheet
        $headers = ['ID','NAMA SISWA','KELAS', 'JENIS PEMBAYARAN', 'TOTAL PEMBAYARAN'];
        $rowIndex = 1;
        foreach ($headers as $header) {
            $sheet->setCellValueByColumnAndRow($rowIndex, 1, $header);
            $rowIndex++;
        }
        
        // Isi data dari database
        $rowIndex = 2;
        foreach ($data as $rowData) {
            $columnIndex = 1;
            $id = ''; // Variabel untuk menyimpan id
            $siswaName = ''; // Variabel untuk menyimpan nama siswa
            $jenisPembayaran = ''; // Variabel untuk menyimpan jenis pembayaran
            $totalPembayaran = ''; // Variabel untuk menyimpan total pembayaran
            $kelas = ''; // Variabel untuk menyimpan kelas
        
            foreach ($rowData as $cellName => $cellData) {
                if($cellName == 'id'){
                    $id = $cellData;
                }elseif ($cellName == 'id_siswa') {
                    $siswaName = tampil_full_siswa_byid($cellData);
                    $id_kelas = get_id_kelas($cellData);
                    $kelas = tampil_full_kelas_byid($id_kelas);
                } elseif ($cellName == 'jenis_pembayaran') {
                    $jenisPembayaran = $cellData;
                } elseif ($cellName == 'total_pembayaran') {
                    $totalPembayaran = $cellData;
                }
        
                // Anda juga dapat menambahkan logika lain jika perlu
                // Contoh: Menghitung total pembayaran, mengubah format tanggal, dll.
                
                // Contoh: $sheet->setCellValueByColumnAndRow($columnIndex, $rowIndex, $cellData);
                $columnIndex++;
            }
        
            // Setelah loop, Anda memiliki data yang diperlukan dari setiap kolom
            // Anda dapat mengisinya ke dalam lembar kerja Excel di sini
            $sheet->setCellValueByColumnAndRow(1, $rowIndex, $id);
            $sheet->setCellValueByColumnAndRow(2, $rowIndex, $siswaName);
            $sheet->setCellValueByColumnAndRow(3, $rowIndex, $kelas);
            $sheet->setCellValueByColumnAndRow(4, $rowIndex, $jenisPembayaran);
            $sheet->setCellValueByColumnAndRow(5, $rowIndex, $totalPembayaran);
        
            $rowIndex++;
        }
        // Auto size kolom berdasarkan konten
        foreach (range('A', $sheet->getHighestDataColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // Set style header
        $headerStyle = [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ];
        $sheet->getStyle('A1:' . $sheet->getHighestDataColumn() . '1')->applyFromArray($headerStyle);
        
        // Konfigurasi output Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'PEMBAYARAN.xlsx'; // Nama file Excel yang akan dihasilkan
        
        // Set header HTTP untuk mengunduh file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Outputkan file Excel ke browser
        $writer->save('php://output');
        
    }
}

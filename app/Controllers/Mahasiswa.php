<?php

namespace App\Controllers;

use CodeIgniter\Database\Exceptions\DatabaseException;

class Mahasiswa extends BaseController
{
    function __construct()
    {
        $this->model = new \App\Models\ModelMahasiswa();
    }

	// public function checkDatabaseConnection()
    // {
    //     try {
    //         // Coba lakukan koneksi ke database
    //         \Config\Database::connect('crud_ci');
    //         echo "Koneksi ke database 'crud_ci' berhasil.";
    //     } catch (DatabaseException $e) {
    //         echo "Koneksi ke database 'crud_ci' gagal: " . $e->getMessage();
    //     }
    // }

	public function hapus($id){
		$this->model->delete($id);
		return redirect()->to('mahasiswa');
	}

	public function edit($id){
		return json_encode($this->model->find($id));
	}

    public function simpan()
    {
        $validasi  = \Config\Services::validation();
		$aturan = [
			'nama' => [
				'label' => 'Nama',
				'rules' => 'required|min_length[5]',
				'errors' => [
					'required' => '{field} harus diisi',
					'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter'
				]
			],
			'email' => [
				'label' => 'Email',
				'rules' => 'required|min_length[5]|valid_email',
				'errors' => [
					'required' => '{field} harus diisi',
					'min_length' => 'Minimum karakter untuk field {field} adalah 5 karakter',
					'valid_email' => 'Email yang kamu masukkan tidak valid'
				]
			],
			'nohp' => [
				'label' => 'Nomor HP',
				'rules' => 'required|min_length[11]',
				'errors' => [
					'required' => '{field} harus diisi',
					'min_length' => 'Minimum karakter untuk field {field} adalah 11 karakter'
				]
			],
		];

		$validasi->setRules($aturan);
		if ($validasi->withRequest($this->request)->run()) {
			$id = $this->request->getPost('id');
			$nama = $this->request->getPost('nama');
			$email = $this->request->getPost('email');
			$jurusan = $this->request->getPost('jurusan');
			$nohp = $this->request->getPost('nohp');

			// untuk menghilangkan karakter selain angka dari nohp
			$nohp = $this->request->getPost('nohp');
			$nohp = preg_replace('/[^0-9]/', '', $nohp);
			// akhir penghilangan karakter

            $data = [
				'id' => $id,
                'nama' => $nama,
                'email' => $email,
                'jurusan' => $jurusan,
                'nohp' => $nohp
            ];

            $this->model->save($data);

			$hasil['sukses'] = "Berhasil memasukkan data";
			$hasil['gagal'] = true;
		} else {
			$hasil['sukses'] = false;
			$hasil['gagal'] = $validasi->listErrors();
		}
        return json_encode($hasil);
    }

    public function index()
    {
		$jumlahBaris = 2;

        // $katakunci = $this->request->getGet('katakunci');
		// if ($katakunci) {
		// 	$cari = $this->model->pencarian($katakunci);
		// } else {
		// 	$cari = $this->model;
		// }
		// $data['katakunci'] = $katakunci;

		$data['dataMahasiswa'] = $this->model->orderBy('id', 'desc')->paginate($jumlahBaris);
		// $data['dataMahasiswa'] = $this->model->orderBy('id', 'desc')->findAll();
		$data['pager'] = $this->model->pager;
		$data['nomor'] = ($this->request->getVar('page') == 1)?'0': $this->request->getVar('page');
		return view('mahasiswa_view', $data);
    }
}

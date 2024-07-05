<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;


class MuridController extends ResourceController
{
    protected $modelName = 'App\Models\Murid';
    protected $format    = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        // print_r($this->model); die;
        $data = [
            'message' => 'success',
            'data_murid' => $this->model->orderBy('id', 'DESC')->findALL()
        ];
        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $data = [
            'message' => 'success',
            'murid_byid' => $this->model->find($id)
        ];

        if ($data['murid_byid'] == NULL) {
            return $this->failNotFound('Data Murid tidak Ditemukan');
        }


        return $this->respond($data, 200);
    }


    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = $this->validate([
            'nama' => 'required',
            'absen' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'gambar' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        // proses upload gmbar
        $gambar     = $this->request->getFile('gambar');
        $namaGambar = $gambar->getRandomName();
        $gambar->move('gambar', $namaGambar);

        $this->model->insert([
            'nama'      => esc($this->request->getVar('nama')),
            'absen'     => esc($this->request->getVar('absen')),
            'alamat'    => esc($this->request->getVar('alamat')),
            'email'     => esc($this->request->getVar('email')),
            'gambar'    => $namaGambar

        ]);

        $response = [
            'message' => 'Data Murid berhasil ditambahkan'
        ];

        return $this->respondCreated($response);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $rules = $this->validate([
            'nama' => 'required',
            'absen' => 'required',
            'alamat' => 'required',
            'email' => 'required|valid_email',
            'gambar' => 'if_exist|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ]);
        
        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];
            return $this->failValidationErrors($response);
        }
        
        // proses update gambar
        $gambar = $this->request->getFile('gambar');
        
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('gambar', $namaGambar);

            $gambarDb = $this->model->find($id);
            if ($gambarDb['gambar'] == $this->request->getPost('gambarLama')) {
                unlink('gambar/' . $this->request->getPost('gambarLama'));
            }
        } else {
            $namaGambar = $this->request->getPost('gambarLama');
        }
        
        $this->model->update($id, [
            'nama' => esc($this->request->getVar('nama')),
            'absen' => esc($this->request->getVar('absen')),
            'alamat' => esc($this->request->getVar('alamat')),
            'email' => esc($this->request->getVar('email')),
            'gambar' => $namaGambar
        ]);
        
        $response = [
            'message' => 'Data Murid berhasil diubah'
        ];
        
        return $this->respond($response, 200);
        
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $this->model->delete($id);

        $response = [
            'message' => 'Data Murid berhasil dihapus'
        ];

        return $this->respondDeleted($response, 200);
    }
}

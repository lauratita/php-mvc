<?php

class Mahasiswa_model
{
    // private $mhs = [
    //     [
    //         "nama" => "Laura Tita",
    //         "NISN" => "0048849229",
    //         "email" => "lauratita316@gmial.com",
    //         "jurusan" => "RPL"
    //     ],
    //     [
    //         "nama" => "Yeptaii",
    //         "NISN" => "004884658",
    //         "email" => "yeptaai4@gmial.com",
    //         "jurusan" => "RPL"
    //     ],
    //     [
    //         "nama" => "aku kamu kita",
    //         "NISN" => "005679068",
    //         "email" => "kitaaaa@gmial.com",
    //         "jurusan" => "iya"
    //     ]

    //     ];

        private $table = 'mahasiswa';
        private $db;
        
        public function __construct()
        {
            $this->db = new Database;
        }

        public function getAllMahasiswa()
        {
            // $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
            // $this->stmt->execute();
            // return $this->stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->db->query('SELECT * FROM ' . $this->table);
            return $this->db->resultSet();
        }

        public function getMahasiswaById($id)
        {
            $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
            $this->db->bind('id', $id);
            return $this->db->single();
        }

        public function tambahDataMahasiswa($data)
        {
            $query = "INSERT INTO mahasiswa VALUES ('', :nama, :nisn, :email, :jurusan)";

            $this->db->query($query);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('nisn', $data['nisn']);
            $this->db->bind('email', $data['email']);
            $this->db->bind('jurusan', $data['jurusan']);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function hapusDataMahasiswa($id)
        {
            $query = "DELETE FROM mahasiswa WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function ubahDataMahasiswa($data)
        {
            $query = "UPDATE mahasiswa SET
                        nama = :nama,
                        nisn = :nisn,
                        email = :email,
                        jurusan = :jurusan
                        WHERE id = :id";

            $this->db->query($query);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('nisn', $data['nisn']);
            $this->db->bind('email', $data['email']);
            $this->db->bind('jurusan', $data['jurusan']);
            $this->db->bind('id', $data['id']);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function cariDataMahasiswa()
        {
            $keyword = $_POST['keyword'];
            $query = "SELECT * FROM mahasiswa WHERE nama LIKE :keyword";
            $this->db->query($query);
            $this->db->bind('keyword', "%$keyword%");
            return $this->db->resultSet();
        }
}
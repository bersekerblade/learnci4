<?php

namespace App\Models;

use CodeIgniter\Model;

class OrangModel extends Model
{
    protected $table = 'orang';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'alamat'];

    public function search($keyword)
    {

        // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'
        // $builder = $this->table('orang');
        // $builder->like('nama', $keyword);
        // return $builder;

        return $this->table('orang')->like('nama', $keyword)->orLike('alamat', $keyword);
    }
}

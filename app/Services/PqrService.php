<?php

namespace App\Services;

use App\Interfaces\PqrInterface;
use App\Repositories\PqrRepository;

class PqrService implements PqrInterface
{
    protected $pqrRepository;

    public function __construct(PqrRepository $pqrRepository)
    {
        $this->pqrRepository = $pqrRepository;
    }

    public function getAll()
    {
        return $this->pqrRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->pqrRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->pqrRepository->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->pqrRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->pqrRepository->delete($id);
    }
}
<?php

namespace App\Services;

use App\Interfaces\PedidoInterface;
use App\Repositories\PedidoRepository;

class PedidoService implements PedidoInterface
{
    protected $pedidoRepository;

    public function __construct(PedidoRepository $pedidoRepository)
    {
        $this->pedidoRepository = $pedidoRepository;
    }

    public function getAll()
    {
        return $this->pedidoRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->pedidoRepository->getById($id);
    }

    public function create(array $datos)
    {
        return $this->pedidoRepository->create($datos);
    }

    public function update(array $datos, int $id)
    {
        return $this->pedidoRepository->update($datos, $id);
    }

    public function delete(int $id)
    {
        return $this->pedidoRepository->delete($id);
    }

    public function getByEstado(string $estado)
    {
        return $this->pedidoRepository->getByEstado($estado);
    }

    public function getByFecha(string $fecha)
    {
        return $this->pedidoRepository->getByFecha($fecha);
    }

    public function getByTotal(float $total)
    {
        return $this->pedidoRepository->getByTotal($total);
    }

    public function getByCliente(int $id_cliente)
    {
        return $this->pedidoRepository->getByCliente($id_cliente);
    }
}
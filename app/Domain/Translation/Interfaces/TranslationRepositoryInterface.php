<?php

namespace App\Domain\Translation\Interfaces;
use Illuminate\Database\Eloquent\Collection;

interface TranslationRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function update(int $id, array $data);
    public function find(int $id);

}

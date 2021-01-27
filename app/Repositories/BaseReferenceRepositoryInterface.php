<?php

namespace App\Repositories;

interface BaseReferenceRepositoryInterface
{
    public function all();
    public function getByItemId($userId);
}
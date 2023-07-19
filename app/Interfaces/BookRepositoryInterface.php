<?php

namespace App\Interfaces;

interface BookRepositoryInterface
{
    public function getAllBook();
    public function createBook(array $request);
    public function getBookById(int $id);
    public function updateBook(array $request, int $id);
    public function deleteBook(int $id);
}

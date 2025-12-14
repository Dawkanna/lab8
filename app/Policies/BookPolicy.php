<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    /**
     * viewAny → Хэн ч номын жагсаалтыг харж болно (login шаардлагагүй)
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * view → Нэвтэрсэн бүх хэрэглэгч номын дэлгэрэнгүйг харж болно
     */
    public function view(?User $user, Book $book): bool
    {
        return true;
    }

    /**
     * create → Зөвхөн admin болон editor ном үүсгэнэ
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    /**
     * update → Зөвхөн:
     *  - admin
     *  - эсвэл тухайн номыг үүсгэсэн хэрэглэгч
     */
    public function update(User $user, Book $book): bool
    {
        return $user->isAdmin() || $user->id === $book->user_id;
    }

    /**
     * delete → Зөвхөн admin ном устгана
     */
    public function delete(User $user, Book $book): bool
    {
        return $user->isAdmin();
    }
}

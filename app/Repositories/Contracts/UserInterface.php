<?php
namespace App\Repositories\Contracts;

interface UserInterface
{
    /**
     * 根据ID返回用户信息
     * @return mixed
     */
    public function getById($id);
}
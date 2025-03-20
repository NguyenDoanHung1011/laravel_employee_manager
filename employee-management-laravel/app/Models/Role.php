<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles'; // Đặt tên bảng thủ công nếu cần
    protected $fillable = ['name']; // Cho phép cập nhật cột 'name'

    // Quan hệ với User
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class LoginEmailExists implements Rule
{
    /**
     * تحديد ما إذا كانت القاعدة تمر.
     */
    public function passes($attribute, $value)
    {
        // التحقق من وجود البريد الإلكتروني في جدول employees أو stores
        return DB::table('employees')->where('email', $value)->exists() ||
            DB::table('stores')->where('email', $value)->exists();
    }

    /**
     * الحصول على رسالة الخطأ.
     */
    public function message()
    {
        return 'The :attribute must exist in either the employees or stores table.';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $national_code
 * @property int $age
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\StudentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Query\Builder|Student onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNationalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|Student withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Student withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStatus($value)
 */
class Student extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'national_code',
        'age',
        'status',
    ];

    public function courses (){
        return $this->belongsToMany(Course::class);
    }
}

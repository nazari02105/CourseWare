<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Professor
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $national_code
 * @property int $experience
 * @property int $age
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\ProfessorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Professor newQuery()
 * @method static \Illuminate\Database\Query\Builder|Professor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Professor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereNationalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|Professor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Professor withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereStatus($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 */
class Professor extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'username',
        'email',
        'password',
        'national_code',
        'experience',
        'age',
        'status',
    ];

    public function courses (){
        return $this->hasMany(Course::class);
    }

    public function exams (){
        return $this->hasMany(Exam::class);
    }

    public function questions (){
        return $this->hasMany(Question::class);
    }
}

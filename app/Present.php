<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Present extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'tanggal', 'keterangan', 'jam_masuk', 'jam_keluar'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getJamKerjaAttribute()
    {
        $jam = 0;
        if ($this->keterangan == 'Masuk' || $this->keterangan == 'Telat') {
            if ($this->jam_masuk != null && $this->jam_keluar != null) {
                $jam_masuk = strtotime($this->jam_masuk);
                $jam_keluar = strtotime($this->jam_keluar);
                $jam_kerja = $jam_keluar - $jam_masuk;
                $jam = floor($jam_kerja / 3600);
            }
        }
        return $jam;
    }
}

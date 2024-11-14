<?php

namespace App\Imports;

use App\Models\Fair;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\Importable;

class FairsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable;

    public function model(array $row)
    {
        return new Fair([
            'name' => $row['name'],
            'location' => $row['location'],
            'start_date' => $this->transformDate($row['start_date']),
            'end_date' => $this->transformDate($row['end_date']),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }

    private function transformDate($value)
    {
        try {
            return Carbon::createFromFormat('d.m.Y', $value)->format('Y-m-d');
        } catch (\Exception $e) {
            return Carbon::parse($value)->format('Y-m-d');
        }
    }

    public function onError(\Throwable $e)
    {
        // Hata durumunda yapılacak işlemler
    }

    public function onFailure(\Maatwebsite\Excel\Validators\Failure ...$failures)
    {
        // Validasyon hatası durumunda yapılacak işlemler
    }
}
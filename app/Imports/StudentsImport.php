<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class StudentsImport implements ToCollection, WithHeadingRow
{
    protected $inserted = 0;
    protected $updated = 0;
    protected $ignored = 0;
    protected $messages = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $nombre = trim($row['nombre'] ?? '');
            $email = trim($row['email'] ?? '');
            $documento = trim($row['documento'] ?? '');

            // Si no hay nombre, ignorar
            if (!$nombre) {
                $this->ignored++;
                $this->messages[] = "Fila ignorada (sin nombre)";
                continue;
            }

            // 🟢 Si NO hay email ni documento → crear directamente (solo nombre)
            if (!$email && !$documento) {
                Student::create([
                    'nombre' => $nombre,
                    'email' => null,
                    'documento' => null,
                ]);
                $this->inserted++;
                $this->messages[] = "Insertado (solo nombre): {$nombre}";
                continue;
            }

            // 🔎 Buscar por email o documento si existen
            $query = Student::query();

            if ($email) {
                $query->whereRaw('LOWER(TRIM(email)) = ?', [strtolower($email)]);
            }

            if ($documento) {
                $query->orWhereRaw('TRIM(documento) = ?', [$documento]);
            }

            $student = $query->first();

            if ($student) {
                // Si ya existe, actualiza si hay cambios
                $changed = false;

                if ($student->nombre !== $nombre) {
                    $student->nombre = $nombre;
                    $changed = true;
                }

                if ($documento && $student->documento !== $documento) {
                    $student->documento = $documento;
                    $changed = true;
                }

                if ($email && $student->email !== $email) {
                    $student->email = $email;
                    $changed = true;
                }

                if ($changed) {
                    $student->save();
                    $this->updated++;
                } else {
                    $this->ignored++;
                }
            } else {
                // Crear nuevo si no existe por email/documento
                Student::create([
                    'nombre' => $nombre,
                    'email' => $email ?: null,
                    'documento' => $documento ?: null,
                ]);

                $this->inserted++;
            }
        }
    }

    public function getInsertedCount() { return $this->inserted; }
    public function getUpdatedCount() { return $this->updated; }
    public function getIgnoredCount() { return $this->ignored; }
    public function getMessages() { return $this->messages; }
}


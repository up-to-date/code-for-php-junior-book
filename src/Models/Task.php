<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name'];

    public function find($id)
    {
        $mysqli = new \mysqli('localhost', 'homestead', 'secret', 'pnb');
        $mysqli->set_charset("utf8mb4");

        $result = $mysqli->query("SELECT * FROM tasks WHERE id={$id}");

        return $result->fetch_assoc();
    }

    public function update($id, $data)
    {
        $mysqli = new \mysqli('localhost', 'homestead', 'secret', 'pnb');
        $mysqli->set_charset("utf8mb4");

        $mysqli->query("UPDATE tasks SET name = '{$data['name']}' WHERE id = {$id}");
    }
}

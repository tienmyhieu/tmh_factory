<?php

class TmhDatabase
{
    private TmhJson $json;

    public function __construct(TmhJson $json)
    {
        $this->json = $json;
    }

    public function entity(string $primaryKey, string $tableName): array
    {
        return $this->row($primaryKey, $tableName);
    }

    private function prune(array $row): array
    {
        $fields = ['active', 'comment', 'obverse'];
        foreach ($fields as $field) {
            if (in_array($field, array_keys($row))) {
                unset($row[$field]);
            }
        }
        return $row;
    }

    private function relations(string $tableName): array
    {
        $relations = [
            'catalog' => ['emperor', 'metal'],
            'emperor' => ['inscription'],
            'inscription' => ['inscription_type']
        ];
        return in_array($tableName, array_keys($relations)) ? $relations[$tableName]: [];
    }

    private function row(string $primaryKey, string $tableName): array
    {
        $table = $this->table($tableName);
        $relations = $this->relations($tableName);
        $row = in_array($primaryKey, array_keys($table)) ? $table[$primaryKey]: [];
        foreach ($relations as $relation) {
            if ($row[$relation]) {
                $row[$relation] = $this->row($row[$relation], $relation);
            }
        }
        return $this->prune($row);
    }

    private function table(string $tableName): array
    {
        return $this->json->load(__DIR__ . '/tmh_database/database/', $tableName);
    }
}

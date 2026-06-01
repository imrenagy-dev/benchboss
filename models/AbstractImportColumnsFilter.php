<?php

namespace app\models;

class AbstractImportColumnsFilter
{
    protected array $stringColumnsIndex = [];

    public function __construct(protected readonly array $columns, protected readonly array $stringColumns)
    {
        foreach ($stringColumns as $stringColumn) {
            $index = array_search($stringColumn, $columns);
            if ($index !== false) {
                $this->stringColumnsIndex[] = $index;
            }
        }
    }

    public function escapeStringColumns(array $csvRow): array
    {
        foreach ($this->stringColumnsIndex as $index) {
            $csvRow[$index] = $this->escapeString($csvRow[$index]);
        }
        return $csvRow;
    }

    public function escapeString(string $str): string
    {
        return htmlspecialchars($str, ENT_COMPAT);
    }
}
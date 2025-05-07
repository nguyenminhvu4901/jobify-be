<?php
namespace App\Contracts;

interface ElasticsearchSyncContract
{
    public function syncRecord(array $data): void;
    public function reindex(): void;
    public function deleteIndex(string $index): void;
}

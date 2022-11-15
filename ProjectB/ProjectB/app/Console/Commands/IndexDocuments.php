<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Documents;
use Elasticsearch;

class IndexDocuments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'index:documents';

    // protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $documents = Documents::all();

        foreach ($documents as $document) {
            try {
                Elasticsearch::index([
                    'id' => $document->id,
                    'index' => 'documents',
                    'body' => [
                        'title' => $document->title,
                        'degree' => $document->degree,
                        'text_data' => $document->text_data
                    ]
                ]);
            } catch (Exception $e) {
                $this->info($e->getMessage());
            }
        }

        $this->info("Posts were successfully indexed");
    }
}

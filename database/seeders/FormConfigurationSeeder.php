<?php

namespace Database\Seeders;

use App\Models\FormConfiguration;
use App\Models\FormSubmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FormConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = storage_path('app/data/submission.json');

        if (!File::exists($jsonPath)) {
            $this->command->error('JSON file not found at: ' . $jsonPath);
            return;
        }

        $jsonContent = File::get($jsonPath);
        $formData = json_decode($jsonContent, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error('Invalid JSON format: ' . json_last_error_msg());
            return;
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        FormSubmission::truncate();
        FormConfiguration::truncate();

        foreach ($formData as $section) {
            FormConfiguration::create([
                'name' => $section['name'],
                'form_id' => $section['id'],
                'payloads' => $section['payloads'],
                'is_active' => true
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $this->command->info('Form configurations seeded successfully!');

    }
}

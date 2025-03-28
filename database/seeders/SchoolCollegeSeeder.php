<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolCollege;

class SchoolCollegeSeeder extends Seeder
{
    public function run()
    {
        $schools = [
            [
                'name' => 'College of Agriculture, Health and Natural Resources',
                'slug' => 'college-of-agriculture-health-natural-resources',
            ],
            [
                'name' => 'School of Business',
                'slug' => 'school-of-business',
            ],
            [
                'name' => 'College of Engineering',
                'slug' => 'college-of-engineering',
            ],
            [
                'name' => 'School of Fine Arts',
                'slug' => 'school-of-fine-arts',
            ],
            [
                'name' => 'School of Law',
                'slug' => 'school-of-law',
            ],
            [
                'name' => 'College of Liberal Arts and Sciences',
                'slug' => 'college-of-liberal-arts-sciences',
            ],

            [
                'name' => 'Neag School of Education',
                'slug' => 'neag-school-of-education',
            ],
            [
                'name' => 'School of Nursing',
                'slug' => 'school-of-nursing',
            ],
            [
                'name' => 'School of Pharmacy',
                'slug' => 'school-of-pharmacy',
            ],
            [
                'name' => 'School of Social Work',
                'slug' => 'school-of-social-work',
            ],
            [
                'name' => 'Avery Point Campus',
                'slug' => 'avery-point',
                'type' => 'campus',
            ],
            [
                'name' => 'Hartford Campus',
                'slug' => 'hartford',
                'type' => 'campus',
            ],
            [
                'name' => 'Stamford Campus',
                'slug' => 'stamford',
                'type' => 'campus',
            ],
            [
                'name' => 'Waterbury Campus',
                'slug' => 'waterbury',
                'type' => 'campus',
            ],

            [
                'name' => 'Library',
                'slug' => 'library',
                'type' => 'library',
            ]
        ];
    
        foreach ($schools as $school) {
            SchoolCollege::updateOrCreate(
                ['slug' => $school['slug']],
                [
                    'name' => $school['name'],
                    'type' => $school['type'] ?? 'school',
                ]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            [
                'name' => 'تفسير القرآن الكريم',
            ],
            [
                'name' => 'علوم القرآن',
            ],
            [
                'name' => 'العقيدة وأصول الدين',
            ],
            [
                'name' => 'أصول الفقه',
            ],
            [
                'name' => 'فقه العبادات والمعاملات',
            ],
            [
                'name' => 'الحديث الشريف وعلومه',
            ],
            [
                'name' => 'اللغة العربية وعلومها',
            ],
            [
                'name' => 'الدواوين',
            ],
            [
                'name' => 'المنطق',
            ],
            [
                'name' => 'الفلسفة',
            ],
            [
                'name' => 'الرثاء',
            ],
            [
                'name' => 'الرؤيا والتعبير',
            ],
            [
                'name' => 'الخطب والوصايا',
            ],
            [
                'name' => 'التصوف',
            ],
            [
                'name' => 'الزهد والرقائق',
            ],
            [
                'name' => 'الأخلاق',
            ],
            [
                'name' => 'آداب البحث',
            ],
            [
                'name' => 'السياسة وتدبير الملك',
            ],
            [
                'name' => 'حدود العلم',
            ],
            [
                'name' => 'المدائح النبوية',
            ],
            [
                'name' => 'الوعظ، النصح، الحكم، التضرع والابتهال',
            ],
            [
                'name' => 'الأدعية والأذكار',
            ],
            [
                'name' => 'الفضائل',
            ],
            [
                'name' => 'التاريخ والجغرافيا',
            ],
            [
                'name' => 'الخواص، الجداول والأوفاق',
            ],
            [
                'name' => 'العلوم الرياضية',
            ],
            [
                'name' => 'العلوم التجريبية',
            ],
            [
                'name' => 'المواضيع المتنوعة',
            ]
        ];

        foreach($subjects as $subject){
            Subject::create($subject);
        }
    }
}

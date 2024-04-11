<?php

namespace Database\Seeders;

use App\Models\Department\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'ar' => [
                'name' => 'الاشعه',
                'description' => 'هو جزء أساسي من مرافق الرعاية الصحية الحديثة. وهو مسؤول عن أداء مختلف الإجراءات التصويرية التشخيصية باستخدام الأشعة السينية، وهي شكل من أشكال الإشعاع الكهرومغناطيسي. يُستخدم تصوير الأشعة السينية على نطاق واسع لتصور الهياكل الداخلية للجسم، مما يساعد في تشخيص وعلاج العديد من الحالات الطبية.',
            ],
            'en' => [
                'name' => 'Department of X-ray',
                'description' => 'is a vital component of modern healthcare facilities. It is responsible for performing various diagnostic imaging procedures using X-rays, a form of electromagnetic radiation. X-ray imaging is widely used to visualize the internal structures of the body, aiding in the diagnosis and treatment of numerous medical conditions.',
            ],
            'scientific_name' => 'x-ray',
            'status' => 0
        ]);
        Department::create([
            'ar' => [
                'name' => 'الحساسية',
                'description' => 'هو تخصص طبي يركز على تشخيص وعلاج الحساسية واضطرابات جهاز المناعة. يهتم هذا القسم بفهم كيفية تفاعل الجسم مع مواد معينة والتي يمكن أن تسبب أعراض الحساسية مثل الطفح الجلدي، والتهاب الأنف، والحكة، وصعوبة التنفس.',
            ],
            'en' => [
                'name' => 'Department of Allergy',
                'description' => 'is a medical specialty that focuses on diagnosing and treating allergies and immune system disorders. This department is concerned with understanding how the body reacts to certain substances that can cause allergic symptoms such as rashes, nasal inflammation, itching, and difficulty breathing.',
            ],
            'scientific_name' => 'allergy',
        ]);
        Department::create([
            'ar' => [
                'name' => 'جراحه',
                'description' => 'الجراحة هي تخصص طبي يشمل الإجراءات الجراحية التي تتطلب تدخلات جراحية لعلاج الإصابات والأمراض والتشوهات من خلال تدخلات جراحية. يتلقى الجراحون تدريبًا عالي المستوى يؤهلهم لأداء الإجراءات الجراحية لاستعادة صحة المريض أو تحسينها. يمكن تصنيف الجراحة إلى أنواع مختلفة استنادًا إلى منطقة الجسم والغرض وتعقيد الإجراء.',
            ],
            'en' => [
                'name' => 'Department of Surgery',
                'description' => 'Surgery is a medical specialty that involves invasive procedures to treat injuries, diseases, and deformities through operative interventions. Surgeons are highly trained medical professionals who perform surgical procedures to restore or improve a patient\'s health. Surgery can be categorized into various types based on the area of the body, purpose, and complexity of the procedure.',
            ],
            'scientific_name' => 'surgery',
        ]);
    }
}

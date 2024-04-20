<?php

namespace Database\Seeders;

use App\Models\Clinic\Clinic;
use App\Models\Pharmacy\Pharmacy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createClinics();
        $this->createPharmacies();

    }//end of run


    private function createClinics()
    {
        $clinic = Clinic::create([
            "ar" => [
                "name" => 'عيادة الامل',
                "description" => 'العيادة الأمل هي مركز للشفاء والعافية، مكرسة لتقديم رعاية متعاطفة ودعم لكل من يبحث عنه. مهمتنا هي زرع الأمل في كل مريض، وتعزيز الثقة بالنفس والتفاؤل في رحلتهم نحو صحة أفضل. مع فريق من المحترفين الماهرين والمرافق المتطورة، نسعى لتقديم علاج شخصي وحلول شاملة لتلبية احتياجات الرعاية الصحية المتنوعة. في العيادة الأمل، نؤمن بأن كل فرد يستحق فرصة لمستقبل أفضل وأكثر صحة.',
            ],
            "en" => [
                "name" => 'Hope Clinic',
                "description" => 'Hope Clinic is a beacon of healing and wellness, dedicated to providing compassionate care and support to all who seek it. Our mission is to instill hope in every patient, fostering a sense of optimism and empowerment on their journey towards better health. With a team of skilled professionals and state-of-the-art facilities, we strive to deliver personalized treatment and holistic solutions to address diverse medical needs. At Hope Clinic, we believe that every individual deserves a chance for a brighter, healthier future.',
            ],
            "number" => '5524568',
            "email" => 'hope@clinic.com',
            "password" => Hash::make('password'),
        ]);
        $clinic->departments()->attach(['1','3']);

        // Attach each day to the clinic
        $daysIds = ['2','4','6'];

        foreach ($daysIds as $day) {
            $clinic->facilityDays()->create([
                'day_id' => $day,
                'facility_type' => Clinic::class,
                'facility_id' => $clinic->id,
            ]);
        }

        $clinic->facilityProfile()->create([
            'facility_id' => $clinic->id,
            'facility_type' => Clinic::class,
            "address" => 'new Zarqa',
            "city" => '4',
            'phone' => '0775314544',
            "postal_code" => '55555',
            "open_hours" => '15:48:00',
            "close_hours" => '02:10:00',
            "owner_name" => 'Macaulay Mcfarland',
            "owner_phone" => '0775314544',
            "owner_email" => 'xuvyde@mailinator.com',
        ]);

        $clinic->addRole('clinic');

        
    }//end of create clinics

    private function createPharmacies()
    {
        $pharmacy = Pharmacy::create([
            "ar" => [
                "name" => 'صيدلية السلام',
                "description" => 'صيدلية السلام هي مؤسسة طبية تقدم خدمات صيدلانية متنوعة للمجتمع المحلي. تعتبر مكاناً موثوقاً للحصول على الأدوية والمستلزمات الطبية بجودة عالية وأسعار معقولة. تسعى الصيدلية دائماً لتلبية احتياجات العملاء وتوفير الرعاية الصحية الشاملة.',
            ],
            "en" => [
                "name" => 'Al Salam Pharmacy',
                "description" => 'Al Salam Pharmacy is a medical establishment providing a variety of pharmaceutical services to the local community. It serves as a trusted location for obtaining high-quality medications and medical supplies at reasonable prices. The pharmacy continually strives to meet customer needs and provide comprehensive healthcare.',
            ],
            "number" => '8521476',
            "email" => 'alsalam@gmail.com',
            "password" => Hash::make('password'),
        ]);

        // Attach each day to the clinic
        $daysIds = ['2','4','6'];

        foreach ($daysIds as $day) {
            $pharmacy->facilityDays()->create([
                'day_id' => $day,
                'facility_type' => Pharmacy::class,
                'facility_id' => $pharmacy->id,
            ]);
        }

        $pharmacy->facilityProfile()->create([
            'facility_id' => $pharmacy->id,
            'facility_type' => Pharmacy::class,
            "address" => 'new Zarqa',
            "city" => '5',
            'phone' => '0775314544',
            "postal_code" => '55555',
            "open_hours" => '15:48:00',
            "close_hours" => '02:10:00',
            "owner_name" => 'Macaulay Mcfarland',
            "owner_phone" => '0775314544',
            "owner_email" => 'xuvyde@mailinator.com',
        ]);
        $pharmacy->addRole('pharmacy');
    }//end of create Pharmacies
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phoneNumber' => '123456789',
        ]);


        $cities_per_state = array(
            "Andaman and Nicobar Islands" => array("Port Blair", "Havelock Island"),
            "Andhra Pradesh" => array("Visakhapatnam", "Vijayawada"),
            "Arunachal Pradesh" => array("Itanagar", "Tawang"),
            "Assam" => array("Guwahati", "Tezpur"),
            "Bihar" => array("Patna", "Gaya"),
            "Chandigarh" => array("Chandigarh", "Panchkula"),
            "Chhattisgarh" => array("Raipur", "Bhilai"),
            "Dadra and Nagar Haveli" => array("Silvassa", "Dadra"),
            "Daman and Diu" => array("Daman", "Diu"),
            "Delhi" => array("New Delhi", "Gurgaon"),
            "Goa" => array("Panaji", "Margao"),
            "Gujarat" => array("Ahmedabad", "Surat"),
            "Haryana" => array("Faridabad", "Gurugram"),
            "Himachal Pradesh" => array("Shimla", "Manali"),
            "Jammu and Kashmir" => array("Srinagar", "Jammu"),
            "Jharkhand" => array("Ranchi", "Jamshedpur"),
            "Karnataka" => array("Bengaluru", "Mysuru"),
            "Kerala" => array("Thiruvananthapuram", "Kochi"),
            "Ladakh" => array("Leh", "Kargil"),
            "Lakshadweep" => array("Kavaratti", "Agatti"),
            "Madhya Pradesh" => array("Bhopal", "Indore"),
            "Maharashtra" => array("Mumbai", "Pune"),
            "Manipur" => array("Imphal", "Ukhrul"),
            "Meghalaya" => array("Shillong", "Cherrapunji"),
            "Mizoram" => array("Aizawl", "Lunglei"),
            "Nagaland" => array("Kohima", "Dimapur"),
            "Odisha" => array("Bhubaneswar", "Cuttack"),
            "Puducherry" => array("Puducherry", "Karaikal"),
            "Punjab" => array("Chandigarh", "Ludhiana"),
            "Rajasthan" => array("Jaipur", "Udaipur"),
            "Sikkim" => array("Gangtok", "Namchi"),
            "Tamil Nadu" => array("Chennai", "Coimbatore"),
            "Telangana" => array("Hyderabad", "Warangal"),
            "Tripura" => array("Agartala", "Udaipur"),
            "Uttar Pradesh" => array("Lucknow", "Kanpur"),
            "Uttarakhand" => array("Dehradun", "Nainital"),
            "West Bengal" => array("Kolkata", "Darjeeling")
        );

        foreach(array_keys($cities_per_state) as $state){
            \App\Models\states::query()->create([
                'state_name' => $state,
            ]);
        }

        $index = 0;
        foreach($cities_per_state as $id => $state){
            $index++;
            foreach($state as $city){
                \App\Models\cities::query()->create([
                    'city_name' => $city,
                    'state_id' => $index
                ]);
            }
        }
        $job_categories = array(
            "Information Technology",
            "Finance",
            "Healthcare",
            "Education",
            "Engineering",
            "Sales",
            "Marketing",
            "Human Resources",
            "Customer Service",
            "Hospitality",
            "Administration",
            "Retail",
            "Legal",
            "Manufacturing",
            "Construction",
            "Design",
            "Transportation",
            "Media",
            "Art",
            "Science"
        );

        foreach($job_categories as $job){
            \App\Models\job_categories::query()->create([
                'job_category_name' => $job,
            ]);
        }
        \App\Models\Posts::factory(10)->create();
    }
}

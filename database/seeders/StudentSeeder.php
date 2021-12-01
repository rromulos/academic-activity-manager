<?php

namespace Database\Seeders;

use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    private $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student1 = [
            'name' => 'John Doe',
            'university_id' => 1,
            'email' => 'johndoe@test.com',
            'phone' => '5547912345678',
            'ra' => '123456789'
        ];
        $student2 = [
            'name' => 'Jane Doe',
            'university_id' => 1,
            'email' => 'janedoe@test.com',
            'phone' => '5547987654321',
            'ra' => '987654321'
        ];
        $this->studentRepository->create($student1);
        $this->studentRepository->create($student2);
    }
}

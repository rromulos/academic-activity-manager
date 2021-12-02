<?php

namespace Database\Seeders;

use App\Repositories\Interfaces\SubjectRepositoryInterface;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    private $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject1 = [
            'name' => 'Math',
        ];

        $subject2 = [
            'name' => 'Chemistry'
        ];

        $this->subjectRepository->create($subject1);
        $this->subjectRepository->create($subject2);
    }
}

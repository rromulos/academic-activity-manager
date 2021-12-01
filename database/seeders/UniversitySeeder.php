<?php

namespace Database\Seeders;

use App\Repositories\Interfaces\UniversityRepositoryInterface;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    private $universityRepository;

    public function __construct(UniversityRepositoryInterface $universityRepository)
    {
        $this->universityRepository = $universityRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $university1 = [
            'name' => 'Oxford'
        ];
        $university2 = [
            'name' => 'Harvard'
        ];
        $this->universityRepository->create($university1);
        $this->universityRepository->create($university2);
    }
}

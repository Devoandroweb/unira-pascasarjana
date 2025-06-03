<?php

namespace App\Repositories\Lecturer;

use LaravelEasyRepository\Repository;

interface LecturerRepository extends Repository
{

   public function insertLecture($data);
   public function updateLecture($data);
   public function deleteLecture($lecture);
   public function restore($request);
   public function forceDelete($request);
}

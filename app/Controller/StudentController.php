<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\Student;

class StudentController extends Controller
{
    private $student;
    public function __construct()
    {
        $this->student = new Student;
    }
    public function index()
    {
        $student = $this->student->get();
        return views('student.index', ['student' => $student]);
    }
}

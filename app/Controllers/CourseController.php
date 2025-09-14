<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Course;
use App\Models\Take;

use CodeIgniter\HTTP\ResponseInterface;

class CourseController extends BaseController
{
    private $course;
    private $take;

    private $rules = [
        'course_name' => 'required',
        'credits' => 'required',
    ];

    public function __construct()
    {
        $this->course = model(Course::class);
        $this->take = model(Take::class);
    }

    public function index()
    { 
        $keyword = $this->request->getGet('keyword');  
        $data = $this->course->select('courses.course_id, course_name, credits, takes.enroll_date')->like('course_name', $keyword ?? '')->join('takes', 'takes.course_id = courses.course_id', 'left')->findAll();
        

        return view('courses/index', [
            'courses' => $data
        ]);
    }

    public function create()
    {
        return view('courses/create');
    }

    public function store() {
        $data = $this->request->getPost();
        if(! $this->validateData($data, $this->rules)) {
            return redirect()->back()->withInput();
        }
        $this->course->save($data);
        return redirect()->to('/courses');
    }

    public function edit($id)
    {
        $data = $this->course->where('course_id', $id)->first();
        
        return view('courses/edit', [
            'data' => $data
        ]);
    }

     public function update($id) {
        $data = $this->request->getPost();
        if(! $this->validateData($data, $this->rules)) {
            return redirect()->back()->withInput();
        }
        $this->course->update($id, $data);
        return redirect()->to('/courses');
    }

    public function show($id)
    {
        $data = $this->course->where('course_id', $id)->first();
        
        return view('courses/detail', [
            'data' => $data
        ]);
    }

    public function delete($id)
    {
        $this->course->delete($id);
        
        return redirect()->to('/courses');
    }

    public function enroll($id) {
        $mhs = get_data_mahasiswa();
        $course = $this->course->where('course_id', $id)->first();
        $take = $this->take->where('course_id', $id)->where('nim', $mhs['nim'])->first();

        if(!$course) {
            return redirect()->back()->with('error', 'id tidak ditemukan');
        }        

        if($take) {
            return redirect()->back()->with('error', 'course sudah diambil');
        }

        $this->take->insert([
            'course_id' => $id,
            'nim' => $mhs['nim'],
            'enroll_date' => date('Y-m-d'),
        ]);

        return redirect()->back();
    }
}

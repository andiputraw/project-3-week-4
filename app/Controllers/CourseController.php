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
        
        if($this->request->isAJAX()) {
   
            return $this->response->setJSON($data);
        }
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
        return redirect()->to('/courses')->with('info', 'Course berhasil ditambahkan');
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
        return redirect()->to('/courses')->with('info', "Course dengan id: $id berhasil diupdate");
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


        if($this->request->isAJAX()) {
            return $this->response->setJSON([
                'message' => 'success'
            ]);
        }
        
        return redirect()->to('/courses')->with('info', "Course dengan id: $id berhasil dihapus");
    }

    public function enroll($idCsv) {
        log_message("debug", $idCsv);
        $ids = explode("-", $idCsv);
        log_message("debug", join(" ", $ids) );

        $mhs = get_data_mahasiswa();
        $course = $this->course->whereIn('course_id', $ids)->findAll();
        $take = $this->take->whereIn('course_id', $ids)->where('nim', $mhs['nim'])->findAll();

        if(count($take) > 0)  {
            return redirect()->back()->with('error', 'course sudah diambil');
        }

        $this->take->insertBatch(array_map(function($id) use ($mhs) {
            return [
            'course_id' => $id,
            'nim' => $mhs['nim'],
            'enroll_date' => date('Y-m-d'),
            ];
        }, $ids));

        if($this->request->isAJAX()) {
            return $this->response->setJSON([
                'message' => 'success'
            ]);
        }

        return redirect()->back()->with('info', "course $course[course_name] berhasil diambil");
    }
}

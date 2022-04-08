<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function begin()
    {
        return view('begin');
    }
    public function enterGrades(Request $request)
    {
        $student_1 = $request->name_1;
        $student_2 = $request->name_2;
        $student_3 = $request->name_3;
        $student_4 = $request->name_4;
        $student_5 = $request->name_5;

        return view('enter-grades', [
            'student_1' => $student_1,
            'student_2' => $student_2,
            'student_3' => $student_3,
            'student_4' => $student_4,
            'student_5' => $student_5
        ]);
    }
    protected function computeAverageGrade($midterm, $final)
    {
        $average = ($midterm + $final) / 2;
        return round($average, 2);
    }
    protected function giveRemarks($average)
    {
        if ($average >= 75) {
            $remark = "PASSED";
        } else {
            $remark = "FAILED";
        } 
        return $remark;
    }
    public function computeGrades(Request $request)
    {
        $student_1 = $request->student_1;
        $student_2 = $request->student_2;
        $student_3 = $request->student_3;
        $student_4 = $request->student_4;
        $student_5 = $request->student_5;

        $s1_average = $this->computeAverageGrade($request->s1_grade1, $request->s1_grade2);
        $s2_average = $this->computeAverageGrade($request->s2_grade1, $request->s2_grade2);
        $s3_average = $this->computeAverageGrade($request->s3_grade1, $request->s3_grade2);
        $s4_average = $this->computeAverageGrade($request->s4_grade1, $request->s4_grade2);
        $s5_average = $this->computeAverageGrade($request->s5_grade1, $request->s5_grade2);

        $s1_remark =  $this->giveRemarks($s1_average);
        $s2_remark =  $this->giveRemarks($s2_average);
        $s3_remark =  $this->giveRemarks($s3_average);
        $s4_remark =  $this->giveRemarks($s4_average);
        $s5_remark =  $this->giveRemarks($s5_average);
        return view('compute-grades', [
            'student_1' => $student_1,
            'student_2' => $student_2,
            'student_3' => $student_3,
            'student_4' => $student_4,
            'student_5' => $student_5,
            // Student 1 Grade
            's1_grade1' => $request->s1_grade1,
            's1_grade2' => $request->s1_grade2,
            's1_average' => $s1_average,
            's1_remark' => $s1_remark,
            // Student 2 Grade
            's2_grade1' => $request->s2_grade1,
            's2_grade2' => $request->s2_grade2,
            's2_average' => $s2_average,
            's2_remark' => $s2_remark,
            // Student 3 Grade
            's3_grade1' => $request->s3_grade1,
            's3_grade2' => $request->s3_grade2,
            's3_average' => $s3_average,
            's3_remark' => $s3_remark,
            // Student 4 Grade
            's4_grade1' => $request->s4_grade1,
            's4_grade2' => $request->s4_grade2,
            's4_average' => $s4_average,
            's4_remark' => $s4_remark,
            // Student 5 Grade
            's5_grade1' => $request->s5_grade1,
            's5_grade2' => $request->s5_grade2,
            's5_average' => $s5_average,
            's5_remark' => $s5_remark
        ]);
    }
}
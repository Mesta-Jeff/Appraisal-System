<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AppraisalController;
use App\Http\Controllers\AuthenticationController;


Route::get('/', function () {
    return view('index');
});


// ================  AUTHENTICATION CONTROL UNIT ROUTE  ===========================
Route::get('/auth/login', [AuthenticationController::class, 'login'])->name('login');
Route::get('/auth/recover-password', [AuthenticationController::class, 'recover_password'])->name('recover-password');
Route::get('/auth/reset-password', [AuthenticationController::class, 'reset_password'])->name('reset-password');


Route::post('/bulk-destroy', [SettingsController::class, 'bulk_destroy'])->name('bulk-destroy');

// ========== VIEWS IN SETTINGS FOLDER ========== 

Route::get('/settings/roles', [SettingsController::class, 'roles'])->name('roles');
Route::post('/settings/roles/add', [SettingsController::class, 'addRole'])->name('addRole');
Route::post('/settings/roles/update', [SettingsController::class, 'updateRole'])->name('updateRole');
Route::post('/settings/roles/destroy', [SettingsController::class, 'destroyRole'])->name('destroyRole');
Route::get('/fetch-roles', [SettingsController::class, 'fetch_roles'])->name('fetch-roles');

Route::get('/settings/permissions', [SettingsController::class, 'permissions'])->name('permissions');
Route::post('/settings/permissions/add', [SettingsController::class, 'addPermission'])->name('addPermission');
Route::post('/settings/permissions/update', [SettingsController::class, 'updatePermission'])->name('updatePermission');
Route::post('/settings/permissions/destroy', [SettingsController::class, 'destroyPermission'])->name('destroyPermission');
Route::get('/fetch-permissions', [SettingsController::class, 'fetch_permissions'])->name('fetch-permissions');

Route::get('/settings/departments', [SettingsController::class, 'departments'])->name('departments');
Route::post('/settings/departments/add', [SettingsController::class, 'addDepartment'])->name('addDepartment');
Route::post('/settings/departments/update', [SettingsController::class, 'updateDepartment'])->name('updateDepartment');
Route::post('/settings/departments/destroy', [SettingsController::class, 'destroyDepartment'])->name('destroyDepartment');
Route::get('/fetch-departments', [SettingsController::class, 'fetch_departments'])->name('fetch-departments');

Route::get('/settings/faculties', [SettingsController::class, 'faculties'])->name('faculties');
Route::post('/settings/faculties/add', [SettingsController::class, 'addFaculty'])->name('addFaculty');
Route::post('/settings/faculties/update', [SettingsController::class, 'updateFaculty'])->name('updateFaculty');
Route::post('/settings/faculties/destroy', [SettingsController::class, 'destroyFaculty'])->name('destroyFaculty');
Route::get('/fetch-faculties', [SettingsController::class, 'fetch_faculties'])->name('fetch-faculties');

Route::get('/settings/programme', [SettingsController::class, 'programmes'])->name('programmes');
Route::post('/settings/programmes/add', [SettingsController::class, 'addProgramme'])->name('addProgramme');
Route::post('/settings/programmes/update', [SettingsController::class, 'updateProgramme'])->name('updateProgramme');
Route::post('/settings/programmes/destroy', [SettingsController::class, 'destroyProgramme'])->name('destroyProgramme');
Route::get('/fetch-programmes', [SettingsController::class, 'fetchProgrammes'])->name('fetch-programmes');
Route::get('/fetch-department-programmes', [SettingsController::class, 'fetchDepartmentProgrammes'])->name('fetch-department-programmes');

Route::get('/settings/semester', [SettingsController::class, 'semesters'])->name('semester');
Route::post('/settings/semesters/add', [SettingsController::class, 'addSemester'])->name('addSemester');
Route::post('/settings/semesters/update', [SettingsController::class, 'updateSemester'])->name('updateSemester');
Route::post('/settings/semesters/destroy', [SettingsController::class, 'destroySemester'])->name('destroySemester');
Route::get('/fetch-semesters', [SettingsController::class, 'fetchSemesters'])->name('fetch-semesters');

Route::get('/settings/sessions', [SettingsController::class, 'sessions'])->name('sessions');
Route::post('/settings/sessions/add', [SettingsController::class, 'addSession'])->name('addSession');
Route::post('/settings/sessions/update', [SettingsController::class, 'updateSession'])->name('updateSession');
Route::post('/settings/sessions/destroy', [SettingsController::class, 'destroySession'])->name('destroySession');
Route::get('/fetch-sessions', [SettingsController::class, 'fetchSessions'])->name('fetch-sessions');

Route::get('/settings/session-semester', [SettingsController::class, 'sessionSemester'])->name('session-semester');
Route::post('/settings/session-semester/add', [SettingsController::class, 'addSessionSemester'])->name('addSessionSemester');
Route::post('/settings/session-semester/update', [SettingsController::class, 'updateSessionSemester'])->name('updateSessionSemester');
Route::post('/settings/session-semester/destroy', [SettingsController::class, 'destroySessionSemester'])->name('destroySessionSemester');
Route::get('/fetch-session-semesters', [SettingsController::class, 'fetchSessionSemesters'])->name('fetch-session-semesters');

Route::get('/settings/session-course', [SettingsController::class, 'sessionCourse'])->name('session-course');
Route::post('/settings/session-course/add', [SettingsController::class, 'addSessionCourse'])->name('addSessionCourse');
Route::post('/settings/session-course/update', [SettingsController::class, 'updateSessionCourse'])->name('updateSessionCourse');
Route::post('/settings/session-course/destroy', [SettingsController::class, 'destroySessionCourse'])->name('destroySessionCourse');
Route::get('/fetch-session-courses', [SettingsController::class, 'fetchSessionCourses'])->name('fetch-session-courses');

Route::get('/settings/courses', [SettingsController::class, 'courses'])->name('courses');
Route::post('/settings/courses/add', [SettingsController::class, 'addCourse'])->name('addCourse');
Route::post('/settings/courses/update', [SettingsController::class, 'updateCourse'])->name('updateCourse');
Route::post('/settings/courses/destroy', [SettingsController::class, 'destroyCourse'])->name('destroyCourse');
Route::get('/fetch-courses', [SettingsController::class, 'fetchCourses'])->name('fetch-courses');
Route::get('/fetch-programme-courses', [SettingsController::class, 'fetchProgrammeCourses'])->name('fetch-programme-courses');

Route::get('/settings/classes', [SettingsController::class, 'classes'])->name('classes');
Route::post('/settings/classes/add', [SettingsController::class, 'addClass'])->name('addClass');
Route::post('/settings/classes/update', [SettingsController::class, 'updateClass'])->name('updateClass');
Route::post('/settings/classes/destroy', [SettingsController::class, 'destroyClass'])->name('destroyClass');
Route::get('/fetch-levels', [SettingsController::class, 'fetchLevels'])->name('fetch-levels');


Route::get('/settings/questions', [SettingsController::class, 'questions'])->name('questions');
Route::get('/settings/system', [SettingsController::class, 'systemConfig'])->name('system-config');
Route::get('/settings/system-dictionary', [SettingsController::class, 'systemDictionary'])->name('system-dictionary');
Route::get('/settings/appraisal-configuring', [SettingsController::class, 'AppraisalConfig'])->name('appraisal-config');



// ================  APPRAISAL CONTROL UNIT ROUTE  ===========================
Route::get('/student-questionaires', [AppraisalController::class, 'studentQuestionaires'])->name('student-questionaires');
Route::get('/appraise/available-staff', [AppraisalController::class, 'availableStaff'])->name('available-staff');
Route::get('/appraise/rejected-appraisal', [AppraisalController::class, 'rejectedAppraisal'])->name('rejected-appraisal');
Route::get('/appraise/students-been-appraised', [AppraisalController::class, 'studentsBeenAppraised'])->name('students-been-appraised');

Route::get('/appraise/staff-been-appraised', [AppraisalController::class, 'staffBeenAppraised'])->name('staff-been-appraised');
Route::get('/appraise/appraisal-statistics', [AppraisalController::class, 'appraisalStatistics'])->name('appraisal-statistics');
Route::get('/appraise/lecturer-based-statistics', [AppraisalController::class, 'lecturerBasedStatistics'])->name('lecturer-based-statistics');
Route::get('/appraise/department-based-statistics', [AppraisalController::class, 'departmentBasedStatistics'])->name('department-based-statistics');
Route::get('/appraise/faculty-based-statistics', [AppraisalController::class, 'facultyBasedStatistics'])->name('faculty-based-statistics');
Route::get('/appraise/list-of-appraised-staff', [AppraisalController::class, 'listOfAppraisedStaff'])->name('list-of-appraised-staff');
Route::get('/appraise/list-of-appraised-students', [AppraisalController::class, 'listOfAppraisedStudents'])->name('list-of-appraised-students');




// ================  USER CONTROL UNIT ROUTE  ===========================

Route::get('/settings/users', [UserController::class, 'usersAccount'])->name('users-account');
Route::get('/settings/students', [UserController::class, 'Students'])->name('students');
Route::post('/add/student/bulk', [UserController::class, 'StudentsAddBulk'])->name('students-add-bulk');
Route::post('/students/edit-record', [UserController::class, 'updateStudents'])->name('students-editRecord');
Route::post('/students/destroy', [UserController::class, 'destroyStudent'])->name('destroyStudent');
Route::post('/students/promote', [UserController::class, 'promoteStudent'])->name('promoteStudent');

Route::get('/settings/staff', [UserController::class, 'Staff'])->name('staff');



// ================  STUDENT CONTROL UNIT ROUTE  ===========================

Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
Route::get('/student/examination-number', [StudentController::class, 'examinationNumber'])->name('exams-number');
Route::get('/student/seat-number', [StudentController::class, 'seatNumber'])->name('seat-number');
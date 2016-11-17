<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//
//首页的路由
Route::get("/", ["uses" => "IndexController@index"]);
//显示全部课程的路由
//Route::get('course/showALLCourse',["uses"=>"CourseController@showALLCourse"]);
Route::get('course/showCourseInfo/{courseId}/{token}', ['middleware' => 'studentLoginCheck', "uses" => "CourseController@showCourseInfo"]);
//成功页面
Route::get('success/{token}', ['middleware' => 'studentLoginCheck', function () {
    return view('success');
}]);
//失败页面
Route::get('error/{token}', ['middleware' => 'studentLoginCheck', function () {
    return view('error');
}]);
//未登录页面
Route::get('notLogin', function () {
    return view('notLogin');
});
//视频观看页面
Route::get('course/watchVideo/{sectionId}/{token}', ['middleware' => 'studentLoginCheck', "uses" => "CourseController@watchVideo"]);
//Student下的控制器
Route::post('student/getStudentInfo/{token}', ['middleware' => 'studentLoginCheck', "uses" => "StudentController@getStudentInfo"]);

Route::get('student/mySpace/{token}', ['middleware' => 'studentLoginCheck', "uses" => "StudentController@mySpace"]);
Route::get('student/myHomework/{token}', ['middleware' => 'studentLoginCheck', "uses" => "StudentController@myHomework"]);
Route::get('student/allHomework/{course_id}/{token}', ['middleware' => 'studentLoginCheck', "uses" => "StudentController@allHomework"]);

//upload
////加权限
Route::post('upload/submitHomework/{token}', ['middleware' => 'studentLoginCheck', "uses" => "UploadController@submitHomework"]);
Route::post('api/upload/uploadFile/{token}', ['middleware' => ['loginCheck','permissionCheck:UploadUploadFile'], "uses" => "UploadController@uploadFile"]);
//DownloadController
////加权限
Route::get('downloadFile/getDownloadFile/{downloadFilename}/{token}', ['middleware' => 'studentLoginCheck', "uses" => "DownloadFileController@getDownloadFile"]);
Route::get('api/downloadFile/getHomeworkPack/{token}/{homeworkId}', ['middleware' => ['loginCheck', 'permissionCheck:DownloadFileGetPack'], "uses" => "DownloadFileController@getHomeworkPack"]);

//Login控制器下的路由
Route::post('api/login/login', ['uses' => 'LoginController@login']);
Route::post('api/login/logout', ['uses' => 'LoginController@logout']);
Route::post('api/login/studentLogin', ['uses' => 'LoginController@studentLogin']);
Route::post('api/login/studentLogout', ['uses' => 'LoginController@studentLogout']);

//InstituteController下的路由
Route::post('api/institute/addInstitute/{token}', ['middleware' => 'loginCheck', 'uses' => 'InstituteController@addInstitute']);

//InstituteController
Route::post('api/institute/addInstitute/{token}', ['middleware' => ['loginCheck', 'permissionCheck:InstituteAddInstitute'], 'uses' => 'InstituteController@addInstitute']);
Route::post('api/institute/deleteInstituteById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:InstituteDeleteInstitute'], 'uses' => 'InstituteController@deleteInstituteById']);
Route::post('api/institute/modifyInstituteById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:InstituteModifyInstituteById'], 'uses' => 'InstituteController@modifyInstituteById']);
Route::post('api/institute/getAllInstitute/{token}', ['middleware' => ['loginCheck', 'permissionCheck:InstituteGetAllInstitute'], 'uses' => 'InstituteController@getAllInstitute']);
//DepartmentController
Route::post('api/department/addDepartmentByInstituteId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:DepartmentAddDepartmentByInstituteId'], 'uses' => 'DepartmentController@addDepartmentByInstituteId']);
Route::post('api/department/deleteDepartmentById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:DepartmentDeleteDepartmentById'], 'uses' => 'DepartmentController@deleteDepartmentById']);
Route::post('api/department/modifyDepartmentById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:DepartmentModifyDepartmentById'], 'uses' => 'DepartmentController@modifyDepartmentById']);
Route::post('api/department/getAllDepartmentByInstituteId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:DepartmentGetAllDepartmentByInstituteId'], 'uses' => 'DepartmentController@getAllDepartmentByInstituteId']);
//MajorController
Route::post('api/major/addMajorByDepartmentId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:MajorAddMajorByDepartmentId'], 'uses' => 'MajorController@addMajorByDepartmentId']);
Route::post('api/major/deleteMajorById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:MajorDeleteMajorById'], 'uses' => 'MajorController@deleteMajorById']);
Route::post('api/major/modifyMajorById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:MajorModifyMajorById'], 'uses' => 'MajorController@modifyMajorById']);
Route::post('api/major/getAllMajorByDepartmentId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:MajorGetAllMajorByDepartmentId'], 'uses' => 'MajorController@getAllMajorByDepartmentId']);
//ClassesController
Route::post('api/classes/addClassesByMajorId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ClassesAddClassesByMajorId'], 'uses' => 'ClassesController@addClassesByMajorId']);
Route::post('api/classes/deleteClassesById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ClassesDeleteClassesById'], 'uses' => 'ClassesController@deleteClassesById']);
Route::post('api/classes/modifyClassesById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ClassesModifyClassesById'], 'uses' => 'ClassesController@modifyClassesById']);
Route::post('api/classes/getAllClassesByMajorId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ClassesGetAllClassesByMajorId'], 'uses' => 'ClassesController@getAllClassesByMajorId']);
//AdministratorAndClassController
Route::post('api/administratorAndClasses/addAdministratorAndClasses/{token}', ['middleware' => ['loginCheck', 'permissionCheck:AdministratorAndClassAddAdministratorAndClasses'], 'uses' => 'AdministratorAndClassController@addAdministratorAndClasses']);
Route::post('api/administratorAndClasses/deleteAdministratorAndClasses/{token}', ['middleware' => ['loginCheck', 'permissionCheck:AdministratorAndClassDeleteAdministratorAndClasses'], 'uses' => 'AdministratorAndClassController@deleteAdministratorAndClasses']);
Route::post('api/administratorAndClasses/getAllAdministratorAndClasses/{token}', ['middleware' => ['loginCheck', 'permissionCheck:AdministratorAndClassGetAllAdministratorAndClasses'], 'uses' => 'AdministratorAndClassController@getAllAdministratorAndClasses']);
//AdministratorAndCourseController
Route::post('api/administratorAndCourse/addAdministratorAndCourse/{token}', ['middleware' => ['loginCheck', 'permissionCheck:AdministratorAndCourseAddAdministratorAndCourse'], 'uses' => 'AdministratorAndCourseController@addAdministratorAndCourse']);
Route::post('api/administratorAndCourse/deleteAdministratorAndCourse/{token}', ['middleware' => ['loginCheck', 'permissionCheck:AdministratorAndCourseDeleteAdministratorAndCourse'], 'uses' => 'AdministratorAndCourseController@deleteAdministratorAndCourse']);
Route::post('api/administratorAndCourse/getAllAdministratorAndCourse/{token}', ['middleware' => ['loginCheck', 'permissionCheck:AdministratorAndCourseGetAllAdministratorAndCourse'], 'uses' => 'AdministratorAndCourseController@getAllAdministratorAndCourse']);
//ClassesAndCourseController
Route::post('api/classesAndCourse/addClassesAndCourse/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ClassesAndCourseAddClassesAndCourse'], 'uses' => 'ClassesAndCourseController@addClassesAndCourse']);
Route::post('api/classesAndCourse/deleteClassesAndCourse/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ClassesAndCourseDeleteClassesAndCourse'], 'uses' => 'ClassesAndCourseController@deleteClassesAndCourse']);
Route::post('api/classesAndCourse/getAllClassesAndCourse/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ClassesAndCourseGetAllClassesAndCourse'], 'uses' => 'ClassesAndCourseController@getAllClassesAndCourse']);

//AdministratorController下的路由
Route::post('api/administrator/addAdministrator/{token}', ['middleware' => ['loginCheck', 'permissionCheck:AdministratorAddAdministrator'], 'uses' => 'AdministratorController@addAdministrator']);
Route::post('api/administrator/deleteAdministratorById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:AdministratorDeleteAdministrator'], 'uses' => 'AdministratorController@deleteAdministratorById']);
Route::post('api/administrator/getAllAdministrator/{token}', ['middleware' => ['loginCheck', 'permissionCheck:AdministratorGetAllAdministrator'], 'uses' => 'AdministratorController@getAllAdministrator']);
//CourseController
Route::post('api/course/addCourse/{token}', ['middleware' => ['loginCheck', 'permissionCheck:CourseAddCourse'], 'uses' => 'CourseController@addCourse']);
Route::post('api/course/deleteCourseById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:CourseDeleteCourseById'], 'uses' => 'CourseController@deleteCourseById']);
Route::post('api/course/modifyCourseById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:CourseModifyCourseById'], 'uses' => 'CourseController@modifyCourseById']);
Route::post('api/course/getAllCoursesByAdministratorId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:CourseGetAllCoursesByAdministratorId'], 'uses' => 'CourseController@getAllCoursesByAdministratorId']);
//ChapterController
Route::post('api/chapter/addChapterByCourseId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ChapterAddChapterByCourseId'], 'uses' => 'ChapterController@addChapterByCourseId']);
Route::post('api/chapter/deleteChapterById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ChapterDeleteChapterById'], 'uses' => 'ChapterController@deleteChapterById']);
Route::post('api/chapter/modifyChapterById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ChapterModifyChapterById'], 'uses' => 'ChapterController@modifyChapterById']);
Route::post('api/chapter/getAllChapterByCourseID/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ChapterGetAllChapterByCourseID'], 'uses' => 'ChapterController@getAllChapterByCourseID']);
//SectionController
Route::post('api/section/addSectionByChapterId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:SectionAddSectionByChapterId'], 'uses' => 'SectionController@addSectionByChapterId']);
Route::post('api/section/deleteSectionById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:SectionDeleteSection'], 'uses' => 'SectionController@deleteSectionById']);
Route::post('api/section/modifySectionById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:SectionModifySection'], 'uses' => 'SectionController@modifySectionById']);
Route::post('api/section/getAllSectionByChapterId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:SectionGetAllSectionByChapterID'], 'uses' => 'SectionController@getAllSectionByChapterId']);
//ResourceController
Route::post('api/resource/addResourceBySectionId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ResourceAddResourceBySectionId'], 'uses' => 'ResourceController@addResourceBySectionId']);
Route::post('api/resource/deleteResourceById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ResourceDeleteResourceById'], 'uses' => 'ResourceController@deleteResourceById']);
Route::post('api/resource/modifyResourceById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ResourceModifyResourceById'], 'uses' => 'ResourceController@modifyResourceById']);
Route::post('api/resource/getAllResourceBySectionId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ResourceGetAllResourceBySectionId'], 'uses' => 'ResourceController@getAllResourceBySectionId']);
Route::post('api/resource/getResourceById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ResourceGetResourceById'], 'uses' => 'ResourceController@getResourceById']);

//RoleController
Route::post('api/role/addRole/{token}', ['middleware' => ['loginCheck', 'permissionCheck:RoleAddRole'], 'uses' => 'RoleController@addRole']);
Route::post('api/role/deleteRoleById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:RoleDeleteRoleById'], 'uses' => 'RoleController@deleteRoleById']);
Route::post('api/role/modifyRoleById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:RoleModifyRoleById'], 'uses' => 'RoleController@modifyRoleById']);
Route::post('api/role/getAllRole/{token}', ['middleware' => ['loginCheck', 'permissionCheck:RoleGetAllRole'], 'uses' => 'RoleController@getAllRole']);
//PermissionController
Route::post('api/permission/addPermission/{token}', ['middleware' => ['loginCheck', 'permissionCheck:PermissionAddPermission'], 'uses' => 'PermissionController@addPermission']);
Route::post('api/permission/deletePermissionById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:PermissionDeletePermissionById'], 'uses' => 'PermissionController@deletePermissionById']);
Route::post('api/permission/getAllPermission/{token}', ['middleware' => ['loginCheck', 'permissionCheck:PermissionGetAllPermission'], 'uses' => 'PermissionController@getAllPermission']);
//AdministratorAndRoleController
Route::post('api/administratorAndRole/addAdministratorAndRole/{token}', ['middleware' => ['loginCheck', 'permissionCheck:AdministratorAndRoleAddAdministratorAndRole'], 'uses' => 'AdministratorAndRoleController@addAdministratorAndRole']);
Route::post('api/administratorAndRole/deleteAdministratorAndRole/{token}', ['middleware' => ['loginCheck', 'permissionCheck:AdministratorAndRoleDeleteAdministratorAndRole'], 'uses' => 'AdministratorAndRoleController@deleteAdministratorAndRole']);
Route::post('api/administratorAndRole/getAllAdministratorAndRole/{token}', ['middleware' => ['loginCheck', 'permissionCheck:AdministratorAndRoleGetAllAdministratorAndRole'], 'uses' => 'AdministratorAndRoleController@getAllAdministratorAndRole']);
//RoleAndPermissionController
Route::post('api/roleAndPermission/addRoleAndPermission/{token}', ['middleware' => ['loginCheck', 'permissionCheck:RoleAndPermissionAddRoleAndPermission'], 'uses' => 'RoleAndPermissionController@addRoleAndPermission']);
Route::post('api/roleAndPermission/deleteRoleAndPermission/{token}', ['middleware' => ['loginCheck', 'permissionCheck:RoleAndPermissionDeleteRoleAndPermission'], 'uses' => 'RoleAndPermissionController@deleteRoleAndPermission']);
Route::post('api/roleAndPermission/getAllRoleAndPermission/{token}', ['middleware' => ['loginCheck', 'permissionCheck:RoleAndPermissionGetAllAdministratorAndRole'], 'uses' => 'RoleAndPermissionController@getAllRoleAndPermission']);
//excel下
Route::post('api/excel/getExcelInfoAndReturn/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ExcelGetExcelInfoAndReturn'], 'uses' => 'ExcelController@getExcelInfoAndReturn']);
Route::post('api/excel/uploadExcel/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ExcelUploadExcel'], 'uses' => 'ExcelController@uploadExcel']);


//ImportController导入控制器
Route::post('api/import/importAdministrator/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ImportImportAdministrator'], 'uses' => 'ImportController@importAdministrator']);
Route::post('api/import/importStudent/{token}', ['middleware' => ['loginCheck', 'permissionCheck:ImportImportStudent'], 'uses' => 'ImportController@importStudent']);
//homework下的路由
Route::post('api/homework/addHomeworkByCourseId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:HomeworkAddHomework'], 'uses' => 'HomeworkController@addHomeworkByCourseId']);
Route::post('api/homework/deleteHomeworkById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:HomeworkDeleteHomeworkById'], 'uses' => 'HomeworkController@deleteHomeworkById']);
Route::post('api/homework/modifyHomeworkById/{token}', ['middleware' => ['loginCheck', 'permissionCheck:HomeworkModifyHomeworkById'], 'uses' => 'HomeworkController@modifyHomeworkById']);
Route::post('api/homework/getAllHomeworkByCourseId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:HomeworkGetAllHomeworkByCourseId'], 'uses' => 'HomeworkController@getAllHomeworkByCourseId']);
//StudentAndHomeWorkByHomework
Route::post('api/studentAndHomeWork/getStudentAndHomeWorkByHomeworkId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:StudentAndHomeWorkGetAll'], 'uses' => 'studentAndHomeWorkController@getStudentAndHomeWorkByHomeworkId']);
Route::post('api/studentAndHomeWork/modifyStudentAndHomeWorkByHomeworkId/{token}', ['middleware' => ['loginCheck', 'permissionCheck:StudentAndHomeWorkModify'], 'uses' => 'studentAndHomeWorkController@modifyStudentAndHomeWorkByHomeworkId']);


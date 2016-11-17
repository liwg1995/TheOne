<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();

        DB::table('permissions')->insert([
            'permissionName' => "InstituteAddInstitute",
            'permissionMean' =>"添加学院",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "InstituteDeleteInstitute",
            'permissionMean' =>"删除学院",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "InstituteModifyInstituteById",
            'permissionMean' =>"修改学院信息",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "InstituteGetAllInstitute",
            'permissionMean' =>"得到所有学院",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        //系管理下的权限
        DB::table('permissions')->insert([
            'permissionName' => "DepartmentAddDepartmentByInstituteId",
            'permissionMean' =>"添加系",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "DepartmentDeleteDepartmentById",
            'permissionMean' =>"删除系",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "DepartmentModifyDepartmentById",
            'permissionMean' =>"修改系",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "DepartmentGetAllDepartmentByInstituteId",
            'permissionMean' =>"通过学院得到所有系",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        //专业管理下的权限
        DB::table('permissions')->insert([
            'permissionName' => "MajorGetAllMajorByDepartmentId",
            'permissionMean' =>"根据系得到所有用专业",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "MajorAddMajorByDepartmentId",
            'permissionMean' =>"添加专业",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "MajorDeleteMajorById",
            'permissionMean' =>"删除专业",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "MajorModifyMajorById",
            'permissionMean' =>"修改专业",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        //班级管理下的权限
        DB::table('permissions')->insert([
            'permissionName' => "ClassesAddClassesByMajorId",
            'permissionMean' =>"添加班级",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ClassesDeleteClassesById",
            'permissionMean' =>"删除班级",


            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ClassesModifyClassesById",
            'permissionMean' =>"修改班级",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ClassesGetAllClassesByMajorId",
            'permissionMean' =>"根据专业得到所有班级",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        // 管理员－班级管理权限
        DB::table('permissions')->insert([
            'permissionName' => "AdministratorAndClassAddAdministratorAndClasses",
            'permissionMean' =>"增加管理员与班级信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "AdministratorAndClassDeleteAdministratorAndClasses",
            'permissionMean' =>"删除管理员与班级信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "AdministratorAndClassGetAllAdministratorAndClasses",
            'permissionMean' =>"得到所有管理员与班级信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        // 管理员－课程 权限
        DB::table('permissions')->insert([
            'permissionName' => "AdministratorAndCourseAddAdministratorAndCourse",
            'permissionMean' =>"增加管理员与课程信息",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "AdministratorAndCourseDeleteAdministratorAndCourse",
            'permissionMean' =>"删除管理员与课程信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "AdministratorAndCourseGetAllAdministratorAndCourse",
            'permissionMean' =>"得到所有管理员与课程信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        //班级－课程权限
        DB::table('permissions')->insert([
            'permissionName' => "ClassesAndCourseAddClassesAndCourse",
            'permissionMean' =>"增加班级与课程信息",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ClassesAndCourseDeleteClassesAndCourse",
            'permissionMean' =>"删除班级与课程信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ClassesAndCourseGetAllClassesAndCourse",
            'permissionMean' =>"得到所有班级与课程信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        // 管理员用户管理权限
        DB::table('permissions')->insert([
            'permissionName' => "AdministratorAddAdministrator",
            'permissionMean' =>"增加一个管理员",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "AdministratorDeleteAdministrator",
            'permissionMean' =>"删除一个管理员",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "AdministratorGetAllAdministrator",
            'permissionMean' =>"得到所有一个管理员",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        //课程权限
        DB::table('permissions')->insert([
            'permissionName' => "CourseAddCourse",
            'permissionMean' =>"增加课程",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "CourseDeleteCourseById",
            'permissionMean' =>"删除课程",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "CourseModifyCourseById",
            'permissionMean' =>"修改课程",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "CourseGetAllCoursesByAdministratorId",
            'permissionMean' =>"得到管理员对应的课程",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        //章管理权限
        DB::table('permissions')->insert([
            'permissionName' => "ChapterAddChapterByCourseId",
            'permissionMean' =>"添加章",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ChapterDeleteChapterById",
            'permissionMean' =>"删除章",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ChapterModifyChapterById",
            'permissionMean' =>"修改章",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ChapterGetAllChapterByCourseID",
            'permissionMean' =>"得到所有章",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        //节管理权限
        DB::table('permissions')->insert([
            'permissionName' => "SectionAddSectionByChapterId",
            'permissionMean' =>"添加节",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "SectionDeleteSection",
            'permissionMean' =>"删除节",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "SectionModifySection",
            'permissionMean' =>"修改节信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "SectionGetAllSectionByChapterID",
            'permissionMean' =>"得到所有节信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        //角色控制器权限
        DB::table('permissions')->insert([
            'permissionName' => "RoleAddRole",
            'permissionMean' =>"添加角色",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "RoleDeleteRoleById",
            'permissionMean' =>"删除角色",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "RoleModifyRoleById",
            'permissionMean' =>"修改角色信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "RoleGetAllRole",
            'permissionMean' =>"得到所有角色",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);

        //权限控制器 权限
        DB::table('permissions')->insert([
            'permissionName' => "PermissionAddPermission",
            'permissionMean' =>"添加权限",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "PermissionDeletePermissionById",
            'permissionMean' =>"删除权限",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "PermissionGetAllPermission",
            'permissionMean' =>"得到所有权限",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        // 用户－角色控制器 权限
        DB::table('permissions')->insert([
            'permissionName' => "AdministratorAndRoleAddAdministratorAndRole",
            'permissionMean' =>"添加用户和角色的信息",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "AdministratorAndRoleDeleteAdministratorAndRole",
            'permissionMean' =>"删除用户和角色的信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "AdministratorAndRoleGetAllAdministratorAndRole",
            'permissionMean' =>"得到所有用户和角色的信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        // 角色－权限控制器权限
        DB::table('permissions')->insert([
            'permissionName' => "RoleAndPermissionAddRoleAndPermission",
            'permissionMean' =>"添加角色和权限的信息",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "RoleAndPermissionDeleteRoleAndPermission",
            'permissionMean' =>"删除角色和权限的信息",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "RoleAndPermissionGetAllAdministratorAndRole",
            'permissionMean' =>"得到所有角色和权限的信息",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);

        //资源权限
        DB::table('permissions')->insert([
            'permissionName' => "ResourceAddResourceBySectionId",
            'permissionMean' =>"添加资源",
            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ResourceDeleteResourceById",
            'permissionMean' =>"删除资源",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ResourceModifyResourceById",
            'permissionMean' =>"修改资源信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ResourceGetAllResourceBySectionId",
            'permissionMean' =>"得到所有资源信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ResourceGetResourceById",
            'permissionMean' =>"得到某个资源信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        //上传文件的权限
        DB::table('permissions')->insert([
            'permissionName' => "UploadUploadFile",
            'permissionMean' =>"上传文件",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        //电子表格上传
        DB::table('permissions')->insert([
            'permissionName' => "ExcelGetExcelInfoAndReturn",
            'permissionMean' =>"得到电子表格信息并返回",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ExcelUploadExcel",
            'permissionMean' =>"上传电子表格",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        //Import下的权限
        DB::table('permissions')->insert([
            'permissionName' => "ImportImportAdministrator",
            'permissionMean' =>"导入管理员信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "ImportImportStudent",
            'permissionMean' =>"导入学生信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        //作业的权限
        DB::table('permissions')->insert([
            'permissionName' => "HomeworkAddHomework",
            'permissionMean' =>"添加作业",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "HomeworkDeleteHomeworkById",
            'permissionMean' =>"删除作业",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "HomeworkModifyHomeworkById",
            'permissionMean' =>"修改作业信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "HomeworkGetAllHomeworkByCourseId",
            'permissionMean' =>"得到所有作业信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "StudentAndHomeWorkGetAll",
            'permissionMean' =>"得到所有学生和的作业信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "StudentAndHomeWorkModify",
            'permissionMean' =>"修改学生和的作业信息",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'permissionName' => "DownloadFileGetPack",
            'permissionMean' =>"打包下载学生的作业",

            "created_at"=>\Carbon\Carbon::now(),
            "updated_at"=>\Carbon\Carbon::now()
        ]);

    }
}

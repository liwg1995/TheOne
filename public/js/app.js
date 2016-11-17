angular.module('TheyOneAdmin', ['ngRoute', 'ngCookies', 'angularFileUpload', 'ui.bootstrap'])
    .factory('ServerComm', ['$http', '$cookieStore', '$location', function ($http, $cookieStore, $location) {
        var comm = function (api, data, callback, errorCallback) {
            var url = '/api/' + api;
            if ($cookieStore.get('token')) {
                url += '/' + $cookieStore.get('token');
            }
            $http({
                method: 'POST',
                url: url,
                data: data
            }).then(function (response) {
                switch (response.data.status) {
                    case 'OK':
                        callback(response.data.content);
                        console.log(response.data.content);
                        break;
                    case 'ERROR':
                        if (typeof errorCallback === 'undefined') {
                            alert(response.data.content);
                            //console.log(response.data.content);
                        }
                        else {
                            errorCallback(response.data.content)
                            //console.log(response.data.content);
                        }
                        break;
                    case 'NOT_LOGGED_IN':
                        $location.path('/logout');
                        break;
                    case 'PERMISSION_DENIED':
                        alert(response.data.content);
                        break;
                }

                // this callback will be called asynchronously
                // when the response is available
            }, function (response) {
                errorCallback(response);
                //console.log(response.data.content);

                // called asynchronously if an error occurs
                // or server returns response with an error status.
            });
        };
        var commGet = function (api, data) {
            var url = '/api/' + api;
            if ($cookieStore.get('token')) {
                url += '/' + $cookieStore.get('token');
            }
            $http({
                method: 'GET',
                url: url,
                data: data
            })
        };

        return {
            comm: comm,
            commGet: commGet
        };
    }])
    .constant('PROJECT_NAME', 'TheyOne在线课堂 - 后台管理')
    .config(['$routeProvider', function ($routeProvider) {
        $routeProvider
            .when('/login', {
                templateUrl: 'admin_partials/login.html',
                controller: 'LoginController'
            })
            .when('/dashboard', {
                templateUrl: 'admin_partials/dashboard.html',
                controller: 'DashboardController'
            })
            .when('/courses', {
                templateUrl: 'admin_partials/courses.html',
                controller: 'CourseController'
            })
            .when('/roles', {
                templateUrl: 'admin_partials/roles.html',
                controller: 'RoleController'
            })
            .when('/institutes', {
                templateUrl: 'admin_partials/institutes.html',
                controller: 'InstituteController'
            })

            .when('/departments/:instituteId', {
                templateUrl: 'admin_partials/departments.html',
                controller: 'DepartmentController'
            })
            .when('/majors/:departmentId', {
                templateUrl: 'admin_partials/majors.html',
                controller: 'MajorController'
            })
            .when('/classes/:majorId', {
                templateUrl: 'admin_partials/classes.html',
                controller: 'ClassController'
            })

            .when('/users', {
                templateUrl: 'admin_partials/users.html',
                controller: 'UserController'
            })
            .when('/chapters/:courseId/:courseName/', {
                templateUrl: 'admin_partials/chapters.html',
                controller: 'ChapterController'
            })
            .when('/sections/:chapterId', {
                templateUrl: 'admin_partials/sections.html',
                controller: 'SectionController'
            })
            .when('/setRoles/:administrator_id/:nickname/', {
                templateUrl: 'admin_partials/setRoles.html',
                controller: 'SetRoleController'
            })
            .when('/setPermissions/:role_id/:roleName/', {
                templateUrl: 'admin_partials/setPermissions.html',
                controller: 'SetPermissionController'
            })
            .when('/resources/:sectionId', {
                templateUrl: 'admin_partials/resources.html',
                controller: 'ResourceController'
            })
            .when('/resourceEditor/:id/:sectionId/', {
                templateUrl: 'admin_partials/resourceEditor.html',
                controller: 'ResourceEditorController'
            })
            .when('/addClasses/:courseId/:courseName/', {
                templateUrl: 'admin_partials/addClasses.html',
                controller: 'AddClassesController'
            })
            .when('/uploadAdministrators', {
                templateUrl: 'admin_partials/uploadAdministrators.html',
                controller: 'UploadAdministratorController'
            })
            .when('/uploadStudents', {
                templateUrl: 'admin_partials/uploadStudents.html',
                controller: 'UploadStudentController'
            })
            .when('/uploadHomework', {
                templateUrl: 'admin_partials/uploadHomework.html',
                controller: 'UploadHomeworkController'
            })
            .when('/judgeHomework', {
                templateUrl: 'admin_partials/judgeHomework.html',
                controller: 'JudgeHomeworkController'
            })
            .when('/showHomework/:courseId/:courseName/', {
                templateUrl: 'admin_partials/showHomework.html',
                controller: 'ShowHomeworkController'
            })
            .when('/showJudgePage/:homeworkId', {
                templateUrl: 'admin_partials/showJudgePage.html',
                controller: 'ShowJudgePageController'
            })
            .when('/addHomework/:courseId/:courseName/', {
                templateUrl: 'admin_partials/addHomework.html',
                controller: 'AddHomeworkController'
            })
            .when('/logout', {
                template: '',
                controller: 'LogoutController'
            }).otherwise({
            redirectTo: '/dashboard'
        });
    }])
    .controller('RootController', ['$scope', '$cookieStore', '$location', 'PROJECT_NAME', function ($scope, $cookieStore, $location, projectName) {

        var $this = this;

        $this.projectName = projectName;
        $this.moduleName = '';
        $this.isLogin = false;

        $scope.$on('$routeChangeSuccess', function (event, data) {
            console.log(event);
            console.log(data);
        });

        $scope.$on('onModuleNameChange', function (event, moduleName) {
            $this.moduleName = moduleName;
        });

        $scope.$on('onLogin', function (event, token) {
            $cookieStore.put('token', token);
            $this.isLogin = true;
            $location.path('/dashboard');
        });

        $scope.$on('onLogout', function (event, data) {
            $cookieStore.remove('token');
            $this.isLogin = false;
            $location.path('/login');
        });

        $scope.init = function () {
            if ($cookieStore.get('token')) {
                $this.isLogin = true;
//                $location.path('/dashboard');
            }
            else {
                $scope.$emit('onLogout');
            }
        }();

    }])
    .controller('LoginController', ['$scope', '$location', 'ServerComm', function ($scope, $location, serverComm) {
        $scope.$emit('onModuleNameChange', 'Login');

        $scope.loginPostData = {
            username: '',
            password: ''
        };

        $scope.login = function () {
            serverComm.comm('login/login', $scope.loginPostData, function (data) {
                $scope.$emit('onLogin', data.token);
            });
        }
    }])
    .controller('LogoutController', ['$scope', function ($scope) {
        $scope.$emit('onLogout');
    }])
    .controller('TemplateController', ['$scope', '$location', 'ServerComm', function ($scope, $location, serverComm) {
        $scope.$emit('onModuleNameChange', 'Template');

        $scope.templates = [];

        $scope.refresh = function () {
            serverComm.comm('template/getTemplateList', {}, function (data) {
                $scope.templates = data;
            });
        };

        $scope.showEditor = function (index) {
            $location.path('/template/' + $scope.templates[index].filename);
        };

        $scope.refresh();

    }])
    .controller('DashboardController', ['$scope', function ($scope) {
        $scope.$emit('onModuleNameChange', 'Dashboard');
    }])
    .controller('CourseController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm) {
        $scope.$emit('onModuleNameChange', 'Course');
        $scope.courses = [];

        $scope.refresh = function () {
            serverComm.comm('course/getAllCoursesByAdministratorId', {}, function (data) {
                $scope.courses = data;//执行此方法的时候从后台取得数据
                console.log(data);
            });
        };

        $scope.getCourse = function (course) {
            if (course == null) {
                return {
                    id: 0,
                    courseName: "",
                    courseIntro: "",
                    coursePicture: "",
                    sequence: 1
                };
            }
            else {
                //return $scope.banners[index];
                return course;
            }
        };

        //$scope.setVisible = function(banner, isVisible) {
        //    //var banner = $scope.getBanner(index);
        //    serverComm.comm('banner/setVisibleById', {id: banner.id, isVisible: isVisible}, function (data) {
        //        banner.isVisible = isVisible;
        //    });
        //};

        $scope.showEditor = function (course) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/courseEditor.html',
                controller: 'CourseEditorController',
                resolve: {
                    course: $scope.getCourse(course)
                }
            });

            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };
        $scope.delete = function (course) {
            //var banner = $scope.getBanner(index);
            if (confirm("确定删除此课程吗")) {
                serverComm.comm('course/deleteCourseById', {id: course.id}, function () {
                    $scope.refresh();
                });
            }
        };

        $scope.refresh();
    }])
    .controller('CourseEditorController', ['$scope', '$location', '$window', '$cookieStore', '$uibModalInstance', 'ServerComm', 'course', 'FileUploader', function ($scope, $location, $window, $cookieStore, $uibModalInstance, serverComm, course, FileUploader) {
        $scope.$emit('onModuleNameChange', 'Course');

        $scope.course = angular.copy(course);
        var uploader = $scope.uploader = new FileUploader({
            url: 'api/upload/uploadFile' + '/' + $cookieStore.get('token'),
            autoUpload: true
        });
        uploader.uploadAll();
        // FILTERS
        //uploader.autoUpload = true;
        console.log(uploader);
        uploader.onSuccessItem = function (fileItem, response, status, headers) {
            $scope.course.coursePicture = response.content;
            console.log(response.content);
        };

        //console.info('uploader', uploader);
        $scope.submit = function () {
            if ($scope.course.id == 0) {
                console.log($scope.course);
                serverComm.comm('course/addCourse', $scope.course, function () {
                    $uibModalInstance.close();
                });
            }
            else {
                serverComm.comm('course/modifyCourseById', $scope.course, function () {
                    $uibModalInstance.close();
                });
            }

        };
        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }])

    .controller('DepartmentController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', '$routeParams', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm, $routeParams) {
        $scope.$emit('onModuleNameChange', 'Institute');
        $scope.departments = [];

        $scope.refresh = function () {
            serverComm.comm('department/getAllDepartmentByInstituteId', {institute_id: $routeParams.instituteId}, function (data) {
                $scope.departments = data;//执行此方法的时候从后台取得数据
            });
        };

        $scope.getDepartment = function (department) {
            if (department == null) {
                return {
                    id: 0,
                    departmentName: "",
                    institute_id: $routeParams.instituteId,
                    sequence: 1
                };
            }
            else {
                //return $scope.banners[index];
                return department;
            }
        };
        $scope.showEditor = function (department) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/departmentEditor.html',
                controller: 'DepartmentEditorController',
                resolve: {
                    department: $scope.getDepartment(department)
                }
            });

            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };
        $scope.delete = function (department) {
            //var banner = $scope.getBanner(index);
            if (confirm("确定删除此课程吗")) {
                serverComm.comm('department/deleteDepartmentById', {id: department.id}, function () {
                    $scope.refresh();
                });
            }
        };

        $scope.refresh();
    }])
    .controller('DepartmentEditorController', ['$scope', '$location', '$window', '$cookieStore', '$uibModalInstance', 'ServerComm', 'department', function ($scope, $location, $window, $cookieStore, $uibModalInstance, serverComm, department) {
        $scope.$emit('onModuleNameChange', 'Institute');

        $scope.department = angular.copy(department);
        $scope.submit = function () {
            if ($scope.department.id == 0) {
                console.log($scope.department);
                serverComm.comm('department/addDepartmentByInstituteId', $scope.department, function () {
                    $uibModalInstance.close();
                });
            }
            else {
                serverComm.comm('department/modifyDepartmentById', $scope.department, function () {
                    $uibModalInstance.close();
                });
            }

        };
        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }])


    .controller('MajorController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', '$routeParams', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm, $routeParams) {
        $scope.$emit('onModuleNameChange', 'Institute');
        $scope.majors = [];
        $scope.refresh = function () {
            serverComm.comm('major/getAllMajorByDepartmentId', {department_id: $routeParams.departmentId}, function (data) {
                $scope.majors = data;//执行此方法的时候从后台取得数据
            });
        };
        $scope.getMajor = function (major) {
            if (major == null) {
                return {
                    id: 0,
                    majorName: "",
                    department_id: $routeParams.departmentId,
                    sequence: 1
                };
            }
            else {
                //return $scope.banners[index];
                return major;
            }
        };
        $scope.showEditor = function (major) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/majorEditor.html',
                controller: 'MajorEditorController',
                resolve: {
                    major: $scope.getMajor(major)
                }
            });
            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };
        $scope.delete = function (major) {
            //var banner = $scope.getBanner(index);
            if (confirm("确定删除此专业吗")) {
                serverComm.comm('major/deleteMajorById', {id: major.id}, function () {
                    $scope.refresh();
                });
            }
        };

        $scope.refresh();
    }])
    .controller('MajorEditorController', ['$scope', '$location', '$window', '$cookieStore', '$uibModalInstance', 'ServerComm', 'major', function ($scope, $location, $window, $cookieStore, $uibModalInstance, serverComm, major) {
        $scope.$emit('onModuleNameChange', 'Institute');

        $scope.major = angular.copy(major);
        $scope.submit = function () {
            if ($scope.major.id == 0) {
                console.log($scope.major);
                serverComm.comm('major/addMajorByDepartmentId', $scope.major, function () {
                    $uibModalInstance.close();
                });
            }
            else {
                serverComm.comm('major/modifyMajorById', $scope.major, function () {
                    $uibModalInstance.close();
                });
            }

        };
        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }])


    .controller('ClassController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', '$routeParams', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm, $routeParams) {
        $scope.$emit('onModuleNameChange', 'Institute');
        $scope.classes = [];
        $scope.refresh = function () {
            serverComm.comm('classes/getAllClassesByMajorId', {major_id: $routeParams.majorId}, function (data) {
                $scope.classes = data;//执行此方法的时候从后台取得数据
            });
        };

        $scope.getClasse = function (classe) {
            if (classe == null) {
                return {
                    id: 0,
                    className: "",
                    major_id: $routeParams.majorId,
                    sequence: 1
                };
            }
            else {
                //return $scope.banners[index];
                return classe;
            }
        };
        $scope.showEditor = function (classe) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/classEditor.html',
                controller: 'ClassEditorController',
                resolve: {
                    classe: $scope.getClasse(classe)
                }
            });

            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };
        $scope.delete = function (classe) {
            //var banner = $scope.getBanner(index);
            if (confirm("确定删除此班级吗")) {
                serverComm.comm('classes/deleteClassesById', {id: classe.id}, function () {
                    $scope.refresh();
                });
            }
        };

        $scope.refresh();
    }])
    .controller('ClassEditorController', ['$scope', '$location', '$window', '$cookieStore', '$uibModalInstance', 'ServerComm', 'classe', function ($scope, $location, $window, $cookieStore, $uibModalInstance, serverComm, classe) {
        $scope.$emit('onModuleNameChange', 'Institute');

        $scope.classe = angular.copy(classe);
        $scope.submit = function () {
            if ($scope.classe.id == 0) {
                console.log($scope.classe);
                serverComm.comm('classes/addClassesByMajorId', $scope.classe, function () {
                    $uibModalInstance.close();
                });
            }
            else {
                serverComm.comm('classes/modifyClassesById', $scope.classe, function () {
                    $uibModalInstance.close();
                });
            }

        };
        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }])


    .controller('SetRoleController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', '$routeParams', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm, $routeParams) {
        $scope.$emit('onModuleNameChange', 'User');
        $scope.roles = [];
        $scope.nickname = $routeParams.nickname;
        $scope.refresh = function () {
            serverComm.comm('administratorAndRole/getAllAdministratorAndRole', {administrator_id: $routeParams.administrator_id}, function (data) {
                $scope.roles = data;//得到已有的角色

            });
        };
        $scope.submit = function () {
            //console.log($scope.roles);
            serverComm.comm('administratorAndRole/addAdministratorAndRole', $scope.roles, function () {
                alert("操作成功");
            });

        };

        $scope.goBack = function () {
            $window.history.back();
        };

        $scope.refresh();
    }])
    .controller('SetPermissionController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', '$routeParams', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm, $routeParams) {
        $scope.$emit('onModuleNameChange', 'Role');
        $scope.permissions = [];
        $scope.roleName = $routeParams.roleName;
        $scope.refresh = function () {
            serverComm.comm('roleAndPermission/getAllRoleAndPermission', {role_id: $routeParams.role_id}, function (data) {
                $scope.permissions = data;//得到已有的角色

            });
        };
        $scope.submit = function () {
            serverComm.comm('roleAndPermission/addRoleAndPermission', $scope.permissions, function () {
                alert("操作成功");
            });

        };
        $scope.isCheckAll = false;
        $scope.checkAll = function () {
            for (var i = 0; i < $scope.permissions.length; i++) {
                $scope.permissions[i]['selected'] = $scope.isCheckAll;

            }
        };
        $scope.goBack = function () {
            $window.history.back();
        };

        $scope.refresh();
    }])


    .controller('UserController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm) {
        $scope.$emit('onModuleNameChange', 'User');
        $scope.users = [];
        $scope.refresh = function () {
            serverComm.comm('administrator/getAllAdministrator', {}, function (data) {
                $scope.users = data;//执行此方法的时候从后台取得数据
            });
        };

        $scope.getUser = function (user) {
            if (user == null) {
                return {
                    id: 0,
                    username: "",
                    password: "",
                    nickname: "",
                    isValid: true
                };
            }
            else {
                //return $scope.banners[index];
                return user;
            }
        };

        //$scope.setVisible = function(banner, isVisible) {
        //    //var banner = $scope.getBanner(index);
        //    serverComm.comm('banner/setVisibleById', {id: banner.id, isVisible: isVisible}, function (data) {
        //        banner.isVisible = isVisible;
        //    });
        //};

        $scope.showEditor = function (user) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/userEditor.html',
                controller: 'UserEditorController',
                resolve: {
                    user: $scope.getUser(user)
                }
            });

            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };
        $scope.delete = function (user) {
            //var banner = $scope.getBanner(index);
            if (confirm("确定删除此用户吗?")) {
                serverComm.comm('administrator/deleteAdministratorById', {administrator_id: user.id}, function () {
                    $scope.refresh();
                });
            }
        };

        $scope.refresh();
    }])


    .controller('UserEditorController', ['$scope', '$location', '$window', '$cookieStore', '$uibModalInstance', 'ServerComm', 'user', function ($scope, $location, $window, $cookieStore, $uibModalInstance, serverComm, user) {
        $scope.$emit('onModuleNameChange', 'User');

        $scope.user = angular.copy(user);
        //console.info('uploader', uploader);
        $scope.submit = function () {
            if ($scope.user.id == 0) {
                console.log($scope.user);
                serverComm.comm('administrator/addAdministrator', $scope.user, function () {
                    $uibModalInstance.close();
                });
            }

        };
        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }])


    .controller('ChapterController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', '$routeParams', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm, $routeParams) {
        $scope.$emit('onModuleNameChange', 'Course');

        $scope.chapters = [];
        $scope.courseName = $routeParams.courseName;
        $scope.refresh = function () {
            serverComm.comm('chapter/getAllChapterByCourseID', {course_id: $routeParams.courseId}, function (data) {
                $scope.chapters = data;//执行此方法的时候从后台取得数据

            });
        };

        $scope.getChapter = function (chapter) {
            if (chapter == null) {
                return {
                    id: 0,
                    chapterName: '',
                    course_id: $routeParams.courseId,
                    sequence: 0
                };
            }
            else {
                //return $scope.banners[index];
                return chapter;
            }
        };
        $scope.goBack = function () {
            $window.history.back();
        };

        //$scope.setVisible = function(banner, isVisible) {
        //    //var banner = $scope.getBanner(index);
        //    serverComm.comm('banner/setVisibleById', {id: banner.id, isVisible: isVisible}, function (data) {
        //        banner.isVisible = isVisible;
        //    });
        //};

        $scope.showEditor = function (chapter) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/chapterEditor.html',
                controller: 'ChapterEditorController',
                resolve: {
                    chapter: $scope.getChapter(chapter)
                }
            });

            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };
        $scope.delete = function (chapter) {
            //var banner = $scope.getBanner(index);
            if (confirm("确定删除此章吗")) {
                serverComm.comm('chapter/deleteChapterById', {id: chapter.id}, function () {
                    $scope.refresh();
                });
            }
        };

        $scope.refresh();
    }])
    .controller('ChapterEditorController', ['$scope', '$location', '$window', '$cookieStore', '$uibModalInstance', 'ServerComm', 'chapter', function ($scope, $location, $window, $cookieStore, $uibModalInstance, serverComm, chapter) {
        $scope.$emit('onModuleNameChange', 'Course');

        $scope.chapter = angular.copy(chapter);

        $scope.submit = function () {
            if ($scope.chapter.id == 0) {
                console.log($scope.chapter);
                serverComm.comm('chapter/addChapterByCourseId', $scope.chapter, function () {
                    $uibModalInstance.close();
                });
            }
            else {
                serverComm.comm('chapter/modifyChapterById', $scope.chapter, function () {
                    $uibModalInstance.close();
                });
            }

        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }])


    .controller('SectionController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', '$routeParams', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm, $routeParams) {
        $scope.$emit('onModuleNameChange', 'Course');

        $scope.sections = [];
        $scope.refresh = function () {
            serverComm.comm('section/getAllSectionByChapterId', {chapter_id: $routeParams.chapterId}, function (data) {
                $scope.sections = data;//执行此方法的时候从后台取得数据

            });
        };

        $scope.getSelection = function (section) {
            if (section == null) {
                return {
                    id: 0,
                    sectionName: '',
                    chapter_id: $routeParams.chapterId,
                    sequence: 0
                };
            }
            else {
                //return $scope.banners[index];
                return section;
            }
        };
        $scope.goBack = function () {
            $window.history.back();
        };


        $scope.showEditor = function (section) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/sectionEditor.html',
                controller: 'SectionEditorController',
                resolve: {
                    section: $scope.getSelection(section)
                }
            });

            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };
        $scope.delete = function (section) {
            //var banner = $scope.getBanner(index);
            if (confirm("确定删除此节吗?????")) {
                serverComm.comm('section/deleteSectionById', {id: section.id}, function () {
                    $scope.refresh();
                });
            }
        };

        $scope.refresh();
    }])
    .controller('SectionEditorController', ['$scope', '$location', '$window', '$cookieStore', '$uibModalInstance', 'ServerComm', 'section','FileUploader', function ($scope, $location, $window, $cookieStore, $uibModalInstance, serverComm, section,FileUploader) {
        $scope.$emit('onModuleNameChange', 'Course');

        $scope.section = angular.copy(section);

        $scope.submit = function () {
            if ($scope.section.id == 0) {
                console.log($scope.section);
                serverComm.comm('section/addSectionByChapterId', $scope.section, function () {
                    $uibModalInstance.close();

                });
            }
            else {
                serverComm.comm('section/modifySectionById', $scope.section, function () {
                    $uibModalInstance.close();
                });
            }

        };
        var uploaderVideo = $scope.uploaderVideo = new FileUploader({
            url: 'api/upload/uploadFile' + '/' + $cookieStore.get('token')
        });

        // FILTERS
        uploaderVideo.autoUpload = true;
        uploaderVideo.filters.push({
            name: 'customFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                return this.queue.length < 10;
            }
        });
        uploaderVideo.onSuccessItem = function (fileItem, response, status, headers) {
            //console.info('onSuccessItem', response.filePath);

            $scope.section.videoAddress = response.content;

        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }])

    .controller('RoleController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm) {
        $scope.$emit('onModuleNameChange', 'Role');
        $scope.roles = [];
        $scope.refresh = function () {
            serverComm.comm('role/getAllRole', {}, function (data) {
                $scope.roles = data;//执行此方法的时候从后台取得数据
            });
        };

        $scope.getRole = function (role) {
            if (role == null) {
                return {
                    id: 0,
                    roleName: ""
                };
            }
            else {
                //return $scope.banners[index];
                return role;
            }
        };

        $scope.showEditor = function (role) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/roleEditor.html',
                controller: 'RoleEditorController',
                resolve: {
                    role: $scope.getRole(role)
                }
            });

            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };
        $scope.delete = function (role) {
            //var banner = $scope.getBanner(index);
            if (confirm("确定删除这个角色吗?")) {
                serverComm.comm('role/deleteRoleById', {id: role.id}, function () {
                    $scope.refresh();
                });
            }
        };

        $scope.refresh();
    }])


    .controller('RoleEditorController', ['$scope', '$location', '$window', '$cookieStore', '$uibModalInstance', 'ServerComm', 'role', function ($scope, $location, $window, $cookieStore, $uibModalInstance, serverComm, role) {
        $scope.$emit('onModuleNameChange', 'Role');

        $scope.role = angular.copy(role);


        //console.info('uploader', uploader);
        $scope.submit = function () {
            if ($scope.role.id == 0) {
                console.log($scope.role);
                serverComm.comm('role/addRole', $scope.role, function () {
                    $uibModalInstance.close();
                });
            }
            else {
                serverComm.comm('role/modifyRoleById', $scope.role, function () {
                    $uibModalInstance.close();

                });
            }

        };
        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }])


    .controller('InstituteController', ['$scope', '$location', '$window', '$cookieStore', 'ServerComm', '$uibModal', function ($scope, $location, $window, $cookieStore, serverComm, $uibModal) {
        $scope.$emit('onModuleNameChange', 'Institute');

        $scope.institutes = [];

        $scope.refresh = function () {
            serverComm.comm('institute/getAllInstitute', {}, function (data) {
                $scope.institutes = data;
            });
        };

        $scope.delete = function (institute) {
            if (confirm('您确定要删除该学院吗?')) {
                serverComm.comm('institute/deleteInstituteById', {id: institute.id}, function (data) {
                    $scope.refresh();
                });
            }
        };
        $scope.getInstitute = function (institute) {
            if (institute == null) {
                return {
                    id: 0,
                    instituteName: "",
                    sequence: 0
                };
            }
            else {
                //return $scope.banners[index];
                return institute;
            }
        };
        $scope.showEditor = function (institute) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/instituteEditor.html',
                controller: 'InstituteEditorController',
                resolve: {
                    institute: $scope.getInstitute(institute)
                }
            });

            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };


        $scope.refresh();

    }])


    .controller('ResourceController', ['$scope', '$location', '$window', '$cookieStore', 'ServerComm', '$routeParams', function ($scope, $location, $window, $cookieStore, serverComm, $routeParams) {
        $scope.$emit('onModuleNameChange', 'Course');

        $scope.resources = [];

        $scope.refresh = function () {
            serverComm.comm('resource/getAllResourceBySectionId', {section_id: $routeParams.sectionId}, function (data) {
                $scope.resources = data;
            });
        };

        $scope.delete = function (resource) {
            if (confirm('您确定要删除该资料吗?')) {

                serverComm.comm('resource/deleteResourceById', {id: resource.id}, function (data) {
                    $scope.refresh();
                });
            }
        };

        $scope.showEditor = function (id) {
            $location.path('resourceEditor/' + id + '/' + $routeParams.sectionId);
        };
        $scope.goBack = function () {
            $window.history.back();
        };


        $scope.refresh();

    }])
    .controller('ResourceEditorController', ['$scope', '$location', '$window', '$routeParams', 'ServerComm', 'FileUploader', '$cookieStore', function ($scope, $location, $window, $routeParams, serverComm, FileUploader, $cookieStore) {
        $scope.$emit('onModuleNameChange', 'Course');

        $scope.resource = {};
        $scope.refresh = function () {
            if ($routeParams.id == 0) {
                $scope.resource = {
                    videoAddress: "",
                    resourceName: "",
                    resourceAddress: "",
                    sequence: "",
                    section_id: $routeParams.sectionId


                };
            }
            else {
                serverComm.comm('resource/getResourceById', {id: $routeParams.id}, function (data) {
                    $scope.resource = data;
                });
            }
        };
        // var uploaderVideo = $scope.uploaderVideo = new FileUploader({
        //     url: 'api/upload/uploadFile' + '/' + $cookieStore.get('token')
        // });
        //
        // // FILTERS
        // uploaderVideo.autoUpload = true;
        // uploaderVideo.filters.push({
        //     name: 'customFilter',
        //     fn: function (item /*{File|FileLikeObject}*/, options) {
        //         return this.queue.length < 10;
        //     }
        // });
        // uploaderVideo.onSuccessItem = function (fileItem, response, status, headers) {
        //     //console.info('onSuccessItem', response.filePath);
        //
        //     $scope.resource.videoAddress = response.content;
        // };

        var uploaderResource = $scope.uploaderResource = new FileUploader({
            url: 'api/upload/uploadFile' + '/' + $cookieStore.get('token')
        });

        // FILTERS
        uploaderResource.autoUpload = true;
        uploaderResource.filters.push({
            name: 'customFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                return this.queue.length < 10;
            }
        });
        uploaderResource.onSuccessItem = function (fileItem, response, status, headers) {
            //console.info('onSuccessItem', response.filePath);

            $scope.resource.resourceAddress = response.content;
        };


        $scope.save = function () {
            if ($routeParams.id == 0) {
                serverComm.comm('resource/addResourceBySectionId', $scope.resource, function (data) {
                    $location.path('resources/' + $scope.resource.section_id);
                });
            }
            else {
                serverComm.comm('resource/modifyResourceById', $scope.resource, function (data) {
                    $location.path('resources/' + $scope.resource.section_id);
                });
            }
        };

        $scope.goBack = function () {
            $window.history.back();
        };

        $scope.refresh();

    }])
    .controller('AddClassesController', ['$scope', '$location', '$window', '$cookieStore', 'ServerComm', '$routeParams', function ($scope, $location, $window, $cookieStore, serverComm, $routeParams) {
        $scope.$emit('onModuleNameChange', 'Course');

        $scope.classes = [];
        $scope.courseName = $routeParams.courseName;
        $scope.refresh = function () {
            serverComm.comm('classesAndCourse/getAllClassesAndCourse', {course_id: $routeParams.courseId}, function (data) {
                $scope.classes = data;
                console.log(data);
            });
        };


        $scope.goBack = function () {
            $window.history.back();
        };
        $scope.submit = function () {
            serverComm.comm('classesAndCourse/addClassesAndCourse', $scope.classes, function (data) {
                alert("操作成功");
                console.log(data);
            });

        };

        $scope.refresh();

    }])


    .controller('InstituteEditorController', ['$scope', '$location', '$window', '$routeParams', 'ServerComm', 'institute', '$uibModalInstance', function ($scope, $location, $window, $routeParams, serverComm, institute, $uibModalInstance) {
        $scope.$emit('onModuleNameChange', 'Institute');

        $scope.institute = angular.copy(institute);


        //console.info('uploader', uploader);
        $scope.submit = function () {
            if ($scope.institute.id == 0) {
                console.log($scope.institute);
                serverComm.comm('institute/addInstitute', $scope.institute, function () {
                    $uibModalInstance.close();
                });
            }
            else {
                serverComm.comm('institute/modifyInstituteById', $scope.institute, function () {
                    $uibModalInstance.close();

                });
            }

        };
        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }])
    .controller('UploadAdministratorController', ['$scope', '$location', '$window', '$cookieStore', 'ServerComm', 'FileUploader', function ($scope, $location, $window, $cookieStore, serverComm, FileUploader) {
        $scope.$emit('onModuleNameChange', 'UploadAdministrator');

        $scope.teacherInfo = {};
        $scope.filename = "";
        $scope.institutes = [];
        $scope.departments = [];
        $scope.majors = [];
        $scope.selectedMajorId = 0;
        $scope.majorIsNull = false;
        //$scope.selectedInstitute = 0;
        $scope.refresh = function () {
            serverComm.comm('institute/getAllInstitute', {}, function (data) {
                $scope.institutes = data;
            });
        };
        $scope.getDepartments = function (instituteId) {
            serverComm.comm('department/getAllDepartmentByInstituteId', {institute_id: instituteId}, function (data) {
                $scope.departments = data;
                //console.log($scope.departments);


            });
        }
        $scope.getMajors = function (departmentId) {
            serverComm.comm('major/getAllMajorByDepartmentId', {department_id: departmentId}, function (data) {
                $scope.majors = data;


            });
        }
        $scope.getSelectedMajor = function (majorId) {

            $scope.selectedMajorId = majorId;
        }
        // FILTERS
        var uploader = $scope.uploader = new FileUploader({
            url: 'api/excel/uploadExcel' + '/' + $cookieStore.get('token')
        });
        uploader.autoUpload = true;
        uploader.onSuccessItem = function (fileItem, response, status, headers) {
            $scope.filename = response.content;
            serverComm.comm('excel/getExcelInfoAndReturn', {filename: $scope.filename}, function (data) {
                $scope.teacherInfo = data;
                console.log($scope.teacherInfo);
                console.log($scope.selectedMajorId);
            });
        };

        $scope.save = function () {
            serverComm.comm('import/importAdministrator', {
                major_id: $scope.selectedMajorId,
                teachers: $scope.teacherInfo
            }, function (data) {
                alert("信息上传成功");
            });

        };
        $scope.goBack = function () {
            $window.history.back();
        };
        $scope.refresh();
    }])

    .controller('UploadStudentController', ['$scope', '$location', '$window', '$cookieStore', 'ServerComm', 'FileUploader', function ($scope, $location, $window, $cookieStore, serverComm, FileUploader) {
        $scope.$emit('onModuleNameChange', 'UploadStudent');

        $scope.filename = "";
        $scope.institutes = [];
        $scope.departments = [];
        $scope.majors = [];
        $scope.classes = [];
        $scope.selectedClassId = 0;
        $scope.studenInfo = {};
        $scope.refresh = function () {
            serverComm.comm('institute/getAllInstitute', {}, function (data) {
                $scope.institutes = data;
            });
        };
        $scope.getDepartments = function (instituteId) {
            serverComm.comm('department/getAllDepartmentByInstituteId', {institute_id: instituteId}, function (data) {
                $scope.departments = data;
            });
        }
        $scope.getMajors = function (departmentId) {
            serverComm.comm('major/getAllMajorByDepartmentId', {department_id: departmentId}, function (data) {
                $scope.majors = data;
            });
        }
        $scope.getClasses = function (majorId) {
            serverComm.comm('classes/getAllClassesByMajorId', {major_id: majorId}, function (data) {
                $scope.classes = data;
            });
        }
        $scope.getSelectedClass = function (classId) {
            $scope.selectedClassId = classId;
        }
        var uploader = $scope.uploader = new FileUploader({
            url: 'api/excel/uploadExcel' + '/' + $cookieStore.get('token')
        });
        uploader.autoUpload = true;
        uploader.onSuccessItem = function (fileItem, response, status, headers) {
            $scope.filename = response.content;
            serverComm.comm('excel/getExcelInfoAndReturn', {filename: $scope.filename}, function (data) {
                $scope.studenInfo = data;
            });
        };
        $scope.save = function () {
            serverComm.comm('import/importStudent', {
                class_id: $scope.selectedClassId,
                students: $scope.studenInfo
            }, function (data) {
                alert("信息上传成功");
            });
        };
        $scope.goBack = function () {
            $window.history.back();
        };
        $scope.refresh();

    }])
    //UploadHomeworkController
    .controller('UploadHomeworkController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm) {
        $scope.$emit('onModuleNameChange', 'UploadHomework');
        $scope.courses = [];

        $scope.refresh = function () {
            serverComm.comm('course/getAllCoursesByAdministratorId', {}, function (data) {
                $scope.courses = data;//执行此方法的时候从后台取得数据
                console.log(data);
            });
        };

        $scope.getCourse = function (course) {
            if (course == null) {
                return {
                    id: 0,
                    courseName: "",
                    courseIntro: "",
                    coursePicture: "",
                    sequence: 1
                };
            }
            else {
                //return $scope.banners[index];
                return course;
            }
        };

        //$scope.setVisible = function(banner, isVisible) {
        //    //var banner = $scope.getBanner(index);
        //    serverComm.comm('banner/setVisibleById', {id: banner.id, isVisible: isVisible}, function (data) {
        //        banner.isVisible = isVisible;
        //    });
        //};

        $scope.showEditor = function (course) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/courseEditor.html',
                controller: 'CourseEditorController',
                resolve: {
                    course: $scope.getCourse(course)
                }
            });

            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };
        $scope.delete = function (course) {
            //var banner = $scope.getBanner(index);
            if (confirm("确定删除此课程吗")) {
                serverComm.comm('course/deleteCourseById', {id: course.id}, function () {
                    $scope.refresh();
                });
            }
        };

        $scope.refresh();
    }])


    .controller('AddHomeworkController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', '$routeParams', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm, $routeParams) {
        $scope.$emit('onModuleNameChange', 'UploadHomework');

        $scope.homeworks = [];
        $scope.courseName = $routeParams.courseName;

        $scope.refresh = function () {
            serverComm.comm('homework/getAllHomeworkByCourseId', {course_id: $routeParams.courseId}, function (data) {
                $scope.homeworks = data;//执行此方法的时候从后台取得数据
                console.log($scope.homeworks);
            });
        };

        $scope.getHomework = function (homework) {
            if (homework == null) {
                return {
                    id: 0,
                    homeworkName: '',
                    homeworkAddress: '',
                    expiredTime:'',
                    course_id: $routeParams.courseId,
                    sequence: 0
                };
            }
            else {
                //return $scope.banners[index];
                return homework;
            }
        };
        $scope.goBack = function () {
            $window.history.back();
        };

        //$scope.setVisible = function(banner, isVisible) {
        //    //var banner = $scope.getBanner(index);
        //    serverComm.comm('banner/setVisibleById', {id: banner.id, isVisible: isVisible}, function (data) {
        //        banner.isVisible = isVisible;
        //    });
        //};

        $scope.showEditor = function (homework) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/homeworkEditor.html',
                controller: 'HomeworkEditorController',
                resolve: {
                    homework: $scope.getHomework(homework)
                }
            });

            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };
        $scope.delete = function (homework) {
            //var banner = $scope.getBanner(index);
            if (confirm("确定删除此作业吗")) {
                serverComm.comm('homework/deleteHomeworkById', {id: homework.id}, function () {
                    $scope.refresh();
                });
            }
        };

        $scope.refresh();
    }])
    .controller('HomeworkEditorController', ['$scope', '$location', '$window', '$cookieStore', '$uibModalInstance', 'ServerComm', 'FileUploader', 'homework', function ($scope, $location, $window, $cookieStore, $uibModalInstance, serverComm, FileUploader, homework) {
        $scope.$emit('onModuleNameChange', 'UploadHomework');

        $scope.homework = angular.copy(homework);
        var uploader = $scope.uploader = new FileUploader({
            url: 'api/upload/uploadFile' + '/' + $cookieStore.get('token'),
            autoUpload: true
        });
        uploader.uploadAll();
        // FILTERS
        //uploader.autoUpload = true;
        console.log(uploader);
        uploader.onSuccessItem = function (fileItem, response, status, headers) {
            $scope.homework.homeworkAddress = response.content;
        };


        $scope.submit = function () {
            if ($scope.homework.id == 0) {
                console.log($scope.homework);
                serverComm.comm('homework/addHomeworkByCourseId', $scope.homework, function () {
                    $uibModalInstance.close();
                });
            }
            else {
                serverComm.comm('homework/modifyHomeworkById', $scope.homework, function () {
                    $uibModalInstance.close();
                });
            }

        };
        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }])


    .controller('JudgeHomeworkController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm) {
        $scope.$emit('onModuleNameChange', 'JudgeHomework');
        $scope.courses = [];

        $scope.refresh = function () {
            serverComm.comm('course/getAllCoursesByAdministratorId', {}, function (data) {
                $scope.courses = data;//执行此方法的时候从后台取得数据
                console.log(data);
            });
        };

        $scope.getCourse = function (course) {
            if (course == null) {
                return {
                    id: 0,
                    courseName: "",
                    courseIntro: "",
                    coursePicture: "",
                    sequence: 1
                };
            }
            else {
                //return $scope.banners[index];
                return course;
            }
        };

        //$scope.setVisible = function(banner, isVisible) {
        //    //var banner = $scope.getBanner(index);
        //    serverComm.comm('banner/setVisibleById', {id: banner.id, isVisible: isVisible}, function (data) {
        //        banner.isVisible = isVisible;
        //    });
        //};

        $scope.showEditor = function (course) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/courseEditor.html',
                controller: 'CourseEditorController',
                resolve: {
                    course: $scope.getCourse(course)
                }
            });

            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };
        $scope.delete = function (course) {
            //var banner = $scope.getBanner(index);
            if (confirm("确定删除此课程吗")) {
                serverComm.comm('course/deleteCourseById', {id: course.id}, function () {
                    $scope.refresh();
                });
            }
        };

        $scope.refresh();
    }])


    .controller('ShowHomeworkController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', '$routeParams', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm, $routeParams) {
        $scope.$emit('onModuleNameChange', 'JudgeHomework');

        $scope.homeworks = [];
        $scope.homeworkAndStudents = [];
        $scope.courseName = $routeParams.courseName;
        $scope.token = $cookieStore.get('token');
        $scope.refresh = function () {
            serverComm.comm('homework/getAllHomeworkByCourseId', {course_id: $routeParams.courseId}, function (data) {
                $scope.homeworks = data;//执行此方法的时候从后台取得数据
                console.log($scope.homeworks);
            });
        };

        $scope.getHomework = function (homework) {
            if (homework == null) {
                return {
                    id: 0,
                    homeworkName: '',
                    homeworkAddress: '',
                    course_id: $routeParams.courseId,
                    sequence: 0
                };
            }
            else {
                //return $scope.banners[index];
                return homework;
            }
        };
        $scope.goBack = function () {
            $window.history.back();
        };
        $scope.refresh();
    }])
    //ShowJudgePageController

    .controller('ShowJudgePageController', ['$scope', '$location', '$window', '$cookieStore', '$uibModal', 'ServerComm', '$routeParams', function ($scope, $location, $window, $cookieStore, $uibModal, serverComm, $routeParams) {
        $scope.$emit('onModuleNameChange', 'JudgeHomework');

        $scope.homeworkAndStudents = [];
        $scope.refresh = function () {
            serverComm.comm('studentAndHomeWork/getStudentAndHomeWorkByHomeworkId', {homework_id: $routeParams.homeworkId}, function (data) {
                $scope.homeworkAndStudents = data;//执行此方法的时候从后台取得数据
                console.log($scope.homeworkAndStudents);
            });
        };
        //studentAndHomeworkEditor.html


        $scope.getHomeworkAndStudent = function (homeworkAndStudent) {
            //return $scope.banners[index];
            return homeworkAndStudent;
        };
        $scope.showEditor = function (homeworkAndStudent) {
            var instance = $uibModal.open({
                animation: true,
                templateUrl: 'admin_partials/studentAndHomeworkEditor.html',
                controller: 'StudentAndHomeworkEditorController',
                resolve: {
                    homeworkAndStudent: $scope.getHomeworkAndStudent(homeworkAndStudent)
                }
            });

            instance.result.then(function () {
                $scope.refresh();
            }, function () {

            });

        };
        $scope.goBack = function () {
            $window.history.back();
        };
        $scope.refresh();
    }])
    .controller('StudentAndHomeworkEditorController', ['$scope', '$location', '$window', '$cookieStore', '$uibModalInstance', 'ServerComm', 'homeworkAndStudent', function ($scope, $location, $window, $cookieStore, $uibModalInstance, serverComm, homeworkAndStudent) {
        $scope.$emit('onModuleNameChange', 'UploadHomework');

        $scope.homeworkAndStudent = angular.copy(homeworkAndStudent);
        $scope.submit = function () {
            serverComm.comm('studentAndHomeWork/modifyStudentAndHomeWorkByHomeworkId', $scope.homeworkAndStudent, function () {
                console.log($scope.homeworkAndStudent);
                $uibModalInstance.close();
            });
            //if ($scope.homeworkAndStudent.id == 0) {
            //    console.log($scope.homework);
            //    serverComm.comm('homework/addHomeworkByCourseId', $scope.homework, function () {
            //        $uibModalInstance.close();
            //    });
            //}
            //else {
            //    serverComm.comm('studentAndHomeWork/modifyStudentAndHomeWorkByHomeworkId', $scope.homeworkAndStudent, function () {
            //        $uibModalInstance.close();
            //    });
            //}


        };
        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }])
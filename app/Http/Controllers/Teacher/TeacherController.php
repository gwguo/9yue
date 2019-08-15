<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TeacherModel;
use App\Model\CoursetypeModel;
use App\Model\CourseModel;
use App\Model\SectionModel;
use App\Model\CoursesonsectionModel;
use App\Model\CourseperiodModel;
use App\Model\CourseworkModel;
use App\Model\ReplyModel;
use App\Model\LeavewordsModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 教师登录页面
     */
    public function login()
    {
        return view('teacher.login');
    }

    /**
     * @param Request $request
     * @return string
     * 登录执行
     */
    public function logindo(Request $request)
    {
        $t_name = $request->input('t_name');
        $t_pwd = $request->input('t_pwd');
        $arr = TeacherModel::where('t_name', $t_name)->first();
        if ($arr) {
            if ($t_pwd == $arr['t_pwd']) {
                $session_id = session(['teacher_id' => $arr['t_id']]);
                return json_encode(['code' => 1, 'msg' => '登录成功', 'session_id' => $session_id]);
            } else {
                return json_encode(['code' => 0, 'msg' => '用户名或密码不正确']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '没有此用户']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 教师端首页
     */
    public function index()
    {
        return view('teacher.index');
    }

    /**
     * @param Request $request
     *邮箱
     */
    public function email(Request $request)
    {
        $code = mt_rand(111111, 999999);
        cache::put('code', $code, '3000');
        Mail::raw("验证码:" . $code . "，5分钟有效。", function ($message) {
            $email = $_POST['email'];
            $message->subject('验证');
            $message->to($email);
        });
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 教师注册页面
     */
    public function reg()
    {
        return view('teacher.reg');
    }

    /**
     * @param Request $request
     * @return string
     * 注册执行
     */
    public function regdo(Request $request)
    {
        $t_name = $request->input('t_name');
        $t_pwd = $request->input('t_pwd');
        $t_pwd2 = $request->input('t_pwd2');
        $email = $request->input('email');
        $code = $request->input('code');
        $arr = TeacherModel::where('t_name', $t_name)->first();
        if (!$arr) {
            if ($t_pwd != $t_pwd2) {
                return json_encode(['code' => 0, 'msg' => '两次输入密码不一致']);
            }
            $codes = cache::get('code');
            if ($codes != $code) {
                return json_encode(['code' => 0, 'msg' => '验证码有误']);
            }
            $data = [
                't_name' => $t_name,
                't_pwd' => $t_pwd,
                'email' => $email
            ];
            $res = TeacherModel::insert($data);
            if ($res) {
                cache::forget('code');
                return json_encode(['code' => 1, 'msg' => '注册成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '注册失败']);
            }
        } else {
            return json_encode(['code' => 2, 'msg' => '已经有此账号了，去登录']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 修改密码页面
     */
    public function resetpwd()
    {
        return view('teacher.resetpwd');
    }

    /**
     * @param Request $request
     * @return string
     * 执行修改密码
     */
    public function resetpwds(Request $request)
    {
        $t_id = session('teacher_id');
        $t_pwd = $request->input('t_pwd');
        $pwd = $request->input('pwd');
        $pwd2 = $request->input('pwd2');
        $arr = TeacherModel::where('t_id', $t_id)->first();
        if ($t_pwd == $arr['t_pwd']) {
            if ($pwd != $pwd2) {
                return json_encode(['code' => 0, 'msg' => '两次密码不一致']);
            }
            $data = [
                't_pwd' => $pwd
            ];
            $res = TeacherModel::where('t_id', $t_id)->update($data);
            if ($res) {
                session('teacher_id', '');
                return json_encode(['code' => 1, 'msg' => '修改成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '修改失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '原密码不对']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 退出
     */
    public function loginout()
    {
        session::forget('teacher_id');
        return view('teacher.login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 忘记密码页面
     */
    public function forgetpwd()
    {
        return view('teacher.forgetpwd');
    }

    /**
     * @param Request $request
     * @return string
     * 忘记密码验证邮箱
     */
    public function forgetpwds(Request $request)
    {
        $t_name = $request->input('t_name');
        $email = $request->input('email');
        $code = $request->input('code');
        $codes = cache::get('code');
        $arr = TeacherModel::where('t_name', $t_name)->first();
        if ($arr) {
            if ($email == $arr['email']) {
                if ($codes != $code) {
                    return json_encode(['code' => 0, 'msg' => '验证码有误']);
                } else {
                    session(['teacher_id' => $arr['t_id']]);
                    cache::forget('code');
                    return json_encode(['code' => 1, 'msg' => '验证成功，去填写新密码']);
                }
            } else {
                return json_encode(['code' => 0, 'msg' => '此邮箱与注册的邮箱不一致，请重新填写']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '不存在此用户，去注册']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 新密码页面
     */
    public function newpwd()
    {
        return view('teacher.newpwd');
    }

    /**
     * @param Request $request
     * @return string
     * 新密码执行
     */
    public function newpwds(Request $request)
    {
        $t_id = session('teacher_id');
        $pwd = $request->input('pwd');
        $pwd2 = $request->input('pwd2');
        if ($pwd != $pwd2) {
            return json_encode(['code' => 0, 'msg' => '两次输入密码不一致']);
        }
        $arr = TeacherModel::where('t_id', $t_id)->first();
        if ($arr) {
            $data = [
                't_pwd' => $pwd
            ];
            $res = TeacherModel::where('t_id', $t_id)->update($data);
            if ($res) {
                return json_encode(['code' => 1, 'msg' => '找回密码成功，去登录吧']);
            } else {
                return json_encode(['code' => 0, 'msg' => '找回密码失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '参数错误']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 完善个人信息页面
     */
    public function myuser()
    {
        $t_id = session('teacher_id');
        $arr = TeacherModel::where('t_id', $t_id)->first();
        return view('teacher.myuser', ['arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 提交审核
     */
    public function myusers(Request $request)
    {
        $data = $request->input();
        $t_name = $data['t_name'];
        $arr = TeacherModel::where('t_name', $t_name)->first();
        if ($arr) {
            $res = TeacherModel::where('t_name', $t_name)->update($data);
            if ($res) {
                return json_encode(['code' => 1, 'msg' => '提交成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '提交失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '已经有此用户了，换个名字试试']);
        }
    }

    /**
     * @param Request $request
     * @return string
     * 教师头像上传
     */
    public function userupload(Request $request)
    {
        $file = $_FILES['file'];
        $path = $file['tmp_name'];
        $newpath = "./imgs/" . $file['name'];
        $media = move_uploaded_file($path, $newpath);
        if ($media) {
            $success = [
                'seccess' => 0,
                'code' => 0,
                'img' => $newpath
            ];
            return json_encode($success);
        } else {
            $error = [
                'seccess' => 1,
                'code' => 1
            ];
            return json_encode($error);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 个人中心页面
     */
    public function meuser()
    {
        $t_id = session('teacher_id');
        $arr = TeacherModel::where('t_id', $t_id)->first();
        return view('teacher.meuser', ['arr' => $arr]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 课程添加
     */
    public function course()
    {
        $data = [
            'status' => 1
        ];
        $arr = CoursetypeModel::where($data)->get()->toArray();
        return view('teacher.course', ['arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 课程添加执行
     */
    public function courseadd(Request $request)
    {
        $data = $request->input();
        $data['c_time'] = time();
        $data['t_id'] = session('teacher_id');
        $c_name = $data['c_name'];
        $res = CourseModel::where('c_name', $c_name)->first();
        if (!$res) {
            $arr = CourseModel::insert($data);
            if ($arr) {
                return json_encode(['code' => 1, 'msg' => '添加成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '添加失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '已有此课程']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 课程展示页面
     */
    public function courselist()
    {
        $t_id = session('teacher_id');
        $data = TeacherModel::where('t_id', $t_id)->first();
        $where = [
            'is_del' => 0,
            't_id' => $t_id
        ];
        $arr = CourseModel::join('course_type', 'course.course_id', '=', 'course_type.course_id')->where($where)->paginate(3);
        return view('teacher.courselist', ['arr' => $arr, 'data' => $data]);
    }

    /**
     * @param Request $request
     * @return string
     * 课程删除
     */
    public function coursedel(Request $request)
    {
        $c_id = $request->input('id');
        $arr = [
            'is_del' => 1
        ];
        $data = CourseModel::where('c_id', $c_id)->update($arr);
        if ($data) {
            return json_encode(['code' => 1, 'msg' => '删除成功']);
        } else {
            return json_encode(['code' => 0, 'msg' => '删除失败']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 课程修改页面
     */
    public function courseup(Request $request)
    {
        $id = $request->input('id');
        $data = CourseModel::where('c_id', $id)->first();
        $datas = [
            'status' => 1
        ];
        $arr = CoursetypeModel::where($datas)->get()->toArray();
        return view('teacher.courseup', ['data' => $data, 'arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 课程修改执行
     */
    public function courseupdo(Request $request)
    {
        $data = $request->input();
        $id = $request->input('c_id');
        $c_name = $data['c_name'];
        $data['u_time'] = time();
        $data['t_id'] = session('teacher_id');
        $arr = CourseModel::where('c_name', $c_name)->first();
        if (!$arr) {
            $res = CourseModel::where('c_id', $id)->update($data);
            if ($res) {
                return json_encode(['code' => 1, 'msg' => '修改成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '修改失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '已经有此课程了，请重新填写']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 章节添加页面
     */
    public function section()
    {
        $t_id = session('teacher_id');
        $data = [
            'is_del' => 0,
            't_id' => $t_id
        ];
        $arr = CourseModel::where($data)->get()->toArray();
        return view('teacher.section', ['arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 章节添加执行
     */
    public function sectionadd(Request $request)
    {
        $data = $request->input();
        $data['c_time'] = time();
        $data['st_id'] = session('teacher_id');
        $section_name = $data['section_name'];
        $res = SectionModel::where('section_name', $section_name)->first();
        if (!$res) {
            $arr = SectionModel::insert($data);
            if ($arr) {
                return json_encode(['code' => 1, 'msg' => '添加成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '添加失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '已有此章节']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 章节展示页面
     */
    public function sectionlist()
    {
        $t_id = session('teacher_id');
        $arr = TeacherModel::where('t_id', $t_id)->first();
        $where = [
            'sis_del' => 0,
            'st_id' => $t_id
        ];
        $data = SectionModel::join('course', 'course_section.c_id', '=', 'course.c_id')->where($where)->paginate(3);
        return view('teacher.sectionlist', ['data' => $data, 'arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 章节删除
     */
    public function sectiondel(Request $request)
    {
        $section_id = $request->input('section_id');
        $arr = [
            'sis_del' => 1
        ];
        $data = SectionModel::where('section_id', $section_id)->update($arr);
        if ($data) {
            return json_encode(['code' => 1, 'msg' => '删除成功']);
        } else {
            return json_encode(['code' => 0, 'msg' => '删除失败']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 章节修改页面
     */
    public function sectionup(Request $request)
    {
        $section_id = $request->input('section_id');
        $t_id = session('teacher_id');
        $data = SectionModel::where('section_id', $section_id)->first();
        $datas = [
            'is_del' => 0,
            't_id' => $t_id
        ];
        $arr = CourseModel::where($datas)->get()->toArray();
        return view('teacher.sectionup', ['data' => $data, 'arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 章节修改执行
     */
    public function sectionupdo(Request $request)
    {
        $data = $request->input();
        $section_id = $request->input('section_id');
        $section_name = $data['section_name'];
        $data['u_time'] = time();
        $data['st_id'] = session('teacher_id');
        $arr = SectionModel::where('section_name', $section_name)->first();
        if (!$arr) {
            $res = SectionModel::where('section_id', $section_id)->update($data);
            if ($res) {
                return json_encode(['code' => 1, 'msg' => '修改成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '修改失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '已经有此章节了，请重新填写']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 小节添加页面
     */
    public function son()
    {
        $t_id = session('teacher_id');
        $data = [
            'sis_del' => 0,
            'st_id' => $t_id
        ];
        $arr = SectionModel::where($data)->get()->toArray();
        return view('teacher.son', ['arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     *小节添加执行
     */
    public function sonadd(Request $request)
    {
        $data = $request->input();
        $data['c_time'] = time();
        $data['sont_id'] = session('teacher_id');
        $son_name = $data['son_name'];
        $res = CoursesonsectionModel::where('son_name', $son_name)->first();
        if (!$res) {
            $arr = CoursesonsectionModel::insert($data);
            if ($arr) {
                return json_encode(['code' => 1, 'msg' => '添加成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '添加失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '已有此小节']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 小节展示页面
     */
    public function sonlist()
    {
        $t_id = session('teacher_id');
        $arr = TeacherModel::where('t_id', $t_id)->first();
        $where = [
            'sonis_del' => 0,
            'sont_id' => $t_id
        ];
        $data = CoursesonsectionModel::join('course_section', 'course_son_section.section_id', '=', 'course_section.section_id')->where($where)->paginate(3);
        return view('teacher.sonlist', ['data' => $data, 'arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 小节删除
     */
    public function sondel(Request $request)
    {
        $son_id = $request->input('son_id');
        $arr = [
            'sonis_del' => 1
        ];
        $data = CoursesonsectionModel::where('son_id', $son_id)->update($arr);
        if ($data) {
            return json_encode(['code' => 1, 'msg' => '删除成功']);
        } else {
            return json_encode(['code' => 0, 'msg' => '删除失败']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 小节修改页面
     */
    public function sonup(Request $request)
    {
        $son_id = $request->input('son_id');
        $t_id = session('teacher_id');
        $data = CoursesonsectionModel::where('son_id', $son_id)->first();
        $datas = [
            'sis_del' => 0,
            'st_id' => $t_id
        ];
        $arr = SectionModel::where($datas)->get()->toArray();
        return view('teacher.sonup', ['data' => $data, 'arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 小节修改执行
     */
    public function sonupdo(Request $request)
    {
        $data = $request->input();
        $son_id = $request->input('son_id');
        $son_name = $data['son_name'];
        $data['u_time'] = time();
        $data['sont_id'] = session('teacher_id');
        $arr = CoursesonsectionModel::where('son_name', $son_name)->first();
        if (!$arr) {
            $res = CoursesonsectionModel::where('son_id', $son_id)->update($data);
            if ($res) {
                return json_encode(['code' => 1, 'msg' => '修改成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '修改失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '已经有此小节了，请重新填写']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 课时添加页面
     */
    public function period()
    {
        $t_id = session('teacher_id');
        $data = [
            'sonis_del' => 0,
            'sont_id' => $t_id
        ];
        $arr = CoursesonsectionModel::where($data)->get()->toArray();
        return view('teacher.period', ['arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 视频上传
     */
    public function videoupload(Request $request)
    {
        $file = $_FILES['file'];
        $path = $file['tmp_name'];
        $newpath = "video/" . $file['name'];
        $media = move_uploaded_file($path, $newpath);
        if ($media) {
            $success = [
                'seccess' => 0,
                'code' => 0,
                'img' => $newpath
            ];
            return json_encode($success);
        } else {
            $error = [
                'seccess' => 1,
                'code' => 1
            ];
            return json_encode($error);
        }
    }

    /**
     * @param Request $request
     * @return string
     * 课时添加执行
     */
    public function periodadd(Request $request)
    {
        $data = $request->input();
        $data['c_time'] = time();
        $data['pt_id'] = session('teacher_id');
        $period_name = $data['period_name'];
        $res = CourseperiodModel::where('period_name', $period_name)->first();
        if (!$res) {
            $arr = CourseperiodModel::insert($data);
            if ($arr) {
                return json_encode(['code' => 1, 'msg' => '添加成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '添加失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '已有此课时']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 课时展示页面
     */
    public function periodlist()
    {
        $t_id = session('teacher_id');
        $arr = TeacherModel::where('t_id', $t_id)->first();
        $where = [
            'pis_del' => 0,
            'pt_id' => $t_id
        ];
        $data = CourseperiodModel::join('course_son_section', 'course_period.son_id', '=', 'course_son_section.son_id')->where($where)->paginate(3);
        return view('teacher.periodlist', ['data' => $data, 'arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 课时删除
     */
    public function perioddel(Request $request)
    {
        $period_id = $request->input('period_id');
        $arr = [
            'pis_del' => 1
        ];
        $data = CourseperiodModel::where('period_id', $period_id)->update($arr);
        if ($data) {
            return json_encode(['code' => 1, 'msg' => '删除成功']);
        } else {
            return json_encode(['code' => 0, 'msg' => '删除失败']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 课时修改页面
     */
    public function periodup(Request $request)
    {
        $period_id = $request->input('period_id');
        $t_id = session('teacher_id');
        $data = CourseperiodModel::where('period_id', $period_id)->first();
        $datas = [
            'sonis_del' => 0,
            'sont_id' => $t_id
        ];
        $arr = CoursesonsectionModel::where($datas)->get()->toArray();
        return view('teacher.periodup', ['data' => $data, 'arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 课时修改执行
     */
    public function periodupdo(Request $request)
    {
        $data = $request->input();
        $period_id = $request->input('period_id');
        $period_name = $data['period_name'];
        $data['u_time'] = time();
        $data['pt_id'] = session('teacher_id');
        $arr = CourseperiodModel::where('period_name', $period_name)->first();
        if (!$arr) {
            $res = CourseperiodModel::where('period_id', $period_id)->update($data);
            if ($res) {
                return json_encode(['code' => 1, 'msg' => '修改成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '修改失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '已经有此课时了，请重新填写']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 作业添加页面
     */
    public function work()
    {
        $t_id = session('teacher_id');
        $data = [
            'pis_del' => 0,
            'pt_id' => $t_id
        ];
        $arr = CourseperiodModel::where($data)->get()->toArray();
        return view('teacher.work', ['arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 作业添加执行
     */
    public function workadd(Request $request)
    {
        $data = $request->input();
        $data['c_time'] = time();
        $data['wt_id'] = session('teacher_id');
        $work_name = $data['work_name'];
        $res = CourseworkModel::where('work_name', $work_name)->first();
        if (!$res) {
            $arr = CourseworkModel::insert($data);
            if ($arr) {
                return json_encode(['code' => 1, 'msg' => '添加成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '添加失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '已有此作业']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 作业展示页面
     */
    public function worklist()
    {
        $t_id = session('teacher_id');
        $arr = TeacherModel::where('t_id', $t_id)->first();
        $where = [
            'wis_del' => 0,
            'wt_id' => $t_id
        ];
        $data = CourseworkModel::join('course_period', 'course_work.period_id', '=', 'course_period.period_id')->where($where)->paginate(3);
        return view('teacher.worklist', ['data' => $data, 'arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 作业删除
     */
    public function workdel(Request $request)
    {
        $work_id = $request->input('work_id');
        $arr = [
            'wis_del' => 1
        ];
        $data = CourseworkModel::where('work_id', $work_id)->update($arr);
        if ($data) {
            return json_encode(['code' => 1, 'msg' => '删除成功']);
        } else {
            return json_encode(['code' => 0, 'msg' => '删除失败']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 作业修改页面
     */
    public function workup(Request $request)
    {
        $work_id = $request->input('work_id');
        $t_id = session('teacher_id');
        $data = CourseworkModel::where('work_id', $work_id)->first();
        $datas = [
            'pis_del' => 0,
            'pt_id' => $t_id
        ];
        $arr = CourseperiodModel::where($datas)->get()->toArray();
        return view('teacher.workup', ['data' => $data, 'arr' => $arr]);
    }

    /**
     * @param Request $request
     * @return string
     * 作业修改执行
     */
    public function workupdo(Request $request)
    {
        $data = $request->input();
        $work_id = $request->input('work_id');
        $work_name = $data['work_name'];
        $data['u_time'] = time();
        $data['wt_id'] = session('teacher_id');
        $arr = CourseworkModel::where('work_name', $work_name)->first();
        if (!$arr) {
            $res = CourseworkModel::where('work_id', $work_id)->update($data);
            if ($res) {
                return json_encode(['code' => 1, 'msg' => '修改成功']);
            } else {
                return json_encode(['code' => 0, 'msg' => '修改失败']);
            }
        } else {
            return json_encode(['code' => 0, 'msg' => '已经有此作业了，请重新填写']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 问答页面
     */
    public function reply()
    {
        $t_id = session('teacher_id');
        $arr = LeavewordsModel::where('t_id', $t_id)->get()->toArray();
        return view('teacher.reply', ['arr' => $arr]);
    }
}
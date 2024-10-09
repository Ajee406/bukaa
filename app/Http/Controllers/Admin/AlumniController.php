<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AlumniService;
use App\Http\Services\UserService;
use App\Models\Batch;
use App\Models\Department;
use App\Models\RegisterForm;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PassingYear;
use App\Traits\ResponseTrait;

class AlumniController extends Controller
{
    use ResponseTrait;

    public $alumniService;
    public $userService;

    public function __construct()
    {
        $this->alumniService = new AlumniService();
        $this->userService = new UserService();
    }

    public function view($id)
    {
        $data['user'] = $this->userService->userData($id);
        return view('alumni.public-profile', $data);
    }

    public function alumniListWithAdvanceFilter(Request $request)
    {
        if ($request->ajax()) {
            return $this->alumniService->getAlumniListAllWithAdvanceFilter($request);
        }
        $data['title'] = __('Alumni List');
        $data['showAdminAlumni'] = 'show';
        $data['activeAlumniApprovedList'] = 'active-color-one';
        $data['department'] = Department::all();
        $data['passingYear'] = PassingYear::all();
        $data['regForm'] = RegisterForm::where('tenant_id', getTenantId())->first();
        return view('admin.manage_alumni.alumni-list-with-search', $data);
    }

    public function alumniPendingListWithAdvanceFilter(Request $request)
    {
        if ($request->ajax()) {
            return $this->alumniService->getAlumniPendingListWithAdvanceFilter($request);
        }
        $data['title'] = __('Alumni Pending List');
        $data['showAdminAlumni'] = 'show';
        $data['activeAlumniPendingList'] = 'active-color-one';
        $data['department'] = Department::all();
        $data['passingYear'] = PassingYear::all();
        $data['regForm'] = RegisterForm::where('tenant_id', getTenantId())->first();
        return view('admin.manage_alumni.alumni-pending-list-with-search', $data);
    }

    public function alumniChangeStatus(Request $request)
    {
        return $this->alumniService->changeAlumniStatus($request);
    }

    public function alumniProfileData($id){

        $id = is_null($id) ? auth()->id() : $id;
        $data['user'] = User::where('id', $id)->with(['alumni', 'institutions', 'currentMembership', 'alumni.batch', 'alumni.department', 'alumni.passing_year'])->first();
        $data['batches'] = Batch::all();
        $data['departments'] = Department::all();
        $data['passing_years'] = PassingYear::all();
        return view('admin.manage_alumni.profile-edit',$data);
    }

    public function storeAlumniInstitution(Request $request)
    {
        return $this->alumniService->institutionStore($request);
    }

    public function updateAlumniProfile(Request $request){

        return $this->alumniService->updateAlumniProfile($request);
    }

}

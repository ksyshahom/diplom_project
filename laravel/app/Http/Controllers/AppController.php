<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $programs = Program::all();
//        $view = 'app/index';
        $view = '_bs/app/index';
        return view($view, compact('user', 'programs'));
    }

    public function send(Request $request)
    {
        $user = Auth::user();
        if (is_null($user->app) || $user->app->verified == 2) {
//        if (true) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'birth_date' => 'required|date',
                'birth_place' => 'required',
                'nationality' => 'required',
                'program_01' => 'required',
                'program_02' => 'required',
                'program_03' => 'required',
                'native_lang' => 'required',
                'gender' => 'required',
                'mobile_phone_code' => 'required',
                'mobile_phone' => 'required',
                'photo' => 'nullable|file|mimetypes:image/jpeg|max:25000',
                'year' => 'required',
                'housing' => 'required',
                'why_enroll' => 'required',
                'source' => 'required_without:source_other|array|min:1',
                'source_other' => 'required_without:source',
                'institution' => 'required',
                'city_country' => 'required',
                'year_from_to' => 'required',
                'field_of_study' => 'required',
                'degree_title' => 'required',
                'gpa' => 'required',
                'diploma' => 'required_without:diploma_old|file|mimetypes:application/pdf|max:25000',
                'diploma_old' => 'required_without:diploma',
                'transcripts' => 'required_without:transcripts_old|file|mimetypes:application/pdf|max:25000',
                'transcripts_old' => 'required_without:transcripts',
                'achievements_doc' => 'nullable|file|mimetypes:application/pdf|max:25000',
                'sop' => 'nullable|file|mimetypes:application/pdf|max:25000',
                'cv' => 'nullable|file|mimetypes:application/pdf|max:25000',
                'rl1' => 'nullable|file|mimetypes:application/pdf|max:25000',
                'rl2' => 'nullable|file|mimetypes:application/pdf|max:25000',
                'citizenship' => 'required',
                'per_city' => 'required',
                'per_state' => 'required',
                'per_country' => 'required',
                'pass_country' => 'required',
                'pass_number' => 'required',
                'pass_from' => 'required|date',
                'pass_to' => 'required|date|after:yesterday',
                'pass_scan' => 'required_without:pass_scan_old|file|mimetypes:application/pdf|max:25000',
                'pass_scan_old' => 'required_without:pass_scan',
                'embassy_city' => 'required',
                'embassy_state' => 'required',
                'embassy_country' => 'required',
            ]);
            $data = $request->all();
            // Files:
            if ($request->has('photo')) {
                $data['photo'] = $request->file('photo')
                    ->store("public/users/$user->id");
            } elseif ($request->has('photo_old')) {
                $data['photo'] = $request->photo_old;
            }
            // ---
            if ($request->has('diploma')) {
                $data['diploma'] = $request->file('diploma')
                    ->store("public/users/$user->id");
            } elseif ($request->has('diploma_old')) {
                $data['diploma'] = $request->diploma_old;
            }
            // ---
            if ($request->has('transcripts')) {
                $data['transcripts'] = $request->file('transcripts')
                    ->store("public/users/$user->id");
            } elseif ($request->has('transcripts_old')) {
                $data['transcripts'] = $request->transcripts_old;
            }
            // ---
            if ($request->has('achievements_doc')) {
                $data['achievements_doc'] = $request->file('achievements_doc')
                    ->store("public/users/$user->id");
            } elseif ($request->has('achievements_doc_old')) {
                $data['achievements_doc'] = $request->achievements_doc_old;
            }
            // ---
            if ($request->has('sop')) {
                $data['sop'] = $request->file('sop')
                    ->store("public/users/$user->id");
            } elseif ($request->has('sop_old')) {
                $data['sop'] = $request->sop_old;
            }
            // ---
            if ($request->has('cv')) {
                $data['cv'] = $request->file('cv')
                    ->store("public/users/$user->id");
            } elseif ($request->has('cv_old')) {
                $data['cv'] = $request->cv_old;
            }
            // ---
            if ($request->has('rl1')) {
                $data['rl1'] = $request->file('rl1')
                    ->store("public/users/$user->id");
            } elseif ($request->has('rl1_old')) {
                $data['rl1'] = $request->rl1_old;
            }
            // ---
            if ($request->has('rl2')) {
                $data['rl2'] = $request->file('rl2')
                    ->store("public/users/$user->id");
            } elseif ($request->has('rl2_old')) {
                $data['rl2'] = $request->rl2_old;
            }
            // ---
            if ($request->has('pass_scan')) {
                $data['pass_scan'] = $request->file('pass_scan')
                    ->store("public/users/$user->id");
            } elseif ($request->has('pass_scan_old')) {
                $data['pass_scan'] = $request->pass_scan_old;
            }
            // DB:
            $application = Application::updateOrCreate(
                ['user_id' => $user->id],
                ['data' => $data, 'verified' => 0]
            );
            // ---
            DB::table('application_program')->where('application_id', $application->id)->delete();
            DB::table('application_program')->insert([
                'application_id' => $application->id,
                'program_id' => $request->program_01,
                'priority' => 1,
            ]);
            DB::table('application_program')->insert([
                'application_id' => $application->id,
                'program_id' => $request->program_02,
                'priority' => 2,
            ]);
            DB::table('application_program')->insert([
                'application_id' => $application->id,
                'program_id' => $request->program_03,
                'priority' => 3,
            ]);
            // ---
        }
        return redirect('/dashboard');
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        if ($user->app) {
            $applicationProgramRows = DB::table('application_program')
                ->where('application_id', $user->app->id)
                ->get();
            $applicationProgramIds = $applicationProgramRows->pluck('id')->toArray();
            DB::table('interviews')->whereIn('application_program_id', $applicationProgramIds)->delete();
            DB::table('application_program')->where('application_id', $user->app->id)->delete();
            Application::where('id', $user->app->id)->delete();
        }
        return back();
    }

    public function item(Request $request, Application $application)
    {
//        $view = 'app/item';
        $view = '_bs/app/item';
        return view(
            $view,
            compact('application')
        );
    }

    public function appList(Request $request)
    {
        $enrollees = User::where('role_id', 1)->get();
        return view('app/list', compact('enrollees'));
    }

    public function edit(Request $request)
    {
        $request->validate([
            'application_id' => 'required',
            'verified' => 'required',
        ]);
        Application::where('id', $request->application_id)->update([
            'verified' => $request->verified,
            'comment' => $request->filled('comment') ? $request->comment : null,
        ]);
        return $this->appList($request);
    }
}

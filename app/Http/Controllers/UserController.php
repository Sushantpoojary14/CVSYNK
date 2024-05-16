<?php

namespace App\Http\Controllers;

use App\Models\job_categories;
use App\Models\Posts;
use App\Models\states;
use App\Models\UserJobApply;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllPosts($start=null,$end=null): \Illuminate\Http\JsonResponse
    {
        $Posts =[];

            $Posts = Posts::query()
                ->with('city')
                ->with('state')
                ->when($start !== null && $end !== null, function ($query)
                    use ($start, $end) {
                         return $query->offset($start)->limit($end+1);
                     })
                ->get();
        $count = Posts::query()
            ->count();

        return response()->json(['posts' => $Posts,'post_count'=>$count],200);
    }

    public function getPostsBySearch($search): \Illuminate\Http\JsonResponse
    {


        $Posts = Posts::query()
            ->with('city')
            ->with('state')
            ->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(job_title) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(company_name) LIKE ?', ['%' . strtolower($search) . '%']);
            })
            ->get();


        return response()->json(['posts' => $Posts,],200);
    }
    public function getAllFilterDetails(): \Illuminate\Http\JsonResponse
    {
        $states= states::query()->with('city')->get();
        $job_categories = job_categories::query()->get();
        return response()->json(['state'=>$states,'job_categories'=>$job_categories],200);
    }
    public function getPostsByFilter(Request $request): \Illuminate\Http\JsonResponse
    {


        $category = $request->input('category');
        $state = $request->input('state');
        $city = $request->input('city');
        $Posts = Posts::query()
            ->with('city')
            ->with('state')
            ->when($category !== null , function ($query)
            use ($category) {
                return $query->where('job_category_id',$category);
            })
            ->when($state !== null , function ($query)
            use ($state) {
                return $query->where('state_id',$state);
            })
            ->when($city !== null , function ($query)
            use ($city) {
                return $query->where('city_id',$city);
            })
            ->get();


        return response()->json(['posts' => $Posts,],200);
    }
    public function applyJobPost(Request $request): \Illuminate\Http\JsonResponse
{


    UserJobApply::query()->create([
        'user_id'=>$request->input('user_id'),
        'post_id'=> $request->input('post_id'),
    ]);


    return response()->json(['message' => 'Added Successfully',],200);
}
    public function getUserJobPost($id): \Illuminate\Http\JsonResponse
    {


        $userData = UserJobApply::query()
            ->where('user_id',$id)->get();
        $job_ids = $userData->pluck('post_id');


        return response()->json(['job_applied' => $job_ids ,],200);
    }
    public function getAllUserPosts($user_id,$start=null,$end=null): \Illuminate\Http\JsonResponse
    {
        $Posts =[];

        $Posts = Posts::query()
            ->with('city')
            ->with('state')
            ->where('user_id',$user_id)
            ->when($start !== null && $end !== null, function ($query)
            use ($start, $end) {
                return $query->offset($start)->limit($end+1);
            })
            ->get();
        $count = count($Posts);

        return response()->json(['posts' => $Posts,'post_count'=>$count],200);
    }
    public function addJobPost(Request $request): \Illuminate\Http\JsonResponse
    {


        Posts::query()->create($request->input()
            );


        return response()->json(['message' => 'Added Successfully',],200);
    }
    public function getAllUserApplied($user_id,$start=null,$end=null): \Illuminate\Http\JsonResponse
    {
        $Posts =[];

        $Posts = Posts::query()
            ->with('city')
            ->with('state')
            ->whereHas('applied',function ($query) use($user_id){
                $query->where('user_id',$user_id);
            })

            ->when($start !== null && $end !== null, function ($query)
            use ($start, $end) {
                return $query->offset($start)->limit($end+1);
            })
            ->get();
        $count = count($Posts);

        return response()->json(['posts' => $Posts,'post_count'=>$count],200);
    }
}

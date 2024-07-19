<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $user = new User();
        $auth = Auth::user();
        $limit_member = $user->getLimitMember($auth->membership_id);

        $limit_article = $limit_member->article_limit ?? 0;
        $limit_video = $limit_member->video_limit ?? 0;

        $data["article"] = $limit_article ? Article::limit($limit_article)->get() : Article::all();
        $data["video"] = $limit_video ? Video::limit($limit_video)->get() : Video::all();
        return view("dashboard", $data);
    }

    public function article($id) {
        $data["article"] = Article::where('id', $id)->first();
        return view("article", $data);
    }
}

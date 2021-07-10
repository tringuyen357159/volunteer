<?php

namespace App\Http\Controllers\Client;
use App\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function News(){
        $news=News::orderBy('id','DESC')->paginate(5);
        $news_volunteering= News::orderBy('id','DESC')->where('type','Volunteering')->take(3)->get();
        $news_organisation= News::orderBy('id','DESC')->where('type','Organisations')->take(3)->get();
        $news_our_blog= News::orderBy('id','DESC')->where('type','Our Blog')->take(3)->get();
        return view('main.pages.news.news')
        ->with('news',$news)
        ->with('news_volunteering', $news_volunteering)
        ->with('news_organisation',$news_organisation)
        ->with('news_our_blog',$news_our_blog);
}
public function NewsHome(){
    $news= News::orderBy('id','DESC')->take(3)->get();
    return view('main.pages.body')
    ->with('news',$news);
}
    public function NewsVolunteer(){
        $news=News::orderBy('id','DESC')->where('type','Volunteering')->paginate(5);
        $news_volunteering= News::orderBy('id','DESC')->where('type','Volunteering')->take(3)->get();
        $news_organisation= News::orderBy('id','DESC')->where('type','Organisations')->take(3)->get();
        $news_our_blog= News::orderBy('id','DESC')->where('type','Our Blog')->take(3)->get();
        return view('main.pages.news.newsvolunteer')
        ->with('news',$news)
        ->with('news_volunteering', $news_volunteering)
        ->with('news_organisation',$news_organisation)
        ->with('news_our_blog',$news_our_blog);
    }
    public function NewsOrg(){
        $news=News::orderBy('id','DESC')->where('type','Organisations')->paginate(5);
        $news_volunteering= News::orderBy('id','DESC')->where('type','Volunteering')->take(3)->get();
        $news_organisation= News::orderBy('id','DESC')->where('type','Organisations')->take(3)->get();
        $news_our_blog= News::orderBy('id','DESC')->where('type','Our Blog')->take(3)->get();
        return view('main.pages.news.newsorganisations')
        ->with('news',$news)
        ->with('news_volunteering', $news_volunteering)
        ->with('news_organisation',$news_organisation)
        ->with('news_our_blog',$news_our_blog);
    }
    public function NewsBlog(){
        $news=News::orderBy('id','DESC')->where('type','Our Blog')->paginate(5);
        $news_volunteering= News::orderBy('id','DESC')->where('type','Volunteering')->take(3)->get();
        $news_organisation= News::orderBy('id','DESC')->where('type','Organisations')->take(3)->get();
        $news_our_blog= News::orderBy('id','DESC')->where('type','Our Blog')->take(3)->get();
        return view('main.pages.news.newsblog')
        ->with('news',$news)
        ->with('news_volunteering', $news_volunteering)
        ->with('news_organisation',$news_organisation)
        ->with('news_our_blog',$news_our_blog);
    }
    public function DetailNews($slug){
        $news_detail = News::where('slug',$slug)->first();
        $news_random=News::whereNotIn('slug',[$slug])->take(3)->get();
        return view('main.pages.news.detail')
        ->with('news_detail',$news_detail)
        ->with('news_random',$news_random);
    }
}

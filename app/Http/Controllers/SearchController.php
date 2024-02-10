<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log; 

class SearchController extends Controller
{

    /** 
     * Show the navbar search results.
     * 
     * @param Request $request
     * @return View
    */

    public function search(Request $request)
    {
        if(! $request->filled('searchVal') && ! $request->filled('searchBy') ){
            return back(); 
        }

        $searchBy = $request->input('searchBy');  
        $keyword = $request->input('searchVal'); 

        if($searchBy == 'users' && $keyword != null){
            $users = User::where('full_name', 'LIKE', '%'.$keyword.'%')
                    ->get(); 
            
            $results = count($users); 
            
            return view('admin.results.users-index', compact('keyword', 'users', 'searchBy', 'results')); 

        }elseif($searchBy == 'categories' && $keyword != null){

            $categories = Category::where('name', 'LIKE', '%'.$keyword.'%')
                    ->get(); 

            $results = count($categories); 

            return view('admin.results.categories-index', compact('keyword', 'categories', 'searchBy', 'results')); 
            
        }elseif($keyword != null){

            $users = User::where('full_name', 'LIKE', '%'.$keyword.'%')
                ->get(); 

            $categories = Category::where('name', 'LIKE', '%'.$keyword.'%')
                ->get(); 
            
            $userResults = count($users); 
            $categoriesResults = count($categories); 

            $totalResults = $userResults + $categoriesResults; 

            return view('admin.results.all-index', compact('keyword', 'users', 'categories', 'userResults', 'categoriesResults',  'totalResults')); 

        }

        Log::info('A navbar search was triggered with the next keyword => {$keyword}'); 

    }

   

}

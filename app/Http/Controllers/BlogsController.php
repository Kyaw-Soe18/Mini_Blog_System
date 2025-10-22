<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BlogsController extends Controller
{
    // blogs list page 
    public function index(){
        $data = Blogs::when(request('searchKey'),function($query){
                    $searchKey = request('searchKey');
                    $query->whereAny(['title', 'description', 'address', 'fee', 'rating'],'like', '%'.$searchKey.'%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(3);

        return view('index', compact('data'));
    }

    // create blogs post 
    public function create(Request $request){

        // check validation
        $this->checkBlogsValidation($request, 'create');

        $data = $this->requestBlogsData($request);

        if($request->hasFile('image')){
            $fileName = uniqid() .$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/uploads/', $fileName);
            $data['image'] = $fileName;
        }else {
            $data['image'] = null;
        }

        Blogs::create($data);
        toast('Success Toast','success');
        return back();
    }

    // delete blogs
    public function delete($id){
        $oldImageName = Blogs::where('id', $id)->first('image');
        $oldImageName = $oldImageName['image'];

        if(file_exists( public_path('uploads/'.$oldImageName) )){
            unlink( public_path('uploads/'.$oldImageName) );
        }

        Blogs::findOrFail($id)->delete();
        Alert::success('Delete Success', 'Your Blog has been deleted...');
        return back();
    }

    // go to blog details
    public function detail($id){
        $data = Blogs::where('id', $id)->first();
        return view('detail', compact('data'));
    }

    // edit blog page
    public function edit($id){
        $data = Blogs::where('id', $id)->first();
        return view('update', compact('data'));
    }

    // update blog post
    public function update(Request $request){
        $id = $request->blog_id;
        $old_image = $request->old_image;

        $this->checkBlogsValidation($request, 'update');

        $data = $this->requestBlogsData($request);

        if($request->hasFile('image')){

            // delete old image under public folder
            if($old_image !== null){
                if(file_exists( public_path('uploads/'.$old_image) )){
                    unlink( public_path('uploads/'.$old_image) );
                }
            }

            // upload new image under public folder
            $fileName = uniqid() .$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/uploads/', $fileName);
            $data['image'] = $fileName;
        }else {
            $data['image'] = $old_image == null ? null : $old_image;
        }

        // update data to table
        Blogs::where('id', $id)->update($data);

        Alert::success('Update Success', 'Your Blog has been updated...');

        return to_route('blogList');
    }

    // check blogs validation
    private function checkBlogsValidation($request, $action){

        $validationRules = [
            'title' => 'required|unique:blogs,title,'.$request->blog_id,
            'description' => 'required',
            'fee' => 'required',
            'address' => 'required|min:3',
            'rating' => 'required',
        ];

        $validationRules['image'] = $action == 'create' ? 'required|mimes:png,jpg,jpeg' : 'mimes:png,jpg,jpeg';

        $validationMessage = [
            'title.required' => 'ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'description.required' => 'ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'fee.required' => 'ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'address.required' => 'ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'rating.required' => 'ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
        ];

        $validator = $request->validate($validationRules, $validationMessage);
    }

    // request blog data
    private function requestBlogsData(Request $request){
        return[
            'title' => $request->title,
            'description' => $request->description,
            'fee' => $request->fee,
            'address' =>  $request->address,
            'rating' => $request->rating,
        ];
    }
} 

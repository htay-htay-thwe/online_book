<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function adminDashboard()
    {
        $adminData = User::where('role', null)->get();
        return view('admin.adminData', compact('adminData'));
    }

    public function adminInput(Request $request)
    {
        //  validation-start
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required',
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        // validation-end
        $data = $this->getAdminData($request);
        if ($request->hasFile('image')) {
            $dbImage = User::where('id', Auth::user()->id)->first();

            // if($dbImage != null){
            //     Storage::delete('public/'.$dbImage->image);
            // }
            if ($dbImage && $dbImage->bookImage) {
                $oldImagePath = public_path('books/' . $dbImage->bookImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // delete the old file
                }
            }

            $imageName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            // $request->file('image')->storeAs('public',$imageName);
            $request->file('bookImage')->move(public_path('books'), $imageName);
            $data['image'] = $imageName;
        }
        User::where('id', Auth::user()->id)->update($data);
        $adminData = User::where('role', null)->get();
        return redirect()->route('admin#input', compact('adminData'));

    }

    private function getAdminData($request)
    {
        return [
            'name'  => $request->name,
            'email' => $request->email,

        ];
    }
}

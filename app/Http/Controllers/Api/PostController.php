<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    //user login Page
    public function login(Request $request)
    {
        //email password
        $user = User::where('email', $request->email)->first();
        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                $orderTotal = Order::where('user_id', $request->user_id)->get();
                return response()->json([
                    'orderTotal' => $orderTotal,
                    'user'       => $user,
                    'token'      => $user->createToken(time())->plainTextToken,
                ]);
            } else {
                return response()->json([
                    'user'  => null,
                    'token' => null,
                ]);
            }
        } else {
            return response()->json([
                'user'  => null,
                'token' => null,
            ]);
        }
    }

    //register
    public function register(Request $request)
    {
        $data = [
            'role'     => $request->role,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ];

        $userData = User::create($data);

        $user = User::where('email', $request->email)->first();
        return response()->json([
            'user'  => $user,
            'token' => $user->createToken(time())->plainTextToken,
        ]);
    }

    public function UpdateUserData(Request $request)
    {
        $id   = $request->user_id;
        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'image' => $request->profile_image,
        ];
        // If a file is uploaded, store it
        if ($request->hasFile('profile_image')) {
            $file      = $request->file('profile_image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            // $path = $file->storeAs('public', $imageName);
            $path = $request->file('bookImage')->move(public_path('books'), $imageName);
            // $storagePath = str_replace('public/', '', $path);
            $data['image'] = $path;
        }
        $updateUserData = User::where('id', $id)->update($data);
        $getUserData    = User::where('id', $id)->first();
        logger($data);
        return response()->json([
            'updateUserData' => $updateUserData,
            'getUserData'    => $getUserData,
        ]);

    }

    public function updatePassword(Request $request)
    {
        $id   = $request->user_id;
        $data = [
            'password' => Hash::make($request->newPassword),

        ];
        $password = User::where('id', $id)->update($data);
        return response()->json([
            'updatePassword' => $password,
        ]);
    }

    public function getPassword($user_id)
    {
        $user = User::find($user_id);

        if ($user) {
            $password = $user->password;
            logger($password);
            return response()->json([
                'getPassword' => $password,
                'message'     => 'success',
            ]);
        }

    }
}

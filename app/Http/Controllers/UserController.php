<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\UserRegister;
use App\Mail\ForgetPassword;

class UserController extends Controller
{
    public function register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email'=>'required|email|unique:users',
            'mobile'=>'regex:/[6-9]{1}[0-9]{9}/',
            'pin_code'=>'numeric',
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{
            $user=New User;
            $user->firstname=$req->firstname;
            $user->lastname=$req->lastname;
            $user->email=$req->email;
            $user->mobile=$req->mobile;
            $user->security_key=Crypt::encryptString($req->email);
            $user->country=$req->country;
            $user->city=$req->city;
            $user->pin_code=$req->pin_code;
            if($user->save()){
             $user->assignRole('user');
             Mail::to($user->email)->send(New UserRegister($user));
             return response()->json(['code'=>200,'message'=>'Please check your mail to verify the account.']);
            }
            return response()->json(['error' => "Technical Issue",'code'=>403]);
        }
    }

    public function verifiedpassword(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(),'code=>402']);
        } else {
            // $decrypted = Crypt::decryptString($req->checkid);
            if (!empty($req->security_key)) {
                $user = User::where('security_key', $req->security_key)->update(['password' => Hash::make($req->password), 'security_key' => 'null']);
                if ($user == 1) {
                    return response()->json(['code' => 200]);
                } else {
                    return response()->json(['code' => 403]);
                }
            }
            return response()->json(['code' => 200], 200);
        }
    }

    public function redirectGoogle()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirect();
    }

    public function runCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $finduser = User::where('email', $user->email)->first();
        if ($finduser) {
            Auth::loginUsingId($finduser->id, false);
            return response()->Json(['code'=>'200','data'=>Auth::user()]);
        } else {
            $user_data = new User;
            $user_data->firstname = $user->name;
            $user_data->email = $user->email;
            $user_data->profile = $user->user['picture'];
            $user_data->save();
            $user_data->assignRole('user');
            Auth::loginUsingId($user_data->id, false);
              return response()->Json(['code'=>'200','data'=>Auth::user()]);
           
        }
    }

    public function login(Request $req){
        
        $username=$req->username;
        $password=$req->password;
        
        $validator = Validator::make($req->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(),'code'=>402] );
        } else {
            $role='user';
        $user= User::where('email', $username)->where('role', $role)->first();
        
            if (!$user || !Hash::check($password, $user->password)) {
                return response()->json([
                    'message' => 'These credentials do not match our records.','code'=>401]);
            }
        
             $token = $user->createToken('travander_token')->plainTextToken;
        
        
             return response()->json([
                 'id'=>$user->id,
                 'email'=>$user->email,
                 'role'=>$user->role,
                 'firstname'=>$user->firstname,'lastname'=>$user->lastname,'token'=>$token,'code'=>200]);
        }
    }

    public function logout(Request $req){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'Logout Successfully','code'=>200],200);
    }

    public function updatedetails($id,Request $req)
    {

        $validator = Validator::make($req->all(), [
            'email'=>'required|email',
            'mobile'=>'required|regex:/[6-9]{1}[0-9]{9}/',
            'pin_code'=>'required|numeric',
            'firstname'=>'required',
            'lastname'=>'required',
            'city'=>'required',
            'country'=>'required',
            'dob'=>'required',
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{
            if(!empty($id) && is_numeric($id)){
                $user=User::findOrFail($id);
            $user->firstname=$req->firstname;
            $user->lastname=$req->lastname;
            $user->email=$req->email;
            $user->mobile=$req->mobile;
            $user->dob=$req->dob;
            $user->short_intro=$req->short_intro;
            $user->insta_handle=$req->insta_handle;
            $user->country=$req->country;
            $user->city=$req->city;
            $user->pin_code=$req->pin_code;
            if(!empty($req->hasfile('profile'))){
            $file=$req->file('profile');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('profile/',$filename);
            $user->profile=$filename;
            
        }
            if($user->save()){
                 return response()->json(['code'=>200,
        'firstname'=>$user->firstname,
        'lastname'=>$user->lastname,
        'email'=>$user->email,
        'profile_pic'=>$user->profile,
        'mobile'=>$user->mobile,
        'dob'=>$user->dob,
        'country'=>$user->country,
        'city'=>$user->city,
        'pin_code'=>$user->pin_code,
        'insta_handle'=>$user->insta_handle,
        'short_intro'=>$user->short_intro,
        ]);
            }else{
              return response()->json(['code'=>401,'message'=>"You are not authorized person to access this page"]);  
            }
            }
              return response()->json(['sucess'=>403,'message'=>"Invalid Request"]);
        }
             
        
    }

    public function changepassword($id,Request $request){
        if(!empty($id) & is_numeric($id)){
            $user=User::findorFail($id);
            $userpassword=$user->password ?? '';
            $currentpassword=$request->currentpassword ?? '';
            $newpassword=$request->newpassword ?? '';
            $confirmpassword=$request->confirmpassword ?? '';
            if (Hash::check( $currentpassword,$userpassword)) {
                if(!empty($newpassword) & !empty($confirmpassword)){
                    if($newpassword==$confirmpassword){
                    $user->password=Hash::make($newpassword);
                    $user->save();
                     return response()->json(['code'=>200,'message'=>"Password Change successfully"]);
                }else{
                     return response()->json(['code'=>402,'message'=>"New Password and Confirm Password Doesn't match"]);
                }
                }else{
                     return response()->json(['code'=>402,'message'=>"New Password and Confirm Password Doesn't Blank"]);
                }
            }else{
                return response()->json(['code'=>402,
                'currentpassword'=>$currentpassword,
                'message'=>"Password Doesn't Match"]);  
            }
        }else{
             return response()->json(['code'=>401,'message'=>"you are not authorized person to access this page"]);  
        }
    }

    public function forgot_password(Request $req){

         $validator = Validator::make($req->all(), [
            'email'=>'required'
        ]);

            if($validator->fails()){
                return response()->json(['error'=>$validator->errors(),'status'=> 401]);
            }else{
            $email=$req->email;
            $user=User::where('email',$email)->get()->first();
                if($user){
                    $userss=User::find($user->id);
                        $userss->verifycode=rand(111111,999999);
                        $userss->save();
            Mail::to($userss->email)->send(new ForgetPassword($userss));
                    return response()->json(['code'=>200,'message'=>"Please check your Mail to change the password"]); 
                        }else{
                    return response()->json(['code'=>402,'message'=>"Email Doesn't Match"]); 
                }
            }
    }

    public function reset_password(Request $req){

         $validator = Validator::make($req->all(), [
            'password'=>'required',
            'username'=>'required',
            'code'=>'required'
        ]);

            if($validator->fails()){
                return response()->json(['error'=>$validator->errors(),'status'=> 401]);
            }else{
            $password=$req->password;
            $username=$req->username;
            $code=$req->code;
                $user=User::where('email',$username)->where('verifycode',$code)->get()->first();
                if($user){
                    $user=User::findorfail($user->id);
                        $user->password=Hash::make($password);
                        $user->verifycode=NULL;
                        $user->save();
                    return response()->json(['code'=>200,'message'=>'Password Change Successfully']);
                        }else{
                    return response()->json(['code'=>403,'message'=>'Invalid User details']); 
                }
    
            }
    }

   
}
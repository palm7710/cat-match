<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\Facades\Image;

use App\Services\CheckExtensionServices;
use App\Services\FileUploadServices;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'img_name' => ['file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2000'],
            'self_introduction' => ['string', 'max:255'],
        ]);
    }

    protected function create(array $data)
    {
        $imageFile = $data['img_name'];
        $list = FileUploadServices::fileUpload($imageFile);
        list($extension, $fileNameToStore, $fileData) = $list;
        $data_url = CheckExtensionServices::checkExtension($fileData, $extension);
        
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $data_url = 'data:image/jpeg;base64,' . base64_encode($fileData);
                break;
            case 'png':
                $data_url = 'data:image/png;base64,' . base64_encode($fileData);
                break;
            case 'gif':
                $data_url = 'data:image/gif;base64,' . base64_encode($fileData);
                break;
            default:
                throw new \Exception('Unsupported image format');
        }

        $image = Image::make($data_url);
        $image->resize(400, 400)->save(storage_path('app/public/images/' . $fileNameToStore));

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'self_introduction' => $data['self_introduction'],
            'sex' => $data['sex'],
            'img_name' => $fileNameToStore,
        ]);
    }
}

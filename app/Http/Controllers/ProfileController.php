<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ProfileService;
use App\Models\User;

class ProfileController extends Controller
{
    
    private ProfileService $profileService;

    /**
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index(): Response
    {
        $title = 'My Profile';

        $user = auth()->user();

        return response()->view('userprofile.index', compact('title','user'));

    }

    public function editprofile(): Response
    {
        $title = 'Ubah Data Profile';

        $user = auth()->user();

        return response()->view('userprofile.editprofile', compact('title','user'));
    }

    public function updateprofile(ProfileRequest $request)
    {
        if ($this->profileService->updateProfile($request)) {
            return redirect()->route('myprofile')->with('success', 'Data Profile Berhasil Diubah.');
        } else {
            return redirect('/myprofile/editprofile')->withInput()->with('error', 'Ubah data gagal. Silahkan coba lagi.');
        }
    }

    public function editpassword(): Response
    {
        $title = 'Ubah Password';

        return response()->view('userprofile.editpassword', compact('title'));
    }

    public function updatepassword(ProfileRequest $request)
    {
        if ($this->profileService->updatePassword($request)) {
            return redirect()->route('myprofile')->with('success', 'Password Berhasil Diubah.');
        } else {
            return redirect('/myprofile/editpassword')->withInput()->with('error', 'Ubah password gagal. Silahkan coba lagi.');
        }
    }
}

<?php

namespace App\Services;

//MODELS
use App\Models\User;

//AVATAR
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;


class UserService
{
    //edit profile for selected fields
    public function updateUserProfile(User $user, $validated) {
        //fill up array with NOT empty fields to make correct update
        $userFieldsArray = [];

        foreach($validated as $key => $value) {
            if($value != null && $value != '' && $key != 'avatar') $userFieldsArray[$key] = $value;

            //change user avatar
            if($key == 'avatar' && $value != null && $value != '' ) {
                $avaName = $this->saveAvatar($user->id, $validated['avatar']);

                $userFieldsArray[$key] = $avaName;
            }
        }

        $user->update($userFieldsArray);

        return $user;
    }

    //user avatar logic
    protected function saveAvatar($userId, $avatar) {
        $manager = new ImageManager(new Driver());

        $ava = $manager->decodePath($avatar->getPathname());

        $ava->cover(48, 48);

        $encoded = $ava->encodeUsingFormat(Format::JPEG, quality: 65);

        $avaName = $userId . uniqid() . '.jpg';
        Storage::disk('public')->put($avaName, $encoded);

        //get old url of user's avatar and delete file if exist
        $avaUrlOld = User::where('id', $userId)->value('avatar');

        if($avaUrlOld) {
            Storage::disk('public')->delete($avaUrlOld);
        }

        //return url saved pic
        return $avaName;
    }
}

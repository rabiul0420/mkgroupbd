<?php

/**
 * Required sign for from label
 */

use App\Models\Menu;
use App\Models\Income;
use App\Models\Expense;
use Illuminate\Support\Str;
use App\Models\MenuActivity;
use App\Models\UserPermission;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

if (!function_exists('starSign')) {
    function starSign(): string
    {
        return "<span class='text-danger'>" . " *" . "</span>";
    }
}

/**
 * Return saved message with type
 */
if (! function_exists('savedMessage')) {
    function savedMessage($message = "Information has been saved savedfully!"): array
    {
        return [
            'type' => 'primary',
            'message' => $message
        ];
    }
}

/**
 * Return delete message with type
 */
if (! function_exists('updateMessage')) {
    function updateMessage($message = "Information has been updated successfully!"): array
    {
        return [
            'type' => 'info',
            'message' => $message
        ];
    }
}

/**
 * Return delete message with type
 */
if (! function_exists('deleteMessage')) {
    function deleteMessage($message = "Information has been deleted successfully!"): array
    {
        return [
            'type' => 'danger',
            'message' => $message
        ];
    }
}

/**
 * Return warning message
 */
if (! function_exists('warningMessage')) {
    function warningMessage($message = "Something is wrong!"): array
    {
        return [
            'type' => 'warning',
            'message' => $message
        ];
    }
}

/**
 * Return warning message
 */
if (! function_exists('dangerMessage')) {
    function dangerMessage($message = "Something is wrong!"): array
    {
        return [
            'type' => 'danger',
            'message' => $message
        ];
    }
}

/**
 * Fetch Username by id
 */
if (! function_exists('userNameById')) {
    function userNameById($id): string
    {
        return \App\Models\User::find($id)->name ?? "N/A";
    }
}

/**
 * Return string with limit
 */
if (! function_exists('strLimit')) {
    function strLimit($string, $length = 50)
    {
        return Str::limit($string, $length, '...');
    }
}

/**
 * Upload image
 */
if (! function_exists('uploadImage')) {
    function uploadImage($file, $path = "assets/files/", $width = "", $height = "", $size = "", $name = ""): string
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $imageName = $name . "-" . time() . $file->getClientOriginalName();
        $image = Image::make($file->getPathname());
        if ((isset($height)) and (isset($width))) {
            $image->resize($width, $height);
        }
        if (isset($size)) {
            $image->filesize($size);
        }
        $image->save($path . $imageName);
        return $path . $imageName;
    }
}

/**
 * Check file is image
 */
if (! function_exists('isImage')) {
    function isImage($file)
    {
        $file_type = $file->getClientMimeType();
        $text = explode('/', $file_type)[0];
        if ($text == "image") {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Get file extension
 */
if (! function_exists('fileExtension')) {
    function fileExtension($file)
    {
        if (isset($file)) {
            return $file->getClientOriginalExtension();
        } else {
            return "Inalid file";
        }
    }
}

/**
 * Get file type
 */
if (! function_exists('imageWidthHeight')) {
    function imageWidthHeight($image)
    {
        $img_size_array = getimagesize($image);
        $width = $img_size_array[0];
        $height = $img_size_array[1];
        return array('width' => $width, 'height' => $height);
    }
}

/**
 * Get path image info
 */
if (! function_exists('pathImageInfo')) {
    function pathImageInfo($path)
    {
        $image = Image::make($path);
        return [
            'type' => explode('/', $image->mime())[0],
            'extension' => explode('/', $image->mime())[1],
            'height' => $image->height(),
            'width' => $image->width(),
        ];
    }
}

/**
 * Upload file
 */
if (! function_exists('uploadFile')) {
    function uploadFile($file, $path = "assets/files/"): string
    {
        $uniqueFileName = $file->getClientOriginalName() . '-' . time() . '-' . '.' . $file->getClientOriginalExtension();
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $file->move($path, $uniqueFileName);
        return $path . $uniqueFileName;
    }
}

/**
 * Get pusher info from file
 */
if (!function_exists('siteSetting')) {
    function siteSetting()
    {
        if (file_exists('assets/json/site_setting.json')) {
            $jsonString = File::get('assets/json/site_setting.json');
            return json_decode($jsonString, true);
        } else {
            return "";
        }
    }
}

/**
 * Get blood group list
 */
if (! function_exists('bloodGroups')) {
    function bloodGroups(): array
    {
        return ["A+", "A-", "B+", "B-", "O+", "O-", "AB+", "AB-"];
    }
}

/**
 * Return error message with text danger
 */
if (!function_exists('displayError')) {
    function displayError(string $error = "Something went wrong!")
    {
        return "<span class='text-danger'>" . $error . "</span>";
    }
}

/**
 * Check field has error or not
 */
if (!function_exists('hasError')) {
    function hasError(string $fieldName)
    {
        // Access the current request's validation errors
        $errors = session()->get('errors');
        // Check if there are any errors for the specified field
        return $errors && $errors->has($fieldName) ? 'is-invalid' : '';
    }
}

/**
 * Return a spinner icon
 */
if (!function_exists('commonSpinner')) {
    function commonSpinner()
    {
        return "<i class='fa fa-spinner fa-spin me-2 spinner d-none'></i>";
    }
}

/**
 * Return string with limit
 */
if (! function_exists('strLimit')) {
    function strLimit($string, $length = 50)
    {
        return Str::limit($string, $length, '...');
    }
}


/**
 * Get site settings data
 */
if (!function_exists('siteSetting')) {
    function siteSetting()
    {
        if (file_exists('assets/json/site_setting.json')) {
            $jsonString = File::get('assets/json/site_setting.json');
            return json_decode($jsonString, true);
        } else {
            return "";
        }
    }
}

/**
 * Format date
 */
if (!function_exists('formatDate')) {
    function formatDate($date, $format = "Y-m-d")
    {
        return date($format, strtotime($date));
    }
}

if (! function_exists('encrypt_decrypt')) {
    function encrypt_decrypt($key, $type)
    {
        $str_rand = "OipQx4ehQqG5b9a";
        if (!$key) {
            return false;
        }
        if ($type == 'decrypt') {
            $en_slash_added1 = trim(str_replace(array('mkgroup'), '/', $key));
            $en_slash_added = trim(str_replace(array('mkgroupbd'), '%', $en_slash_added1));
            $key_value = openssl_decrypt($en_slash_added, "AES-128-ECB", $str_rand);
            return $key_value;
        } elseif ($type == 'encrypt') {
            $key_value = openssl_encrypt($key, "AES-128-ECB", $str_rand);
            $en_slash_remove1 = trim(str_replace(array('/'), 'mkgroup', $key_value));
            $en_slash_remove = trim(str_replace(array('%'), 'mkgroupbd', $en_slash_remove1));
            return $en_slash_remove;
        }
        return FALSE;    # if function is not used properly
    }
}

/**
 * Check Menu permission
 */
if (! function_exists('menuPermission')) {
    function menuPermission($menu_name)
    {
        $menu_id = Menu::where("name", $menu_name)->first()->id;
        $condition = [
            'user_id' => auth()->user()->id,
            'menu_id' => $menu_id
        ];
        if (UserPermission::where($condition)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Check route permission
 */
if (! function_exists('routePermission')) {
    function routePermission($route_name)
    {

        // if(!MenuActivity::where('route_name',$route_name)->exists()) {
        //     dd($route_name);
        //     MenuActivity::where('route_name',$route_name)->update(['created_at' => Null]);
        // }
        $activity_id = MenuActivity::where('route_name', $route_name)->first()->id;
        if (!isset($activity_id)) {
            dd($route_name);
        }
        $condition = [
            'user_id' => auth()->user()->id,
            'activity_id' => $activity_id
        ];
        if (UserPermission::where($condition)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}

// Reports
if (! function_exists('totalProfit')) {
    function totalProfit()
    {
        return Income::sum('net_income') - Expense::sum('amount');
    }
}

if (! function_exists('dailyProfit')) {
    function dailyProfit()
    {
        $d_profit= Income::selectRaw('DATE(created_at) as date, SUM(net_income) as total_income')
            ->groupBy('date')
            ->get()
            ->map(function ($income) {
                $totalExpenses = Expense::whereDate('created_at', $income->date)->sum('amount');
                return [
                    'date' => $income->date,
                    'daily_profit' => $income->total_income - $totalExpenses
                ];
            });
            return json_decode($d_profit);
    }
}

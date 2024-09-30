<?php

use Illuminate\Support\Facades\Storage;

// Check if the 'set_active' function does not already exist to avoid redeclaration.
if (!function_exists('set_active')) {
    /**
     * Helper function to set an 'active' class on a navigation link based on the current URL path.
     *
     * @param array $path An array of URL paths or patterns to match against the current request.
     * @param string $active The CSS class to apply if the current request URL matches any of the paths.
     * @return string Returns the CSS class if the current request matches one of the paths, otherwise returns an empty string.
     */
    function set_active($path = [], $active = 'active')
    {
        // Use 'Request::is' method to check if the current URL matches any of the provided paths.
        // 'call_user_func_array' allows passing the array of paths as arguments to the 'Request::is' method.
        return call_user_func_array('Request::is', $path) ? $active : '';
    }
}

if (!function_exists('set_selected')) {
    /**
     * Helper function to set the 'selected' attribute for a select option (supports single and multiple selections).
     *
     * @param string $name The name of the input (used for old() retrieval).
     * @param mixed $value The current value of the option being checked.
     * @param mixed $selectedValues The actual stored value(s) (e.g., from the database), can be a single value or an array.
     * @param string $selected The attribute to apply if the value matches.
     * @return string Returns 'selected' if the value matches old input or the stored value(s).
     */
    function set_selected($name, $value, $selectedValues = null, $selected = 'selected')
    {
        // Get old input value, which might be an array if it's a multiple select
        $oldValues = old($name, $selectedValues);

        // Ensure $oldValues is always an array for consistency
        $oldValues = is_array($oldValues) ? $oldValues : [$oldValues];

        // Return 'selected' if the $value exists in the array of $oldValues
        return in_array($value, $oldValues) ? $selected : '';
    }

    // Select thuong
    // <select class="form-select" name="role">
    //     <option value="admin" {{ set_selected('role', 'admin', $user->role) }}>Admin</option>
    //     <option value="user" {{ set_selected('role', 'user', $user->role) }}>User</option>
    // </select>

    // Select 2
    // <select class="form-select select2" name="roles[]" multiple>
    //     @foreach($roles as $role)
    //         <option value="{{ $role->id }}" {{ set_selected('roles', $role->id, $user->roles->pluck('id')->toArray()) }}>
    //             {{ $role->name }}
    //         </option>
    //     @endforeach
    // </select>
}

// Check if the 'set_checked' function does not already exist to avoid redeclaration.
if (!function_exists('set_checked')) {
    /**
     * Helper function to set the 'checked' attribute for radio buttons or checkboxes.
     *
     * @param mixed $value The value to compare against the current request's old input or existing data.
     * @param mixed $currentValue The value of the option being checked.
     * @param string $checked The attribute to apply if the value matches the current request's old input or existing data.
     * @return string Returns 'checked' if the value matches the old input or existing data, otherwise returns an empty string.
     */
    function set_checked($value, $currentValue, $checked = 'checked')
    {
        // Get the old input value or current value for the update scenario.
        $oldValue = old('value', $currentValue); // Fetch the old input value

        // Return the 'checked' attribute if the values match
        return $value == $oldValue ? $checked : '';
    }
}

// Check if the 'set_disabled' function does not already exist to avoid redeclaration.
if (!function_exists('set_disabled')) {
    /**
     * Helper function to set the 'disabled' attribute for form elements.
     *
     * @param bool $condition The condition to check for disabling the element.
     * @param string $disabled The attribute to apply if the condition is true.
     * @return string Returns 'disabled' if the condition is true, otherwise returns an empty string.
     */
    function set_disabled($condition, $disabled = 'disabled')
    {
        // Return the 'disabled' attribute if the condition is true
        return $condition ? $disabled : '';
    }
}

// Check if the 'set_readonly' function does not already exist to avoid redeclaration.
if (!function_exists('set_readonly')) {
    /**
     * Helper function to set the 'readonly' attribute for form fields.
     *
     * @param bool $condition The condition to check for setting the readonly attribute.
     * @param string $readonly The attribute to apply if the condition is true.
     * @return string Returns 'readonly' if the condition is true, otherwise returns an empty string.
     */
    function set_readonly($condition, $readonly = 'readonly')
    {
        // Return the 'readonly' attribute if the condition is true
        return $condition ? $readonly : '';
    }
}

// Check if the 'set_class' function does not already exist to avoid redeclaration.
if (!function_exists('set_class')) {
    /**
     * Helper function to set custom classes based on conditions.
     *
     * @param bool $condition The condition to check for adding a class.
     * @param string $class The class to add if the condition is true.
     * @return string Returns the class if the condition is true, otherwise returns an empty string.
     */
    function set_class($condition, $class = '')
    {
        // Return the class if the condition is true
        return $condition ? $class : '';
    }
}

if (!function_exists('checkFile')) {
    /**
     * Check the existence of a file on local storage.
     *
     * @param string $path The path of the file in local storage.
     * @return string|null Returns the URL of the file if it exists, otherwise returns null.
     */
    function checkFile($path)
    {
        try {
            $disk = Storage::disk('local'); // Change 'local' to your desired disk if needed

            // Check if $path is a valid string
            if (is_string($path) && !empty($path) && $disk->exists($path)) {
                // Return the URL of the file
                return $disk->url($path);
            }
        } catch (Exception $e) {
            // Log the error for debugging
            \Log::error('Error checking local storage file: ' . $e->getMessage());
        }

        // Return null if no file is found or an error occurs
        return null;
    }
}

if (!function_exists('checkMinioImage')) {
    /**
     * Check the existence of an image on Minio (S3).
     *
     * @param string $path The path of the image file on Minio (S3).
     * @return string|null Returns the URL of the image if it exists, otherwise returns null.
     */
    function checkMinioImage($path)
    {
        try {
            $disk = Storage::disk('s3');

            // Check if $path is a valid string
            if (is_string($path) && !empty($path) && $disk->exists($path)) {
                // Return the URL of the image
                return $disk->url($path);
            }
        } catch (Exception $e) {
            // Log the error for debugging
            \Log::error('Error checking Minio image: ' . $e->getMessage());
        }

        // Return null if no image is found or an error occurs
        return null;
    }
}

if (!function_exists('getGreeting')) {
    function getGreeting()
    {
        $hour = date('H'); // Get the current hour in 24-hour format

        if ($hour >= 5 && $hour < 12) {
            $time = 'morning';
        } elseif ($hour >= 12 && $hour < 17) {
            $time = 'afternoon';
        } elseif ($hour >= 17 && $hour < 21) {
            $time = 'evening';
        } else {
            $time = 'night';
        }

        // Correctly access the translation key
        return __('messages.time.' . $time . '.greeting'); // Concatenation
    }
}

if (!function_exists('getRandomQuote')) {
    function getRandomQuote()
    {
        $quotes = [
            __('messages.quotes.1'),
            __('messages.quotes.2'),
            __('messages.quotes.3'),
            __('messages.quotes.4'),
            __('messages.quotes.5'),
        ];

        return $quotes[array_rand($quotes)];
    }
}

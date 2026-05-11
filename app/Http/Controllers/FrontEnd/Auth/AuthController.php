<?php
namespace App\Http\Controllers\FrontEnd\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
class AuthController extends Controller
{
    public function FrontendLogin(){
        return view('FrontEnd.Auth.login');
    }
    public function Frontendregister(){
        return view('FrontEnd.Auth.register');
    }

    public function Frontendlogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('FrontendLogin');
    }
    public function FrontendregisterSave(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'nullable',
            'phone' => 'nullable',
            'email' => 'required|email',
            'password' => 'required',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $imageName = null;

        if ($request->hasFile('profile_photo')) {

            $manager = new ImageManager(new Driver());
            $imageFile = $request->file('profile_photo');

            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();

            // thumbnail
            $resizedImage = $manager
                ->read($imageFile->getRealPath())
                ->resize(150, 150)
                ->toJpeg(80);

            file_put_contents(
                public_path('/assets/uploads/thumbnail/customers/' . $imageName),
                (string) $resizedImage
            );

            $imageFile->move(
                public_path('/assets/uploads/customers'),
                $imageName
            );
        }

        // ✔ SAVE USER
        $customer = Customers::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password), // IMPORTANT FIX
            'profile_photo' => $imageName
        ]);

        // ✔ LOGIN USER
        Auth::guard('web')->login($customer);

        return redirect()->route('FrontendLogin')->with('success', 'Register successful!');
    }
    public function FrontendLoginAction(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $customer = Customers::where('name', $request->name)->first();

        if (!$customer) {
            return back()->with('error', 'User not found!');
        }

        if (!Hash::check($request->password, $customer->password)) {
            return back()->with('error', 'Wrong password!');
        }

        Auth::guard('customer')->login($customer);
        $request->session()->regenerate();

        return redirect()->route('home.index');
    }
}

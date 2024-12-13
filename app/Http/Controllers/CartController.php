<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function showCart()
    {
        $cartItems = Session::get('cart', []);
        return view('user.cart', compact('cartItems'));
    }

    public function addToCart(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        $cart = Session::get('cart', []);
        
        $cart[$courseId] = [
            'course' => $course,
            'selected_date' => $request->input('selected_date', null)
        ];

        Session::put('cart', $cart);

        return redirect()->route('user.cart')->with('success', 'Kurs został dodany do koszyka.');
    }

    public function updateCart(Request $request, $courseId)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$courseId])) {
            $cart[$courseId]['selected_date'] = $request->input('selected_date');
            Session::put('cart', $cart);
        }

        return redirect()->route('user.cart')->with('success', 'Data kursu została zaktualizowana.');
    }

    public function removeFromCart(Request $request, $courseId)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$courseId])) {
            unset($cart[$courseId]);
            Session::put('cart', $cart);
        }

        return redirect()->route('user.cart')->with('success', 'Kurs został usunięty z koszyka.');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cartItems = Session::get('cart', []);

        foreach ($cartItems as $courseId => $item) {
            $enrollment = Enrollment::create([
                'status' => Enrollment::STATUSES[0],
                'lesson_date' => $item['selected_date'],
                'user_id' => $user->id,
            ]);

            $course = Course::find($courseId);
            foreach ($course->lessons as $lesson) {
                $enrollment->lessons()->attach($lesson->id);
            }
        }

        Session::forget('cart');

        return redirect()->route('user.profile')->with('success', 'Zostałeś zapisany na kurs.');
    }
}

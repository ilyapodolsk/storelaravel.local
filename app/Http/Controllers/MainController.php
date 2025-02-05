<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index(Request $request) {
        $movies = Movie::where('id', '<', '9')->get();
        
        if ($request->movie_id) {
            $movie_id = $request->input('movie_id');
            $cart = session()->get('cart', []);
            $cart[] = $movie_id;
            session()->put('cart', $cart);

            $movie_price = $request->input('movie_price');

            $total = session()->get('total', 0);
            $total += $movie_price;
            session()->put('total', $total);

            return redirect()->back();
        }
        return view('index', ['movies' => $movies]);
    }

    public function sort(Request $request) {
        $column = $request->input('sort', 'updated_at'); // колонка по которой сортировать
        $direction = $request->input('order', 'asc'); // условте сортировки
        $movies = Movie::orderBy($column, $direction)->where('id', '<', '9')->get();
        return view('index', ['movies' => $movies]);
    }

    public function delivery() {
        return view('delivery');
    }

    public function contacts() {
        return view('contacts');
    }

    public function section(Request $request) {
        $id = $request->input('id', 1);
        $category = Category::findOrFail($id);
        $categories = Category::orderBy('id')->get();
        $movies = Movie::orderBy('category_id')->get();
        return view('section', ['category' => $category, 'categories'=>$categories, 'movies' => $movies]);
    }

    public function sortSection(Request $request) {
        $column = $request->input('sort', 'updated_at');
        $direction = $request->input('order', 'asc');
        $id = $request->input('id');
        $category = Category::findOrFail($id);
        $movies = Movie::orderBy($column, $direction)->where('category_id', '=', $category->id)->get();
    
        return view('section', ['category' => $category,  'movies' => $movies]);
    }

    public function cart() {
        $cart = session()->get('cart', []);
        $total = session()->get('total', 0);
        $movies = [];
    
        foreach ($cart as $movie_id) {
             $movie = Movie::find($movie_id);
              if ($movie){
                    $movies[] = $movie;
                    $movies = array_unique($movies);
              }
        }
    
        return view('cart', ['total' => $total, 'movies' => $movies]);
    }

    public function update(Request $request) {
        $quantities = $request->input('quantities', []);
        $delete = $request->input('delete', []);
        $cart = session()->get('cart', []);
        $total = 0;

        $newCart = [];
    
        foreach ($quantities as $movie_id => $quantity) {
           $movie = Movie::find($movie_id);

            if ($movie) {
                  if (isset($delete[$movie_id]) || $quantity == 0) {
                    } else {
                        for ($i = 0; $i < $quantity; $i++) {
                            $newCart[] = $movie_id;
                            }
                         }
                 }
           }
        
         $cart = $newCart;

        $total = 0;
        foreach ($cart as $movie_id) {
          $movie = Movie::find($movie_id);
          if ($movie) {
            $total += $movie->price;
            }
        }

        session()->put('cart', $cart);
        session()->put('total', $total);
       return redirect()->route('cart');
    }

    public function discount(Request $request) {
        $discountCode = $request->input('discount');
        $total = session()->get('total', 0);
        $applied_coupon = session()->get('applied_coupon', false);
    
        if ($applied_coupon) {
            return redirect()->route('cart')->with('error', 'Купон уже применён!');
        }
    
        if ($discountCode) {
             $coupon = Coupon::where('name', $discountCode)->first();
    
             if (!$coupon) {
                 return redirect()->route('cart')->with('error', 'Купон не найден!');
             }
    
            $discount_sum = $total * ($coupon->procent_discount / 100);
            $discount_total = $total - $discount_sum;
    
             session()->put('total', $discount_total);
             session()->put('applied_coupon', true);
            return redirect()->route('cart')->with('success', 'Купон применён!');
        }
    
        return redirect()->route('cart');
    }

    public function order(Request $request) {
        if ($request->func) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|regex:/^(\+?[\d\s-]{3,})?[\d\s-]{7,}$/',
                'email' => 'required|email|max:255',
                'delivery' => 'required|in:0,1',
                'address' => 'required_if:delivery,==,0|max:255',
                'notice' =>'max:255',
                'g-recaptcha-response' => 'recaptcha',
            ], [
                'name.required' => 'Пожалуйста, укажите ваше имя',
                'name.max' => 'Имя не должно превышать 255 символов',
                'phone.required' => 'Пожалуйста, укажите ваш номер телефона',
                'phone.max' => 'Пожалуйста, укажите корректный номер телефона',
                'email.required' => 'Пожалуйста, укажите ваш адресс электронной почты',
                'email.email' => 'Пожалуйста, укажите корректный адресс электронной почты',
                'email.max' => 'Пожалуйста, укажите корректный адресс электронной почты',
                'delivery.required' => 'Пожалуйста, укажите способ доставки',
                'address.required' => 'Пожалуйста, укажите адресс доставки',
                'g-recaptcha-response' => 'Вы не прошли проверку Recaptcha "Я не робот"',
            ]);
            $order = new Cart();
            $order->name = $validated['name'];
            $order->phone = $validated['phone'];
            $order->email = $validated['email'];
            $order->delivery = $validated['delivery'];
            $order->address = $validated['address'];
            $order->comment = $validated['notice'];

            $movies = [];
            foreach (session('cart') as $item) {
            $movie = Movie::where('id', $item)->first();
            $movies[] = $movie->title;
            }
            $order->products = implode(', ', $movies);
            $order->price = session('total');

            $order->save();

            session()->forget('total');
            session()->forget('cart');

            return redirect()->route('addorder');
        }
        return view('order');
    }

    public function addorder() {
        return view ('addorder');
    }

    public function product(Movie $movie) {
        $movies = Movie::where('id', '!=', $movie->id)
               ->where('category_id', $movie->category_id)
               ->inRandomOrder()
               ->limit(3)
               ->get();
        $category = Category::where('id', $movie->category_id)->first();
        return view('products', ['movies' => $movies, 'movie' => $movie, 'category' => $category]);
    }

    public function search(Request $request) {
        if ($request->search_add) {
            $validated = $request->validate([
                'search_add' => 'required|string|min:3|max:100'
            ]);
            $search_add = $validated['search_add'];
            $movies = Movie::where('title', 'LIKE', "%$search_add%")
                ->orWhere('actors', 'LIKE', "%$search_add%")
                ->orWhere('description', 'LIKE', "%$search_add%")->get();
        }
        else return redirect()->route('index');
        return view('search', ['search_add' => $search_add, 'movies' => $movies]);
    }

}
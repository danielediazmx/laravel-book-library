<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowingHistory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('book.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('book.form', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book();
        $book->fill($request->only('name', 'author', 'category_id',));
        $book->save();

        return redirect('/book');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('book.form', ['book' => $book, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->fill($request->only('name', 'author', 'category_id'));
        $book->save();

        return redirect('/book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect('/book');
    }

    public function change_availability(Book $book)
    {
        BorrowingHistory::where(['status' => BorrowingHistory::STATUS_ACTIVE])->update(['status'=>BorrowingHistory::STATUS_INACTIVE]);

        Session::flash('message', "Success!");
        Session::flash('type', 'green');
        return redirect('/book');
    }

    public function request_book($id)
    {
        $user = Auth::user();
        $current_active_borrow = BorrowingHistory::where(['status' => BorrowingHistory::STATUS_ACTIVE,
            'book_id' => $id, 'user_id' => $user->id])->first();

        if ($current_active_borrow) {
            Session::flash('message', "Oops, looks like there's another person that has already borrowed this book.");
            Session::flash('type', 'red');

            return redirect('/book');
        } else {
            $borrow = new BorrowingHistory();
            $borrow->user_id = $user->id;
            $borrow->book_id = $id;
            $borrow->save();

            Session::flash('message', "Success!");
            Session::flash('type', 'green');

            return redirect('/book');
        }

    }
}
